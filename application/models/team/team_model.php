<?php defined('BASEPATH') OR exit('No direct script access allowed');

class team_model extends CI_Model {

//-------------------------------------------------------------
//                      INSERT SERVICE INTO DB
//-------------------------------------------------------------

    public function insert_team_db($team_data)
    {
        $this->db->set($team_data);
        return $this->db->insert('team');
    }




//-------------------------------------------------------------
//                      RETRIEVE ITEMS  SECTION
//-------------------------------------------------------------
    
     // Fetch records
     public function get_team_Data($rowno, $rowperpage )
     {
         $this->db->select('*');
         $this->db->from('team');
 
         $this->db->order_by('team_id', 'desc'); // added order by clause
         $this->db->limit($rowperpage, $rowno);
         $query = $this->db->get();
     
         return $query->result_array();
     }
 
     

     // Select total records
     public function get_team_logs_count()
     {
         $this->db->select('count(*) as allcount');
         $this->db->from('team');

     
         $query = $this->db->get();
         $result = $query->result_array();
     
         return $result[0]['allcount'];
     }



     public function retrieve_team_data()
     {
        return $this->db->get('team')->result_array();
     }



//-------------------------------------------------------------
//                  RETRIEVE Service DETAILS FOR UPDATE
//-------------------------------------------------------------

public function get_team_details_form($id)
{
    return $this->db->where('team_id', $id)->get('team')->row_array();
} 


// -------------------------------------------------------------
//                      UPDATE 
// -------------------------------------------------------------

public function updating_team($team_data, $team_id){
    $this->db->set($team_data);
    $this->db->where('team_id', $team_id)->update('team',$team_data);
}

//-------------------------------------------------------------
//                      DELETE
//-------------------------------------------------------------

public function delete_team($id){
    $this->db->where('team_id', $id)->delete('team');
}




}