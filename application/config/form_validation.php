<?php
$config = array(
    'signup' => array(
	array(
	    'field' => 'fname',
	    'label' => 'First Name',
	    'rules' => 'required'
	),
	array(
	    'field' => 'lname',
	    'label' => 'Last Name',
	    'rules' => 'required'
	),
	array(
	    'field' => 'uname',
	    'label' => 'User Name',
	    'rules' => 'required'
	),
	array(
	    'field' => 'phone',
	    'label' => 'Phone number',
	    'rules' => 'required'
	),
	array(
	    'field' => 'email',
	    'label' => 'Email Address',
	    'rules' => 'required',
	    'errors' => array(
		'is_unique' => 'This %s already exists please choose another'
	    )
	),
	array(
	    'field' => 'pswd',
	    'label' => 'Password',
	    'rules' => 'required'
	),
	array(
	    'field' => 'pswd2',
	    'label' => 'Password Confirmation',
	    'rules' => 'required|matches[pswd]'
	)
    ),
	
    'system_setting' => array(
            array( 
                'field'=>'name', 
                'label'=>'System Name', 
                'rules'=>'required'
            ),
            array( 
                'field'=>'title', 
                'label'=>'School Name', 
                'rules'=>'required'
            ),
            array( 
                'field'=>'system_email', 
                'label'=>'School Support Email', 
                'rules'=>'required'
            ),
            array( 
                'field'=>'term', 
                'label'=>'Current Term', 
                'rules'=>'required'
            ),
            array( 
                'field'=>'session', 
                'label'=>'Current Session', 
                'rules'=>'required'
            )    
    ),
    'search_contacts' => array(
            array(
                'field'=>'entry',
                'label'=>'Search entry',
                'rules'=>'required'
            )
    ),
    'share' => array(
            array(
                'field'=>'contacts',
                'label'=>'Contact',
                'rules'=>'required',
		'errors'=> array(
		    'required' => 'You must select a %s before you can share a document'
		)
            )
    ),
    'backend' => array(
            array(
                'field'=>'email',
                'label'=>'Email Address',
                'rules'=>'required|callback_authenticate_login'
            ),
	    array(
                'field'=>'password',
                'label'=>'Password',
                'rules'=>'required'
            )
    ),
    'putme' => array(
            array(
                'field'=>'regno',
                'label'=>'Jamb registration number',
                'rules'=>'required|callback_authenticate_putme'
            )
    ),
    'confirm_order' => array(
            array(
                'field'=>'orderid',
                'label'=>'Invoice number',
                'rules'=>'required'
            )
    ),
    'login' => array(
            array(
                'field'=>'email',
                'label'=>'Email address',
                'rules'=>'required|callback_authenticate_login'
            ),
	    array(
                'field'=>'pswd',
                'label'=>'Password',
                'rules'=>'required'
            )
    ),
    'course' => array(
            array(
                'field'=>'ctitle',
                'label'=>'Course title',
                'rules'=>'required'
            ),
	    array(
                'field'=>'cunit',
                'label'=>'Credit unit',
                'rules'=>'required'
            ),
	    array(
                'field'=>'ccode',
                'label'=>'Course code',
                'rules'=>'required'
            ),
	    array(
                'field'=>'level',
                'label'=>'Level',
                'rules'=>'required'
            ),
	    array(
                'field'=>'department',
                'label'=>'Department',
                'rules'=>'required'
            ),
	    array(
                'field'=>'sem',
                'label'=>'Semester',
                'rules'=>'required'
            ),
	    array(
                'field'=>'type',
                'label'=>'Semester',
                'rules'=>'required'
            )
    ),
    'sections' => array(
            array(
                'field'=>'name',
                'label'=>'Section Name',
                'rules'=>'required'
            ),
            array(
                'field'=>'parent_id',
                'label'=>'Main Class',
                'rules'=>'required'
            )
    ),
    'regcourse' => array(
            array(
                'field'=>'dept',
                'label'=>'department name',
                'rules'=>'required'
            ),
            array(
                'field'=>'lvl',
                'label'=>'level',
                'rules'=>'required|greater_than[0]',
		'errors' => array(
		    'greater_than' => 'Please select your %s '
		)
            ),
            array(
                'field'=>'sem',
                'label'=>'semester',
                'rules'=>'required|greater_than[0]',
		'errors' => array(
		    'greater_than' => 'Please select your %s '
		)
            )
    ),
    'department' => array(
            array(
                'field'=>'department',
                'label'=>'Department Name',
                'rules'=>'required'
            ),
            array(
                'field'=>'faculty',
                'label'=>'Faculty',
                'rules'=>'required'
            ),
            array(
                'field'=>'matprefix',
                'label'=>'Matric number prefix',
                'rules'=>'required'
            )
    ),
    'tutor' => array(
		array(
		    'field'=>'surname',
		    'label'=>'Surname Name',
		    'rules'=>'required'
		),
		array(
		    'field'=>'firstname',
		    'label'=>'First name',
		    'rules'=>'required'
		),
		array(
		    'field'=>'email',
		    'label'=>'Email Address',
		    'rules'=>'required'
		),
		array(
		    'field'=>'dept',
		    'label'=>'Department',
		    'rules'=>'required'
		)
    )
);