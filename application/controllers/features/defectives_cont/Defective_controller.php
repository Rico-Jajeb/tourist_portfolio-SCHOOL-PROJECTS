<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Defective_controller extends CI_Controller {

    public function __construct()
    {
            parent::__construct();
            $this->load->helper("url");
            $this->load->library('session');
            $this->load->library('pagination');
            $this->load->model('defectives/defective_model');
            $this->load->model('items_model/item_category/item_category_model');
            $this->load->helper(array('form', 'url'));
    }




	public function index()
    {
      
    }

//-------------------------------------------------------------
//                  DEFECTIVES TABLES
//-------------------------------------------------------------


	public function defective_table($rowno=0)
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
            $allcount = $this->defective_model->get_defective_logs_count($search_text);

            // Get the records based on the search text, row position and number of rows per page
            $admin_logs_record = $this->defective_model->get_defective_items_Data($rowno, $rowperpage, $search_text);

            // Pagination Configuration
            $config['base_url'] = base_url('index.php/features/defectives_cont/Defective_controller/defective_table');
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

            // Get all categories
            $all_categories = $this->item_category_model->get_categories();

            // Load view with data
            $data = array(
                "pagination" => $pagination_links,
                "result" => $admin_logs_record,
                "row" => $rowno,
                "search" => $search_text,
                "categories" => $all_categories
            );

            $this->load->view('template/header');
            $this->load->view('features/defective/defective', $data);
            $this->load->view('template/footer');
   
    }





//-------------------------------------------------------------
//                  TO INSERT DATA INTO DEFECTIVES
//-------------------------------------------------------------

    public function insert_defective_item()
    {
        $config['upload_path'] = FCPATH . 'assets/image/defective_item_img';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 5323400;
        $config['max_width'] = 12024;
        $config['max_height'] = 12682;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {

            // Get CPU data  from form inputs using POST method
            $name_model = $this->input->post('name_model');
            $brand = $this->input->post('brand');
            $description = $this->input->post('description');
            $quantity = $this->input->post('quantity');
            $category = $this->input->post('category');
            $supplier = $this->input->post('supplier');
            $status = $this->input->post('status');
            $date_found = $this->input->post('date_found');
            $active = $this->input->post('active');

            // Store CPU data in an array with name, brand, description, quantity, price, and category fields
            $defective_data = [
                    'item_name/model' => $name_model,
                    'item_brand' => $brand,
                    'Notes' => $description,
                    'item_quantity' => $quantity,
                    'status' => $status,
                    'item_category' => $category,
                    'item_supplier' => $supplier,
                    'date_found' => $date_found,
                    'active' => $active,
                    
            ];

            // Call the insert_cpu_db function from model to insert the CPU data into the database
            $this->defective_model->insert_defective_into_db($defective_data);
            $this->session->set_flashdata('status', 'Save Successfully!');
            redirect('defective');

        } else {
            $upload_data = $this->upload->data();
            $filename = $upload_data['file_name'];
            $id = uniqid(); // generate a unique ID for the image

            // rename the uploaded file to the unique ID
            $userfile = $id . '_' . $filename;
            $new_path = $config['upload_path'] . '/' . $userfile;
            rename($upload_data['full_path'], $new_path);

            // Get CPU dat and image filename from form inputs using POST method
            $name_model = $this->input->post('name_model');
            $brand = $this->input->post('brand');
            $description = $this->input->post('description');
            $quantity = $this->input->post('quantity');
            $category = $this->input->post('category');
            $supplier = $this->input->post('supplier');
            $status = $this->input->post('status');
            $date_found = $this->input->post('date_found');
            $active = $this->input->post('active');

            // Store CPU data in an array with name, brand, description, quantity, price, and category fields
            $defective_data = [
                    'item_name/model' => $name_model,
                    'item_brand' => $brand,
                    'Notes' => $description,
                    'item_quantity' => $quantity,
                    'status' => $status,
                    'item_category' => $category,
                    'item_supplier' => $supplier,
                    'date_found' => $date_found,
                    'active' => $active,
                    'item_image' => $userfile,
                  
            ];

            $this->defective_model->insert_defective_into_db($defective_data);
            $this->session->set_flashdata('status', 'Save Successfully!');
            redirect('defective');
        }
    }




//-------------------------------------------------------------
//                      DELETE DEFECTIVE ITEM DATA
//-------------------------------------------------------------


    public function delete_defective_data($id){
        $this->defective_model->delete_defective_item_byId($id);
        redirect('defective');
    }


   
//-------------------------------------------------------------
//                       GET DEFECTIVE ITEM DETAILS
//-------------------------------------------------------------


public function get_defective_Details($id){
    $all_items = array(
        "result" => $this->defective_model->get_defective_Form($id),
    );

    $all_category = array(
        //this code will get the data of categories_tbl
        "result" => $this->item_category_model->get_categories(),
    );

    $data = array(
        "data1" => $all_items,
        "data2" => $all_category
    );
    
    $this->load->view('template/header');
    $this->load->view('features/defective/update_defective/update_defective', $data);
    $this->load->view('template/footer');
}


