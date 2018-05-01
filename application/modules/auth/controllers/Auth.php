<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MX_Controller
{

    public function __construct()
    {
	parent::__construct();
	$this->load->module(['templates','security']);
	$this->load->model('mdl_auth');
	
    }

    /*
     *  SITE PAGES
     */

    function index()
    {
	$this->login();
    }

    function qr_scanner()
    {
	$this->load->view('qr-scanner');
    }
    
    /*
     * Postutme applcation area
     */
    function putme()
    {
	if ( $this->form_validation->run($this, 'putme')  == TRUE ):
	    if ($this->input->get('redirect') != NULL) {
                redirect($this->input->get('redirect'), 'refresh');
            }else{
                redirect('dashboard/', 'refresh');
            }
	endif;
	
	$data = $this->page_settings('putme', NULL, NULL, 'POST UTME SCREENING', 'auth');
	$this->templates->backend($data);
    }
    
    /*
     * log in section for students.
     */
    function login()
    {
	if ( $this->form_validation->run($this, 'login')  == TRUE ):
	    if ($this->input->get('redirect') != NULL) {
		$url = urldecode($this->input->get('redirect'));
                redirect($url, 'refresh');
            }else{
                redirect('dashboard/', 'refresh');
            }
	endif;
	
	$data = $this->page_settings('default_login', NULL, NULL, 'LOGIN USER', 'auth');
	$this->templates->backend($data);
    }
    
    /*
     * log in section for administrators.
     */
    function backend()
    {
	if ( $this->form_validation->run($this, 'backend')  == TRUE ):
	    
	    if ($this->input->get('redirect') != NULL) {
		$url = urldecode($this->input->get('redirect'));
                redirect($url, 'refresh');
            }else{
                redirect('dashboard/', 'refresh');
            }
	endif;
	
	$data = $this->page_settings('default_login', NULL, NULL, 'LOGIN ADMINISTRATOR', 'auth');
	$this->templates->backend($data);
    }

    function forgot_password()
    {
	$data = $this->page_settings('forgot_password', NULL, NULL, 'Forgot Password', 'auth');
	$this->templates->backend($data);
    }

    function authenticate_login( $user )
    {
	//prep data for request | filter for xss attack
	$pword = $this->input->post('pswd');
	
	//check if user with credential exists
	$credential = array('email'=> $user, 'pword'=> $this->security->encrypt($pword) );
        $this->db->where( $credential );
        $result = $this->mdl_auth->get();
        
        if ($result->num_rows() > 0){
            $this->create_session($result->row()->user_id);
            return TRUE;
        }else{
            $this->form_validation->set_message('authenticate_login','Invalid email or password '. $pword.' '.$user);
            return FALSE;
        }
    }
    
    function authenticate_putme( $regno )
    {
	//check if user with credential exists
        $this->db->where('jamb_reg',$regno);
        $result = $this->mdl_auth->get();
	
        if ($result->num_rows() > 0){
            $this->create_session($result->row()->user_id, 'PUTME');
            return TRUE;
        }else{
            $this->form_validation->set_message('authenticate_putme','Invalid username or password');
            return FALSE;
        }
    }
    
    function create_session($user_id){
	$result = $this->mdl_auth->get_where($user_id)->row();
	$this->session->name = $result->firstname.' '.$result->lastname;
	$this->session->uname = $result->username;
	$this->session->user_id = $result->user_id;
	$this->session->role = $result->is_admin;
    }
    
    function ajax_login()
    {
	$key = $this->input->post('key');
	$this->db->where('email', $key);
	$res = $this->db->get('users');
	if ( $res->num_rows() > 0 )
	{
	    $this->create_session($res->row()->user_id);
	    echo json_encode(['status'=>'success']);
	    die();
	}
	echo json_encode(['status'=>'failure']);
	die();
    }
  

    function logout()
    {
	$this->session->sess_destroy();
	$_SESSION = [];
	$this->session->set_flashdata('success', 'logged_out');
	redirect(base_url('login'), 'refresh');
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
