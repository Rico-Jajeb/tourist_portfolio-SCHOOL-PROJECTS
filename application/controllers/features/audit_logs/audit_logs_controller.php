<?php
class audit_logs_controller extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->library('session');
		$this->load->library('pagination');
        $this->load->library('session');
		$this->load->model('customization/customize_model');
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


        if (!$this->upload->do_upload('userfile')) {

            $team_data = [
                    'team_name' => $name,
                    'team_role' => $role,
                    'team_twitter_link' => $twitter_link,
                    'team_facebook_link' => $facebook_link,
                    'team_instagram_link' => $instagram_link,
            ];

            $this->team_model->insert_team_db($team_data);
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

            $about_year = $this->input->post('about_year');
            $about_title = $this->input->post('about_title');
            $about_story = $this->input->post('about_story');

            $team_data = [
                    'team_name' => $name,
                    'team_role' => $role,
                    'team_twitter_link' => $twitter_link,
                    'team_facebook_link' => $facebook_link,
                    'team_instagram_link' => $instagram_link,
                    'team_img' => $userfile,
            ];

            $this->team_model->insert_team_db($team_data);
            $this->session->set_flashdata('status', 'Save Successfully!');
            redirect('team_table');
        }
    }


//-------------------------------------------------------------
//                  TO DISPLAY DATA 
//-------------------------------------------------------------
    public function audit_logs_table($rowno=0)
    {
 
            $rowperpage = 10;// Row per page

            // Check if the row position is specified
            if($rowno != 0)
            {
                $rowno = ($rowno-1) * $rowperpage;
            }

            // Get the total count of records
            $allcount = $this->audit_logs_model->get_audit_logs_count();

            // Get the records based on the search text, row position and number of rows per page
            $admin_logs_record = $this->audit_logs_model->get_audit_logs_Data($rowno, $rowperpage);

            // Pagination Configuration
            $config['base_url'] = base_url('index.php/features/audit_logs/audit_logs_controller/audit_logs_table');
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
            $this->load->view('features/audit_logs/audit_logs',  $data);
            $this->load->view('Templates/ft');

    }








}