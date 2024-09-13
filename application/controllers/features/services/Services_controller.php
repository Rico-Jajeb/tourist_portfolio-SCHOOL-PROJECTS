<?php
class Services_controller extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->library('session');
		$this->load->library('pagination');
        $this->load->library('session');
		$this->load->model('customization/customize_model');
		$this->load->model('services/services_model');
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

    public function insert_services()
    {
        $config['upload_path'] = FCPATH . 'assets/image/services';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp|ico|svg|webp';
        $config['max_size'] = 5323400;
        $config['max_width'] = 12024;
        $config['max_height'] = 12682;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {


            $Services_title = $this->input->post('Services_title');
            $Service_desc = $this->input->post('Service_desc');
            $admin_id = $this->input->post('admin_id');
            $admin_name = $this->input->post('admin_name2');

            $service_data = [
                    'services_title' => $Services_title,
                    'services_description' => $Service_desc,
            ];

            $team_data = array(
                'date_time_in' => null, 
                'date_time_out' => null, 
                'action' => "Upload a new service = " .$Services_title, 
                'admin_username' => $admin_name, 
                'admin_id' => $admin_id, 
            );

            $this->services_model->insert_service_db($service_data);
            $this->audit_logs_model->insert_audit_actions($team_data); //this code is to insert the admin user action to logs
            $this->session->set_flashdata('status', 'Save Successfully!');
            redirect('services_table');

        } else {
            $upload_data = $this->upload->data();
            $filename = $upload_data['file_name'];
            $id = uniqid(); // generate a unique ID for the image

            // rename the uploaded file to the unique ID
            $userfile = $id . '_' . $filename;
            $new_path = $config['upload_path'] . '/' . $userfile;
            rename($upload_data['full_path'], $new_path);

            $Services_title = $this->input->post('Services_title');
            $Service_desc = $this->input->post('Service_desc');
            $admin_id = $this->input->post('admin_id');
            $admin_name = $this->input->post('admin_name2');

            $service_data = [
                    'services_title' => $Services_title,
                    'services_description' => $Service_desc,
                    'services_img' => $userfile,
            ];

            $team_data = array(
                'date_time_in' => null, 
                'date_time_out' => null, 
                'action' => "Upload a new service = " .$Services_title, 
                'admin_username' => $admin_name, 
                'admin_id' => $admin_id, 
            );


            $this->services_model->insert_service_db($service_data);
            $this->audit_logs_model->insert_audit_actions($team_data); //this code is to insert the admin user action to logs
            $this->session->set_flashdata('status', 'Save Successfully!');
            redirect('services_table');
        }
    }


//-------------------------------------------------------------
//                  TO DISPLAY DATA 
//-------------------------------------------------------------
    public function services_table($rowno=0)
    {
 
            $rowperpage = 5;// Row per page

            // Check if the row position is specified
            if($rowno != 0)
            {
                $rowno = ($rowno-1) * $rowperpage;
            }

            // Get the total count of records
            $allcount = $this->services_model->get_service_logs_count();

            // Get the records based on the search text, row position and number of rows per page
            $admin_logs_record = $this->services_model->get_service_Data($rowno, $rowperpage);

            // Pagination Configuration
            $config['base_url'] = base_url('index.php/features/services/Services_controller/services_table');
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
            $this->load->view('features/services/services',  $data);
            $this->load->view('Templates/ft');

    }




//-------------------------------------------------------------
//                     GET SERVICE DETAILS
//-------------------------------------------------------------



    public function get_service_Details($id){


        $system_data = array(
            "result" => $this->customize_model->get_system_info(),
        );

        $service_details = array(
            "result" => $this->services_model->get_service_details_form($id),
        );

        $data = array(
            "data1" => $service_details,
            "data2" => $system_data,
        );
        
        $this->load->view('Templates/hd', $system_data);
        $this->load->view('features/services/update/update_services',  $data);
        $this->load->view('Templates/ft');
    }


//-------------------------------------------------------------
//                          UPDATE
//-------------------------------------------------------------

    public function update_services()
    {
        $config['upload_path'] = FCPATH . 'assets/image/services';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp|ico|svg|webp';
        $config['max_size'] = 5323400;
        $config['max_width'] = 12024;
        $config['max_height'] = 12682;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {


            $Services_title = $this->input->post('Services_title');
            $Service_desc = $this->input->post('Service_desc');
            $service_id = $this->input->post('service_id');
            $admin_id = $this->input->post('admin_id');
            $admin_name = $this->input->post('admin_name2');

            $service_data = [
                    'services_title' => $Services_title,
                    'services_description' => $Service_desc,
            ];

            $team_data = array(
                'date_time_in' => null, 
                'date_time_out' => null, 
                'action' => "Update the service = " .$Services_title, 
                'admin_username' => $admin_name, 
                'admin_id' => $admin_id, 
            );

            $this->services_model->updating_services($service_data, $service_id);
            $this->audit_logs_model->insert_audit_actions($team_data); //this code is to insert the admin user action to logs
            $this->session->set_flashdata('status2', 'Save Successfully!');
            redirect('services_table');

        } else {
            $upload_data = $this->upload->data();
            $filename = $upload_data['file_name'];
            $id = uniqid(); // generate a unique ID for the image

            // rename the uploaded file to the unique ID
            $userfile = $id . '_' . $filename;
            $new_path = $config['upload_path'] . '/' . $userfile;
            rename($upload_data['full_path'], $new_path);

            $Services_title = $this->input->post('Services_title');
            $Service_desc = $this->input->post('Service_desc');
            $service_id = $this->input->post('service_id');
            $admin_id = $this->input->post('admin_id');
            $admin_name = $this->input->post('admin_name2');

            $service_data = [
                    'services_title' => $Services_title,
                    'services_description' => $Service_desc,
                    'services_img' => $userfile,
            ];

            $team_data = array(
                'date_time_in' => null, 
                'date_time_out' => null, 
                'action' => "Update the service = " .$Services_title, 
                'admin_username' => $admin_name, 
                'admin_id' => $admin_id, 
            );

            $this->services_model->updating_services($service_data, $service_id);
            $this->audit_logs_model->insert_audit_actions($team_data); //this code is to insert the admin user action to logs
            $this->session->set_flashdata('status2', 'Save Successfully!');
            redirect('services_table');
        }
    }

//-------------------------------------------------------------
//                  TO DELETE SERVICES
//-------------------------------------------------------------

    public function delete_service($id){
        $admin_name = $this->session->userdata('admin_username');
        $admin_id = $this->session->userdata('admin_id');
        $Services_title = $this->input->get('title');

        $team_data = array(
            'date_time_in' => null, 
            'date_time_out' => null, 
            'action' => "Delete the service = " .$Services_title, 
            'admin_username' => $admin_name, 
            'admin_id' => $admin_id, 
        );

        $this->services_model->delete_service($id);
        $this->audit_logs_model->insert_audit_actions($team_data); //this code is to insert the admin user action to logs
        redirect('services_table');
    }

}