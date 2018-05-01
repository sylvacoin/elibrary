<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MX_Controller
{

    public function __construct()
    {
	parent::__construct();
	$this->load->module('templates');
	//Modules::run('settings/is_userlogged');
    }

    /*
     *  SITE PAGES
     */

    function index()
    {
	$data = $this->page_settings('settings', $this->get_system_data_from_db(), NULL, 'Site settings', 'settings');
	$this->templates->backend($data);
    }

    function update($param = '')
    {
	if ($param == 'do_update') {
	    $data['description'] = $this->input->post('name');
	    $this->db->where('type', 'system_name');
	    $this->db->update('settings', $data);

	    $data['description'] = $this->input->post('title');
	    $this->db->where('type', 'school_name');
	    $this->db->update('settings', $data);

	    $data['description'] = $this->input->post('address');
	    $this->db->where('type', 'address');
	    $this->db->update('settings', $data);

	    $data['description'] = $this->input->post('phone');
	    $this->db->where('type', 'school_contact_phone');
	    $this->db->update('settings', $data);

	    $data['description'] = $this->input->post('system_email');
	    $this->db->where('type', 'schoool_support_email');
	    $this->db->update('settings', $data);

	    $data['description'] = $this->input->post('term');
	    $this->db->where('type', 'curr_term');
	    $this->db->update('settings', $data);

	    $data['description'] = $this->input->post('session');
	    $this->db->where('type', 'curr_session');
	    $this->db->update('settings', $data);

	    $data['description'] = $this->input->post('use_count');
	    $this->db->where('type', 'scratch_card_max_use');
	    $this->db->update('settings', $data);

	    $data['description'] = $this->input->post('login_type');
	    $this->db->where('type', 'login_type');
	    $this->db->update('settings', $data);

	    $data['description'] = $this->input->post('login_type') == 'DEFAULT' ? 'FALSE' : $this->input->post('pin');
	    $this->db->where('type', 'use_scratch_card');
	    $this->db->update('settings', $data);

	    $this->session->set_flashdata('success', 'Settings were updated successfully');
	    redirect(base_url() . 'settings/', 'refresh');
	}

	if ($param == 'do_upload') {
	    $status = Modules::run('upload_manager/upload', 'userfile', 'logo', '.png');
	    if ($status != false) {
		$data['description'] = $status;
		$this->db->where('type', 'logo');
		$this->db->update('settings', $data);

		$this->session->set_flashdata('success', 'Logo was uploaded successfully');
		redirect(base_url() . 'settings/', 'refresh');
	    }
	}

	if ($param == 'do_upload_wallpaper') {
	    $status = Modules::run('upload_manager/upload', 'wallpaper_file', 'wallpaper', '.jpg', true, 1350, 260);
	    //echo '<pre>'.print_r($status, 1).'</pre>' ;
	    //die();
	    if ($status != false) {
		$data['description'] = $status;
		$this->db->where('type', 'school_wallpaper');
		$this->db->update('settings', $data);

		$this->session->set_flashdata('success', 'wallpaper was uploaded successfully');
		redirect(base_url() . 'settings/', 'refresh');
	    }
	}

	if ($param == 'change_skin') {
	    $data['description'] = $this->input->get('skin');
	    $this->db->where('type', 'skin_colour');
	    $this->db->update('settings', $data);
	    $this->session->set_flashdata('success', 'theme selected');
	    redirect(base_url() . 'settings/', 'refresh');
	}

	redirect(base_url() . 'settings/', 'refresh');
    }

    function is_userlogged()
    {
	if (!isset($this->session->role) || !is_numeric($this->session->user_id)) {
	    redirect('login?redirect='. current_url());
	}
    }

    /*
     *  HELPER FUNCTIONS
     */

// do not delete, Configures the page

    function get_system_data_from_post()
    {
	$data['system_name'] = $this->input->post('name');
	$data['school_name'] = $this->input->post('title');
	$data['address'] = $this->input->post('address');
	$data['school_contact_phone'] = $this->input->post('phone');
	$data['school_support_email'] = $this->input->post('system_email');
	$data['curr_term'] = $this->input->post('term');
	$data['curr_session'] = $this->input->post('session');
	$data['login_type'] = $this->input->post('login_type');
	$data['pin'] = $this->input->post('use_scratch_card');
	$data['use_count'] = $this->input->post('scratch_card_max_use');

	return $data;
    }

    private function get_system_data_from_db()
    {
	$data['name'] = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
	$data['title'] = $this->db->get_where('settings', array('type' => 'school_name'))->row()->description;
	$data['address'] = $this->db->get_where('settings', array('type' => 'address'))->row()->description;
	$data['phone'] = $this->db->get_where('settings', array('type' => 'school_contact_phone'))->row()->description;
	$data['system_email'] = $this->db->get_where('settings', array('type' => 'school_support_email'))->row()->description;
	$data['term'] = $this->db->get_where('settings', array('type' => 'curr_term'))->row()->description;
	$data['session'] = $this->db->get_where('settings', array('type' => 'curr_session'))->row()->description;
	$data['login_type'] = $this->db->get_where('settings', array('type' => 'login_type'))->row()->description;
	$data['pin'] = $this->db->get_where('settings', array('type' => 'use_scratch_card'))->row()->description;
	$data['use_count'] = $this->db->get_where('settings', array('type' => 'scratch_card_max_use'))->row()->description;
	return $data;
    }
    
    public function get_systemInfo( $type = NULL )
    {
	if ( $type == NULL ) {
	    return $this->get_system_data_from_db();
	}
	
	return $this->db->get_where('settings', array('type' => $type))->row()->description;
    }

    /*
     *  CRUD Operations
     */

    //gets all the information from db
    function get($order_by = '')
    {
	$query = $this->mdl_settings->get($order_by);
	return $query;
    }

    function get_with_limit($limit, $offset, $order_by)
    {
	$this->load->model('mdl_settings');
	$query = $this->mdl_settings->get_with_limit($limit, $offset, $order_by);
	return $query;
    }

    function get_where($id)
    {
	$this->load->model('mdl_settings');
	$query = $this->mdl_settings->get_where($id);
	return $query;
    }

    function get_where_custom($col, $value)
    {
	$this->load->model('mdl_settings');
	$query = $this->mdl_settings->get_where_custom($col, $value);
	return $query;
    }

    function _insert($data)
    {
	$this->load->model('mdl_settings');
	$this->mdl_settings->_insert($data);
    }

    function _update($id, $data)
    {
	$this->load->model('mdl_settings');
	$this->mdl_settings->_update($id, $data);
    }

    function _delete($id)
    {
	$this->load->model('mdl_settings');
	$this->mdl_settings->_delete($id);
    }

    function count_where($column, $value)
    {
	$this->load->model('mdl_settings');
	$count = $this->mdl_settings->count_where($column, $value);
	return $count;
    }

    function get_max()
    {
	$this->load->model('mdl_settings');
	$max_id = $this->mdl_settings->get_max();
	return $max_id;
    }

    function _custom_query($mysql_query)
    {
	$this->load->model('mdl_settings');
	$query = $this->mdl_settings->_custom_query($mysql_query);
	return $query;
    }

    /*
     * PAGE SETTINGS
     * ========================================================================
     */

    function page_settings($view_file, $view_data, $data_name = 'result', $page_title = NULL, $module = NULL)
    {
	if ($data_name == NULL) {
	    $data = $view_data;
	} else {
	    $data[$data_name] = $view_data;
	}
	$data['view_file'] = $view_file;
	$data['page_title'] = $page_title;
	if ($module != NULL) {
	    $data['module'] = $module;
	}
	return $data;
    }

    function debug($array)
    {
	echo '<pre>' . print_r($array, 1) . '</pre>';
	die();
    }

}
