<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MY_form_validation
 *
 * @author Code X
 */
class MY_Form_validation extends CI_Form_validation{
    //put your code here
    function run($module='', $group='') {
        //(is_object($module)) && $this->CI = &$module;
        if(is_object($module)) { $this->CI = &$module; }
        return parent::run($group);
    }
}
