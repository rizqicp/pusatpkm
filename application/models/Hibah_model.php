<?php defined('BASEPATH') or exit('No direct script access allowed');

class Hibah_model extends CI_Model
{
    public function dataTables()
    {
        $this->datatables->select('hibah.id, hibah.nama, kategori.kependekan, hibah.file, hibah.status');
        $this->datatables->join('kategori', 'hibah.kategori_id=kategori.id');
        $this->datatables->from('hibah');
        $this->datatables->add_column('no', '$1', 'id');
        $this->datatables->add_column(
            'aksi',
            anchor('admin/ubahhibah?id=$1', 'Ubah', array('class' => 'btn btn-primary btn-xs')) . " " .
                anchor('admin/hapushibah/$1', 'Hapus', array('class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Yakin akan menghapus hibah ini?')")),
            'id'
        );
        return print_r($this->datatables->generate());
    }

    public function getById($idHibah)
    {
        return $this->db->get_where('hibah', ['id' => $idHibah])->row_array();
    }

    function _create($table, $data)
    {
        $current = get_instance();
        $current->db->insert($table, $data);
        return $current->db->insert_id();
    }

    function _uploadFile($nama, $id)
    {
        $current = get_instance();
        $config['upload_path']          = './uploads/format/';
        $config['allowed_types']        = 'doc|docx|pdf';
        $config['file_name']            =  $id . '_format' . '_' . str_replace(' ', '_', strtolower($nama));
        $config['overwrite']            = true;
        $config['max_size']             = 10240; // 10MB

        $current->load->library('upload', $config);

        if ($current->upload->do_upload('hibahFile')) {
            return $current->upload->data("file_name");
        } else {
            echo "error upload file ";
            var_dump($_FILES);
            die;
        }
    }

    public function tambahhibah()
    {

        $this->form_validation->set_rules('hibahNama', 'Nama Hibah', 'required');
        $this->form_validation->set_rules('hibahKategori', 'Kategori Hibah', 'required');
        if (empty($_FILES['hibahFile']['name'])) {
            $this->form_validation->set_rules('hibahFile', 'Document', 'required', ['required' => 'Silahkan upload format!']);
        }

        if ($this->form_validation->run() == TRUE) {

            $data = [
                'id' => '',
                'nama' => $this->input->post('hibahNama', TRUE),
                'status' => $this->input->post('hibahStatus', TRUE),
                'file' => '',
                'kategori_id' => $this->input->post('hibahKategori', TRUE),
            ];

            $hibahId = $this->_create('hibah', $data);

            if ($_FILES['hibahFile']['error'] != 4) {
                $this->db->set('file', $this->_uploadFile($data['nama'], $hibahId));
                $this->db->where('id', $hibahId);
                $this->db->update('hibah');
            }

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Hibah baru ditambahkan</div>');
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function ubahHibah($hibah)
    {
        if ($this->input->post('hibahNama') != $hibah['nama']) {
            $this->form_validation->set_rules('hibahNama', 'Nama hibah', 'required');
        }
        if ($this->input->post('hibahStatus') != $hibah['status']) {
            $this->form_validation->set_rules('hibahStatus', 'Status hibah', 'required');
        }
        if ($this->input->post('hibahKategori') != $hibah['kategori_id']) {
            $this->form_validation->set_rules('hibahKategori', 'Kategori hibah', 'required');
        }

        // cek file upload
        $uploadFile = false;
        if ($_FILES != null) {
            if ($_FILES['hibahFile']['error'] != 4) {
                $uploadFile = true;
            } else {
                $uploadFile = false;
            }
        }

        if ($this->form_validation->run() == true || $uploadFile == true) {
            if ($this->input->post('hibahNama') != null && $this->input->post('hibahNama') != $hibah['nama']) {
                $this->db->set('nama', $this->input->post('hibahNama'));
                $this->db->where('id', $hibah['id']);
                $this->db->update('hibah');
            }
            if ($this->input->post('hibahStatus') != null && $this->input->post('hibahStatus') != $hibah['status']) {
                $this->db->set('status', $this->input->post('hibahStatus'));
                $this->db->where('id', $hibah['id']);
                $this->db->update('hibah');
            }
            if ($this->input->post('hibahKategori') != null && $this->input->post('hibahKategori') != $hibah['kategori_id']) {
                $this->db->set('kategori_id', $this->input->post('hibahKategori'));
                $this->db->where('id', $hibah['id']);
                $this->db->update('hibah');
            }
            if ($_FILES['hibahFile']['error'] != 4) {
                unlink('./uploads/format/' . $hibah['file']);
                $this->db->set('file', $this->_uploadFile($hibah['nama'], $hibah['id']));
                $this->db->where('id', $hibah['id']);
                $this->db->update('hibah');
            }

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Hibah berhasil diperbarui</div>');
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function hapushibah($hibah)
    {
        if ($hibah['file'] != NULL) {
            unlink('./uploads/format/' . $hibah['file']);
        }
        $this->db->where('id', $hibah['id']);
        $this->db->delete('hibah');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Hibah berhasil dihapus</div>');
        return TRUE;
    }
}
