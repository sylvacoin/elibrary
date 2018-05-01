<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Documents extends MX_Controller
{

    function __construct()
    {
	parent::__construct();
	$this->load->module('templates');
	$this->load->model('mdl_documents');
	$this->load->library('form_validation');
	$this->load->library('upload');
	if (!is_numeric($this->session->user_id)) {
	    redirect('login');
	}
    }

    /*
     * ===============PAGES================= 
     */

    function index()
    {
	$data = $this->page_settings('default', NULL, NULL, 'Default', 'documents');
	$this->templates->backend($data);
    }

    function lists()
    {
	$this->db->join('document_type', 'document_type.doctype_id = documents.type_id');
	$this->db->join('document_category d', 'd.doc_cat_id = documents.cat_id');
	$docs['documents'] = $this->mdl_documents->get('doc_id');

	$this->load->view('view', $docs);
    }

    function view($id = NULL)
    {
	$data = $this->page_settings('view_document', NULL, NULL, 'View document', 'document');
	if (is_numeric($id)) {
	    $this->db->join('document_type', 'document_type.doctype_id = documents.type_id');
	    $this->db->join('document_category d', 'd.doc_cat_id = documents.cat_id');
	    $result = $this->_get_where($id)->row();
	    $data = $this->page_settings('view-single', $result, 'result', 'View document', 'documents');
	}
	$this->templates->backend($data);
    }
    
    function is_favorite( $id )
    {
	$this->db->where(array(
	   'user_id' => $this->session->user_id,
	    'doc_id' => $id
	));
	
	return $this->db->get('fav_documents')->num_rows() > 0 ? true : false;
    }

    function read($id)
    {
	$data = $this->page_settings('view_document', NULL, NULL, 'View document', 'document');
	if (is_numeric($id)) {
	    $this->db->join('document_type', 'document_type.doctype_id = documents.type_id');
	    $result = $this->_get_where($id)->row();
	    $data = $this->page_settings('view-single_full', $result, 'result', 'View document', 'documents');
	}
	$this->templates->backend($data);
    }

    function ajax_fav_books( $remove = false )
    {
	$doc_id = $this->input->post('doc');
	
	if ( $remove ) {
	    $this->db->where(array(
		'doc_id' => $doc_id,
		'user_id' => $this->session->user_id,
	    ));

	    if ($this->db->delete('fav_documents')) {
		echo json_encode(['status'=>'success','msg'=>'book was removed from favorite list']);
	    } else {
		echo json_encode(['status'=>'failure','msg'=>'problem removing book from favorites list']);
	    }
	} else {
	    $data = array(
		'doc_id' => $doc_id,
		'user_id' => $this->session->user_id,
		'added_date' => date('d-m-Y')
	    );

	    if ($this->db->insert('fav_documents', $data)) {
		echo json_encode(['status'=>'success','msg'=>'book has been added to favorites list']);
	    } else {
		echo json_encode(['status'=>'failure','msg'=>'problem adding book to favorites list']);
		
	    }
	}
    }

    function fav_books()
    {

	$this->db->join('fav_documents fd', 'fd.doc_id = documents.doc_id');
	$this->db->join('document_category dc', 'dc.doc_cat_id = documents.cat_id');
	$this->db->join('document_type dt', 'dt.doctype_id = documents.type_id');
	$this->db->where('fd.user_id', $this->session->user_id);
	$result = $this->mdl_documents->get('fd.doc_id');
	$data = $this->page_settings('favourites', $result, 'documents', 'View document', 'documents');
	$this->templates->backend($data);
    }

    function share()
    {
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	    $user = $this->session->user_id;
	    $contacts = $this->input->post('contacts');
	    $document_id = $this->input->post('document');
	    $data = [];

	    foreach ( $contacts as $id => $selection )
	    {
		$this->db->where([
		    'ucontact_id' => $id,
		    'doc_id' => $document_id
		]);
		$rows = $this->db->get('share_document')->num_rows();
		if ($rows < 1) {
		    $data[] = array(
			'user_id' => $user,
			'ucontact_id' => $id,
			'shared_date' => date('d-m-y'),
			'doc_id' => $document_id,
		    );
		}
	    }

	    if (count($data) > 0 && $this->db->insert_batch('share_document', $data)) {
		echo json_encode(['status' => 'true', 'msg' => 'Share successful']);
	    } else {
		echo json_encode(['status' => 'false', 'msg' => 'Share not successful']);
	    }
	    die();
	} else {
	    echo json_encode(['status' => 'false', 'msg' => 'Share not successful. improper request']);
	}

	echo json_encode(['status' => 'false', 'msg' => 'Share not successful, bad validation']);
    }
    
    function shared_books()
    {
	$this->db->join('share_document sd', 'sd.doc_id = documents.doc_id');
	$this->db->join('document_category dc', 'dc.doc_cat_id = documents.cat_id');
	$this->db->join('document_type dt', 'dt.doctype_id = documents.type_id');
	$this->db->join('users u', 'u.user_id = sd.user_id');
	$this->db->where('ucontact_id', $this->session->user_id);
	$result = $this->mdl_documents->get('sd.doc_id');
	$data = $this->page_settings('favourites', $result, 'documents', 'View document', 'documents');
	$this->templates->backend($data);
    }

    function modify($id)
    {
	if ($this->form_validation->run($this, 'upload') == TRUE) {
	    $this->submit_data();
	} else {
	    $data = $this->get_access_data_from_db($id);
	    $data['view_file'] = 'default';
	    $data['id'] = $id;
	    $this->templates->backend($data);
	}
    }

    function download($id)
    {
	$path = $this->mdl_documents->get_where($id)->filepath;
	$this->load->helper('download');
	force_download('C:/xampp/htdocs/ci_oms/' . $path, NULL);
    }

    function ajax_upload_document($file)
    {
	$config['upload_path'] = './assets/uploads/documents/';
	$config['allowed_types'] = 'docx|doc|mp3|mp4|flv|avi|jpg|jpeg|png';
	$config['max_size'] = '100000';

	$this->upload->initialize($config);
	if ($this->upload->do_upload($file)) {
	    $data['file_path'] = 'assets/uploads/documents/' . $this->upload->data('file_name');
	    $data['status'] = true;
	    $data['message'] = 'File upload was successful';
	    echo json_encode($data);
	} else {

	    $data['status'] = false;
	    $data['message'] = $this->upload->display_errors();
	    echo json_encode($data);
	}
    }

    function ajax_upload_data()
    {
	//upload document
	$file = $this->upload_document('file');

	$id = $this->uri->segment(3);
	if ($file['status'] != false) {

	    //check if the doctype exxists in the database
	    $file['type_id'] = $this->get_doctypes($file['type']);

	    if ($file['type_id'] === false) {
		$this->load->model('mdl_documents_type', 'mdt');
		//if no doc type as such exists, then add a new one
		$result = $this->mdt->_insert(['doc_type' => $file['type'], 'last_added' => time()]);
		$file['type_id'] = $this->db->insert_id();
	    }

	    $filepath = $file['file_path'];
	    if (is_numeric($id)) {
		//$this->_update($id, $data);
		$_SESSION['doc_data'] = array_merge(Modules::run('parsers/parser_init', $filepath), $file);
		$vdata['doc_data'] = $this->session->doc_data;
		$vdata['status'] = true;
		$vdata['result'] = $this->load->view('upload_doc_list', $file, true);
	    } else {
		//$this->_insert($data);
		$parseData = Modules::run('parsers/parser_init', $filepath);

		$_SESSION['doc_data'] = array_merge($parseData, $file);
		$vdata['doc_data'] = $this->session->doc_data;

		$vdata['status'] = true;
		$vdata['result'] = $this->load->view('upload_doc_list', $file, true);
	    }
	} else {
	    $vdata['status'] = false;
	    $vdata['result'] = $file['message'];//print_r($_FILES);//$file['message'];
	}

	echo json_encode($vdata);
    }

    function upload_document($file)
    {
	$config['upload_path'] = './assets/uploads/documents/';
	$config['allowed_types'] = '*';
	$config['max_size'] = '100000';
	$data = [];

	$this->upload->initialize($config);
	if ($this->upload->do_upload($file)) {
	    $data['file_path'] = 'assets/uploads/documents/' . $this->upload->data('file_name');
	    $data['status'] = true;
	    $data['type'] = $this->upload->data('file_ext');
	    $data['file_size'] = $this->upload->data('file_size');
	    $data['orig_name'] = $this->upload->data('orig_name');
	    $data['enc_name'] = $this->upload->data('file_name');
	    $data['message'] = 'File upload was successful';
	} else {

	    $data['status'] = false;
	    $data['message'] = $this->upload->display_errors();
	}

	return $data;
    }

    function get_doctypes($doctype = NULL)
    {
	$this->load->model('mdl_documents_type', 'mdt');
	if ($doctype != NULL) {
	    $doctypes = $this->mdt->get_where_custom('doc_type', $doctype);
	    if ($doctypes->num_rows() > 0) {
		return $doctypes->row()->doctype_id;
	    }
	}

	return false;
    }

    function get_doc_types($doctype = NULL)
    {
	$this->load->model('mdl_documents_type', 'mdt');
	if ($doctype != NULL) {
	    $doctypes = $this->mdt->get_where_custom('doc_type', $doctype);
	    if ($doctypes->num_rows() > 0) {
		return $doctypes->row()->doctype_id;
	    }
	}
	$doctypes = $this->mdt->get('doc_type');
	return $doctypes;
    }

    function access()
    {
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	    $this->submit_access_data();
	}

	redirect('documents');
    }

    function submit_access_data()
    {

	//get data from post
	$data = $this->get_access_data_from_post();


	$id = $this->uri->segment(3);

	if (is_numeric($id)) {
	    $this->_update($id, $data);
	} else {
	    $this->_insert($data);
	    unset($_SESSION['doc_data']);
	}

	redirect('documents');
    }

    function get_access_data_from_post()
    {

	$data['title'] = $this->input->post('title');
	$data['author'] = $this->input->post('docAuthor');
	//$data['cat_id']   = if ( $this->input->post('docCategory') == NULL ) ? 
	$cat = $this->input->post('docCategory');
	$cat2 = $this->input->post('docCategory2');
	if ($cat == NULL && $cat2 != NULL) {
	    Modules::run('category/quick_insert', $cat2);
	    $data['cat_id'] = $this->db->insert_id;
	} else {
	    $data['cat_id'] = $cat;
	}

	//check if th file has an edition
	if ($this->input->post('docHasEdition') == 'true') {
	    $data['edition'] = $this->input->post('edition');
	}

	if (!is_numeric($this->uri->segment(3))) {
	    //file info
	    $data['file_size'] = $_SESSION['doc_data']['file_size'];
	    $data['tags'] = $_SESSION['doc_data']['content'];
	    $data['url'] = $_SESSION['doc_data']['file_path'];
	    $data['orig_name'] = $_SESSION['doc_data']['orig_name'];
	    $data['enc_name'] = $_SESSION['doc_data']['orig_name'];
	    $data['screenshot_path'] = $this->input->post('screenshot');
	    $data['type_id'] = $_SESSION['doc_data']['type_id'];
	    $data['date_added'] = time();
	}
	return $data;
    }

    function get_access_data_from_db($id)
    {
	//check what access level the filee is using and serialize access_ids of users allowed to use file
	$returned = $this->mdl_documents->get_where($id)->row();

	$data['docContact'] = serialize($returned->access_ids);
	$data['docAccessibility'] = $returned->access_level;
	$data['docTitle'] = $returned->title;
	$data['docAuthor'] = $returned->author;
	$data['docCategory'] = $returned->cat_id;
	$data['docEdition'] = $returned->edition;
	$data['docHasEdition'] = $returned->edition != NULL ? 1 : 0;
	$data['docHasPswd'] = $returned->is_pswd;

	return $data;
    }

    function search_page()
    {
	$data = $this->page_settings('search', NULL, NULL, 'Search for books', 'documents');
	$this->templates->backend($data);
    }

    function ajax_search()
    {
	$col = $this->input->post('col');
	$val = $this->input->post('val');

	if ($col == NULL && $val == NULL) {
	    echo json_encode(array('status' => false));
	    return;
	}


	switch ( $col )
	{
	    case 'doc_filter_author':
		$this->db->like('author', $val);
		break;
	    case 'doc_filter_subject':
		$this->db->like('title', $val);
		break;
	    case 'doc_filter_content':
		$this->db->like('tags', $val);
		break;
	    default:
		$this->db->like('tags', $val);
		break;
	}

	$result = $this->mdl_documents->get();
	echo json_encode($result);
    }

    function search()
    {
	if ($_SERVER['REQUEST_METHOD'] == "POST" && $this->input->post('doc_filter_col') != NULL) {

	    $col_request = $this->input->post('doc_filter_col');
	    if ($col_request == 'doc_filter_subject' && $this->input->post('doc_filter_value') != NULL) {
		$where = ['title' => $this->input->post('doc_filter_value')];
		$this->db->like($where);
	    } elseif ($col_request == 'doc_filter_author' && $this->input->post('doc_filter_value') != NULL) {
		$where = ['author' => $this->input->post('doc_filter_value')];
		$this->db->like($where);
	    } elseif ($col_request == 'doc_filter_type' && $this->input->post('doc_types') != NULL) {
		$where = ['type_id' => $this->input->post('doc_types')];
		$this->db->where($where);
	    } elseif ($col_request == 'doc_filter_doc_date' && $this->input->post('doc_date_start') != NULL && $this->input->post('doc_date_stop') != NULL) {
		$t1 = strtotime($this->input->post('doc_start_date'));
		$t2 = strtotime($this->input->post('doc_stop_date'));
		$max_time = max([ $t1, $t2]);
		$min_time = min([ $t1, $t2]);

		$where = [
		    'date_added >' => $min_time,
		    'date_added <' => $max_time];
		$this->db->where($where);
	    } elseif ($col_request == 'doc_filter_content' && $this->input->post('doc_filter_value') != NULL) {
		$match = ['tags' => $this->input->post('doc_filter_value')];
		$this->db->like($match);
	    } else {
		$where = ['title' => $this->input->post('doc_filter_value')];
		$this->db->like($where);
	    }
	    $data = $this->page_settings('search', 'Search Result(s)');
	    $this->db->join('document_type', 'document_type.doctype_id = documents.type_id');
	    $data['result'] = $this->mdl_documents->get('');
	    $this->templates->backend($data);
	}
    }

    /*
     * PRIVATE FUNCTIONS
     */

    private function _insert($data)
    {
	if ($this->mdl_documents->_insert($data)) {
	    $this->session->set_flashdata('success', 'Document was added successfully');
	} else {
	    $this->session->set_flashdata('error', 'Document was not added');
	}
    }

    private function _update($id, $data)
    {
	if ($this->mdl_documents->_update($id, $data)) {
	    $this->session->set_flashdata('success', 'Document was updated successfully');
	} else {
	    $this->session->set_flashdata('error', 'Document was not updated');
	}
    }

    private function _get_where($id)
    {
	$this->load->model('mdl_documents');
	$query = $this->mdl_documents->get_where($id);
	return $query;
    }

    function delete($id)
    {
    	$item = $this->mdl_documents->get_where($id)->row()->url;
		if ($this->mdl_documents->_delete($id)) {
		    unlink($item);
		    $this->session->set_flashdata('success', 'Document was Deleted successfully');
		} else {
		    $this->session->set_flashdata('error', 'Document was not deleted');
		}
		redirect('documents');
    }

    /*
     * PAGE SETTINGS
     * ========================================================================
     */

    function page_settings($view_file, $view_data, $data_name = 'result', $page_title = NULL, $model = NULL)
    {
	if ($data_name == NULL) {
	    $data = $view_data;
	} else {
	    $data[$data_name] = $view_data;
	}
	$data['view_file'] = $view_file;
	$data['page_title'] = $page_title;
	if ($model != NULL) {
	    $data['module'] = $model;
	}
	return $data;
    }

    function debug($array)
    {
	echo '<pre>' . print_r($array, 1) . '</pre>';
	die();
    }

}
