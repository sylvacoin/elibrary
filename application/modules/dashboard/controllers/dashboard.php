

<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends MX_Controller
{

    function __construct()
    {
	parent::__construct();
	$this->load->module('templates');
	if ( !is_numeric($this->session->user_id) ){
	    redirect( 'login' );
	}
    }

    function index()
    {
	$data = $this->page_settings('welcome', NULL, NULL, 'welcome', 'dashboard');
	$this->templates->backend($data);
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
