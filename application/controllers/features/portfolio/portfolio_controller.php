<?php
class portfolio_controller extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->model('portfolio/portfolio_model');
        $this->load->model('customization/customize_model');
        $this->load->model('authentication/Authentication_model');
        $this->load->model('audit_logs/audit_logs_model');
	}
	

    public function index() 
    {
        $this->load->view('Templates/hd');
        $this->load->view('features/portfolio/portfolio');
        $this->load->view('Templates/ft');
    }

    public function port_video() 
    {
        $this->load->view('Templates/hd');
        $this->load->view('features/portfolio_video/portfolio_video');
        $this->load->view('Templates/ft');
    }




//-------------------------------------------------------------
//                  TO INSERT DATA 
//-------------------------------------------------------------

    public function insert_portfolio_image()
    {
        $config['upload_path'] = FCPATH . 'assets/image/portfolio_image';
        // $config['allowed_types'] = 'gif|jpg|png';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp|ico|svg|webp';
        $config['max_size'] = 5323400;
        $config['max_width'] = 12024;
        $config['max_height'] = 12682;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {

            // Get CPU data  from form inputs using POST method
            $image_title = $this->input->post('image_title');
            $image_caption = $this->input->post('image_caption');

            // Store CPU data in an array with name, brand, description, quantity, price, and category fields
            $portfolio_data = [
                    'image_title' => $image_title,
                    'image_caption' => $image_caption,
            ];

            // Call the insert_cpu_db function from model to insert the CPU data into the database
            $this->portfolio_model->insert_image_into_db($portfolio_data);
            $this->session->set_flashdata('status', 'Save Successfully!');
            redirect('portfolio');

        } else {
            $upload_data = $this->upload->data();
            $filename = $upload_data['file_name'];
            $id = uniqid(); // generate a unique ID for the image

            // rename the uploaded file to the unique ID
            $userfile = $id . '_' . $filename;
            $new_path = $config['upload_path'] . '/' . $userfile;
            rename($upload_data['full_path'], $new_path);

            // Get CPU dat and image filename from form inputs using POST method
            $image_title = $this->input->post('image_title');
            $image_caption = $this->input->post('image_caption');
            $admin_id = $this->input->post('admin_id');
            $admin_name = $this->input->post('admin_name2');


            // Store CPU data in an array with name, brand, description, quantity, price, and category fields
            $portfolio_data = [
                    'image_title' => $image_title,
                    'image_caption' => $image_caption,
                    'image' => $userfile,
            ];

            $team_data = array(
                'date_time_in' => null, 
                'date_time_out' => null, 
                'action' => "Upload a image = " .$image_title, 
                'admin_username' => $admin_name, 
                'admin_id' => $admin_id, 
            );

            $this->portfolio_model->insert_image_into_db($portfolio_data);
            $this->audit_logs_model->insert_audit_actions($team_data); //this code is to insert the admin user action to logs
            $this->session->set_flashdata('status', 'Save Successfully!');
            redirect('portfolio');
        }
    }





    public function insert_portfolio_video()
    {
  
        // Get media data and filename from form inputs using POST method
        $media_title = $this->input->post('video_title');
        $media_caption = $this->input->post('video_description');
        $video_link = $this->input->post('video_link');
        $admin_id = $this->input->post('admin_id');
        $admin_name = $this->input->post('admin_name2');

        // Store media data in an array with title, caption, and media fields
        $portfolio_data = [
                'video_title' => $media_title,
                'video_description' => $media_caption,
                'video_yt_link' => $video_link,
        ];

        $team_data = array(
            'date_time_in' => null, 
            'date_time_out' => null, 
            'action' => "Upload a video = " .$media_title, 
            'admin_username' => $admin_name, 
            'admin_id' => $admin_id, 
        );


        $this->portfolio_model->insert_video_into_db($portfolio_data);
        $this->audit_logs_model->insert_audit_actions($team_data); //this code is to insert the admin user action to logs
        $this->session->set_flashdata('status', 'Save Successfully!');
        redirect('port_video');
        
    }



