<?php
class team_controller extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->library('session');
		$this->load->library('pagination');
        $this->load->library('session');
		$this->load->model('customization/customize_model');
		$this->load->model('team/team_model');
        $this->load->model('audit_logs/audit_logs_model');
	}

    public function index() 
    {
		$system_data = array(
            "result" => $this->customize_model->get_system_info(),
        );

        $this->load->view('Templates/hd', $system_data);
        $this->load->view('features/dashboard/dashboard', $system_data );
        $this->load->view('Templates/ft');
    }

//-------------------------------------------------------------
//                  TO INSERT SERVICES
//-------------------------------------------------------------

    public function insert_team()
    {
        $config['upload_path'] = FCPATH . 'assets/image/team';
        // $config['allowed_types'] = 'gif|jpg|png';
        $config['allowed_types'] = 'gif|jpg|png|bmp|tiff|svg|eps|pdf|webp|jp2|heic';
        $config['max_size'] = 5323400;
        $config['max_width'] = 12024;
        $config['max_height'] = 12682;

        $this->load->library('upload', $config);

        $name = $this->input->post('name');
        $role = $this->input->post('role');
        $twitter_link = $this->input->post('twitter_link');
        $facebook_link = $this->input->post('facebook_link');
        $instagram_link = $this->input->post('instagram_link');
        $admin_id = $this->input->post('admin_id');
        $admin_name = $this->input->post('admin_name2');


        if (!$this->upload->do_upload('userfile')) {

            $team_data = [
                    'team_name' => $name,
                    'team_role' => $role,
                    'team_twitter_link' => $twitter_link,
                    'team_facebook_link' => $facebook_link,
                    'team_instagram_link' => $instagram_link,
            ];

            $team_data2 = array(
                'date_time_in' => null, 
                'date_time_out' => null, 
                'action' => "Upload new team info, name = " .$name, 
                'admin_username' => $admin_name, 
                'admin_id' => $admin_id, 
            );


            $this->team_model->insert_team_db($team_data);
            $this->audit_logs_model->insert_audit_actions2($team_data2); //this code is to insert the admin user action to logs
            $this->session->set_flashdata('status', 'Save Successfully!');
            redirect('team_table');

        } else {
            $upload_data = $this->upload->data();
            $filename = $upload_data['file_name'];
            $id = uniqid(); // generate a unique ID for the image

            // rename the uploaded file to the unique ID
            $userfile = $id . '_' . $filename;
            $new_path = $config['upload_path'] . '/' . $userfile;
            rename($upload_data['full_path'], $new_path);

            $name = $this->input->post('name');
            $role = $this->input->post('role');
            $twitter_link = $this->input->post('twitter_link');
            $facebook_link = $this->input->post('facebook_link');
            $instagram_link = $this->input->post('instagram_link');
            $admin_id = $this->input->post('admin_id');
            $admin_name = $this->input->post('admin_name2');
            

            $team_data = [
                    'team_name' => $name,
                    'team_role' => $role,
                    'team_twitter_link' => $twitter_link,
                    'team_facebook_link' => $facebook_link,
                    'team_instagram_link' => $instagram_link,
                    'team_img' => $userfile,
            ];

            $team_data2 = array(
                'date_time_in' => null, 
                'date_time_out' => null, 
                'action' => "Upload new team info, name = " .$name , 
                'admin_username' => $admin_name, 
                'admin_id' => $admin_id, 
            );


            $this->team_model->insert_team_db($team_data);
            $this->audit_logs_model->insert_audit_actions2($team_data2); //this code is to insert the admin user action to logs
            $this->session->set_flashdata('status', 'Save Successfully!');
            redirect('team_table');
        }
    }


//-------------------------------------------------------------
//                  TO DISPLAY DATA 
//-------------------------------------------------------------
    public function team_table($rowno=0)
    {
 
            $rowperpage = 5;// Row per page

            // Check if the row position is specified
            if($rowno != 0)
            {
                $rowno = ($rowno-1) * $rowperpage;
            }

            // Get the total count of records
            $allcount = $this->team_model->get_team_logs_count();

            // Get the records based on the search text, row position and number of rows per page
            $admin_logs_record = $this->team_model->get_team_Data($rowno, $rowperpage);

            // Pagination Configuration
            $config['base_url'] = base_url('index.php/features/team/team_controller/team_table');
            $config['use_page_numbers'] = TRUE;
            $config['total_rows'] = $allcount;
            $config['per_page'] = $rowperpage;
            $config['num_links'] = 1;
            $config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="pagination">';
            $config['full_tag_close'] = '</ul></nav>';
            $config['first_tag_open'] = '<li class="page-item">';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li class="page-item">';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li class="page-item">';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li class="page-item">';
            $config['prev_tag_close'] = '</li>';
            $config['num_tag_open'] = '<li class="page-item">';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
            $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
            $config['attributes'] = array('class' => 'page-link');

            $this->pagination->initialize($config);

            // Generate pagination links
            $pagination_links = $this->pagination->create_links();

            $system_data = array(
                "result" => $this->customize_model->get_system_info(),
            );

            // Load view with data
            $data = array(
                "pagination" => $pagination_links,
                "result" => $admin_logs_record,
                "row" => $rowno,
                "data2" => $system_data,
            );

            $this->load->view('Templates/hd',  $system_data);
            $this->load->view('features/team/team',  $data);
            $this->load->view('Templates/ft');

    }



    
