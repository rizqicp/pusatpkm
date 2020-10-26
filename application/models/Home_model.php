<?php defined('BASEPATH') or exit('No direct script access allowed');

class Home_model extends CI_Model
{
    public function lihatPengumuman()
    {
        $maxData = 2;
        $dataCount = count($this->db->get('pengumuman')->result_array());
        $pageCount = ceil($dataCount / $maxData);
        $activePage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $startFrom = max(($maxData * $activePage) - $maxData, 0);

        if ($activePage <= $pageCount && $activePage >= 1) {
            $this->db->select('id, judul, isi, gambar, waktu, status');
            $this->db->from('pengumuman');
            $this->db->where('status', 'aktif');
            if (isset($_GET['pencarian'])) {
                $this->db->like('judul', $_GET['pencarian']);
                $this->db->or_like('isi', $_GET['pencarian']);
            }
            $this->db->limit($maxData, $startFrom);
            $this->db->order_by('waktu', 'DESC');
            return $this->db->get()->result_array();
        } else {
            return null;
        }
    }

    public function pagination()
    {
        $maxData = 2;
        $dataCount = count($this->db->get('pengumuman')->result_array());
        $pageCount = ceil($dataCount / $maxData);
        $activePage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $startFrom = max(($maxData * $activePage) - $maxData, 0);

        return [
            'max' => $maxData,
            'from' => $startFrom,
            'count' => $pageCount,
            'active' => $activePage
        ];
    }
}
