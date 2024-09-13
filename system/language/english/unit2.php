public function index()
	{
        $portfolio_img = array(
            'result' => $this->portfolio_model->retrieve_portfolio_img(),
        );

		$system_data = array(
			"result" => $this->customize_model->get_system_info(),
		);

        $data = array(
            'data1' => $portfolio_img,
            'data2' => $system_data,
        );

        $this->load->view('layout/header');
        $this->load->view('features/home_page/main_page', $data);
        $this->load->view('layout/footer');
	}


	public function main()
	{
		$system_data = array(
			"result" => $this->customize_model->get_system_info(),
		);

		$this->load->view('layout/header');
		$this->load->view('features/home_page/main_page', $system_data);
		$this->load->view('layout/footer');
	}




//-------------------------------------------------------------
//                  TO DISPLAY INFO INTO HOMEPAGE
//-------------------------------------------------------------
	public function display_portfolio_image()
    {
        $portfolio_img = array(
            'result' => $this->portfolio_model->retrieve_portfolio_img(),
        );

        $portfolio_video = array(
            'result' => $this->portfolio_model->retrieve_portfolio_video(),
        );

		$system_data = array(
			"result" => $this->customize_model->get_system_info(),
		);

		$service_data = array(
            'result' => $this->services_model->retrieve_service_data(),
        );

		$about_us_data = array(
            'result' => $this->about_model->retrieve_about_data(),
        );

		$team_data = array(
            'result' => $this->team_model->retrieve_team_data(),
        );


        $data = array(
            'data1' => $portfolio_img,
            'data2' => $system_data,
            'data3' => $service_data,
            'data4' => $about_us_data,
            'data5' => $team_data,
            'data6' => $portfolio_video,
        );

        $this->load->view('layout/header', $data);
        $this->load->view('features/home_page/main_page', $data);
        $this->load->view('layout/footer');

    }
  



	public function display_portfolio_details($id)
	{
		$portfolio_img_details = array(
            'result' => $this->portfolio_model->retrieve_portfolio_img_details($id),
        );

		$system_data = array(
			"result" => $this->customize_model->get_system_info(),
		);


        $data = array(
            'data1' => $portfolio_img_details,
            'data2' => $system_data,

        );

		$this->load->view('layout/header', $data);
        $this->load->view('features/home_page/portfolio_details', $data);
        $this->load->view('layout/footer');
	}








    public function sign_inn()
	{
		$this->load->view('Templates/dashboard_header');
		$this->load->view('Authentication/sign_in');
		$this->load->view('Templates/dashboard_footer');
	}


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
        $config['allowed_types'] = 'gif|jpg|png';
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


            // Store CPU data in an array with name, brand, description, quantity, price, and category fields
            $portfolio_data = [
                    'image_title' => $image_title,
                    'image_caption' => $image_caption,
                    'image' => $userfile,
            ];

            $this->portfolio_model->insert_image_into_db($portfolio_data);
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

        // Store media data in an array with title, caption, and media fields
        $portfolio_data = [
                'video_title' => $media_title,
                'video_description' => $media_caption,
                'video_yt_link' => $video_link,
        ];

        $this->portfolio_model->insert_video_into_db($portfolio_data);
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
//                  TO DELETE PORTFOLIO IMAGE  
//-------------------------------------------------------------

    public function delete_portfolio_image($id){
        $this->portfolio_model->delete_portfolio_image($id);
        redirect('portfolio');
    }
















//-------------------------------------------------------------
//                  TO UPDATE THE SHOP INFO
//-------------------------------------------------------------
public function update_shop_name(){
// this code is for the SHOP NAME

$shop_name = $this->input->post('shop_name');
$custom_id = 1;
$data = array(
    'system_tittle' => $shop_name,
);
$this->customize_model->updating_shop_info($data, $custom_id );
$this->session->set_flashdata('status3', 'Update Successfully!');
redirect('Customize');
}


public function update_shop_quote(){
// this code is for the SHOP QUOTE 

$shop_quote = $this->input->post('shop_quote');
$custom_id = 1;
$data = array(
    'system_quote' => $shop_quote,
);
$this->customize_model->updating_shop_info($data, $custom_id );
$this->session->set_flashdata('status3', 'Update Successfully!');
redirect('Customize');
}


public function update_shop_logo(){
// this code is for the SHOP LOGO
$config['upload_path'] = FCPATH . 'assets/image/system_logo';
$config['allowed_types'] = 'gif|jpg|png';
$config['max_size'] = 5323400;
$config['max_width'] = 12024;
$config['max_height'] = 12682;

$this->load->library('upload', $config);

if (!$this->upload->do_upload('userfile')) {
    redirect('Customize');
} else {
    $upload_data = $this->upload->data();
    $filename = $upload_data['file_name'];
    $id = uniqid(); // generate a unique ID for the image

    // rename the uploaded file to the unique ID
    $userfile = $id . '_' . $filename;
    $new_path = $config['upload_path'] . '/' . $userfile;
    rename($upload_data['full_path'], $new_path);
    
    $custom_id = 1;
    $data = [
            'system_logo' => $userfile,
    ];

    $this->customize_model->updating_shop_info($data, $custom_id );
    $this->session->set_flashdata('status3', 'Update Successfully!');
    redirect('Customize');
    
}
redirect('Customize');
}

public function update_shop_background_image(){
// this code is for the SHOP BACKGROUND IMAGE
$config['upload_path'] = FCPATH . 'assets/image/system_background_img';
$config['allowed_types'] = 'gif|jpg|png';
$config['max_size'] = 5323400;
$config['max_width'] = 12024;
$config['max_height'] = 12682;

$this->load->library('upload', $config);

if (!$this->upload->do_upload('userfile')) {
    redirect('Customize');
} else {
    $upload_data = $this->upload->data();
    $filename = $upload_data['file_name'];
    $id = uniqid(); // generate a unique ID for the image

    // rename the uploaded file to the unique ID
    $userfile = $id . '_' . $filename;
    $new_path = $config['upload_path'] . '/' . $userfile;
    rename($upload_data['full_path'], $new_path);
    
    $custom_id = 1;
    $data = [
            'system_background_image' => $userfile,
    ];

    $this->customize_model->updating_shop_info($data, $custom_id );
    $this->session->set_flashdata('status3', 'Update Successfully!');
    redirect('Customize');
    
}
redirect('Customize');
}


//-------------------------------------------------------------
//                  TO INSERT SERVICES
//-------------------------------------------------------------

public function insert_services()
{
    $config['upload_path'] = FCPATH . 'assets/image/services';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size'] = 5323400;
    $config['max_width'] = 12024;
    $config['max_height'] = 12682;

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('userfile')) {


        $Services_title = $this->input->post('Services_title');
        $Service_desc = $this->input->post('Service_desc');

        $service_data = [
                'services_title' => $Services_title,
                'services_description' => $Service_desc,
        ];

        $this->services_model->insert_service_db($service_data);
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

        $Services_title = $this->input->post('Services_title');
        $Service_desc = $this->input->post('Service_desc');

        $service_data = [
                'services_title' => $Services_title,
                'services_description' => $Service_desc,
                'services_img' => $userfile,
        ];


        $this->services_model->insert_service_db($service_data);
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

    }}
