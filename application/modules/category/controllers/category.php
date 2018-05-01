<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Category extends MX_Controller
{

    function __construct() {
        parent::__construct();
        $this->load->module('templates');
        $this->load->model('mdl_category');
    }

/*
 * ===============PAGES================= 
 */
    function add(){        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->submit_data();
        }
        
        $data= $this->page_settings( 'add_category', 'Add Category', 'category' );
        $this->templates->backend($data);
    }

    function view( $id = NULL ){
	$data= $this->page_settings( 'view_category', 'View category', 'category' );
	if ( is_numeric( $id ) )
	{
	    $data['result'] = $this->get_where($id)->row();
	}
	
        
        $this->templates->backend($data); 
    }
    
    function submit_data(){
        //get data from post
        $data = $this->get_data_from_post();
        
        $id = $this->uri->segment(3);
	if (is_numeric($id)){
	    $this->_update($id, $data);
	}else{
	    $this->_insert($data);
	}
        //redirect('category/add');
    }
    
    function get_doc_types( $doctype = NULL ){
        $this->load->model('mdl_category_type', 'mdt');
        if ( $doctype != NULL ) {
            $doctypes = $this->mdt->get_where_custom('doc_type', $doctype);
            if ( $doctypes->num_rows() > 0 )
            {
                return $doctypes->row()->doctype_id;
            }
        }
	$doctypes = $this->mdt->get('doc_type');
        return $doctypes;
        
    }
    
    function get_count(){   
        return $this->mdl_category->count_all();
    }
    
    // do not delete, Configures the page
    function page_settings( $view_file, $page_title, $module = '' )
    {
        $data[ 'view_file' ] = $view_file;
        $data[ 'page_title' ] = $page_title;
        if ( $module != '' ) {
            $data[ 'module' ] = $module;
        }
        return $data;
    }
 
    function edit($id){
        if ($this->form_validation->run($this, 'upload') == TRUE) {
            $this->submit_data();
        }else{
        $data = $this->get_profile_from_db($id);
        $data['view_file'] = 'access_pdf';
        $this->templates->backend($data);
        }
    }
    
    function lists(){
	$data['category'] = $this->mdl_category->get('doc_id');
        $data['view_file'] = 'view_category';
        $this->templates->backend($data);
    }

    /*
 * ===============END OF PAGES================= 
 */

/*
 * ===============START OF FUNCTION================= 
 */
    function get_data_from_post(){
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['type'] = $this->input->post('type');
        return $data;
    }
    
    function get_profile_from_db($id){
        $returned = $this->mdl_category->get_where($id);
        $data['title'] = $returned->title;
        $data['description'] = $returned->description;
        $data['type'] = $returned->type;
        return $data;
    }
    
    function quick_insert($catname){
	$res = $this->mdl_category->get_where_custom('doc_category', $catname);
	
	if ($res->num_rows() > 0 )
	{
	    return $res->row()->doc_cat_id;
	}
	
	$data['doc_category'] = $catname;
	$data['last_added'] = time();
	$this->mdl_category->_insert($data);
	return $this->db->insert_id();
	
    }

    /*
 * ===============END OF FUNCTIONS================= 
 */

function get($order_by) {
$this->load->model('mdl_category');
$query = $this->mdl_category->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_category');
$query = $this->mdl_category->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_category');
$query = $this->mdl_category->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
    $this->load->model('mdl_category');
    $query = $this->mdl_category->get_where_custom($col, $value);
    return $query;
}

    function _insert($data) {
        if ($this->mdl_category->_insert($data)){
            $this->session->set_flashdata('success', 'Document was added successfully');
        }else{
            $this->session->set_flashdata('error', 'Document was not added');
        }
    }

    function _update($id, $data) {
        if ($this->mdl_category->_update($id, $data)){
            $this->session->set_flashdata('success', 'Document was updated successfully');
        }else{
            $this->session->set_flashdata('error', 'Document was not updated');
        }
    }

    function delete($id) {
        if ($this->mdl_category->_delete($id)){
			unlink($this->session->filepath);
			unset($this->session->filepath);
            $this->session->set_flashdata('success', 'Document was Deleted successfully');
        }else{
            $this->session->set_flashdata('error', 'Document was not deleted');
        }
        redirect('category/view');
    }
    
    function get_dropdown( ) {
        $data = [];
        $lists = $this->get('id');
        foreach ( $lists as $option) {
            $data[ $option->doc_cat_id ] = $option->doc_category;
        }
        return $data;
    }
    
    function get_ajax_dropdown( ) {
        
	$id = is_numeric( $this->input->post('id')) ? $this->input->post('id'): '';
	$options = '<option value="">Choose...</option>';
        $lists = $this->get('doc_cat_id');
        foreach ( $lists as $option) {
	    $checked = '';
	    if ( is_numeric( $id ) )
	    {
		$checked = $id == $option->doc_cat_id ? 'selected ="selected"': '';
	    }
	    
	    $options .= '<option value="'.$option->doc_cat_id.'"'.$checked.'>'.$option->doc_category .'</option>';
        }
        echo $options;
    }

function count_where($column, $value) {
$this->load->model('mdl_category');
$count = $this->mdl_category->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_category');
$max_id = $this->mdl_category->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_category');
$query = $this->mdl_category->_custom_query($mysql_query);
return $query;
}

}

