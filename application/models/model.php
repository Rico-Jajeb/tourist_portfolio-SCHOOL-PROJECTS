<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model extends CI_Model 
{

  public function verify_login()
    {
        $username = (string) $this->input->post('username');
        $password = (string) $this->input->post('password');


        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $this->db->where('status','active');
        $query = $this->db->get('user');
        $row = $query->row();

        if ($row)
        {
            $this->user_session($row);

            return TRUE;
        }
            return FALSE;

    }
}