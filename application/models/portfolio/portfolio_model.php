<?php defined('BASEPATH') OR exit('No direct script access allowed');

class portfolio_model extends CI_Model {

//-------------------------------------------------------------
//                      INSERT ITEMS  SECTION
//-------------------------------------------------------------
  
    public function insert_image_into_db($portfolio_data)
    {
        $this->db->set($portfolio_data);
        return $this->db->insert('portfolio_image');
    }


    public function insert_video_into_db($portfolio_data)
    {
        $this->db->set($portfolio_data);
        return $this->db->insert('portfolio_video');
    }






//-------------------------------------------------------------
//                      RETRIEVE ITEMS  SECTION
//-------------------------------------------------------------
    
     // Fetch records
     public function get_portfolio_img_Data($rowno, $rowperpage, $search = "")
     {
         $this->db->select('*');
         $this->db->from('portfolio_image');
        //  $this->db->where('active', 1);

         if ($search != '') {
             $this->db->or_like('image_title', $search);
             $this->db->or_like('image_caption', $search);
         }
 
         $this->db->order_by('image_id', 'desc'); // added order by clause
         $this->db->limit($rowperpage, $rowno);
         $query = $this->db->get();
     
         return $query->result_array();
     }
 
     

     // Select total records
     public function get_portfolio_img_logs_count($search = '')
     {
         $this->db->select('count(*) as allcount');
         $this->db->from('portfolio_image');
     
         if ($search != '') {
            $this->db->or_like('image_title', $search);
            $this->db->or_like('image_caption', $search);
         }
     
         $query = $this->db->get();
         $result = $query->result_array();
     
         return $result[0]['allcount'];
     }

// --------------------video

     // Fetch records
     public function get_portfolio_video_Data($rowno, $rowperpage, $search = "")
     {
         $this->db->select('*');
         $this->db->from('portfolio_video');
        //  $this->db->where('active', 1);

         if ($search != '') {
             $this->db->or_like('video_title', $search);
             $this->db->or_like('video_description', $search);
         }
 
         $this->db->order_by('video_id', 'desc'); // added order by clause
         $this->db->limit($rowperpage, $rowno);
         $query = $this->db->get();
     
         return $query->result_array();
     }
 
     

     // Select total records
     public function get_portfolio_video_logs_count($search = '')
     {
         $this->db->select('count(*) as allcount');
         $this->db->from('portfolio_video');
     
         if ($search != '') {
            $this->db->or_like('video_title', $search);
            $this->db->or_like('video_description', $search);
         }
     
         $query = $this->db->get();
         $result = $query->result_array();
     
         return $result[0]['allcount'];
     }





//-------------------------------------------------------------
//                  RETRIEVE PORTFOLIO DETAILS FOR UPDATE
//-------------------------------------------------------------

     public function get_portfolio_details_form($id)
     {
         return $this->db->where('image_id', $id)->get('portfolio_image')->row_array();
     } 

     public function get_portfolio_video_details_form($id)
     {
         return $this->db->where('video_id', $id)->get('portfolio_video')->row_array();
     } 




//-------------------------------------------------------------
//                  RETRIEVE PORTFOLIO IMAGE INTO HOMEPAGE
//-------------------------------------------------------------

     public function retrieve_portfolio_img()
     {
        return $this->db->get('portfolio_image')->result_array();
     }

     public function retrieve_portfolio_video()
     {
        return $this->db->get('portfolio_video')->result_array();
     }



 
 
//-------------------------------------------------------------
//                      DELETE
//-------------------------------------------------------------

    public function delete_portfolio_image($id){
        $this->db->where('image_id', $id)->delete('portfolio_image');
    }
    public function delete_portfolio_video($id){
        $this->db->where('video_id', $id)->delete('portfolio_video');
    }







// -------------------------------------------------------------
//                      UPDATE 
// -------------------------------------------------------------

    public function updating_portfolio_img($portfolio_data, $portfolio_img_id){
        $this->db->set($portfolio_data);
        $this->db->where('image_id', $portfolio_img_id)->update('portfolio_image',$portfolio_data);
    }

    public function updating_portfolio_video($portfolio_data, $portfolio_video_id){
        $this->db->set($portfolio_data);
        $this->db->where('video_id', $portfolio_video_id)->update('portfolio_video',$portfolio_data);
    }







}