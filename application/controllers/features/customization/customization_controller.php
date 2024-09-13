<?php
class customization_controller extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->model('portfolio/portfolio_model');
		$this->load->model('customization/customize_model');
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
//                  TO DISPLAY THE SHOP INFO
//-------------------------------------------------------------

    public function get_system_details(){
        $system_data = array(
            "result" => $this->customize_model->get_system_info(),
        );

        $this->load->view('Templates/hd', $system_data);
        $this->load->view('features/customization/customization', $system_data );
        $this->load->view('Templates/ft');
    }


//-------------------------------------------------------------
//                  TO UPDATE THE SHOP INFO
//-------------------------------------------------------------
public function update_shop_name(){
    // this code is for the SHOP NAME
    $admin_id = $this->input->post('admin_id');
    $admin_name = $this->input->post('admin_name2');
    $shop_name = $this->input->post('shop_name');
    $custom_id = 1;

    $data = array(
        'system_tittle' => $shop_name,
    );
    $team_data = array(
        'date_time_in' => null, 
        'date_time_out' => null, 
        'action' => "Update the system name = " .$shop_name, 
        'admin_username' => $admin_name, 
        'admin_id' => $admin_id, 
    );

    $this->customize_model->updating_shop_info($data, $custom_id );
    $this->audit_logs_model->insert_audit_actions($team_data); //this code is to insert the admin user action to logs
    $this->session->set_flashdata('status3', 'Update Successfully!');
    redirect('Customize');
}


public function update_shop_quote(){
    // this code is for the SHOP QUOTE 
    $admin_id = $this->input->post('admin_id');
    $admin_name = $this->input->post('admin_name2');
    $shop_quote = $this->input->post('shop_quote');
    $custom_id = 1;
    $data = array(
        'system_quote' => $shop_quote,
    );
    $team_data = array(
        'date_time_in' => null, 
        'date_time_out' => null, 
        'action' => "Update the system quote = " .$shop_quote, 
        'admin_username' => $admin_name, 
        'admin_id' => $admin_id, 
    );
    $this->customize_model->updating_shop_info($data, $custom_id );
    $this->audit_logs_model->insert_audit_actions($team_data); //this code is to insert the admin user action to logs
    $this->session->set_flashdata('status3', 'Update Successfully!');
    redirect('Customize');
}

public function update_facebook_link(){
    // this code is for the SHOP QUOTE 
    $admin_id = $this->input->post('admin_id');
    $admin_name = $this->input->post('admin_name2');
    $facebook = $this->input->post('facebook');
    $custom_id = 1;
    $data = array(
        'facebook_link' => $facebook,
    );
    $team_data = array(
        'date_time_in' => null, 
        'date_time_out' => null, 
        'action' => "Update the facebook link = " .$facebook, 
        'admin_username' => $admin_name, 
        'admin_id' => $admin_id, 
    );
    $this->customize_model->updating_shop_info($data, $custom_id );
    $this->audit_logs_model->insert_audit_actions($team_data); //this code is to insert the admin user action to logs
    $this->session->set_flashdata('status3', 'Update Successfully!');
    redirect('Customize');
}

public function update_twitter_link(){
    // this code is for the SHOP QUOTE 
    $admin_id = $this->input->post('admin_id');
    $admin_name = $this->input->post('admin_name2');
    $twitter = $this->input->post('twitter');
    $custom_id = 1;
    $data = array(
        'twitter_link' => $twitter,
    );
    $team_data = array(
        'date_time_in' => null, 
        'date_time_out' => null, 
        'action' => "Update the twitter link = " .$twitter, 
        'admin_username' => $admin_name, 
        'admin_id' => $admin_id, 
    );
    $this->customize_model->updating_shop_info($data, $custom_id );
    $this->audit_logs_model->insert_audit_actions($team_data); //this code is to insert the admin user action to logs
    $this->session->set_flashdata('status3', 'Update Successfully!');
    redirect('Customize');
}

public function update_instagram_link(){
    // this code is for the SHOP QUOTE 
    $admin_id = $this->input->post('admin_id');
    $admin_name = $this->input->post('admin_name2');
    $instagram = $this->input->post('instagram');
    $custom_id = 1;
    $data = array(
        'instagram_link' => $instagram,
    );
    $team_data = array(
        'date_time_in' => null, 
        'date_time_out' => null, 
        'action' => "Update the instagram link = " .$instagram, 
        'admin_username' => $admin_name, 
        'admin_id' => $admin_id, 
    );
    $this->customize_model->updating_shop_info($data, $custom_id );
    $this->audit_logs_model->insert_audit_actions($team_data); //this code is to insert the admin user action to logs
    $this->session->set_flashdata('status3', 'Update Successfully!');
    redirect('Customize');
}


public function update_shop_logo(){
    // this code is for the SHOP LOGO
    $config['upload_path'] = FCPATH . 'assets/image/system_logo';
    // $config['allowed_types'] = 'gif|jpg|png';
    $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp|ico|svg|webp';
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
        
        $admin_id = $this->input->post('admin_id');
        $admin_name = $this->input->post('admin_name2');
        $custom_id = 1;
        $data = [
                'system_logo' => $userfile,
        ];

        $team_data = array(
            'date_time_in' => null, 
            'date_time_out' => null, 
            'action' => "Update the system logo", 
            'admin_username' => $admin_name, 
            'admin_id' => $admin_id, 
        );

        $this->customize_model->updating_shop_info($data, $custom_id );
        $this->audit_logs_model->insert_audit_actions($team_data); //this code is to insert the admin user action to logs
        $this->session->set_flashdata('status3', 'Update Successfully!');
        redirect('Customize');
        
    }
    redirect('Customize');
}

public function update_shop_background_image(){
    // this code is for the SHOP BACKGROUND IMAGE
    $config['upload_path'] = FCPATH . 'assets/image/system_background_img';
    // $config['allowed_types'] = 'gif|jpg|png';
    $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp|ico|svg|webp';

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
        
        $admin_id = $this->input->post('admin_id');
        $admin_name = $this->input->post('admin_name2');
        $custom_id = 1;
        $data = [
                'system_background_image' => $userfile,
        ];
        $team_data = array(
            'date_time_in' => null, 
            'date_time_out' => null, 
            'action' => "Update the system background image ", 
            'admin_username' => $admin_name, 
            'admin_id' => $admin_id, 
        );

        $this->customize_model->updating_shop_info($data, $custom_id );
        $this->audit_logs_model->insert_audit_actions($team_data); //this code is to insert the admin user action to logs
        $this->session->set_flashdata('status3', 'Update Successfully!');
        redirect('Customize');
        
    }
    redirect('Customize');
}



   





}