<?php defined('BASEPATH') or exit('No direct script access allowed');

class Home_model extends CI_Model
{
    public function getAllPengumuman()
    {
        $this->db->where('status', 'aktif');
        return $this->db->get('pengumuman')->result_array();
    }

    public function getPengumumanLimit($limit, $start, $search = null)
    {
        $this->db->like('judul', $search);
        $this->db->where('status', 'aktif');
        $this->db->order_by('waktu', 'DESC');
        return $this->db->get('pengumuman', $limit, $start)->result_array();
    }

    public function getPengumumanById($id)
    {
        $this->db->select('id, judul, isi, gambar, waktu, status');
        $this->db->from('pengumuman');
        $this->db->where('id', $id);
        return $this->db->get()->row_array();
    }

    public function getCaptionData($limit, $start, $count)
    {
        $firstData = $start != null ? intval($start) + 1 : 1;
        $lastData = $firstData + $limit - 1;
        $totalData = count($count);
        return array(
            'firstData' => $firstData,
            'lastData' => $lastData,
            'totalData' => $totalData
        );
    }
}
