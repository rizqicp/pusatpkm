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
}