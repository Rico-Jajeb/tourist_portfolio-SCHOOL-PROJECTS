<?php defined('BASEPATH') OR exit('No direct script access allowed');

class audit_logs_model extends CI_Model {

//-------------------------------------------------------------
//                      INSERT SERVICE INTO DB
//-------------------------------------------------------------

    public function insert_team_db($team_data)
    {
        $this->db->set($team_data);
        return $this->db->insert('team');
    }

    public function insert_audit_actions($team_data)
    {
        $this->db->set($team_data);
        return $this->db->insert('audit_trail_admin');
    }

    public function insert_audit_actions2($team_data2)
    {
        $this->db->set($team_data2);
        return $this->db->insert('audit_trail_admin');
    }




//-------------------------------------------------------------
//                      RETRIEVE ITEMS  SECTION
//-------------------------------------------------------------
    
     // Fetch records
     public function get_audit_logs_Data($rowno, $rowperpage )
     {
         $this->db->select('*');
         $this->db->from('audit_trail_admin');
 
         $this->db->order_by('logs_id', 'desc'); // added order by clause
         $this->db->limit($rowperpage, $rowno);
         $query = $this->db->get();
     
         return $query->result_array();
     }
 
     

     // Select total records
     public function get_audit_logs_count()
     {
         $this->db->select('count(*) as allcount');
         $this->db->from('audit_trail_admin');

     
         $query = $this->db->get();
         $result = $query->result_array();
     
         return $result[0]['allcount'];
     }



     public function retrieve_team_data()
     {
        return $this->db->get('team')->result_array();
     }





}