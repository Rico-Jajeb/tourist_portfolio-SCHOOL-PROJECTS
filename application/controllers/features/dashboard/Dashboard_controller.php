<?php
class Dashboard_controller extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->library('session');
		$this->load->library('pagination');
        $this->load->library('session');
		$this->load->model('customization/customize_model');
	}

    public function index() 
    {
		$system_data = array(
            "result" => $this->customize_model->get_system_info(),
            "total_img" => $this->customize_model->get_total_portfolio_img(),
            "total_vid" => $this->customize_model->get_total_portfolio_video(),
            "total_admins" => $this->customize_model->get_total_admins(),
            "total_team" => $this->customize_model->get_total_team(),
        );

        $this->load->view('Templates/hd', $system_data);
        $this->load->view('features/dashboard/dashboard', $system_data );
        $this->load->view('Templates/ft');
    }

}