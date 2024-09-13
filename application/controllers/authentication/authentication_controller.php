<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class authentication_controller extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->model('authentication/Authentication_model');
        $this->load->model('customization/customize_model');
        $this->load->library('form_validation');
        $this->load->model('audit_logs/audit_logs_model');
	}
	


    public function index()
	{
        $system_data = array(
			"result" => $this->customize_model->get_system_info(),
		);

        $data = array(
            'data2' => $system_data,
        );

		$this->load->view('Templates/dashboard_header', $data);
		$this->load->view('Authentication/sign_in');
		$this->load->view('Templates/dashboard_footer');
	}


//---------------------------------------------------
//           	TO VIEW THE SIGN UP PAGE SECTION
//---------------------------------------------------
	public function admin_sign_up()
	{
        $system_data = array(
            "result" => $this->customize_model->get_system_info(),
        );

        $data = array(
            'data2' => $system_data,
        );

        $this->load->view('Templates/hd',  $system_data);
        $this->load->view('features/admin_sign_up/admin_sign_up',  $data);
        $this->load->view('Templates/ft');
	}



//---------------------------------------------------
//           	LOGIN PROCESS SECTION
//---------------------------------------------------

    public function login_process()
    {
        $username  = $this->input->post('username');
        $password   = $this->input->post('password');
        $consult_admin = $this->Authentication_model->fetch_admin_details($username, $password);
        $result_admin = $consult_admin->row();
        if ($result_admin) {
            $session = array(
                'admin_username' => $username,
                'admin_password'  => $password,
                'admin_id'       => $result_admin->admin_id,
                'connect'   => true,
            );
            $this->session->set_userdata($session);
            if ($this->session->userdata('connect') == true ){
                $sess = $this->session->userdata('admin_username');
                $sess2 = $this->session->userdata('admin_id');
            }

            //this code is for inserting into the audit trails
            $data = array(
                'admin_username' => $username, 
                'admin_id'       => $result_admin->admin_id,
                'date_time_out'   => NULL,
                'action_time'   => NULL,
            );
            $this->Authentication_model->insert_admin_audit($data);
            $this->session->set_flashdata('status2', 'Save Successfully!');
            redirect('Dashboard');
        } else {
            $this->session->set_flashdata('alert', 'INVALID Username/Password!');
            redirect('sign_in');
        }
    }


//---------------------------------------------------
//           	USER SIGN_UP PROCESS SECTION
//---------------------------------------------------

    // public function admin_sign_up_process() //SIGN_UP-FORM PROCESS
    // {

    //         $first_name  =   $this->input->post('first_name');  
    //         $last_name  =   $this->input->post('last_name');  
    //         $user_name  =   $this->input->post('user_name');  
    //         $email      =   $this->input->post('email');
    //         $password   =   $this->input->post('password');

    //         $sign_up_data = [
    //             'user_Fname' => $first_name,
    //             'user_Lname' => $last_name,
    //             'user_name' => $user_name,
    //             'user_email'     => $email,
    //             'user_password'  => $password,
    //         ];

    //         $this->Authentication_model->sign_up_db($sign_up_data);

    //         // redirect($_SERVER['HTTP_REFERER']); //THIS CODE REDIRECT TO THE SAME PAGE
    //         $this->session->set_flashdata('status', 'Registered Successfully!');
    //         redirect('sign_in');

    // }   


    public function admin_sign_up_process2() //SIGN_UP-FORM PROCESS
    {
        $this->form_validation->set_rules('fname', 'First Name', 'required|min_length[1]|max_length[25]');
        $this->form_validation->set_rules('lname', 'Last Name', 'required|min_length[1]|max_length[25]');
        $this->form_validation->set_rules('mname', 'Middle Name', 'required|min_length[1]|max_length[25]');
        $this->form_validation->set_rules('user_name', 'Username', 'required|min_length[1]|max_length[25]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        
        if ($this->form_validation->run() == FALSE)
        {
            // Get all the validation errors in an array
            $errors = $this->form_validation->error_array();

            // Check which field/s have errors
            if (isset($errors['confirm_password'])) {
                $this->session->set_flashdata('alert2', 'Failed! Confirm Password is required and should match Password');
            } elseif (isset($errors['password'])) {
                $this->session->set_flashdata('alert', 'Failed! Password is required and should have at least 6 characters');
            } else {
                $this->session->set_flashdata('status', 'Failed! Some fields have errors. Please check again.');
            }
            redirect('admin_sign_up');
        }
        else
        {

            $user_Fname     =   $this->input->post('fname');
            $user_Lname     =   $this->input->post('lname');
            $user_Mname     =   $this->input->post('mname');
            $user_email     =   $this->input->post('email');
            $user_name      =   $this->input->post('user_name');
            $user_password  =   $this->input->post('password');
            $user_password2 =   $this->input->post('confirm_password');
            $admin_id = $this->input->post('admin_id');
            $admin_name = $this->input->post('admin_name2');

            $sign_up_data = [
                'admin_Fname'    => $user_Fname,
                'admin_Lname'    => $user_Lname,
                'admin_Mname'    => $user_Mname,
                'admin_email'    => $user_email,
                'admin_username'     => $user_name,
                'admin_password' => $user_password,
            ];

            $team_data = array(
                'date_time_in' => null, 
                'date_time_out' => null, 
                'action' => "Create new admin, name = " .$user_name, 
                'admin_username' => $admin_name, 
                'admin_id' => $admin_id, 
            );

            $this->Authentication_model->sign_up_db($sign_up_data);
            $this->audit_logs_model->insert_audit_actions($team_data); //this code is to insert the admin user action to logs

            // redirect($_SERVER['HTTP_REFERER']); //THIS CODE REDIRECT TO THE SAME PAGE
            $this->session->set_flashdata('status', 'Registered Successfully!');
            redirect('admin_sign_up');
        }
    }


//---------------------------------------------------
//           	    ADMIN LOGOUT 
//---------------------------------------------------
    public function admin_logout()
    {
        //to get  the admin username and id from the session
        $admin_username = $this->session->userdata('admin_username');
        $admin_id = $this->session->userdata('admin_id');
        //to insert the admin username and id to the audit_trail table and to set also the time in into null
        $data = array(
            'admin_username' => $admin_username, 
            'admin_id' => $admin_id,
            'date_time_in'   => NULL, 
            'action_time'   => NULL, 
        );

        $this->Authentication_model->insert_admin_audit($data);

        $this->session->sess_destroy();
        redirect('sign_in');
    }







}