//-------------------------------------------------------------
//                  TO DISPLAY DATA 
//-------------------------------------------------------------

    public function portfolio_img_table($rowno=0)
    {
        $search_text = "";// Search text

            // Check if the search form is submitted
            if($this->input->post('submit') != NULL )
            {
                $search_text = $this->input->post('search_defective_items');
                $this->session->unset_userdata(array("search_defective_items"=>$search_text));
            }
            // Check if the search form is not submitted and there is a search text in session
            elseif($this->input->post('submit') == NULL && $this->session->userdata('search_defective_items') != NULL)
            {
                $search_text = $this->session->userdata('search_defective_items');
            }

            $rowperpage = 5;// Row per page

            // Check if the row position is specified
            if($rowno != 0)
            {
                $rowno = ($rowno-1) * $rowperpage;
            }

            // Get the total count of records
            $allcount = $this->portfolio_model->get_portfolio_img_logs_count($search_text);

            // Get the records based on the search text, row position and number of rows per page
            $admin_logs_record = $this->portfolio_model->get_portfolio_img_Data($rowno, $rowperpage, $search_text);

            // Pagination Configuration
            $config['base_url'] = base_url('index.php/features/portfolio/portfolio_controller/portfolio_img_table');
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

            // Store the search text in session
            $this->session->set_userdata('search_defective_items', $search_text);

            $system_data = array(
                "result" => $this->customize_model->get_system_info(),
            );

            // Load view with data
            $data = array(
                "pagination" => $pagination_links,
                "result" => $admin_logs_record,
                "row" => $rowno,
                "search" => $search_text,
                "data2" => $system_data,
            );

            $this->load->view('Templates/hd',  $system_data);
            $this->load->view('features/portfolio/portfolio',  $data);
            $this->load->view('Templates/ft');

    }




    public function portfolio_video_table($rowno=0)
    {
        $search_text = "";// Search text

            // Check if the search form is submitted
            if($this->input->post('submit') != NULL )
            {
                $search_text = $this->input->post('search_defective_items');
                $this->session->unset_userdata(array("search_defective_items"=>$search_text));
            }
            // Check if the search form is not submitted and there is a search text in session
            elseif($this->input->post('submit') == NULL && $this->session->userdata('search_defective_items') != NULL)
            {
                $search_text = $this->session->userdata('search_defective_items');
            }

            $rowperpage = 5;// Row per page

            // Check if the row position is specified
            if($rowno != 0)
            {
                $rowno = ($rowno-1) * $rowperpage;
            }

            // Get the total count of records
            $allcount = $this->portfolio_model->get_portfolio_video_logs_count($search_text);

            // Get the records based on the search text, row position and number of rows per page
            $admin_logs_record = $this->portfolio_model->get_portfolio_video_Data($rowno, $rowperpage, $search_text);

            // Pagination Configuration
            $config['base_url'] = base_url('index.php/features/portfolio/portfolio_controller/portfolio_video_table');
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

            // Store the search text in session
            $this->session->set_userdata('search_defective_items', $search_text);

            $system_data = array(
                "result" => $this->customize_model->get_system_info(),
            );


            // Load view with data
            $data = array(
                "pagination" => $pagination_links,
                "result" => $admin_logs_record,
                "row" => $rowno,
                "search" => $search_text, 
                "data2" => $system_data, 
            );


            $this->load->view('Templates/hd', $system_data);
            $this->load->view('features/portfolio_video/portfolio_video',  $data);
            $this->load->view('Templates/ft');

    }

//-------------------------------------------------------------
//                     GET PORTFOLIO DETAILS
//-------------------------------------------------------------



    public function get_portfolio_img_Details($id){


        $system_data = array(
            "result" => $this->customize_model->get_system_info(),
        );

        $portfolio_img = array(
            "result" => $this->portfolio_model->get_portfolio_details_form($id),
        );

        $data = array(
            "data1" => $portfolio_img,
            "data2" => $system_data,
        );
        
        $this->load->view('Templates/hd', $system_data);
        $this->load->view('features/portfolio/update/update_portfolio',  $data);
        $this->load->view('Templates/ft');
    }


    public function get_portfolio_video_Details($id){


        $system_data = array(
            "result" => $this->customize_model->get_system_info(),
        );

        $portfolio_video = array(
            "result" => $this->portfolio_model->get_portfolio_video_details_form($id),
        );

        $data = array(
            "data1" => $portfolio_video,
            "data2" => $system_data,
        );
        
        $this->load->view('Templates/hd', $system_data);
        $this->load->view('features/portfolio/update/update_portfolio_video',  $data);
        $this->load->view('Templates/ft');
    }


