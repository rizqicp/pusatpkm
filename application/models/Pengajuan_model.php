<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pengajuan_model extends CI_Model
{
    public function tambahPengajuan()
    {
        foreach ($this->db->get('periode')->result_array() as $periode) {
            $periodeId[] = $periode['id'];
        }
        $this->form_validation->set_rules('periode', 'Periode', 'required|in_list[' . implode(',', $periodeId) . ']');
        foreach ($this->db->get('kategori')->result_array() as $kategori) {
            $kategoriId[] = $kategori['id'];
        }
        $this->form_validation->set_rules('kategori', 'Periode', 'required|in_list[' . implode(',', $kategoriId) . ']');
        $this->form_validation->set_rules('judul', 'Judul', 'required|trim');
        $this->form_validation->set_rules('abstraksi', 'Abstraksi', 'trim');
        $this->form_validation->set_rules('dana', 'Dana', 'trim|numeric');
        foreach ($this->db->get('dosen')->result_array() as $dosen) {
            $dosenNidn[] = $dosen['nidn'];
        }
        $this->form_validation->set_rules('dosenNidn', 'NIDN', 'required|numeric|exact_length[10]|in_list[' . implode(',', $dosenNidn) . ']');

        function create($table, $data)
        {
            $current = get_instance();
            $current->db->insert($table, $data);
            return $current->db->insert_id();
        }

        if ($this->form_validation->run() == true) {
            $dataPengajuan = [
                'id' => null,
                'periode_id' => $this->input->post('periode'),
                'kategori_id' => $this->input->post('kategori'),
                'tahap_id' => 1,
                'dosen_nidn' => $this->input->post('dosenNidn'),
                'judul' => $this->input->post('judul'),
                'abstraksi' => $this->input->post('abstraksi'),
                'dana' => $this->input->post('dana'),
                'file' => null,
                'belmawa_username' => null,
                'belmawa_password' => null,
                'file_laporan' => null
            ];
            var_dump($dataPengajuan);
            die;
        }
    }
}
