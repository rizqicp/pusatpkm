<?php defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function getAllUser()
    {
        $users = $this->db->get('user')->result_array();
        $data = array();
        foreach ($users as $user) {
            $this->db->select('*');
            $this->db->from('user');
            if ($user['role'] == 'mahasiswa') {
                $this->db->join('mahasiswa', 'user.id = mahasiswa.user_id');
            } elseif ($user['role'] == 'dosen') {
                $this->db->join('dosen', 'user.id = dosen.user_id');
            }
            $this->db->where('email', $user['email']);
            array_push($data, $this->db->get()->row_array());
        }
        return $data;
    }

    public function getAllDosen()
    {
        $dosen = $this->db->get('dosen')->result_array();
        $i = 0;
        while ($i < count($dosen)) {
            $dosen[$i]['prodi_nama'] = $this->db->get_where('prodi', array('id' => $dosen[$i]['prodi_id']))->row_array()['nama'];
            $i++;
        }
        return $dosen;
    }

    public function getDosenLimit($limit, $start, $search = null)
    {
        if ($search != null) {
            $this->db->like('nama', $search);
        }
        $dosen = $this->db->get('dosen', $limit, $start)->result_array();
        $i = 0;
        while ($i < count($dosen)) {
            $dosen[$i]['prodi_nama'] = $this->db->get_where('prodi', array('id' => $dosen[$i]['prodi_id']))->row_array()['nama'];
            $dosen[$i]['ulasan'] = $this->db->get_where('ulasan', array('dosen_nidn' => $dosen[$i]['nidn']))->num_rows();
            $i++;
        }
        return $dosen;
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

    public function getUserLimit($limit, $start, $search = null)
    {
        if ($search != null) {
            $this->db->like('email', $search);
        }
        $this->db->order_by('id', 'DESC');
        $users = $this->db->get('user', $limit, $start)->result_array();
        $data = array();
        foreach ($users as $user) {
            $this->db->select('*');
            $this->db->from('user');
            if ($user['role'] == 'mahasiswa') {
                $this->db->join('mahasiswa', 'user.id = mahasiswa.user_id');
            } elseif ($user['role'] == 'dosen') {
                $this->db->join('dosen', 'user.id = dosen.user_id');
            }
            $this->db->where('email', $user['email']);
            array_push($data, $this->db->get()->row_array());
        }
        return $data;
    }

    public function getUserById($id)
    {
        $userExist = $this->db->get_where('user', ['id' => $id])->row_array();
        $userRole = ($userExist) ? $userExist['role'] : null;

        $this->db->select('*');
        $this->db->from('user');
        if ($userRole == 'mahasiswa') {
            $this->db->join('mahasiswa', 'user.id = mahasiswa.user_id');
        } elseif ($userRole == 'dosen') {
            $this->db->join('dosen', 'user.id = dosen.user_id');
        }
        $this->db->where('id', $id);
        $user = $this->db->get()->row_array();
        return $user;
    }

    public function tambahUser()
    {
        // validasi form
        $this->form_validation->set_rules('userNama', 'Nama', 'required|trim', [
            'required' => 'Nama harus diisi!'
        ]);
        foreach ($this->db->get('prodi')->result_array() as $prodi) {
            $prodiId[] = $prodi['id'];
        }
        $this->form_validation->set_rules('userProdi', 'Prodi', 'required|in_list[' . implode(',', $prodiId) . ']', [
            'required' => 'Prodi harus diisi!',
            'in_list' => 'Prodi tidak ada di dalam list!'
        ]);
        $this->form_validation->set_rules('userRole', 'Role', 'required|in_list[mahasiswa,dosen]', [
            'required' => 'Peran harus diisi!',
            'in_list' => 'Peran tidak ada di dalam list!'
        ]);
        if ($this->input->post('userRole', true) == 'mahasiswa') {
            $this->form_validation->set_rules('userNpm', 'NPM', 'required|numeric|min_length[10]|max_length[11]|is_unique[mahasiswa.npm]', [
                'required' => 'NPM harus diisi!',
                'numeric' => 'NPM hanya boleh mengandung angka!',
                'min_length' => 'NPM minimal 10 digit!',
                'max_length' => 'NPM maksimal 11 digit!',
                'is_unique' => 'User dengan NPM tersebut sudah ada!'
            ]);
        } elseif ($this->input->post('userRole', true) == 'dosen') {
            $this->form_validation->set_rules('userNidn', 'NIDN', 'required|numeric|exact_length[10]|is_unique[dosen.nidn]', [
                'required' => 'NIDN harus diisi!',
                'numeric' => 'NIDN hanya boleh mengandung angka!',
                'exact_length' => 'NIDN harus 10 digit!',
                'is_unique' => 'User dengan NIDN tersebut sudah ada!'
            ]);
        }
        $this->form_validation->set_rules('userEmail', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'required' => 'Email harus diisi!',
            'valid_email' => 'Email tidak valid!',
            'is_unique' => 'Email sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('userPassword', 'Password', 'required|trim|min_length[6]|matches[repeatPassword]', [
            'required' => 'Password harus diisi!',
            'min_length' => 'Password terlalu pendek!',
            'matches' => 'Password tidak cocok!'
        ]);
        $this->form_validation->set_rules('repeatPassword', 'Repeat', 'required|trim|matches[userPassword]', [
            'required' => 'Ketik ulang Password!'
        ]);

        // fungsi insert data ke tabel
        function create($table, $data)
        {
            $current = get_instance();
            $current->db->insert($table, $data);
            return $current->db->insert_id();
        }

        // insert data user ke database
        if ($this->form_validation->run() == true) {
            $userData = [
                'id' => null,
                'email' => htmlspecialchars($this->input->post('userEmail', true)),
                'password' => password_hash($this->input->post('userPassword'), PASSWORD_DEFAULT),
                'role' => $this->input->post('userRole', true),
                'status' => 'aktif'
            ];
            $userId = create('user', $userData);
            switch ($this->input->post('userRole', true)) {
                case 'mahasiswa':
                    $mahasiswaData = [
                        'npm' => $this->input->post('userNpm'),
                        'nama' => ucwords(strtolower(htmlspecialchars($this->input->post('userNama', true)))),
                        'prodi_id' => $this->input->post('userProdi'),
                        'user_id' => $userId,
                    ];
                    create('mahasiswa', $mahasiswaData);
                    break;

                case 'dosen':
                    $dosenData = [
                        'nidn' => $this->input->post('userNidn'),
                        'nama' => ucwords(strtolower(htmlspecialchars($this->input->post('userNama', true)))),
                        'prodi_id' => $this->input->post('userProdi'),
                        'user_id' => $userId,
                    ];
                    create('dosen', $dosenData);
                    break;

                default:
                    return false;
                    break;
            }

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun berhasil dibuat</div>');
            return true;
        } else {
            return false;
        }
    }

    public function editUser($user)
    {
        // validate email
        if ($this->input->post('userEmail') != null && $this->input->post('userEmail') != $user['email']) {
            $this->form_validation->set_rules('userEmail', 'Email', 'trim|valid_email|is_unique[user.email]', [
                'valid_email' => 'Email tidak valid!',
                'is_unique' => 'Email sudah terdaftar!'
            ]);
        }

        if ($this->input->post('userStatus') != null && $this->input->post('userStatus') != $user['status']) {
            $this->form_validation->set_rules('userStatus', 'Status', 'trim', []);
        }

        // validate password
        if ($this->input->post('newPassword') != null || $this->input->post('repeatPassword') != null) {
            $this->form_validation->set_rules('newPassword', 'Password', 'required|trim|min_length[6]|matches[repeatPassword]', [
                'required' => 'Password baru harus diisi!',
                'min_length' => 'Password terlalu pendek!',
                'matches' => ''
            ]);
            $this->form_validation->set_rules('repeatPassword', 'Repeat', 'required|trim|matches[newPassword]', [
                'required' => 'Ketik ulang Password!',
                'matches' => 'Password tidak cocok!'
            ]);
        }

        if ($this->form_validation->run() == true) {
            if ($this->input->post('userEmail') != null && $this->input->post('userEmail') != $user['email']) {
                $this->db->set('email', $this->input->post('userEmail'));
            }
            if ($this->input->post('newPassword') != null || $this->input->post('repeatPassword') != null) {
                $this->db->set('password', password_hash($this->input->post('newPassword'), PASSWORD_DEFAULT));
            }
            if ($this->input->post('userStatus') != null && $this->input->post('userStatus') != $user['status']) {
                $this->db->set('status', $this->input->post('userStatus'));
            }
            $this->db->where('id', $user['id']);
            $this->db->update('user');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User ' . $user['nama'] . ' berhasil diperbarui!</div>');
            return true;
        } else {
            return false;
        }
    }

    public function hapusUser()
    {
        if (isset($_POST['hapusid'])) {
            $this->db->delete('user', array('id' => $_POST['hapusid']));
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun ' . $_POST['hapusnama'] . ' berhasil dihapus</div>');
            return true;
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akun ' . $_POST['hapusnama'] . ' gagal dihapus</div>');
            return false;
        }
    }

    public function getKelompok($data)
    {
        $dosen = $this->db->get_where('dosen', array('nidn' => $data['dosen_nidn']))->row_array();
        $jumlahAnggota = count($data) - 12;
        for ($i = 1; $i <= $jumlahAnggota; $i++) {
            $anggota[] = $this->db->get_where('mahasiswa', array('npm' => $data['anggota' . $i]))->row_array();
        }
        $kelompok['dosen'] = $dosen;
        $kelompok['mahasiswa'] = $anggota;

        return $kelompok;
    }
}
