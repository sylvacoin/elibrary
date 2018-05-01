<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends MX_Controller
{

    function __construct()
    {
	parent::__construct();
	//load models
	$this->load->model(['mdl_users', 'mdl_all']);
	$this->load->library(['form_validation']);
	//load all necessary helpers for this class
	$this->load->helper(['array']);

	//load the template
	$this->load->module(['templates', 'security']);
    }

    /*
     *  CONTROLLER PAGES
     * ========================================================================
     */

    function index()
    {
	$data = $this->page_settings('default', NULL, NULL, 'Users', 'users');
	$this->templates->backend($data);
    }

    function signup()
    {
	if ($this->form_validation->run($this, 'signup') == TRUE) {
	    $this->_submit_data();
	}

	//$this->load->view('add');

	$data = $this->page_settings('add', NULL, NULL, 'Add Users', 'users');
	$this->templates->backend($data);
    }

    function edit($id = NULL)
    {
	if ($this->form_validation->run($this, 'profile') == TRUE) {
	    $this->_submit_data();
	}
	$result = $this->_get_data_from_db($id);
	$data = $this->page_settings('default', $result, NULL, 'Edit Profile', 'users');
	$this->templates->backend($data);
	//$this->load->view('default',$result);
    }

    function view($id = NULL)
    {
	//if id is not numeric then its not a specific item. get everything
	if (!is_numeric($id)) {
	    $result = $this->_get('user_id');
	    $data = $this->page_settings('view', $result, 'users', 'View users', 'users');
	} else {
	    $result = $this->_get_where($id);
	    $data = $this->page_settings('view_single', $result->row(), 'user', 'View user', 'users');
	}
	//$this->load->view('view', $result);
	$this->templates->backend($data);
    }
    
    function profile()
    {
	$id = $this->session->user_id;
	$result = $this->_get_where($id);
	$data = $this->page_settings('profile', $result->row(), 'user', 'My profile', 'users');
	$this->templates->backend($data);
    }

    function delete($id = NULL)
    {
	if (is_numeric($id)) {
	    $this->_delete($id, 'mdl_users');
	}

	if ($this->input->get('redirect')) {
	    redirect($this->input->get('redirect'));
	}
    }

    private function insert_contact($data)
    {
	if ($this->db->insert('contacts', $data)) {
	    $this->session->set_flashdata('success', 'Contact request was sent successfully');
	} else {
	    $this->session->set_flashdata('error', 'Contact request was not sent please try again');
	}
	redirect('contacts');
    }

    private function update_contact($data)
    {
	if ($this->db->update('contacts', $data)) {
	    $this->session->set_flashdata('success', 'Contact request was accepted successfully');
	} else {
	    $this->session->set_flashdata('error', 'Contact request was not accepted please try again');
	}
	redirect('my-contacts');
    }

    private function delete_contact($id)
    {
	$this->db->where('ucontact_id', $id);
	if ($this->db->delete('contacts')) {
	    $this->session->set_flashdata('success', 'Contact request was deleted successfully');
	} else {
	    $this->session->set_flashdata('error', 'Contact request was not deleted please try again');
	}
	redirect('my-contacts');
    }

    function contacts($id = NULL)
    {
	if (is_numeric($id)) {
	    $data['ucontact_id'] = $id;
	    $data['user_id'] = $this->session->user_id;
	    $data['date_added'] = date('d-m-y');
	    $this->insert_contact($data);
	}

	if ($this->form_validation->run($this, 'search_contacts')) {
	    $this->db->where('is_admin', 0);
	    $this->db->like('username', $this->input->post('entry'));
	    $this->db->or_like('email', $this->input->post('entry'));
	    $users = $this->mdl_users->get('user_id');
	    $data = $this->page_settings('contacts', $users, 'users', 'Search contact(s)', 'users');
	} else {
	    $data = $this->page_settings('contacts', NULL, NULL, 'Search contact(s)', 'users');
	}

	$this->templates->backend($data);
    }

    function contacts_request($id = NULL, $accept = true)
    {
	if (is_numeric($id)) {
	    $data['contact_req_status'] = 1;
	    $this->db->where('ucontact_id', $this->session->user_id);
	    $this->db->where('user_id', $id);

	    if ($accept) {
		$this->update_contact($data);
	    } else {
		$this->delete_contact($id);
	    }
	}

	$data = $this->page_settings('default', NULL, NULL, 'contact request', 'users');

	$this->templates->backend($data);
    }

    function requests()
    {
	$this->db->join('users u', 'u.user_id = contacts.user_id');
	$this->db->where('contacts.ucontact_id', $this->session->user_id);
	$this->db->where('contact_req_status', 0);

	$data['users'] = $this->db->get('contacts')->result();
	$this->load->view('contacts_1', $data);
    }

    function pending_requests()
    {
	$this->db->join('users u', 'u.user_id = contacts.ucontact_id');
	$this->db->where('contacts.user_id', $this->session->user_id);
	$this->db->where('contact_req_status', 0);
	$data['users'] = $this->db->get('contacts')->result();
	$this->load->view('contacts_1', $data);
    }

    private function get_name($id)
    {
	$res = $this->_get_where($id);
	return $res->row();
    }

    function my_contact_list()
    {
	$this->db->where('contacts.user_id', $this->session->user_id);
	$this->db->or_where('contacts.ucontact_id', $this->session->user_id);
	$this->db->where('contact_req_status', 1);
	$data = [];
	$users = $this->db->get('contacts')->result();

	foreach ( $users as $u )
	{
	    if ($u->user_id == $this->session->user_id) {
		$res = $this->get_name($u->ucontact_id);
	    } else {
		$res = $this->get_name($u->user_id);
	    }
	    $data[] = (object) array(
		'firstname' => $res->firstname,
		'lastname' => $res->lastname,
		'email' => $res->email,
		'phone' => $res->phone,
		'is_admin' => $res->is_admin,
		'username' => $res->username,
		'user_id' => $res->user_id,
		
	    );
	}

	$data = $this->page_settings('contacts', $data, 'users', 'My contacts', 'users');

	$this->templates->backend($data);
    }

    function get_contacts()
    {
	$this->db->where('contacts.user_id', $this->session->user_id);
	$this->db->or_where('contacts.ucontact_id', $this->session->user_id);
	$this->db->where('contact_req_status', 1);
	$data = [];
	$users = $this->db->get('contacts')->result();

	foreach ( $users as $u )
	{
	    if ($u->user_id == $this->session->user_id) {
		$res = $this->get_name($u->ucontact_id);
	    } else {
		$res = $this->get_name($u->user_id);
	    }
	    $data[] = (object) array(
		'firstname' => $res->firstname,
		'lastname' => $res->lastname,
		'email' => $res->email,
		'phone' => $res->phone,
		'is_admin' => $res->is_admin,
		'username' => $res->username,
		'user_id' => $res->user_id
	    );
	}
	$d['users'] = $data;
	$this->load->view('contact-list', $d);
    }

    /*
     * AJAX FUNCTIONS
     * ========================================================================
     */

    function ajax_add()
    {
	if ($this->form_validation->run($this, 'users') == TRUE) {
	    //get data from post
	    $data = $this->_get_data_from_post();
	    $return = [];
	    //$data['photo'] = Modules::run('upload_manager/upload','image');

	    $return['status'] = $this->mdl_users->_insert($data) ? TRUE : FALSE;
	    $return['msg'] = $data['status'] ? NULL : 'An error occured trying to insert data please try again';
	    $return['node'] = [
		'users' => $data['users'],
		'slug' => $data['users_slug'],
		'id' => $this->db->insert_id()
	    ];


	    echo json_encode($return);
	}
    }

    function ajax_view()
    {
	$result = $this->_get('user_id');
	if (count($result) > 0) {
	    foreach ( $result as $col )
	    {
		//do the extraction here and assign to $data
		$data[] = ['users' => $col->users, 'id' => $col->user_id, 'slug' => $col->users_slug];
	    }
	}

	echo json_encode($data);
    }

    function ajax_validate_data()
    {
	/*
	 * validates an item using type. like validating ann email or a username if it exists
	 * @return bool
	 */
	$item = $this->input->post('item');
	$type = $this->input->post('type');
	$result = $this->_get_where_custom($type, $item)->result();
	if (count($result) > 0) {
	    echo json_encode(['status' => FALSE]);
	} else {
	    echo json_encode(['status' => TRUE]);
	}
    }

    function ajax_view_children()
    {
	$id = $this->input->post('user_id'); //change this to match your data-id from ajax call
	if (!is_numeric($id)) {
	    echo json_encode(['status' => FALSE]);
	    return;
	}

	$result = $this->_get_where_custom('parent_id', $id)->result();
	if (count($result) > 0) {
	    foreach ( $result as $col )
	    {
		//do the extraction here and assign to $data
		$data[] = ['users' => $col->users, 'id' => $col->user_id, 'slug' => $col->users_slug];
	    }
	}

	echo json_encode($data);
    }

    function ajax_delete($id)
    {
	//$id = $this->input->get( 'user_id' ); //change this to match your data-id from ajax call
	if (!is_numeric($id)) {
	    echo json_encode(['status' => FALSE]);
	    return;
	}

	if ($this->mdl_users->_delete($id)) {
	    echo json_encode(['status' => TRUE]);
	} else {
	    echo json_encode(['status' => FALSE]);
	}
    }

    function ajax_edit()
    {
	$id = $this->input->post('id');
	$data['users'] = $this->input->post('users');
	$data['parent_id'] = $this->input->post('parent');

	$return = ['status' => FALSE];
	if (is_numeric($id)) {
	    $return['status'] = $this->mdl_users->_update($id, $data) ? TRUE : FALSE;
	    $return['msg'] = $data['status'] ? NULL : 'An error occured trying to update data please try again';
	}
	echo json_encode($return);
    }

    /*
     * CRUD
     * =========================================================================
     */

    function _get($order_by, $model = 'mdl_users')
    {
	$query = $this->$model->get($order_by);
	return $query;
    }

    function _get_with_limit($limit, $offset, $order_by, $model = 'mdl_users')
    {
	$query = $this->$model->get_with_limit($limit, $offset, $order_by);
	return $query;
    }

    function _get_where($id, $model = 'mdl_users')
    {
	$query = $this->$model->get_where($id);
	return $query;
    }

    function _get_where_custom($col, $value, $model = 'mdl_users')
    {
	$query = $this->$model->get_where_custom($col, $value);
	return $query;
    }

    function _insert($data, $model = 'mdl_users')
    {
	if ($this->$model->_insert($data)) {
	    $this->session->set_flashdata('success', 'Data was added successful');
	} else {
	    $this->session->set_flashdata('error', 'Data was not added successful please try again later');
	}
    }

    function _update($id, $data, $model = 'mdl_users')
    {

	if ($this->$model->_update($id, $data)) {
	    $this->session->set_flashdata('success', 'users was updated successfully');
	} else {
	    $this->session->set_flashdata('error', 'users not updated please try again later');
	}
    }

    function _delete($id, $model = 'mdl_users')
    {
	if ($this->$model->_delete($id)) {
	    $this->session->set_flashdata('success', 'Data was deleted successfully');
	} else {
	    $this->session->set_flashdata('error', 'Data was not deleted successfully please try again later');
	}
	if ($model == 'mdl_users') {
	    redirect('users');
	}
    }

    function _count_where($column, $value, $model = 'mdl_users')
    {
	$count = $this->$model->count_where($column, $value);
	return $count;
    }

    function _get_max($model = 'mdl_users')
    {
	$max_id = $this->$model->get_max();
	return $max_id;
    }

    function _custom_query($mysql_query, $model = 'mdl_users')
    {
	$query = $this->$model->_custom_query($mysql_query);
	return $query;
    }

    /*
     * WIDGETS
     * ========================================================================
     */

    function get_biz_profile()
    {
	$id = $this->session->user_id;
	return $this->_get_bizdata_from_db($id, 'mdl_marketers_info');
    }

    function update_last_seen()
    {
	$id = $this->session->user_id;
	$this->db->where('user_id', $id);
	return $this->db->update('users', ['last_seen' => date('Y-m-d H:i:s')]);
    }

    /*
     * HELPERS
     * ========================================================================
     */

    function _get_data_from_post($type = 'user')
    {
	$pswd = $this->input->post('pswd');
	$data['firstname'] = $this->input->post('fname');
	$data['lastname'] = $this->input->post('lname');
	$data['username'] = $this->input->post('uname');
	$data['pword'] = $this->security->encrypt($pswd);

	$data['email'] = $this->input->post('email');
	$data['phone'] = $this->input->post('phone');

//	$data['lastname'] = $this->input->post('lname');
//	$data['lastname'] = $this->input->post('lname');
	return $data;
    }

    function _get_data_from_db($id = NULL, $model = 'mdl_users')
    {
	$returned = $this->$model->get_where($id)->row();

	$data['fname'] = $returned->firstname;
	$data['lname'] = $returned->lastname;
	$data['uname'] = $returned->username;
	$data['email'] = $returned->email;
	$data['phone'] = $returned->phone;
	$data['photo'] = $returned->image;
	$data['reg_date'] = time();

	//$data['photo'] = $returned->image;
	return $data;
    }

    function _get_bizdata_from_db($id = NULL, $model = 'mdl_marketers_info')
    {
	$returned = $this->$model->get_where($id)->row();

	$data['email'] = $returned->email;
	$data['phone'] = $returned->phone;

	$data['bname'] = $returned->business_name;
	$data['btype'] = $returned->is_company;
	$data['state'] = $returned->state_id;
	$data['country'] = $returned->country_id;
	$data['lga'] = $returned->lga;
	$data['town'] = $returned->town;
	$data['addr'] = $returned->address;
	$data['photo'] = $returned->logo;
	$data['description'] = $returned->description;
	$data['website'] = $returned->website;
	//$data['photo'] = $returned->image;
	return $data;
    }

    function _submit_data()
    {
	//get data from post
	$data = $this->_get_data_from_post();
	//$this->debug($_FILES);
	if (isset($_FILES['photo']) && $_FILES['photo']['name'] != NULL) {
	    $data['image'] = Modules::run('upload_manager/upload', 'photo', 'profile');
	}

	$id = $this->uri->segment(3) == 'edit' ? $this->session->user_id : '';
	if (is_numeric($id)) {
	    $this->_update($id, $data);
	    Modules::run('auth/create_session', $this->session->user_id);
	    redirect($this->uri->segment(3) == 'edit' ? 'users/profile' : 'users');
	} else {
	    $this->_insert($data);
	    redirect('login');
	}
    }

    function _submit_biz_data()
    {
	//get data from post
	$data = $this->_get_data_from_post('business');
	//$this->debug($_FILES);
	if ($_FILES['photo']['name'] != NULL) {
	    $data['logo'] = Modules::run('upload_manager/upload', 'photo', 'biz');
	}

	$id = $this->uri->segment(3) == 'edit' ? $this->session->user_id : '';
	if (is_numeric($id)) {
	    $this->_update($id, $data, 'mdl_marketers_info');
	    //Modules::run('auth/create_session', $this->session->user_id);
	    redirect($this->uri->segment(3) == 'edit' ? 'users/profile' : 'users');
	} else {
	    $this->_insert($data, 'mdl_marketers_info');
	    //redirect('login');
	}
    }

    function get_dropdown_option($name, $selected, $extra, $where = NULL, $model = 'mdl_users')
    {
	$data = [];
	if ($where != NULL) {
	    $this->db->where($where);
	    $data = $this->$model->get();
	} else {
	    $data = $this->$model->get();
	}
	if (count($data) > 0) {
	    $options[NULL] = '--choose--';
	    foreach ( $data as $datum )
	    {
		$options[$datum->user_id] = $datum->users;
	    }
	} else {
	    $options[] = 'No option has been added';
	}
	return form_dropdown($name, $options, $selected, $extra);
    }

    function get_walletBalance()
    {
	return $this->_get_where($this->session->user_id)->row()->balance;
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
