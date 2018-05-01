<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Security extends MX_Controller
{

    public function __construct()
    {
	parent::__construct();
    }

    /*
     *  SITE PAGES
     */

    function index()
    {
	if (is_numeric($this->session->user_id)):
	    redirect('dashboard');
	else:
	    redirect('login');
	endif;
    }

    function encrypt($password)
    {
	$enc_key = MD5($password . SALT);
	return $enc_key;
    }
    
    function notifications()
    {
	$this->db->where('ucontact_id', $this->session->user_id);
	$this->db->where('contact_req_status', 0);
	$data['contact_request'] = $this->db->get('contacts')->num_rows();
	
	$this->db->where('ucontact_id', $this->session->user_id);
	$data['recommended_books'] = $this->db->get('share_document')->num_rows();
	
	$this->db->where('user_id', $this->session->user_id);
	$data['shared_books'] = $this->db->get('share_document')->num_rows();
	
	$this->db->where('user_id', $this->session->user_id);
	$data['fav_books'] = $this->db->get('fav_documents')->num_rows();
	
	return (object) $data;
    }
    
    function debug($array)
    {
	echo '<pre>' . print_r($array, 1) . '</pre>';
	die();
    }

}
