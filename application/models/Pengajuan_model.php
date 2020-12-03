<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pengajuan_model extends CI_Model
{
    public function getAllPengajuan()
    {
        $this->db->select('
        pengajuan.id AS pengajuan_id,
        pengajuan.judul AS pengajuan_judul,
        pengajuan.abstraksi AS pengajuan_abstraksi,
        pengajuan.dana AS pengajuan_dana,
        pengajuan.file AS pengajuan_file,
        pengajuan.file_laporan AS pengajuan_laporan,
        pengajuan.belmawa_username,
        pengajuan.belmawa_password,
        periode.tahun AS periode_tahun,
        kategori.nama AS kategori_nama,
        tahap.nama AS tahap_nama,
        tahap.id AS tahap_id,
        dosen.nama AS dosen_nama
        ');
        $this->db->join('periode', 'pengajuan.periode_id = periode.id');
        $this->db->join('kategori', 'pengajuan.kategori_id = kategori.id');
        $this->db->join('tahap', 'pengajuan.tahap_id = tahap.id');
        $this->db->join('dosen', 'pengajuan.dosen_nidn = dosen.nidn');
        $this->db->order_by('pengajuan.id', 'DESC');
        return $this->db->get('pengajuan')->result_array();
    }

    public function getAllPengajuanLimit($limit, $start, $search = null)
    {
        $this->db->select('
        pengajuan.id AS pengajuan_id,
        pengajuan.judul AS pengajuan_judul,
        pengajuan.abstraksi AS pengajuan_abstraksi,
        pengajuan.dana AS pengajuan_dana,
        pengajuan.file AS pengajuan_file,
        pengajuan.file_laporan AS pengajuan_laporan,
        pengajuan.belmawa_username,
        pengajuan.belmawa_password,
        periode.tahun AS periode_tahun,
        kategori.nama AS kategori_nama,
        tahap.nama AS tahap_nama,
        tahap.id AS tahap_id,
        dosen.nama AS dosen_nama
        ');
        $this->db->join('periode', 'pengajuan.periode_id = periode.id');
        $this->db->join('kategori', 'pengajuan.kategori_id = kategori.id');
        $this->db->join('tahap', 'pengajuan.tahap_id = tahap.id');
        $this->db->join('dosen', 'pengajuan.dosen_nidn = dosen.nidn');
        $this->db->like('pengajuan.judul', $search);
        $this->db->order_by('pengajuan.id', 'DESC');
        return $this->db->get('pengajuan', $limit, $start)->result_array();
    }

    public function getFinishPengajuan()
    {
        $this->db->select('
        pengajuan.id AS pengajuan_id,
        pengajuan.judul AS pengajuan_judul,
        pengajuan.abstraksi AS pengajuan_abstraksi,
        pengajuan.dana AS pengajuan_dana,
        pengajuan.file AS pengajuan_file,
        pengajuan.file_laporan AS pengajuan_laporan,
        pengajuan.belmawa_username,
        pengajuan.belmawa_password,
        periode.tahun AS periode_tahun,
        kategori.nama AS kategori_nama,
        tahap.nama AS tahap_nama,
        tahap.id AS tahap_id,
        dosen.nama AS dosen_nama
        ');
        $this->db->join('periode', 'pengajuan.periode_id = periode.id');
        $this->db->join('kategori', 'pengajuan.kategori_id = kategori.id');
        $this->db->join('tahap', 'pengajuan.tahap_id = tahap.id');
        $this->db->join('dosen', 'pengajuan.dosen_nidn = dosen.nidn');
        $this->db->where('pengajuan.tahap_id', 6);
        $this->db->order_by('pengajuan.id', 'DESC');
        return $this->db->get('pengajuan')->result_array();
    }

    public function getFinishPengajuanLimit($limit, $start, $search = null)
    {
        $this->db->select('
        pengajuan.id AS pengajuan_id,
        pengajuan.judul AS pengajuan_judul,
        pengajuan.abstraksi AS pengajuan_abstraksi,
        pengajuan.dana AS pengajuan_dana,
        pengajuan.file AS pengajuan_file,
        pengajuan.file_laporan AS pengajuan_laporan,
        pengajuan.belmawa_username,
        pengajuan.belmawa_password,
        periode.tahun AS periode_tahun,
        kategori.nama AS kategori_nama,
        tahap.nama AS tahap_nama,
        tahap.id AS tahap_id,
        dosen.nama AS dosen_nama
        ');
        $this->db->join('periode', 'pengajuan.periode_id = periode.id');
        $this->db->join('kategori', 'pengajuan.kategori_id = kategori.id');
        $this->db->join('tahap', 'pengajuan.tahap_id = tahap.id');
        $this->db->join('dosen', 'pengajuan.dosen_nidn = dosen.nidn');
        $this->db->like('pengajuan.judul', $search);
        $this->db->where('pengajuan.tahap_id', 6);
        $this->db->order_by('pengajuan.id', 'DESC');
        return $this->db->get('pengajuan', $limit, $start)->result_array();
    }

    public function getPengajuanById($id)
    {
        $this->db->where('id', $id);
        $pengajuan = $this->db->get('pengajuan')->row_array();

        $this->db->where('pengajuan_id', $id);
        $pengusul = $this->db->get('pengusul')->result_array();

        for ($i = 0; $i < count($pengusul); $i++) {
            $anggota['anggota' . ($i + 1)] = $pengusul[$i]['mahasiswa_npm'];
        }

        return array_merge($pengajuan, $anggota);
    }

    public function getUserPengajuan()
    {
        $this->db->select('
        pengusul.id AS pengusul_id,
        pengusul.anggota AS pengusul_anggota,
        pengajuan.id AS pengajuan_id,
        pengajuan.judul AS pengajuan_judul,
        pengajuan.abstraksi AS pengajuan_abstraksi,
        pengajuan.dana AS pengajuan_dana,
        pengajuan.file AS pengajuan_file,
        pengajuan.file_laporan AS pengajuan_laporan,
        pengajuan.belmawa_username,
        pengajuan.belmawa_password,
        periode.tahun AS periode_tahun,
        kategori.nama AS kategori_nama,
        tahap.nama AS tahap_nama,
        tahap.id AS tahap_id,
        dosen.nama AS dosen_nama
        ');
        $this->db->join('pengajuan', 'pengusul.pengajuan_id = pengajuan.id');
        $this->db->join('periode', 'pengajuan.periode_id = periode.id');
        $this->db->join('kategori', 'pengajuan.kategori_id = kategori.id');
        $this->db->join('tahap', 'pengajuan.tahap_id = tahap.id');
        $this->db->join('dosen', 'pengajuan.dosen_nidn = dosen.nidn');
        $this->db->where('pengusul.mahasiswa_npm', $this->session->userdata('npm'));
        $this->db->order_by('pengajuan.id', 'DESC');
        return $this->db->get('pengusul')->result_array();
    }

    public function getUserPengajuanLimit($limit, $start, $search = null)
    {
        $this->db->select('
        pengusul.id AS pengusul_id,
        pengusul.anggota AS pengusul_anggota,
        pengajuan.id AS pengajuan_id,
        pengajuan.judul AS pengajuan_judul,
        pengajuan.abstraksi AS pengajuan_abstraksi,
        pengajuan.dana AS pengajuan_dana,
        pengajuan.file AS pengajuan_file,
        pengajuan.file_laporan AS pengajuan_laporan,
        pengajuan.belmawa_username,
        pengajuan.belmawa_password,
        periode.tahun AS periode_tahun,
        kategori.nama AS kategori_nama,
        tahap.nama AS tahap_nama,
        tahap.id AS tahap_id,
        dosen.nama AS dosen_nama
        ');
        $this->db->join('pengajuan', 'pengusul.pengajuan_id = pengajuan.id');
        $this->db->join('periode', 'pengajuan.periode_id = periode.id');
        $this->db->join('kategori', 'pengajuan.kategori_id = kategori.id');
        $this->db->join('tahap', 'pengajuan.tahap_id = tahap.id');
        $this->db->join('dosen', 'pengajuan.dosen_nidn = dosen.nidn');
        $this->db->like('pengajuan.judul', $search);
        $this->db->where('pengusul.mahasiswa_npm', $this->session->userdata('npm'));
        $this->db->order_by('pengajuan.id', 'DESC');
        return $this->db->get('pengusul', $limit, $start)->result_array();
    }

    public function getDosenBimbingan()
    {
        $this->db->select('
        pengajuan.id AS pengajuan_id,
        pengajuan.judul AS pengajuan_judul,
        pengajuan.abstraksi AS pengajuan_abstraksi,
        pengajuan.dana AS pengajuan_dana,
        pengajuan.file AS pengajuan_file,
        pengajuan.file_laporan AS pengajuan_laporan,
        pengajuan.belmawa_username,
        pengajuan.belmawa_password,
        periode.tahun AS periode_tahun,
        kategori.nama AS kategori_nama,
        tahap.nama AS tahap_nama,
        tahap.id AS tahap_id,
        dosen.nama AS dosen_nama
        ');
        $this->db->join('periode', 'pengajuan.periode_id = periode.id');
        $this->db->join('kategori', 'pengajuan.kategori_id = kategori.id');
        $this->db->join('tahap', 'pengajuan.tahap_id = tahap.id');
        $this->db->join('dosen', 'pengajuan.dosen_nidn = dosen.nidn');
        $this->db->where('pengajuan.dosen_nidn', $this->session->userdata('nidn'));
        $this->db->order_by('pengajuan.id', 'DESC');
        return $this->db->get('pengajuan')->result_array();
    }

    public function getDosenBimbinganLimit($limit, $start, $search = null)
    {
        $this->db->select('
        pengajuan.id AS pengajuan_id,
        pengajuan.judul AS pengajuan_judul,
        pengajuan.abstraksi AS pengajuan_abstraksi,
        pengajuan.dana AS pengajuan_dana,
        pengajuan.file AS pengajuan_file,
        pengajuan.file_laporan AS pengajuan_laporan,
        pengajuan.belmawa_username,
        pengajuan.belmawa_password,
        periode.tahun AS periode_tahun,
        kategori.nama AS kategori_nama,
        tahap.nama AS tahap_nama,
        tahap.id AS tahap_id,
        dosen.nama AS dosen_nama
        ');
        $this->db->join('periode', 'pengajuan.periode_id = periode.id');
        $this->db->join('kategori', 'pengajuan.kategori_id = kategori.id');
        $this->db->join('tahap', 'pengajuan.tahap_id = tahap.id');
        $this->db->join('dosen', 'pengajuan.dosen_nidn = dosen.nidn');
        $this->db->like('pengajuan.judul', $search);
        $this->db->where('pengajuan.dosen_nidn', $this->session->userdata('nidn'));
        $this->db->order_by('pengajuan.id', 'DESC');
        return $this->db->get('pengajuan', $limit, $start)->result_array();
    }

    public function getDosenUlasan()
    {
        $this->db->select('
        ulasan.id AS ulasan_id,
        ulasan.dosen_nidn AS ulasan_dosen,
        ulasan.komentar AS ulasan_komentar,
        ulasan.file AS ulasan_file,
        pengajuan.id AS pengajuan_id,
        pengajuan.judul AS pengajuan_judul,
        pengajuan.abstraksi AS pengajuan_abstraksi,
        pengajuan.dana AS pengajuan_dana,
        pengajuan.file AS pengajuan_file,
        pengajuan.file_laporan AS pengajuan_laporan,
        pengajuan.belmawa_username,
        pengajuan.belmawa_password,
        periode.tahun AS periode_tahun,
        kategori.nama AS kategori_nama,
        tahap.nama AS tahap_nama,
        tahap.id AS tahap_id,
        dosen.nama AS dosen_nama
        ');
        $this->db->join('pengajuan', 'ulasan.pengajuan_id = pengajuan.id');
        $this->db->join('periode', 'pengajuan.periode_id = periode.id');
        $this->db->join('kategori', 'pengajuan.kategori_id = kategori.id');
        $this->db->join('tahap', 'pengajuan.tahap_id = tahap.id');
        $this->db->join('dosen', 'pengajuan.dosen_nidn = dosen.nidn');
        $this->db->where('ulasan.dosen_nidn', $this->session->userdata('nidn'));
        $this->db->order_by('pengajuan.id', 'DESC');
        return $this->db->get('ulasan')->result_array();
    }

    public function getDosenUlasanLimit($limit, $start, $search = null)
    {
        $this->db->select('
        ulasan.id AS ulasan_id,
        ulasan.dosen_nidn AS ulasan_dosen,
        ulasan.komentar AS ulasan_komentar,
        ulasan.file AS ulasan_file,
        pengajuan.id AS pengajuan_id,
        pengajuan.judul AS pengajuan_judul,
        pengajuan.abstraksi AS pengajuan_abstraksi,
        pengajuan.dana AS pengajuan_dana,
        pengajuan.file AS pengajuan_file,
        pengajuan.file_laporan AS pengajuan_laporan,
        pengajuan.belmawa_username,
        pengajuan.belmawa_password,
        periode.tahun AS periode_tahun,
        kategori.nama AS kategori_nama,
        tahap.nama AS tahap_nama,
        tahap.id AS tahap_id,
        dosen.nama AS dosen_nama
        ');
        $this->db->join('pengajuan', 'ulasan.pengajuan_id = pengajuan.id');
        $this->db->join('periode', 'pengajuan.periode_id = periode.id');
        $this->db->join('kategori', 'pengajuan.kategori_id = kategori.id');
        $this->db->join('tahap', 'pengajuan.tahap_id = tahap.id');
        $this->db->join('dosen', 'pengajuan.dosen_nidn = dosen.nidn');
        $this->db->like('pengajuan.judul', $search);
        $this->db->where('ulasan.dosen_nidn', $this->session->userdata('nidn'));
        $this->db->order_by('pengajuan.id', 'DESC');
        return $this->db->get('ulasan', $limit, $start)->result_array();
    }

    public function getPengulas($nidn)
    {
        $ulasan = $this->db->get_where('ulasan', array('pengajuan_id' => $nidn))->row_array();
        $dosen = $this->db->get_where('dosen', array('nidn' => $ulasan['dosen_nidn']))->row_array();
        return array_merge($ulasan, $dosen);
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
        $this->form_validation->set_rules('judul', 'Judul', 'required|trim', ['required' => 'Judul harus diisi!']);
        $this->form_validation->set_rules('abstraksi', 'Abstraksi', 'required|trim', ['required' => 'Abstraksi harus diisi!']);
        $this->form_validation->set_rules('dana', 'Dana', 'trim|numeric', ['numeric' => 'Dana harus berupa angka!']);
        $this->form_validation->set_rules('dosen', 'NIDN', 'required|numeric|exact_length[10]|in_list[' . implode(',', $dosenNidn) . ']', [
            'required' => 'NIDN Pembimbing harus diisi!',
            'numeric' => 'NIDN harus berupa angka!',
            'exact_length' => 'NIDN harus 10 digit!',
            'in_list' => 'Pembimbing belum terdaftar!'
        ]);
        $this->form_validation->set_rules('anggota1', 'NPM', 'required|numeric|min_length[10]|max_length[11]|in_list[' . implode(',', $mahasiswaNpm) . ']', [
            'required' => 'NPM Anggota harus diisi!',
            'numeric' => 'NPM harus berupa angka!',
            'min_length' => 'NPM minimal 10 digit!',
            'max_length' => 'NPM maksimal 11 digit!',
            'in_list' => 'Mahasiswa belum terdaftar!'
        ]);
        if ($this->input->post()) {
            if (array_key_exists("anggota2", $this->input->post())) {
                $this->form_validation->set_rules('anggota2', 'NPM', 'required|numeric|min_length[10]|max_length[11]|in_list[' . implode(',', $mahasiswaNpm) . ']', [
                    'required' => 'NPM Anggota harus diisi!',
                    'numeric' => 'NPM harus berupa angka!',
                    'min_length' => 'NPM minimal 10 digit!',
                    'max_length' => 'NPM maksimal 11 digit!',
                    'in_list' => 'Mahasiswa belum terdaftar!'
                ]);
            }
            if (array_key_exists("anggota3", $this->input->post())) {
                $this->form_validation->set_rules('anggota3', 'NPM', 'required|numeric|min_length[10]|max_length[11]|in_list[' . implode(',', $mahasiswaNpm) . ']', [
                    'required' => 'NPM Anggota harus diisi!',
                    'numeric' => 'NPM harus berupa angka!',
                    'min_length' => 'NPM minimal 10 digit!',
                    'max_length' => 'NPM maksimal 11 digit!',
                    'in_list' => 'Mahasiswa belum terdaftar!'
                ]);
            }
            if (array_key_exists("anggota4", $this->input->post())) {
                $this->form_validation->set_rules('anggota4', 'NPM', 'required|numeric|min_length[10]|max_length[11]|in_list[' . implode(',', $mahasiswaNpm) . ']', [
                    'required' => 'NPM Anggota harus diisi!',
                    'numeric' => 'NPM harus berupa angka!',
                    'min_length' => 'NPM minimal 10 digit!',
                    'max_length' => 'NPM maksimal 11 digit!',
                    'in_list' => 'Mahasiswa belum terdaftar!'
                ]);
            }
            if (array_key_exists("anggota5", $this->input->post())) {
                $this->form_validation->set_rules('anggota5', 'NPM', 'required|numeric|min_length[10]|max_length[11]|in_list[' . implode(',', $mahasiswaNpm) . ']', [
                    'required' => 'NPM Anggota harus diisi!',
                    'numeric' => 'NPM harus berupa angka!',
                    'min_length' => 'NPM minimal 10 digit!',
                    'max_length' => 'NPM maksimal 11 digit!',
                    'in_list' => 'Mahasiswa belum terdaftar!'
                ]);
            }
        }
        if (empty($_FILES['userFile']['name'])) {
            $this->form_validation->set_rules('userFile', 'Document', 'required', ['required' => 'Silahkan upload proposal!']);
        }


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
            $config['max_size']             = 10240; // 10MB

            $current->load->library('upload', $config);

            if ($current->upload->do_upload('userFile')) {
                return $current->upload->data("file_name");
            } else {
                echo "error upload file";
                var_dump($_FILES);
                die;
            }
        }

        // insert data pengajuan
        if ($this->form_validation->run() == true) {
            $dataPengajuan = [
                'id' => null,
                'periode_id' => $this->input->post('periode'),
                'kategori_id' => $this->input->post('kategori'),
                'tahap_id' => 1,
                'dosen_nidn' => $this->input->post('dosen'),
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

            // insert data pengusul
            $jumlahPengusul = count($this->input->post()) - 6;
            for ($add = 1; $add <= $jumlahPengusul; $add++) {
                $dataPengusul = [
                    'id' => null,
                    'pengajuan_id' => $pengajuanId,
                    'mahasiswa_npm' => $this->input->post('anggota' . $add),
                    'anggota' => $add
                ];
                create('pengusul', $dataPengusul);
            }

            // insert log pengajuan
            $dataLog = [
                'id' => null,
                'pengajuan_id' => $pengajuanId,
                'waktu' => null,
                'berita' => 'Pengajuan Dibuat'
            ];
            create('log', $dataLog);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pengajuan berhasil dibuat!</div>');
            return true;
        }
    }

    public function editPengajuan($pengajuan)
    {
        // fungsi insert, return id
        function createNew($table, $data)
        {
            $current = get_instance();
            $current->db->insert($table, $data);
            return $current->db->insert_id();
        }

        function _updateFile($id)
        {
            $current = get_instance();
            $config['upload_path']          = './upload/pengajuan/';
            $config['allowed_types']        = 'doc|docx';
            $config['file_name']            = 'pengajuan_' . $id;
            $config['overwrite']            = true;
            $config['max_size']             = 10240; // 10MB

            $current->load->library('upload', $config);

            if ($current->upload->do_upload('userFile')) {
                return $current->upload->data("file_name");
            } else {
                echo "error upload file";
                var_dump($_FILES);
                die;
            }
        }

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
        if ($this->input->post('periode') != $pengajuan['periode_id']) {
            $this->form_validation->set_rules('periode', 'Periode', 'required|in_list[' . implode(',', $periodeId) . ']');
        }
        if ($this->input->post('kategori') != $pengajuan['kategori_id']) {
            $this->form_validation->set_rules('kategori', 'Periode', 'required|in_list[' . implode(',', $kategoriId) . ']');
        }
        if ($this->input->post('judul') != $pengajuan['judul']) {
            $this->form_validation->set_rules('judul', 'Judul', 'required|trim', ['required' => 'Judul harus diisi!']);
        }
        if ($this->input->post('abstraksi') != $pengajuan['abstraksi']) {
            $this->form_validation->set_rules('abstraksi', 'Abstraksi', 'required|trim', ['required' => 'Abstraksi harus diisi!']);
        }
        if ($this->input->post('dana') != $pengajuan['dana']) {
            $this->form_validation->set_rules('dana', 'Dana', 'trim|numeric', ['numeric' => 'Dana harus berupa angka!']);
        }
        if ($this->input->post('dosen') != $pengajuan['dosen_nidn']) {
            $this->form_validation->set_rules('dosen', 'NIDN', 'required|numeric|exact_length[10]|in_list[' . implode(',', $dosenNidn) . ']', [
                'required' => 'NIDN Pembimbing harus diisi!',
                'numeric' => 'NIDN harus berupa angka!',
                'exact_length' => 'NIDN harus 10 digit!',
                'in_list' => 'Pembimbing belum terdaftar!'
            ]);
        }
        if ($this->input->post('anggota1') != $pengajuan['anggota1']) {
            $this->form_validation->set_rules('anggota1', 'NPM', 'required|numeric|min_length[10]|max_length[11]|in_list[' . implode(',', $mahasiswaNpm) . ']', [
                'required' => 'NPM Anggota harus diisi!',
                'numeric' => 'NPM harus berupa angka!',
                'min_length' => 'NPM minimal 10 digit!',
                'max_length' => 'NPM maksimal 11 digit!',
                'in_list' => 'Mahasiswa belum terdaftar!'
            ]);
        }
        if ($this->input->post()) {
            if (array_key_exists("anggota2", $this->input->post())) {
                if ($this->input->post('anggota2') != $pengajuan['anggota2']) {
                    $this->form_validation->set_rules('anggota2', 'NPM', 'required|numeric|min_length[10]|max_length[11]|in_list[' . implode(',', $mahasiswaNpm) . ']', [
                        'required' => 'NPM Anggota harus diisi!',
                        'numeric' => 'NPM harus berupa angka!',
                        'min_length' => 'NPM minimal 10 digit!',
                        'max_length' => 'NPM maksimal 11 digit!',
                        'in_list' => 'Mahasiswa belum terdaftar!'
                    ]);
                }
            }
            if (array_key_exists("anggota3", $this->input->post())) {
                if ($this->input->post('anggota3') != $pengajuan['anggota3']) {
                    $this->form_validation->set_rules('anggota3', 'NPM', 'required|numeric|min_length[10]|max_length[11]|in_list[' . implode(',', $mahasiswaNpm) . ']', [
                        'required' => 'NPM Anggota harus diisi!',
                        'numeric' => 'NPM harus berupa angka!',
                        'min_length' => 'NPM minimal 10 digit!',
                        'max_length' => 'NPM maksimal 11 digit!',
                        'in_list' => 'Mahasiswa belum terdaftar!'
                    ]);
                }
            }
            if (array_key_exists("anggota4", $this->input->post())) {
                if ($this->input->post('anggota4') != $pengajuan['anggota4']) {
                    $this->form_validation->set_rules('anggota4', 'NPM', 'required|numeric|min_length[10]|max_length[11]|in_list[' . implode(',', $mahasiswaNpm) . ']', [
                        'required' => 'NPM Anggota harus diisi!',
                        'numeric' => 'NPM harus berupa angka!',
                        'min_length' => 'NPM minimal 10 digit!',
                        'max_length' => 'NPM maksimal 11 digit!',
                        'in_list' => 'Mahasiswa belum terdaftar!'
                    ]);
                }
            }
            if (array_key_exists("anggota5", $this->input->post())) {
                if ($this->input->post('anggota5') != $pengajuan['anggota5']) {
                    $this->form_validation->set_rules('anggota5', 'NPM', 'required|numeric|min_length[10]|max_length[11]|in_list[' . implode(',', $mahasiswaNpm) . ']', [
                        'required' => 'NPM Anggota harus diisi!',
                        'numeric' => 'NPM harus berupa angka!',
                        'min_length' => 'NPM minimal 10 digit!',
                        'max_length' => 'NPM maksimal 11 digit!',
                        'in_list' => 'Mahasiswa belum terdaftar!'
                    ]);
                }
            }
        }

        // cek file upload
        $uploadFile = false;
        if ($_FILES != null) {
            if ($_FILES['userFile']['error'] != 4) {
                $uploadFile = true;
            } else {
                $uploadFile = false;
            }
        }

        if ($this->form_validation->run() == true || $uploadFile == true) {
            if ($this->input->post('periode') != null && $this->input->post('periode') != $pengajuan['periode_id']) {
                $this->db->set('periode_id', $this->input->post('periode'));
                $this->db->where('id', $pengajuan['id']);
                $this->db->update('pengajuan');
            }
            if ($this->input->post('kategori') != null && $this->input->post('kategori') != $pengajuan['kategori_id']) {
                $this->db->set('kategori_id', $this->input->post('kategori'));
                $this->db->where('id', $pengajuan['id']);
                $this->db->update('pengajuan');
            }
            if ($this->input->post('judul') != null && $this->input->post('judul') != $pengajuan['judul']) {
                $this->db->set('judul', $this->input->post('judul'));
                $this->db->where('id', $pengajuan['id']);
                $this->db->update('pengajuan');
            }
            if ($this->input->post('abstraksi') != null && $this->input->post('abstraksi') != $pengajuan['abstraksi']) {
                $this->db->set('abstraksi', $this->input->post('abstraksi'));
                $this->db->where('id', $pengajuan['id']);
                $this->db->update('pengajuan');
            }
            if ($this->input->post('dana') != null && $this->input->post('dana') != $pengajuan['dana']) {
                $this->db->set('dana', $this->input->post('dana'));
                $this->db->where('id', $pengajuan['id']);
                $this->db->update('pengajuan');
            }
            if ($this->input->post('dosen') != null && $this->input->post('dosen') != $pengajuan['dosen_nidn']) {
                $this->db->set('dosen_nidn', $this->input->post('dosen'));
                $this->db->where('id', $pengajuan['id']);
                $this->db->update('pengajuan');
            }
            if ($_FILES['userFile']['error'] != 4) {
                unlink('./upload/pengajuan/' . $pengajuan['file']);
                $this->db->set('file', _updateFile($pengajuan['id']));
                $this->db->where('id', $pengajuan['id']);
                $this->db->update('pengajuan');
            }

            // hapus data pengusul lama
            $this->db->where('pengajuan_id', $pengajuan['id']);
            $this->db->delete('pengusul');
            // insert data pengusul baru
            $jumlahPengusul = count($this->input->post()) - 6;
            for ($add = 1; $add <= $jumlahPengusul; $add++) {
                $dataPengusul = [
                    'id' => null,
                    'pengajuan_id' => $pengajuan['id'],
                    'mahasiswa_npm' => $this->input->post('anggota' . $add),
                    'anggota' => $add
                ];
                createNew('pengusul', $dataPengusul);
            }

            $dataLog = [
                'id' => null,
                'pengajuan_id' => $pengajuan['id'],
                'waktu' => null,
                'berita' => 'Pengajuan Diedit'
            ];
            $this->db->insert('log', $dataLog);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pengajuan berhasil diubah!</div>');
            return true;
        } else {
            return false;
        }
    }

    public function hapusPengajuan()
    {
        if (isset($_POST['hapusid'])) {
            if ($_POST['hapusfile'] != null) {
                unlink('./upload/pengajuan/' . $_POST['hapusfile']);
            }
            $this->db->delete('pengajuan', array('id' => $_POST['hapusid']));
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pengajuan "' . $_POST['hapusjudul'] . '" berhasil dihapus!</div>');
            return true;
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Pengajuan "' . $_POST['hapusjudul'] . '" gagal dihapus!</div>');
            return false;
        }
    }

    public function getKeterangan($data)
    {
        $periode = $this->db->get_where('periode', array('id' => $data['periode_id']))->row_array();
        $kategori = $this->db->get_where('kategori', array('id' => $data['kategori_id']))->row_array();
        $tahap = $this->db->get_where('tahap', array('id' => $data['tahap_id']))->row_array();

        $keterangan['periode'] = $periode;
        $keterangan['kategori'] = $kategori;
        $keterangan['tahap'] = $tahap;

        return $keterangan;
    }

    public function tugaskanPengajuan()
    {
        if (isset($_POST['pengajuan_id']) && isset($_POST['dosen_nidn'])) {
            if ($this->db->get_where('ulasan', array('pengajuan_id' => $this->input->post('pengajuan_id')))->row_array()) {
                $this->db->set('dosen_nidn', $this->input->post('dosen_nidn'));
                $this->db->where('pengajuan_id', $this->input->post('pengajuan_id'));
                $this->db->update('ulasan');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pengulas berhasil diperbarui!</div>');
                return true;
            } else {
                $ulasan = [
                    'id' => null,
                    'pengajuan_id' => $this->input->post('pengajuan_id'),
                    'dosen_nidn' => $this->input->post('dosen_nidn'),
                    'komentar' => null,
                    'file' => null
                ];
                $this->db->insert('ulasan', $ulasan);
                $this->db->set('tahap_id', 2);
                $this->db->where('id', $this->input->post('pengajuan_id'));
                $this->db->update('pengajuan');
            }

            // insert log pengajuan
            $dataLog = [
                'id' => null,
                'pengajuan_id' => $this->input->post('pengajuan_id'),
                'waktu' => null,
                'berita' => 'Pengajuan Ditugaskan'
            ];
            $this->db->insert('log', $dataLog);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pengajuan berhasil ditugaskan!</div>');
            return true;
        } else {
            return false;
        }
    }

    public function kirimUlasan($id, $ulasan)
    {
        // Validasi
        foreach ($this->db->get('tahap')->result_array() as $tahap) {
            $tahapId[] = $tahap['id'];
        }
        $this->form_validation->set_rules('tahap', 'Tahap', 'required|in_list[' . implode(',', $tahapId) . ']', [
            'required' => 'Silahkan pilih hasil ulasan!'
        ]);

        // fungsi upload
        function _uploadUlasan($id)
        {
            $current = get_instance();
            $config['upload_path']          = './upload/ulasan/';
            $config['allowed_types']        = 'doc|docx';
            $config['file_name']            = 'ulasan_' . $id;
            $config['overwrite']            = true;
            $config['max_size']             = 10240; // 10MB

            $current->load->library('upload', $config);

            if ($current->upload->do_upload('userFile')) {
                return $current->upload->data("file_name");
            } else {
                echo "error upload file";
                var_dump($_FILES);
                die;
            }
        }

        if ($this->form_validation->run() == true) {
            $this->db->set('tahap_id', $this->input->post('tahap'));
            $this->db->where('id', $id);
            $this->db->update('pengajuan');

            if ($_FILES != null) {
                if ($_FILES['userFile']['error'] != 4) {
                    if ($ulasan['file'] != null) {
                        unlink('./upload/pengajuan/' . $ulasan['file']);
                    }
                    $this->db->set('file', _uploadUlasan($ulasan['id']));
                }
            }
            $this->db->set('komentar', $this->input->post('komentar'));
            $this->db->where('id', $ulasan['id']);
            $this->db->update('ulasan');

            // insert log ulasan
            $berita = $this->db->get_where('tahap', array('id' => $this->input->post('tahap')))->row_array()['nama'];
            $dataLog = [
                'id' => null,
                'pengajuan_id' => $id,
                'waktu' => null,
                'berita' => $berita
            ];
            $this->db->insert('log', $dataLog);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Hasil ulasan berhasil dikirim!</div>');
            return true;
        } else {
            return false;
        }
    }

    public function kirimRevisi($pengajuan)
    {
        // fungsi upload
        function _uploadRevisi($id)
        {
            $current = get_instance();
            $config['upload_path']          = './upload/pengajuan/';
            $config['allowed_types']        = 'doc|docx';
            $config['file_name']            = 'pengajuan_' . $id;
            $config['overwrite']            = true;
            $config['max_size']             = 10240; // 10MB

            $current->load->library('upload', $config);

            if ($current->upload->do_upload('userFile')) {
                return $current->upload->data("file_name");
            } else {
                echo "error upload file";
                var_dump($_FILES);
                die;
            }
        }

        // Validasi
        if (empty($_FILES['userFile']['name'])) {
            $this->form_validation->set_rules('userFile', 'Document', 'required', ['required' => 'Silahkan upload file revisi!']);
        }

        // cek file upload
        $uploadFile = false;
        if ($_FILES != null) {
            if ($_FILES['userFile']['error'] != 4) {
                $uploadFile = true;
            } else {
                $uploadFile = false;
            }
        }

        if ($this->form_validation->run() == true || $uploadFile == true) {
            if ($_FILES['userFile']['error'] != 4) {
                unlink('./upload/pengajuan/' . $pengajuan['file']);
                $this->db->set('file', _uploadRevisi($pengajuan['id']));
                $this->db->set('tahap_id', '2');
                $this->db->where('id', $pengajuan['id']);
                $this->db->update('pengajuan');

                $dataLog = [
                    'id' => null,
                    'pengajuan_id' => $pengajuan['id'],
                    'waktu' => null,
                    'berita' => 'Revisi Dikirim'
                ];
                $this->db->insert('log', $dataLog);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Revisi berhasil dikirim!</div>');
                return true;
            }
        } else {
            return false;
        }
    }

    public function kirimAkun($id)
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim', ['required' => 'Username harus diisi!']);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', ['required' => 'Password harus diisi!']);
        if ($this->form_validation->run() == true) {
            $this->db->set('belmawa_username', $this->input->post('username'));
            $this->db->set('belmawa_password', $this->input->post('password'));
            $this->db->where('id', $id);
            $this->db->update('pengajuan');

            $dataLog = [
                'id' => null,
                'pengajuan_id' => $id,
                'waktu' => null,
                'berita' => 'Akun Simbelmawa Dikirim'
            ];
            $this->db->insert('log', $dataLog);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun Simbelmawa berhasil dikirim!</div>');
            return true;
        } else {
            return false;
        }
    }

    public function unggahLaporan($pengajuan)
    {
        // fungsi upload
        function _uploadLaporan($id)
        {
            $current = get_instance();
            $config['upload_path']          = './upload/laporan/';
            $config['allowed_types']        = 'doc|docx';
            $config['file_name']            = 'laporan_' . $id;
            $config['overwrite']            = true;
            $config['max_size']             = 10240; // 10MB

            $current->load->library('upload', $config);

            if ($current->upload->do_upload('userFile')) {
                return $current->upload->data("file_name");
            } else {
                echo "error upload file";
                var_dump($_FILES);
                die;
            }
        }

        // Validasi
        if (empty($_FILES['userFile']['name'])) {
            $this->form_validation->set_rules('userFile', 'Document', 'required', ['required' => 'Silahkan upload file revisi!']);
        }

        // cek file upload
        $uploadFile = false;
        if ($_FILES != null) {
            if ($_FILES['userFile']['error'] != 4) {
                $uploadFile = true;
            } else {
                $uploadFile = false;
            }
        }

        if ($this->form_validation->run() == true || $uploadFile == true) {
            if ($_FILES['userFile']['error'] != 4) {
                if ($pengajuan['file_laporan'] != null) {
                    unlink('./upload/laporan/' . $pengajuan['file']);
                }
                $this->db->set('file_laporan', _uploadLaporan($pengajuan['id']));
                $this->db->set('tahap_id', '6');
                $this->db->where('id', $pengajuan['id']);
                $this->db->update('pengajuan');

                $dataLog = [
                    'id' => null,
                    'pengajuan_id' => $pengajuan['id'],
                    'waktu' => null,
                    'berita' => 'Laporan Akhir Dikirim'
                ];
                $this->db->insert('log', $dataLog);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Laporan Akhir berhasil dikirim!</div>');
                return true;
            }
        } else {
            return false;
        }
    }
}
