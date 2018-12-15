<?php 

$config = array(

	 	/**
		* The rules below validates the administrator login form
        * Rules can be added incrementally for the purpose of structure and scalability 
        */
        'api/login' => array(       
                array(
                        'field' => 'username',
                        'label' => 'username',
                        'rules' => 'required|encode_php_tags|strtolower|trim',
                        'errors' => array('required'=>"{field} cannot be empty") 
                ),
                array(
                        'field' => 'password',
                        'label' => 'Password',
                        'rules' => 'required',
                        'errors'=> array('required' => '{field} cannot be empty')
                )
              
        ), //end login validation





        /**
        * The rules below validates the member registeration form
        */
        'members/add' => array(
                array(
                        'field' => 'firstname',
                        'label' => 'first name',
                        'rules' => 'required|max_length[30]|encode_php_tags|trim|alpha', 
                        'errors' => array('required'=>'{field} is required', 'alpha'=>'unrecognised character(s) in {field}. only alphabets are allowed')
                ),
                array(
                        'field' => 'surname',
                        'label' => 'surname',
                        'rules' => 'required|max_length[30]|encode_php_tags|trim|alpha',
                        'errors' => array('required'=>'{field} is required', 'alpha'=>'unrecognised character(s) in {field}. only alphabets are allowed' )
                ),
                array(
                        'field' => 'middlename',
                        'label' => 'middlename',
                        'rules' => 'max_length[30]|trim|alpha',
                        'errors' => array('max_length'=>'{field} cannot be more than {param} characters long' )
                ),
                array(
                        'field' => 'address',
                        'label' => 'address',
                        'rules' => 'required|trim',
                        'errors' => array('required'=>'{field} is required')
                ),
                array(
                        'field' => 'email',
                        'label' => 'email',
                        'rules' => 'valid_email|trim|is_unique[members.email]',
                        'errors'=> array('valid_email' => 'Invalid email address', 'is_unique'=>'email already belongs to a member')
                ),
                array(
                        'field' => 'telephone1',
                        'label' => 'Telephone',
                        'rules' => 'required|max_length[11]|numeric|trim|is_unique[members.telephone1]',
                        'errors'=> array('numeric' => 'Invalid Phone number', 'max_length'=>'Telephone1 too long',
                                        'is_unique'=>'Member with this phone number already exists')
                ),
                array(
                        'field' => 'telephone2',
                        'label' => 'Telephone2',
                        'rules' => 'max_length[11]|numeric|trim|is_unique[members.telephone2]',
                        'errors'=> array('numeric' => 'Invalid Phone number', 'max_length' => 'Telephone2 too long',
                                        'is_unique'=>'Member with this phone number already exists')
                ),
                array(
                        'field' => 'occupation',
                        'label' => 'occupation',
                        'rules' => 'max_length[100]|alpha_numeric_spaces|alpha_dash|trim',
                        'errors'=> array('max_length' => '{field} cannot be more than {param} characters long',
                                         'alpha_numeric_spaces' => 'unidentified character(s) in {field} field. Only spaces, alpha-numeric characters, dashes and underscores are allowed',
                                         'alpha_dash' => 'unidentified character(s) in {field} field. Only spaces, alpha-numeric characters, dashes and underscores are allowed'
                                         )
                ),
                array(
                        'field' => 'member_status',
                        'label' => 'Member Status',
                        'rules' => 'required|max_length[50]|alpha_numeric_spaces|trim',
                        'errors'=> array('max_length' => '{field} cannot be more than {param} characters long',
                                         'alpha_numeric_spaces' => 'unidentified character(s) in {field} field. Only spaces and alpha-numeric characters are allowed')
                )
        ),




        /**
        * The rules below validates the creation of new permissions
        * NOTE : No user/administrator should have access to this page including the Super-Admin
        * The permission creation page is only for the developers and system engineers 
        */
        'permissions/newPermission' => array( 
                array(
                        'field' => 'perm_name',
                        'label' => 'Permission Name',
                        'rules' => 'required|encode_php_tags|strtolower|trim|alpha_numeric_spaces|is_unique[permissions.name]',
                        'errors' => array('required'=>"{field} cannot be empty", 'is_unique'=>'Permission with this name already exists') 
                ),
                array(
                        'field' => 'perm_code',
                        'label' => 'Permission Code',
                        'rules' => 'required|trim|numeric|is_unique[permissions.code]',
                        'errors'=> array('required' => '{field} cannot be empty', 'is_unique'=>'Permission with this code already exists')
                ),
                array(
                        'field' => 'perm_desc',
                        'label' => 'Desciption',
                        'rules' => 'trim'
                ),
                 array(
                        'field' => 'module',
                        'label' => 'Module',
                        'rules' => 'required|trim|alpha_numeric_spaces|alpha_dash',
                        'errors'=> array('required' => '{field} cannot be empty')
                )
                 
              
        ), //end login validation
























































































        /*
        |-------------------------------------------------------------------------------------------------|
        |--------------------------- FORM VALIDATION FOR CREATE ATTENDANCE CATEGORY ----------------------|
        |-------------------------------------------------------------------------------------------------|
        */


        'attendances/create' => array(
                array(
                        'field' => 'attendance_name',
                        'label' => 'Attendance Type',
                        'rules' => 'required|max_length[50]|encode_php_tags|alpha_numeric_spaces|is_unique[attendances.name]|trim',
                        'errors' => array('required'=>"{field} cannot be empty",
                                            'max_length' => '{field} cannot be more than {param} characters long',
                                            'is_unique' => '{field} already exists. Duplicates not allowed',
                                            'alpha_numeric_spaces' => 'unidentified character(s) in {field} field. Only spaces and alpha-numeric characters are allowed' )  
                ),
                array(
                        'field' => 'attendance_abbr',
                        'label' => 'Attendance Abbrevation',
                        'rules' => 'required|max_length[6]|is_unique[attendances.abbr]|alpha_numeric|trim',
                        'errors'=> array('required' => '{field} cannot be empty', 
                            'is_unique' => 'Attendance with this Abbrevation has already been created. Duplicates not allowed',
                            'alpha_numeric' => 'unidentified character(s) in {field} field. Only alpha-numeric characters are allowed')
                ),
                array(
                        'field' => 'attendance_for',
                        'label' => 'Target',
                        'rules' => 'encode_php_tags|trim',
                        
                )
              
        ),




        




        /*
        |-------------------------------------------------------------------------------------------------|
        |--------------------------- FORM VALIDATION FOR CREATE ATTENDANCE CATEGORY ----------------------|
        |-------------------------------------------------------------------------------------------------|
        */



         /*
		| The rules below controls the form validation for the members-registeration page
		| middle name should be added to the rules once it is implememted in the db
        */
        


        // end member-registeration validation




        'members/updateInfo' => array(
                array(
                        'field' => 'firstname',
                        'label' => 'first name',
                        'rules' => 'required|max_length[30]|encode_php_tags|trim|alpha', //add xss_clean when you understand it
                        'errors' => array('required'=>'{field} is required', 'alpha'=>'unrecognised character(s) in {field}. only alphabets are allowed')
                ),
                array(
                        'field' => 'surname',
                        'label' => 'surname',
                        'rules' => 'required|max_length[30]|encode_php_tags|trim|alpha',
                        'errors' => array('required'=>'{field} is required', 'alpha'=>'unrecognised character(s) in {field}. only alphabets are allowed' )
                ),
                array(
                        'field' => 'middlename',
                        'label' => 'middlename',
                        'rules' => 'max_length[30]|encode_php_tags|trim|alpha',
                        'errors' => array('max_length'=>'{field} cannot be more than {param} characters long' )
                ),
                array(
                        'field' => 'address',
                        'label' => 'address',
                        'rules' => 'required|encode_php_tags|htmlspecialchars_decode|trim',
                        'errors' => array('required'=>'{field} is required')
                ),
                array(
                        'field' => 'email',
                        'label' => 'email',
                        'rules' => 'valid_email|trim',
                        'errors'=> array('valid_email' => 'Invalid email address')
                ),
                array(
                        'field' => 'telephone1',
                        'label' => 'Telephone1',
                        'rules' => 'required|max_length[11]|numeric|trim',
                        'errors'=> array('numeric' => 'Invalid Phone number', 'max_length'=>'phone number too long')
                )
        ),


        /*
		| The rules below controls the form validation for the admin change-password page
		| rule should implement a callback function that ensures admin passwords are very storng
        */
        'admin/passwordChange' => array(
                array(
                        'field' => 'old_password',
                        'label' => 'old password',
                        'rules' => 'required', //add xss_clean when you understand it
                        'errors' => array('required'=>'your Old password is required')
                ),
                array(
                        'field' => 'new_password',
                        'label' => 'new password',
                        'rules' => 'required|min_length[8]|max_length[16]',
                        'errors' => array('required'=>'Enter your new password',
                        					'max_length' => 'password cannot be more than 16 characters',
                        					'min_length' => 'password cannot be less 8 characters'

                                             )
                ),
                array(
                        'field' => 'new_password_again',
                        'label' => 'new password again',
                        'rules' => 'required|matches[new_password]|min_length[8]|max_length[16]',//|callback_password_check',
                        'errors' => array('matches'=>'your passwords don\'t match',
                        					'max_length' => 'password cannot be more than 16 characters',
                        					'min_length' => 'password cannot be less 8 characters',
                                            'password_check' => 'password not strong enough! Password should contain at least an uppercase letter, a lower case letter, a number and a special character')
                )
                
        ),
        // end password-change validation

        /*
        |@author : theekhay_dice
		| The rules below controls service-creation form in the service controller
        */
        'services/addService' => array(
                array(
                        'field' => 'service_name',
                        'label' => 'Service Name',
                        'rules' => 'required|is_unique[service1.name]|alpha_numeric_spaces|max_length[30]|encode_php_tags|trim',
                        'errors' => array('required'=>'{field} is required',
                        				  'max_length' => '{field} cannot be more than {param} characters',
                        				  'is_unique' => '{field} already exists. Duplicates not allowed',
                        				  'alpha_numeric_spaces' => 'unidentified character(s) in {field} field. Only spaces and alpha-numeric characters are allowed', )
                ),
                array(
                        'field' => 'service_abbr',
                        'label' => 'Service Abbrevation',
                        'rules' => 'required|max_length[6]|alpha_numeric|is_unique[service1.abbr]|encode_php_tags|trim|strtoupper',
                        'errors' => array('required'=>'{field} is required',
                        					'max_length' => '{field} cannot be more than {param} characters',
                        					'alpha_numeric' => 'unidentified character(s) in {field} field. Only alpha-numeric characters are allowed',
                        					'is_unique' => '{field} already exists. Duplicates not allowed' 
                       					)                
        		)
        ),// end service-creation validation



        /*
        |@author : theekhay_dice
		| The rules below controls offering-creation form in the finance controller
        */
        'finances/add' => array(
                array(
                        'field' => 'finance_name',
                        'label' => 'Offering Name',
                        'rules' => 'required|is_unique[finances.name]|alpha_numeric_spaces|max_length[30]|encode_php_tags|trim',
                        'errors' => array('required'=>'{field} is required',
                        			  	  'max_length' => '{field} cannot be more than {param} characters',
                        				  'is_unique' => '{field} already exists. Duplicates not allowed',
                        				  'alpha_numeric_spaces' => 'unidentified character(s) in {field} field. Only spaces and alpha-numeric characters are allowed', )
                ),
                array(
                        'field' => 'finance_code',
                        'label' => 'Offering Code',
                        'rules' => 'required|max_length[5]|alpha_numeric|is_unique[finances.code]|encode_php_tags|trim',
                        'errors' => array('required'=>'{field} is required',
                        					'max_length' => '{field} cannot be more than {param} characters',
                        					'alpha_numeric' => 'unidentified character(s) in {field} field. Only alpha-numeric characters are allowed',
                        					'is_unique' => '{field} already exists. Duplicates not allowed' 
                       					)                
        		)
        ),// end service-creation validation


        /*
        |@author : theekhay_dice
		| The rules below controls department-creation form in the Department controller
        */
        'department/add' => array(
                array(
                        'field' => 'department_name',
                        'label' => 'Department Name',
                        'rules' => 'required|is_unique[department.name]|alpha_numeric_spaces|max_length[30]|encode_php_tags|trim',
                        'errors' => array('required'=>'{field} is required',
                        				  'max_length' => '{field} cannot be more than {param} characters',
                        				  'is_unique' => '{field} already exists. Duplicates not allowed',
                        				  'alpha_numeric_spaces' => 'unidentified character(s) in {field} field. Only spaces and alpha-numeric characters are allowed', )
                ),
                array(
                        'field' => 'department_code',
                        'label' => 'Department Code',
                        'rules' => 'required|max_length[5]|alpha_numeric|is_unique[department.code]|encode_php_tags|trim',
                        'errors' => array('required'=>'{field} is required',
                        					'max_length' => '{field} cannot be more than {param} characters',
                        					'alpha_numeric' => 'unidentified character(s) in {field} field. Only alpha-numeric characters are allowed',
                        					'is_unique' => '{field} already exists. Duplicates not allowed' 
                       					)                
        		)
        ),// end department-creation validation


        /*
        |@author : theekhay_dice
		| The rules below controls expense_category-creation form in the expenses controller
        */
        'expenses/create' => array(
                array(
                        'field' => 'expense_name',
                        'label' => 'Expense Name',
                        'rules' => 'required|is_unique[expenses.name]|alpha_numeric_spaces|max_length[30]|encode_php_tags|trim',
                        'errors' => array('required'=>'{field} is required',
                        				'is_unique' => '{field} already exists. Duplicates not allowed',
                        				'max_length' => '{field} cannot be more than {param} characters',
                        				'alpha_numeric_spaces' => 'unidentified character(s) in {field} field. Only spaces and alpha-numeric characters are allowed')
                ),
                array(
                        'field' => 'expense_code',
                        'label' => 'Expense Code',
                        'rules' => 'required|max_length[5]|alpha_numeric|is_unique[expenses.code]|encode_php_tags|trim',
                        'errors' => array('required'=>'{field} is required',
                        					'max_length' => '{field} cannot be more than {param} characters',
                        					'alpha_numeric' => 'unidentified character(s) in {field} field. Only alpha-numeric characters are allowed',
                        					'is_unique' => '{field} already exists. Duplicates not allowed' 
                       					)                
        		)
        ),// end expense_category-creation validation





        /*
        |@author : theekhay_dice
		| The rules below controls group-creation form in the groups controller
        */
        'cells/create' => array(
                array(
                        'field' => 'cell_name',
                        'label' => 'Cell Name',
                        'rules' => 'required|is_unique[cells.name]|alpha_numeric_spaces|max_length[30]|encode_php_tags|trim',
                        'errors' => array('required'=>'{field} is required',
                        				'is_unique' => '{field} already exists. Duplicates not allowed',
                        				'max_length' => '{field} cannot be more than {param} characters',
                        				'alpha_numeric_spaces' => 'unidentified character(s) in {field} field. Only spaces and alpha-numeric characters are allowed', )
                ),
                array(
                        'field' => 'cell_abbr',
                        'label' => 'Cell Abbrevation',
                        'rules' => 'required|max_length[6]|alpha_numeric|is_unique[cells.abbr]|encode_php_tags|trim',
                        'errors' => array('required'=>'{field} is required',
                        					'max_length' => '{field} cannot be more than {param} characters',
                        					'alpha_numeric' => 'unidentified character(s) in {field} field. Only alpha-numeric characters are allowed',
                        					'is_unique' => '{field} already exists. Duplicates not allowed' 
                       					)                
        		),
        		array(
                        'field' => 'zone',
                        'label' => 'Zone',
                        'rules' => 'required|trim',
                        'errors' => array('required'=>'{field} is required'
                       					)                
        		)

        ),
        // end group-creation validation



        /*
        |@author : theekhay_dice
		| The rules below controls new_admin-creation form in the admin controller
        */
        'admin/createNewAdmin' => array(
                array(
                        'field' => 'username',
                        'label' => 'Admin Username',
                        'rules' => 'required|is_unique[admin.username]|alpha_numeric_spaces|max_length[15]|trim|encode_php_tags',
                        'errors' => array('required'=>'{field} is required',
                        				'is_unique' => '{field} already exists. Duplicates not allowed',
                        				'max_length' => '{field} cannot be more than {param} characters',
                        				'alpha_numeric_spaces' => 'unidentified character(s) in {field} field. Only spaces and alpha-numeric characters are allowed', )
                ),
                array(
                        'field' => 'password',
                        'label' => 'Admin Password',
                        'rules' => 'required|max_length[16]|min_length[8]|encode_php_tags', //callback function should be here to ensure password strength
                        'errors' => array('required'=>'{field} is required',
                        					'max_length' => '{field} cannot be more than {param} characters',
                        					'min_length' => '{field} cannot be less than {param} characters'                    					                      					 
                       					)                
        		),
        		array(
                        'field' => 'email',
                        'label' => 'Admin email',
                        'rules' => 'valid_email|is_unique[admin.email]|encode_php_tags|trim',
                        'errors' =>array('valid_email' => 'Invalid email address', 'is_unique'=>'email already belongs to an Admin')                     				                
        		)
        ),
        // end new-admin-creation validation



        /**
        * @author : theekhay
        * The rules below controls new team creation form in the teams controller
        */
        'teams/create' => array(
                array(
                        'field' => 'team_name',
                        'label' => 'Team Name',
                        'rules' => 'required|is_unique[teams.name]|alpha_numeric_spaces|max_length[30]|encode_php_tags|trim',
                        'errors' => array('required'=>'{field} is required',
                                        'is_unique' => '{field} already exists. Duplicates not allowed',
                                        'max_length' => '{field} cannot be more than {param} characters',
                                        'alpha_numeric_spaces' => 'unidentified character(s) in {field} field. Only spaces and alpha-numeric characters are allowed')
                ),
                array(
                        'field' => 'team_abbr',
                        'label' => 'Team Abrrevation',
                        'rules' => 'required|is_unique[teams.abbr]|max_length[6]|alpha_numeric|encode_php_tags|trim',
                        'errors' => array('required'=>'{field} is required',
                                            'max_length' => '{field} cannot be more than {param} characters',
                                            'is_unique' => '{field} already exists. Duplicates not allowed',
                                            'alpha_numeric' => 'unidentified character(s) in {field} field. Only alpha-numeric characters are allowed')               
                ),
                array(
                        'field' => 'team_head',
                        'label' => 'Team Head',
                        'rules' => 'is_unique[teams.head]|encode_php_tags|trim',
                        'errors' =>array('is_unique'=>'Member already heads a team. Member can only head a team at a time.')                                                    
                )
        ),
        // end team creation validation validation


);//end config 

?>