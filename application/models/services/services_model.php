<?php defined('BASEPATH') OR exit('No direct script access allowed');

class services_model extends CI_Model {

//-------------------------------------------------------------
//                      INSERT SERVICE INTO DB
//-------------------------------------------------------------

    public function insert_service_db($service_data)
    {
        $this->db->set($service_data);
        return $this->db->insert('Services');
    }




//-------------------------------------------------------------
//                      RETRIEVE ITEMS  SECTION
//-------------------------------------------------------------
    
     // Fetch records
     public function get_service_Data($rowno, $rowperpage )
     {
         $this->db->select('*');
         $this->db->from('Services');
        //  $this->db->where('active', 1);
 
         $this->db->order_by('services_id', 'desc'); // added order by clause
         $this->db->limit($rowperpage, $rowno);
         $query = $this->db->get();
     
         return $query->result_array();
     }
 
     

     // Select total records
     public function get_service_logs_count()
     {
         $this->db->select('count(*) as allcount');
         $this->db->from('Services');

     
         $query = $this->db->get();
         $result = $query->result_array();
     
         return $result[0]['allcount'];
     }



     public function retrieve_service_data()
     {
        return $this->db->get('Services')->result_array();
     }




//-------------------------------------------------------------
//                  RETRIEVE Service DETAILS FOR UPDATE
//-------------------------------------------------------------

public function get_service_details_form($id)
{
    return $this->db->where('services_id', $id)->get('Services')->row_array();
} 


// -------------------------------------------------------------
//                      UPDATE 
// -------------------------------------------------------------

public function updating_services($service_data, $service_id){
    $this->db->set($service_data);
    $this->db->where('services_id', $service_id)->update('Services',$service_data);
}

//-------------------------------------------------------------
//                      DELETE
//-------------------------------------------------------------

public function delete_service($id){
    $this->db->where('services_id', $id)->delete('Services');
}

}