//-------------------------------------------------------------
//                     UPDATE 
//-------------------------------------------------------------


    public function update_portfolio_image()
    {
        $config['upload_path'] = FCPATH . 'assets/image/portfolio_image';
        // $config['allowed_types'] = 'gif|jpg|png';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp|ico|svg|webp';
        $config['max_size'] = 5323400;
        $config['max_width'] = 12024;
        $config['max_height'] = 12682;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {

            // Get CPU data  from form inputs using POST method
            $image_title = $this->input->post('image_title');
            $image_caption = $this->input->post('image_caption');
            $portfolio_img_id = $this->input->post('portfolio_img_id');
            $admin_id = $this->input->post('admin_id');
            $admin_name = $this->input->post('admin_name2');
            // Store CPU data in an array with name, brand, description, quantity, price, and category fields
            $portfolio_data = [
                    'image_title' => $image_title,
                    'image_caption' => $image_caption,
            ];

            $team_data = array(
                'date_time_in' => null, 
                'date_time_out' => null, 
                'action' => "Update the image = " .$image_title, 
                'admin_username' => $admin_name, 
                'admin_id' => $admin_id, 
            );
    
            // Call the insert_cpu_db function from model to insert the CPU data into the database
            $this->portfolio_model->updating_portfolio_img($portfolio_data, $portfolio_img_id);
            $this->audit_logs_model->insert_audit_actions($team_data); //this code is to insert the admin user action to logs
            $this->session->set_flashdata('status2', 'Save Successfully!');
            redirect('portfolio');

        } else {
            $upload_data = $this->upload->data();
            $filename = $upload_data['file_name'];
            $id = uniqid(); // generate a unique ID for the image

            // rename the uploaded file to the unique ID
            $userfile = $id . '_' . $filename;
            $new_path = $config['upload_path'] . '/' . $userfile;
            rename($upload_data['full_path'], $new_path);

            // Get CPU dat and image filename from form inputs using POST method
            $image_title = $this->input->post('image_title');
            $image_caption = $this->input->post('image_caption');
            $portfolio_img_id = $this->input->post('portfolio_img_id');
            $admin_id = $this->input->post('admin_id');
            $admin_name = $this->input->post('admin_name2');

            // Store CPU data in an array with name, brand, description, quantity, price, and category fields
            $portfolio_data = [
                    'image_title' => $image_title,
                    'image_caption' => $image_caption,
                    'image' => $userfile,
            ];

            $team_data = array(
                'date_time_in' => null, 
                'date_time_out' => null, 
                'action' => "Update the image = " .$image_title, 
                'admin_username' => $admin_name, 
                'admin_id' => $admin_id, 
            );
            $this->portfolio_model->updating_portfolio_img($portfolio_data, $portfolio_img_id );
            $this->audit_logs_model->insert_audit_actions($team_data); //this code is to insert the admin user action to logs
            $this->session->set_flashdata('status2', 'Save Successfully!');
            redirect('portfolio');
        }
    }


    public function update_portfolio_video()
    {
  
        // Get media data and filename from form inputs using POST method
        $media_title = $this->input->post('video_title');
        $media_caption = $this->input->post('video_description');
        $video_link = $this->input->post('video_link');
        $portfolio_video_id = $this->input->post('portfolio_video_id');
        $admin_id = $this->input->post('admin_id');
        $admin_name = $this->input->post('admin_name2');
        // Store media data in an array with title, caption, and media fields
        $portfolio_data = [
                'video_title' => $media_title,
                'video_description' => $media_caption,
                'video_yt_link' => $video_link,
        ];

        $team_data = array(
            'date_time_in' => null, 
            'date_time_out' => null, 
            'action' => "Update the video = " .$media_title, 
            'admin_username' => $admin_name, 
            'admin_id' => $admin_id, 
        );
        $this->portfolio_model->updating_portfolio_video($portfolio_data, $portfolio_video_id);
        $this->audit_logs_model->insert_audit_actions($team_data); //this code is to insert the admin user action to logs
        $this->session->set_flashdata('status2', 'Save Successfully!');
        redirect('port_video');
        
    }

//-------------------------------------------------------------
//                  TO DELETE PORTFOLIO IMAGE  
//-------------------------------------------------------------

    public function delete_portfolio_image($id){
        $admin_name = $this->session->userdata('admin_username');
        $admin_id = $this->session->userdata('admin_id');
        $image_title = $this->input->get('title');

        $team_data = array(
            'date_time_in' => null, 
            'date_time_out' => null, 
            'action' => "Delete a image =  " . $image_title, 
            'admin_username' => $admin_name, 
            'admin_id' => $admin_id, 
        );

        $this->portfolio_model->delete_portfolio_image($id);
        $this->audit_logs_model->insert_audit_actions($team_data); //this code is to insert the admin user action to logs
        redirect('portfolio');
    }

    
    public function delete_portfolio_video($id){
        $admin_name = $this->session->userdata('admin_username');
        $admin_id = $this->session->userdata('admin_id');
        $video_title = $this->input->get('title');

        $team_data = array(
            'date_time_in' => null, 
            'date_time_out' => null, 
            'action' => "Delete a video =  " . $video_title, 
            'admin_username' => $admin_name, 
            'admin_id' => $admin_id, 
        );

        $this->portfolio_model->delete_portfolio_video($id);
        $this->audit_logs_model->insert_audit_actions($team_data); //this code is to insert the admin user action to logs
        redirect('port_video');
    }




}