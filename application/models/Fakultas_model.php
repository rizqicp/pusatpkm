<?php defined('BASEPATH') or exit('No direct script access allowed');

class Fakultas_model extends CI_Model
{
    private $id;
    private $nama;

    public function __construct()
    {
        parent::__construct();
        $this->db->get();
    }
}
