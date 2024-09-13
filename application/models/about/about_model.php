<?php defined('BASEPATH') OR exit('No direct script access allowed');

class about_model extends CI_Model {

//-------------------------------------------------------------
//                      INSERT SERVICE INTO DB
//-------------------------------------------------------------

    public function insert_about_db($about_us_data)
    {
        $this->db->set($about_us_data);
        return $this->db->insert('about');
    }




//-------------------------------------------------------------
//                      RETRIEVE ITEMS  SECTION
//-------------------------------------------------------------
    
     // Fetch records
     public function get_about_Data($rowno, $rowperpage )
     {
         $this->db->select('*');
         $this->db->from('about');
        //  $this->db->where('active', 1);
 
         $this->db->order_by('about_id', 'desc'); // added order by clause
         $this->db->limit($rowperpage, $rowno);
         $query = $this->db->get();
     
         return $query->result_array();
     }
 
     

     // Select total records
     public function get_about_logs_count()
     {
         $this->db->select('count(*) as allcount');
         $this->db->from('about');

     
         $query = $this->db->get();
         $result = $query->result_array();
     
         return $result[0]['allcount'];
     }



     public function retrieve_about_data()
     {
        return $this->db->get('about')->result_array();
     }





//-------------------------------------------------------------
//                  RETRIEVE Service DETAILS FOR UPDATE
//-------------------------------------------------------------

public function get_about_details_form($id)
{
    return $this->db->where('about_id', $id)->get('about')->row_array();
} 


// -------------------------------------------------------------
//                      UPDATE 
// -------------------------------------------------------------

public function updating_about($about_us_data, $about_id){
    $this->db->set($about_us_data);
    $this->db->where('about_id', $about_id)->update('about',$about_us_data);
}


//-------------------------------------------------------------
//                      DELETE
//-------------------------------------------------------------

public function delete_about($id){
    $this->db->where('about_id', $id)->delete('about');
}

}