<?php
class about_controller extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->library('session');
		$this->load->library('pagination');
        $this->load->library('session');
		$this->load->model('customization/customize_model');
		$this->load->model('about/about_model');
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

    public function insert_about()
    {
        $config['upload_path'] = FCPATH . 'assets/image/about_us';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp|ico|svg|webp';
        $config['max_size'] = 5323400;
        $config['max_width'] = 12024;
        $config['max_height'] = 12682;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {


            $about_year = $this->input->post('about_year');
            $about_title = $this->input->post('about_title');
            $about_story = $this->input->post('about_story');
            $admin_id = $this->input->post('admin_id');
            $admin_name = $this->input->post('admin_name2');

            $about_us_data = [
                    'about_year' => $about_year,
                    'about_title' => $about_title,
                    'about_story' => $about_story,
            ];

            $team_data = array(
                'date_time_in' => null, 
                'date_time_out' => null, 
                'action' => "Upload the about = " .$about_title, 
                'admin_username' => $admin_name, 
                'admin_id' => $admin_id, 
            );


            $this->about_model->insert_about_db($about_us_data);
            $this->audit_logs_model->insert_audit_actions($team_data); //this code is to insert the admin user action to logs
            $this->session->set_flashdata('status', 'Save Successfully!');
            redirect('about_table');

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
            $admin_id = $this->input->post('admin_id');
            $admin_name = $this->input->post('admin_name2');

            $about_us_data = [
                    'about_year' => $about_year,
                    'about_title' => $about_title,
                    'about_story' => $about_story,
                    'about_image' => $userfile,
            ];

            $team_data = array(
                'date_time_in' => null, 
                'date_time_out' => null, 
                'action' => "Upload the about = " .$about_title, 
                'admin_username' => $admin_name, 
                'admin_id' => $admin_id, 
            );


            $this->about_model->insert_about_db($about_us_data);
            $this->audit_logs_model->insert_audit_actions($team_data); //this code is to insert the admin user action to logs
            $this->session->set_flashdata('status', 'Save Successfully!');
            redirect('about_table');
        }
    }


//-------------------------------------------------------------
//                  TO DISPLAY DATA 
//-------------------------------------------------------------
    public function about_table($rowno=0)
    {
 
            $rowperpage = 5;// Row per page

            // Check if the row position is specified
            if($rowno != 0)
            {
                $rowno = ($rowno-1) * $rowperpage;
            }

            // Get the total count of records
            $allcount = $this->about_model->get_about_logs_count();

            // Get the records based on the search text, row position and number of rows per page
            $admin_logs_record = $this->about_model->get_about_Data($rowno, $rowperpage);

            // Pagination Configuration
            $config['base_url'] = base_url('index.php/features/about/about_controller/about_table');
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
            $this->load->view('features/about_us/about',  $data);
            $this->load->view('Templates/ft');

    }



//-------------------------------------------------------------
//                     GET ABOUT DETAILS
//-------------------------------------------------------------

    public function get_about_Details($id){


        $system_data = array(
            "result" => $this->customize_model->get_system_info(),
        );

        $about_details = array(
            "result" => $this->about_model->get_about_details_form($id),
        );

        $data = array(
            "data1" => $about_details,
            "data2" => $system_data,
        );
        
        $this->load->view('Templates/hd', $system_data);
        $this->load->view('features/about_us/update/update_about',  $data);
        $this->load->view('Templates/ft');
    }


//-------------------------------------------------------------
//                     UPDATE
//-------------------------------------------------------------

    public function update_about()
    {
        $config['upload_path'] = FCPATH . 'assets/image/about_us';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp|ico|svg|webp';
        $config['max_size'] = 5323400;
        $config['max_width'] = 12024;
        $config['max_height'] = 12682;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {


            $about_year = $this->input->post('about_year');
            $about_title = $this->input->post('about_title');
            $about_story = $this->input->post('about_story');
            $about_id = $this->input->post('about_id');
            $admin_id = $this->input->post('admin_id');
            $admin_name = $this->input->post('admin_name2');

            $about_us_data = [
                    'about_year' => $about_year,
                    'about_title' => $about_title,
                    'about_story' => $about_story,
            ];

            $team_data = array(
                'date_time_in' => null, 
                'date_time_out' => null, 
                'action' => "Update the about = " .$about_title, 
                'admin_username' => $admin_name, 
                'admin_id' => $admin_id, 
            );


            $this->about_model->updating_about($about_us_data, $about_id);
            $this->audit_logs_model->insert_audit_actions($team_data); //this code is to insert the admin user action to logs
            $this->session->set_flashdata('status2', 'Save Successfully!');
            redirect('about_table');

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
            $about_id = $this->input->post('about_id');
            $admin_id = $this->input->post('admin_id');
            $admin_name = $this->input->post('admin_name2');

            $about_us_data = [
                    'about_year' => $about_year,
                    'about_title' => $about_title,
                    'about_story' => $about_story,
                    'about_image' => $userfile,
            ];

            $team_data = array(
                'date_time_in' => null, 
                'date_time_out' => null, 
                'action' => "Update the about = " .$about_title, 
                'admin_username' => $admin_name, 
                'admin_id' => $admin_id, 
            );

            $this->about_model->updating_about($about_us_data, $about_id);
            $this->audit_logs_model->insert_audit_actions($team_data); //this code is to insert the admin user action to logs
            $this->session->set_flashdata('status2', 'Save Successfully!');
            redirect('about_table');
        }
    }



//-------------------------------------------------------------
//                  TO DELETE SERVICES
//-------------------------------------------------------------

    public function delete_about($id){
        $admin_name = $this->session->userdata('admin_username');
        $admin_id = $this->session->userdata('admin_id');
        $about_us = $this->input->get('title');

        $team_data = array(
            'date_time_in' => null, 
            'date_time_out' => null, 
            'action' => "Delete the about = " .$about_us, 
            'admin_username' => $admin_name, 
            'admin_id' => $admin_id, 
        );

        $this->about_model->delete_about($id);
        $this->audit_logs_model->insert_audit_actions($team_data); //this code is to insert the admin user action to logs
        redirect('about_table');
    }


}