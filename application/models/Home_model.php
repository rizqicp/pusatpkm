<?php defined('BASEPATH') or exit('No direct script access allowed');

class Home_model extends CI_Model
{
    public function lihatPengumuman()
    {
        $maxData = 2;
        $dataCount = count($this->db->get('pengumuman')->result_array());
        $pageCount = ceil($dataCount / $maxData);
        $activePage = max(isset($_GET['page']) ? (int)$_GET['page'] : 1, 0);
        $startFrom = ($maxData * $activePage) - $maxData;

        if ($activePage <= $pageCount && $activePage >= 1) {
            $this->db->select('id, judul, isi, gambar, waktu, status');
            $this->db->from('pengumuman');
            $this->db->where('status', 'aktif');
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
        $activePage = max(isset($_GET['page']) ? (int)$_GET['page'] : 1, 0);
        $startFrom = ($maxData * $activePage) - $maxData;

        return [
            'max' => $maxData,
            'from' => $startFrom,
            'count' => $pageCount,
            'activePage' => $activePage
        ];
    }
}
