<?php defined('BASEPATH') or exit('No direct script access allowed');

class Home_model extends CI_Model
{
    public function pagination()
    {
        $max = 2;
        $dataCount = count($this->db->get('pengumuman')->result_array());
        $pageCount = ceil($dataCount / $max);
        $activePage = isset($_GET['page']) ? $_GET['page'] : 1;
        $from = ($max * $activePage) - $max;

        return [
            'max' => $max,
            'from' => $from,
            'count' => $pageCount
        ];
    }

    public function lihatPengumuman()
    {
        $max = 2;
        $dataCount = count($this->db->get('pengumuman')->result_array());
        $pageCount = ceil($dataCount / $max);
        $activePage = isset($_GET['page']) ? $_GET['page'] : 1;
        $from = ($max * $activePage) - $max;

        if ($activePage <= $pageCount && $activePage >= 1) {
            $this->db->select('id, judul, isi, gambar, waktu, status');
            $this->db->from('pengumuman');
            $this->db->where('status', 'aktif');
            $this->db->limit($max, $from);
            $this->db->order_by('waktu', 'DESC');
            return $this->db->get()->result_array();
        } else {
            return null;
        }
    }
}
