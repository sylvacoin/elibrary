<?php

class home extends MX_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->module('templates');
    }
    
    function index(){
        $data['view_file'] = 'homepage';
        $data['module'] = 'home';
        $this->templates->backend($data);
    }
    
    function about(){
        $data['view_file'] = 'aboutpage';
        $data['module'] = 'home';
        $this->templates->backend($data);
    }
    
    function contact(){
        $data['view_file'] = 'contactpage';
        $data['module'] = 'home';
        $this->templates->backend($data);
    }
}