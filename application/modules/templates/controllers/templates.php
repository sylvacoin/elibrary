 <?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of templates
 *
 * @author Code X
 */
class templates extends MX_Controller{
    public function __construct() {
        parent::__construct();
    }
    
    function frontend($data){
        $this->load->view('frontend', $data);
    }
    
    function backend($data){
        $this->load->view('backend', $data);
    }
    
    function middleend($data){
        $this->load->view('middleend', $data);
    }
    
    function error_pages($data){
        $this->load->view('error-pages',$data);
    }
}
