<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pengumuman_model extends CI_Model
{
    public function getAllPengumuman()
    {
        $this->db->order_by('waktu', 'DESC');
        return $this->db->get('pengumuman')->result_array();
    }

    public function getPengumumanById($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('pengumuman')->row_array();
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

    public function getPengumumanLimit($limit, $start, $search = null)
    {
        if ($search != null) {
            $this->db->like('judul', $search);
        }
        $this->db->order_by('waktu', 'DESC');
        return $this->db->get('pengumuman', $limit, $start)->result_array();
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

    public function editPengumuman($pengumuman)
    {
        function _updateFile($id)
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

        if ($this->input->post('judulPengumuman') != $pengumuman['judul']) {
            $this->form_validation->set_rules('judulPengumuman', 'Judul', 'required|trim', ['required' => 'Judul harus diisi!']);
        }
        if ($this->input->post('isiPengumuman') != $pengumuman['isi']) {
            $this->form_validation->set_rules('isiPengumuman', 'Isi', 'required|trim', ['required' => 'Isi harus diisi!']);
        }
        if ($this->input->post('statusPengumuman') != $pengumuman['status']) {
            $this->form_validation->set_rules('statusPengumuman', 'Status', 'required|trim', []);
        }
        if ($this->input->post('hapusGambar') == 'delete') {
            $this->form_validation->set_rules('hapusGambar', 'Gambar', 'required|trim', []);
            $_FILES['gambarPengumuman']['error'] = 4;
        }
        $uploadGambar = false;
        if ($_FILES != null) {
            if ($_FILES['gambarPengumuman']['error'] != 4) {
                $uploadGambar = true;
            } else {
                $uploadGambar = false;
            }
        }

        if ($this->form_validation->run() == true || $uploadGambar == true) {
            if ($this->input->post('judulPengumuman') != null && $this->input->post('judulPengumuman') != $pengumuman['judul']) {
                $this->db->set('judul', $this->input->post('judulPengumuman'));
            }
            if ($this->input->post('isiPengumuman') != null || $this->input->post('repeatPassword') != $pengumuman['isi']) {
                $this->db->set('isi', $this->input->post('isiPengumuman'));
            }
            if ($this->input->post('statusPengumuman') != null && $this->input->post('statusPengumuman') != $pengumuman['status']) {
                $this->db->set('status', $this->input->post('statusPengumuman'));
            }
            if ($this->input->post('hapusGambar') == 'delete') {
                unlink('./assets/img/pengumuman/' . $pengumuman['gambar']);
                $this->db->set('gambar', null);
            }
            if ($_FILES['gambarPengumuman']['error'] != 4) {
                unlink('./assets/img/pengumuman/' . $pengumuman['gambar']);
                $this->db->set('gambar', _updateFile($pengumuman['id']));
            }
            $this->db->where('id', $pengumuman['id']);
            $this->db->update('pengumuman');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pengumuman berhasil diubah!</div>');
            return true;
        } else {
            return false;
        }
    }
}
