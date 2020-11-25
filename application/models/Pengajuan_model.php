<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pengajuan_model extends CI_Model
{
    public function lihatPengajuan($npm)
    {
        $this->db->select('*');
        $this->db->from('pengusul');
        $this->db->join('pengajuan', 'pengusul.pengajuan_id = pengajuan.id');
        $this->db->where('mahasiswa_npm', $npm);
        return $this->db->get()->result_array();
    }

    public function tambahPengajuan()
    {
        // validasi form
        foreach ($this->db->get('periode')->result_array() as $periode) {
            $periodeId[] = $periode['id'];
        }
        foreach ($this->db->get('kategori')->result_array() as $kategori) {
            $kategoriId[] = $kategori['id'];
        }
        foreach ($this->db->get('mahasiswa')->result_array() as $mahasiswa) {
            $mahasiswaNpm[] = $mahasiswa['npm'];
        }
        foreach ($this->db->get('dosen')->result_array() as $dosen) {
            $dosenNidn[] = $dosen['nidn'];
        }
        $this->form_validation->set_rules('periode', 'Periode', 'required|in_list[' . implode(',', $periodeId) . ']');
        $this->form_validation->set_rules('kategori', 'Periode', 'required|in_list[' . implode(',', $kategoriId) . ']');
        $this->form_validation->set_rules('judul', 'Judul', 'required|trim');
        $this->form_validation->set_rules('abstraksi', 'Abstraksi', 'trim');
        $this->form_validation->set_rules('dana', 'Dana', 'trim|numeric');
        $this->form_validation->set_rules('dosenNidn', 'NIDN', 'required|numeric|exact_length[10]|in_list[' . implode(',', $dosenNidn) . ']');
        $this->form_validation->set_rules('mahasiswaNpm', 'NPM', 'required|numeric|min_length[10]|max_length[11]|in_list[' . implode(',', $mahasiswaNpm) . ']');

        // fungsi insert, return id
        function create($table, $data)
        {
            $current = get_instance();
            $current->db->insert($table, $data);
            return $current->db->insert_id();
        }

        // fungsi upload
        function _uploadFile($id)
        {
            $current = get_instance();
            $config['upload_path']          = './upload/pengajuan/';
            $config['allowed_types']        = 'doc|docx';
            $config['file_name']            = 'pengajuan_' . $id;
            $config['overwrite']            = true;
            $config['max_size']             = 2048; // 2MB

            $current->load->library('upload', $config);

            if ($current->upload->do_upload('userFile')) {
                return $current->upload->data("file_name");
            } else {
                echo "error upload file";
                var_dump($_FILES);
                die;
            }
        }

        // simpan data pengajuan ke dalam variabel
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
            $pengajuanId = create('pengajuan', $dataPengajuan);

            $this->db->set('file', _uploadFile($pengajuanId));
            $this->db->where('id', $pengajuanId);
            $this->db->update('pengajuan');

            // data pengusul perlu diperbaiki
            $dataPengusul = [
                'id' => null,
                'pengajuan_id' => $pengajuanId,
                'mahasiswa_npm' => $this->input->post('mahasiswaNpm'),
                'anggota' => 1
            ];
            create('pengusul', $dataPengusul);

            $dataLog = [
                'id' => null,
                'pengajuan_id' => $pengajuanId,
                'waktu' => null,
                'berita' => 'pengajuan dibuat'
            ];
            create('log', $dataLog);

            return true;
        }
    }
}