//-------------------------------------------------------------
//                     GET SERVICE DETAILS
//-------------------------------------------------------------



    public function get_team_Details($id){


        $system_data = array(
            "result" => $this->customize_model->get_system_info(),
        );

        $team_details = array(
            "result" => $this->team_model->get_team_details_form($id),
        );

        $data = array(
            "data1" => $team_details,
            "data2" => $system_data,
        );
        
        $this->load->view('Templates/hd', $system_data);
        $this->load->view('features/team/update/update_team',  $data);
        $this->load->view('Templates/ft');
    }


//-------------------------------------------------------------
//                    UPDATE
//-------------------------------------------------------------

    public function update_team()
    {
        $config['upload_path'] = FCPATH . 'assets/image/team';
        // $config['allowed_types'] = 'gif|jpg|png';
        $config['allowed_types'] = 'gif|jpg|png|bmp|tiff|svg|eps|pdf|webp|jp2|heic';
        $config['max_size'] = 5323400;
        $config['max_width'] = 12024;
        $config['max_height'] = 12682;

        $this->load->library('upload', $config);

        $name = $this->input->post('name');
        $role = $this->input->post('role');
        $twitter_link = $this->input->post('twitter_link');
        $facebook_link = $this->input->post('facebook_link');
        $instagram_link = $this->input->post('instagram_link');
        $team_id = $this->input->post('team_id');
        $admin_id = $this->input->post('admin_id');
        $admin_name = $this->input->post('admin_name2');
        


        if (!$this->upload->do_upload('userfile')) {

            $team_data = [
                    'team_name' => $name,
                    'team_role' => $role,
                    'team_twitter_link' => $twitter_link,
                    'team_facebook_link' => $facebook_link,
                    'team_instagram_link' => $instagram_link,
            ];

            $team_data2 = array(
                'date_time_in' => null, 
                'date_time_out' => null, 
                'action' => "Update team info, name = " .$name , 
                'admin_username' => $admin_name, 
                'admin_id' => $admin_id, 
            );


            $this->team_model->updating_team($team_data, $team_id);
            $this->audit_logs_model->insert_audit_actions2($team_data2); //this code is to insert the admin user action to logs
            $this->session->set_flashdata('status2', 'Save Successfully!');
            redirect('team_table');

        } else {
            $upload_data = $this->upload->data();
            $filename = $upload_data['file_name'];
            $id = uniqid(); // generate a unique ID for the image

            // rename the uploaded file to the unique ID
            $userfile = $id . '_' . $filename;
            $new_path = $config['upload_path'] . '/' . $userfile;
            rename($upload_data['full_path'], $new_path);

            $about_year = $this->input->post('about_year');
            $about_title = $this->input->post('about_title');
            $about_story = $this->input->post('about_story');
            $team_id = $this->input->post('team_id');
            $admin_id = $this->input->post('admin_id');
            $admin_name = $this->input->post('admin_name2');

            $team_data = [
                    'team_name' => $name,
                    'team_role' => $role,
                    'team_twitter_link' => $twitter_link,
                    'team_facebook_link' => $facebook_link,
                    'team_instagram_link' => $instagram_link,
                    'team_img' => $userfile,
            ];

            $team_data2 = array(
                'date_time_in' => null, 
                'date_time_out' => null, 
                'action' => "Update team info, name = " .$name , 
                'admin_username' => $admin_name, 
                'admin_id' => $admin_id, 
            );

            $this->team_model->updating_team($team_data, $team_id);
            $this->audit_logs_model->insert_audit_actions2($team_data2); //this code is to insert the admin user action to logs
            $this->session->set_flashdata('status2', 'Save Successfully!');
            redirect('team_table');
        }
    }


//-------------------------------------------------------------
//                  TO DELETE SERVICES
//-------------------------------------------------------------

    public function delete_team($id){
        $admin_name = $this->session->userdata('admin_username');
        $admin_id = $this->session->userdata('admin_id');
        $team_name = $this->input->get('title');

        $team_data2 = array(
            'date_time_in' => null, 
            'date_time_out' => null, 
            'action' => "Delete the team info, name = " .$team_name, 
            'admin_username' => $admin_name, 
            'admin_id' => $admin_id, 
        );

        $this->team_model->delete_team($id);
        $this->audit_logs_model->insert_audit_actions2($team_data2); //this code is to insert the admin user action to logs
        redirect('team_table');
    }


}