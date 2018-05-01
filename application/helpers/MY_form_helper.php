<?php if (!defined('BASEPATH')) { exit('Direct script access not allowed'); }

function form_months_dropdown($data, $selected=NULL ,$extra=NULL){
    $months = array(1=>'January', 'February', 'March', 'April',
                    'May','June','July','August', 
                    'September','October','November',
                    'December'
                );
    return form_dropdown($data, $months, $selected, $extra);
}

function form_custom_date_dropdown($data,$rmin, $rmax, $selected=NULL ,$extra=NULL){
    $numbers = range($rmin, $rmax);
    $options[0] = $data;
    foreach ($numbers as $index => $value){
        $options[$value] = $value;
    }
    return form_dropdown($data, $options, $selected, $extra);
}

function form_custom_dropdown($data,$rmin, $rmax, $step = 1, $selected=NULL ,$extra=NULL, $suffix = ''){
    $numbers = range($rmin, $rmax, $step);
    $options[0] = '-select '.$suffix.'-';
    foreach ($numbers as $index => $value){
        $options[$value] = $value.' '.$suffix;
    }
    return form_dropdown($data, $options, $selected, $extra);
}

function form_custom_gender_dropdown($data, $selected=NULL ,$extra=NULL){
    $options = [''=>'Select Gender','Male'=>'Male','Female'=>'Female'];
    return form_dropdown($data, $options, $selected, $extra);
}
