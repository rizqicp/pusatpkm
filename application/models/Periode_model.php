<?php defined('BASEPATH') or exit('No direct script access allowed');

class Periode_model extends CI_Model
{
    public function dataTables()
    {
        $this->datatables->add_column('no', '$1', 'id');
        $this->datatables->select('id, tahun, status');
        $this->datatables->add_column(
            'aksi',
            anchor('admin/ubahperiode?id=$1', 'Ubah', array('class' => 'btn btn-primary btn-xs')) . " " .
                anchor('admin/hapusperiode/$1', 'Hapus', array('class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Yakin akan menghapus periode ini?')")),
            'id'
        );
        $this->datatables->from('periode');
        return print_r($this->datatables->generate());
    }

    public function getAll()
    {
        return $this->db->get('periode')->result_array();
    }

    public function getById($idPeriode)
    {
        return $this->db->get_where('periode', ['id' => $idPeriode])->row_array();
    }

    public function tambahPeriode()
    {
        $this->form_validation->set_rules('periodeTahun', 'Tahun Periode', 'required');
        if ($this->form_validation->run() == TRUE) {
            if($this->input->post('periodeStatus')=='aktif'){
                $this->db->set('status','pasif');
                $this->db->where('status','aktif');
                $this->db->update('periode');
            }
            $data = array(
                'id' => '',
                'tahun' => $this->input->post('periodeTahun', TRUE),
                'status' => $this->input->post('periodeStatus', TRUE)
            );
            $this->db->insert('periode', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Periode baru ditambahkan</div>');
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function ubahPeriode($Periode)
    {
        $this->form_validation->set_rules('periodeTahun', 'Tahun Periode', 'required');
        if ($this->form_validation->run() == TRUE) {
            if($this->input->post('periodeStatus')=='aktif'){
                $this->db->set('status','pasif');
                $this->db->where('status','aktif');
                $this->db->update('periode');
            }
            $this->db->set('tahun', $this->input->post('periodeTahun', TRUE));
            $this->db->set('status', $this->input->post('periodeStatus', TRUE));
            $this->db->where('id', $Periode['id']);
            $this->db->update('Periode');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Periode berhasil diperbarui</div>');
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function hapusPeriode($idPeriode)
    {
        $this->db->where('id', $idPeriode['id']);
        $this->db->delete('Periode');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Periode berhasil dihapus</div>');
        return TRUE;
    }
}
