<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_model extends CI_Model
{
    public function dataTables()
    {
        $this->datatables->add_column('no', '$1', 'id');
        $this->datatables->select('id, nama, kependekan');
        $this->datatables->add_column(
            'aksi',
            anchor('admin/ubahkategori?id=$1', 'Ubah', array('class' => 'btn btn-primary btn-xs')) . " " .
                anchor('admin/hapuskategori/$1', 'Hapus', array('class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Yakin akan menghapus kategori ini?')")),
            'id'
        );
        $this->datatables->from('kategori');
        return print_r($this->datatables->generate());
    }

    public function getAll()
    {
        return $this->db->get('kategori')->result_array();
    }

    public function getById($idKategori)
    {
        return $this->db->get_where('kategori', ['id' => $idKategori])->row_array();
    }

    public function tambahKategori()
    {
        $this->form_validation->set_rules('kategoriNama', 'Nama Kategori', 'required');
        $this->form_validation->set_rules('kategoriKependekan', 'Kependekan Kategori', 'required|trim');
        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'id' => '',
                'nama' => $this->input->post('kategoriNama', TRUE),
                'kependekan' => $this->input->post('kategoriKependekan', TRUE)
            );
            $this->db->insert('kategori', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kategori baru ditambahkan</div>');
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function ubahKategori($kategori)
    {
        $this->form_validation->set_rules('kategoriNama', 'Nama Kategori', 'required');
        $this->form_validation->set_rules('kategoriKependekan', 'Kependekan Kategori', 'required|trim');
        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'id' => $kategori['id'],
                'nama' => $this->input->post('kategoriNama', TRUE),
                'kependekan' => $this->input->post('kategoriKependekan', TRUE)
            );
            $this->db->where('id', $kategori['id']);
            $this->db->replace('kategori', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kategori berhasil diperbarui</div>');
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function hapusKategori($idKategori)
    {
        $this->db->where('id', $idKategori);
        $this->db->delete('kategori');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kategori berhasil dihapus</div>');
        return TRUE;
    }
}