// public function get_defective_Details($id){
//     $data = array(
//         "result" => $this->defective_model->get_defective_Form($id),
//     );

    
//     $this->load->view('template/header');
//     $this->load->view('features/defective/update_defective/update_defective', $data);
//     $this->load->view('template/footer');
// }




//-------------------------------------------------------------
//                       UPDATE  ITEM DETAILS
//-------------------------------------------------------------

    
public function updating_defective_item(){


    $config['upload_path'] = FCPATH . 'assets/image/defective_item_img';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size'] = 5323400;
    $config['max_width'] = 12024;
    $config['max_height'] = 12682;

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('userfile')) {

        // Get CPU data  from form inputs using POST method
        $name_model = $this->input->post('name_model');
        $brand = $this->input->post('brand');
        $description = $this->input->post('description');
        $quantity = $this->input->post('quantity');
        $category = $this->input->post('category');
        $supplier = $this->input->post('supplier');
        $status = $this->input->post('status');
        $date_found = $this->input->post('date_found');
        $product_id = $this->input->post('product_id');

        // Store CPU data in an array with name, brand, description, quantity, price, and category fields
        $product = [
            'item_name/model' => $name_model,
            'item_brand' => $brand,
            'Notes' => $description,
            'item_quantity' => $quantity,
            'status' => $status,
            'item_category' => $category,
            'item_supplier' => $supplier,
            'date_found' => $date_found,
                
        ];

        // Call the insert_cpu_db function from model to insert the CPU data into the database
        $this->defective_model->updating_defective($product, $product_id);
        $this->session->set_flashdata('status2', 'Update Successfully!');
        redirect('defective');

    } else {

        $upload_data = $this->upload->data();
        $filename = $upload_data['file_name'];
        $id = uniqid(); // generate a unique ID for the image

        // rename the uploaded file to the unique ID
        $userfile = $id . '_' . $filename;
        $new_path = $config['upload_path'] . '/' . $userfile;
        rename($upload_data['full_path'], $new_path);

        // Get CPU dat and image filename from form inputs using POST method
        $name_model = $this->input->post('name_model');
        $brand = $this->input->post('brand');
        $description = $this->input->post('description');
        $quantity = $this->input->post('quantity');
        $category = $this->input->post('category');
        $supplier = $this->input->post('supplier');
        $status = $this->input->post('status');
        $date_found = $this->input->post('date_found');
        $product_id = $this->input->post('product_id');

        // Store CPU data in an array with name, brand, description, quantity, price, and category fields
        $product = [
                'item_name/model' => $name_model,
                'item_brand' => $brand,
                'Notes' => $description,
                'item_quantity' => $quantity,
                'status' => $status,
                'item_category' => $category,
                'item_supplier' => $supplier,
                'date_found' => $date_found,
                'item_image' => $userfile,
        ];

        $this->defective_model->updating_defective($product, $product_id);
        $this->session->set_flashdata('status2', 'Update Successfully!');
        redirect('defective');
        
    }


    $this->defective_model->updating_defective($product, $product_id );
    $this->session->set_flashdata('status2', 'Update Successfully!');
    redirect('defective');
    
}



//-------------------------------------------------------------
//                       UPDATE  ACTIVE 
//-------------------------------------------------------------

public function active_update(){
    // this code is for the active checkbox update 

    $defective_id = $this->input->post('defective_id');
    $active = $this->input->post('active');
    
    $data = array(
        'active' => $active,
    );
    $this->defective_model->updating_active($data, $defective_id );
    $this->session->set_flashdata('status3', 'Update Successfully!');
    redirect('defective');
}



public function inactive_update(){
    // this code is for the active checkbox update 

    $defective_id = $this->input->post('defective_id');
    $active = $this->input->post('active');
    
    $data = array(
        'active' => $active,
    );
    $this->defective_model->updating_active($data, $defective_id );
    $this->session->set_flashdata('status4', 'Update Successfully!');
    redirect('defective_inactive_table');
}


//-------------------------------------------------------------
//                       DEFECTIVE INACTIVE TABLE SECTION
//-------------------------------------------------------------

    public function defective_inactive_table($rowno=0)
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
            $allcount = $this->defective_model->get_defective_logs_count($search_text);

            // Get the records based on the search text, row position and number of rows per page
            $admin_logs_record = $this->defective_model->get_inactive_defective_items($rowno, $rowperpage, $search_text);

            // Pagination Configuration
            $config['base_url'] = base_url('index.php/features/defectives_cont/Defective_controller/defective_table');
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

            // Load view
            $data['pagination'] = $pagination_links;
            $data['result'] = $admin_logs_record;
            $data['row'] = $rowno;
            $data['search'] = $search_text;

            $this->load->view('template/header');
            $this->load->view('features/defective/inactive_table/inactive_defective', $data);
            $this->load->view('template/footer');    
    }



}