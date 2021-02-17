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

    public function pengajuanBarcode()
    {
        // validasi form
        foreach ($this->db->get('mahasiswa')->result_array() as $mahasiswa) {
            $mahasiswaNpm[] = $mahasiswa['npm'];
        }
        $this->form_validation->set_rules('userBarcode', 'Barcode', 'required|in_list[' . implode(',', $mahasiswaNpm) . ']', [
            'required' => 'Mohon pindai ulang Barcode!',
            'in_list' => 'Mahasiswa tidak terdaftar!'
        ]);
        // ambil data user
        if ($this->form_validation->run() == true) {
            $this->db->select('*');
            $this->db->from('user');
            $this->db->join('mahasiswa', 'user.id = mahasiswa.user_id');
            $this->db->where('npm', $this->input->post('userBarcode'));
            $user['npm'] = $this->db->get()->row_array()['npm'];

            // set session
            if ($user) {
                $this->session->set_userdata($user);
                return true;
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Mahasiswa tidak terdaftar!</div>');
                return false;
            }
        } else {
            return false;
        }
    }
}
