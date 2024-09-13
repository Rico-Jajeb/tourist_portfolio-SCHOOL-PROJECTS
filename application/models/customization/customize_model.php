<?php defined('BASEPATH') OR exit('No direct script access allowed');

class customize_model extends CI_Model {


//-------------------------------------------------------------
//                     GET THE DEFECTIVE ITEM  FORM 
//-------------------------------------------------------------
    public function get_system_info()
    {
        return $this->db->get('Customize_system')->row_array();
    } 

    public function get_total_portfolio_img()
    {
        $this->db->select('count(*) as image_count');
        $this->db->from('portfolio_image');
        $query = $this->db->get();
        return $query->row()->image_count;
    }

    public function get_total_portfolio_video()
    {
        $this->db->select('count(*) as video_id ');
        $this->db->from('portfolio_video');
        $query = $this->db->get();
        return $query->row()->video_id ;
    }

    public function get_total_admins()
    {
        $this->db->select('count(*) as admin_id ');
        $this->db->from('all_admin_user');
        $query = $this->db->get();
        return $query->row()->admin_id ;
    }

    public function get_total_team()
    {
        $this->db->select('count(*) as team_id ');
        $this->db->from('team');
        $query = $this->db->get();
        return $query->row()->team_id ;
    }
    

    public function updating_shop_info($data, $custom_id){
        $this->db->set($data);
        $this->db->where('custom_id', $custom_id)->update('Customize_system',$data);
    }


}