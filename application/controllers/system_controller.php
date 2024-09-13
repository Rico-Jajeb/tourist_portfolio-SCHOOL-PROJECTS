<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class system_controller extends CI_Controller {



	public function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->model('portfolio/portfolio_model');
        $this->load->model('customization/customize_model');
		$this->load->model('services/services_model');
		$this->load->model('about/about_model');
		$this->load->model('team/team_model');
	}
	
	public function index()
	{
        // $portfolio_img = array(
        //     'result' => $this->portfolio_model->retrieve_portfolio_img(),
        // );

		// $system_data = array(
		// 	"result" => $this->customize_model->get_system_info(),
		// );

        // $data = array(
        //     'data1' => $portfolio_img,
        //     'data2' => $system_data,
        // );

        // $this->load->view('layout/header');
        // $this->load->view('features/home_page/main_page', $data);
        // $this->load->view('layout/footer');
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



}
