<?php defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function getalluser()
    {
        $this->db->select('id,email,password,role,status');
        $this->db->from('user');
        return $this->db->get()->result_array();
    }
}
