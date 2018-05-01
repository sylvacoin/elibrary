<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modal extends MX_Controller {
    
	public function __construct()
	{
            parent::__construct();
            $this->load->module('template');
            
	}
        
	function index(){
		$data['view_file'] = 'welcome_message';
		$data['page_title'] = 'Welcome Message';
		$data['module'] = 'home';
		$this->template->home($data);
	}
	
	function modal_edit_class($class_id, $section = false){
            $modal_data = Modules::run('Classes/get_profile_from_db', $class_id);
            if ($section == false) {
                $this->load->view('modal_edit_class', $modal_data);
            }else{
                $this->load->view('modal_edit_section', $modal_data);
            }
            echo '<script src="assets/js/neon-custom-ajax.js"></script>';
	}
        
        function modal_add_subject($id=''){
            $modal_data['subject_id'] = '';
            if ( is_numeric($id) ) {
                $modal_data = Modules::run('subjects/get_profile_from_db', $id);
                $this->load->view('modal_add_subject', $modal_data);
            }else{
                $this->load->view('modal_add_subject', $modal_data);
            }
            echo '<script src="assets/js/neon-custom-ajax.js"></script>';
	}
        
        function modal_upload_assessment(){
            $data['url'] = $this->input->get('return');
            $data['current_class'] = $this->input->get('id');
			$this->load->view('modal_upload_assessment', $data);
            echo '<script src="assets/js/neon-custom-ajax.js"></script>';
	}
        
        function modal_student_profile( $id ) {
            $modal_data = Modules::run('students/get_profile_from_db', $id);
            $this->load->view('modal_student_profile', $modal_data);
            
            echo '<script src="assets/js/neon-custom-ajax.js"></script>';
        }
}
