<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pengumuman_model extends CI_Model
{
    public function getAllPengumuman()
    {
        $this->db->order_by('waktu', 'DESC');
        return $this->db->get('pengumuman')->result_array();
    }

    public function tambahPengumuman()
    {
        // validasi form
        $this->form_validation->set_rules('judulPengumuman', 'Judul', 'required|trim', ['required' => 'Judul harus diisi!']);
        $this->form_validation->set_rules('isiPengumuman', 'Isi', 'required|trim', ['required' => 'Isi harus diisi!']);

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
            $config['upload_path']          = './assets/img/pengumuman/';
            $config['allowed_types']        = 'jpg|jpeg|png';
            $config['file_name']            = 'pengumuman_' . $id;
            $config['overwrite']            = true;
            $config['max_size']             = 2048; // 2MB

            $current->load->library('upload', $config);

            if ($current->upload->do_upload('gambarPengumuman')) {
                return $current->upload->data("file_name");
            } else {
                echo "error upload file";
                var_dump($_FILES);
                die;
            }
        }

        if ($this->form_validation->run() == true) {
            $dataPengumuman = [
                'id' => null,
                'judul' => $this->input->post('judulPengumuman'),
                'isi' => $this->input->post('isiPengumuman'),
                'gambar' => null,
                'waktu' => null,
                'status' => $this->input->post('statusPengumuman')
            ];
            // var_dump($_FILES);
            // die;

            $pengumumanId = create('pengumuman', $dataPengumuman);

            if ($_FILES['gambarPengumuman']['error'] != 4) {
                $this->db->set('gambar', _uploadFile($pengumumanId));
                $this->db->where('id', $pengumumanId);
                $this->db->update('pengumuman');
            }

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pengumuman berhasil dibuat!</div>');
            return true;
        } else {
            return false;
        }
    }

    public function hapusPengumuman()
    {
        if (isset($_POST['hapusid'])) {
            if ($_POST['hapusgambar'] != null) {
                unlink('./assets/img/pengumuman/' . $_POST['hapusgambar']);
            }
            $this->db->delete('pengumuman', array('id' => $_POST['hapusid']));
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pengumuman "' . $_POST['hapusjudul'] . '" berhasil dihapus</div>');
            return true;
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Pengumuman "' . $_POST['hapusjudul'] . '" gagal dihapus</div>');
            return false;
        }
    }
}
