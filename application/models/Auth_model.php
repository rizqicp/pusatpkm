<?php defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    /*
    |--------------------------------------------------------------------------
    | login model
    |--------------------------------------------------------------------------
    |
    | method untuk verifikasi login user
    |
    | memvalidasi form input dari user
    | mengambil data user dari database
    | unset session lama
    | set data user ke dalam session baru
    |
    */
    public function login()
    {
        // validasi form
        $this->form_validation->set_rules('userEmail', 'Email', 'required|trim|valid_email', [
            'required' => 'Silahkan masukkan Email!',
            'valid_email' => 'Email tidak valid!'
        ]);
        $this->form_validation->set_rules('userPassword', 'Password', 'required|trim', [
            'required' => 'Silahkan masukkan Password!'
        ]);

        // ambil data user
        if ($this->form_validation->run() == true) {
            $userEmail = $this->input->post('userEmail');
            $userPassword = $this->input->post('userPassword');
            $userRole = $this->db->get_where('user', ['email' => $userEmail])->row_array()['role'];
            $this->db->select('*');
            $this->db->from('user');
            if ($userRole == 'mahasiswa') {
                $this->db->join('mahasiswa', 'user.id = mahasiswa.user_id');
            } elseif ($userRole == 'dosen') {
                $this->db->join('dosen', 'user.id = dosen.user_id');
            }
            $this->db->where('email', $userEmail);
            $user = $this->db->get()->row_array();

            // set session
            if ($user) {
                if ($user['status'] == 'aktif') {
                    if (password_verify($userPassword, $user['password'])) {
                        unsetSessionHelper();
                        $this->session->set_userdata($user);
                        return true;
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
                        return false;
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Email belum diverifikasi!</div>');
                    return false;
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email belum teregistrasi!</div>');
                return false;
            }
        } else {
            return false;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | logout model
    |--------------------------------------------------------------------------
    |
    | method untuk mengakhiri sesi user
    |
    | panggil helper unsetSessionHelper()
    | unset session user
    | kirim pesan berhasil logout
    |
    */
    public function logout()
    {
        unsetSessionHelper();
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah mengakhiri sesi!</div>');
    }

    /*
    |--------------------------------------------------------------------------
    | register model
    |--------------------------------------------------------------------------
    |
    | method untuk menambahkan user ke database
    |
    | memvalidasi form input dari user
    | menjalankan fungsi create() untuk mengembalikan nilai id terakhir
    | gunakan id untuk foreign key mahasiswa/dosen
    |
    */
    public function register()
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
        if ($this->input->post('userRole', true) == 'Mahasiswa') {
            $this->form_validation->set_rules('userNpm', 'NPM', 'required|numeric|min_length[10]|max_length[11]|is_unique[mahasiswa.npm]', [
                'required' => 'NPM harus diisi!',
                'numeric' => 'NPM hanya boleh mengandung angka!',
                'min_length' => 'NPM minimal 10 digit!',
                'max_length' => 'NPM maksimal 11 digit!',
                'is_unique' => 'User dengan NPM tersebut sudah ada!'
            ]);
        } elseif ($this->input->post('userRole', true) == 'Dosen') {
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
        if ($this->form_validation->run() == true && $this->input->post('userRole', true) == 'mahasiswa') {
            $userData = [
                'id' => null,
                'email' => htmlspecialchars($this->input->post('userEmail', true)),
                'password' => password_hash($this->input->post('userPassword'), PASSWORD_DEFAULT),
                'role' => $this->input->post('userRole', true),
                'status' => 'Pasif'
            ];
            $userId = create('user', $userData);
            $mahasiswaData = [
                'npm' => $this->input->post('userNpm'),
                'nama' => ucwords(strtolower(htmlspecialchars($this->input->post('userNama', true)))),
                'prodi_id' => $this->input->post('userProdi'),
                'user_id' => $userId,
            ];
            create('mahasiswa', $mahasiswaData);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun berhasil dibuat, silahkan cek email untuk Verifikasi!</div>');
            return true;
        } elseif ($this->form_validation->run() == true && $this->input->post('userRole', true) == 'dosen') {
            $userData = [
                'id' => null,
                'email' => htmlspecialchars($this->input->post('userEmail', true)),
                'password' => password_hash($this->input->post('userPassword'), PASSWORD_DEFAULT),
                'role' => $this->input->post('userRole', true),
                'status' => 'Pasif'
            ];
            $userId = create('user', $userData);
            $dosenData = [
                'nidn' => $this->input->post('userNidn'),
                'nama' => ucwords(strtolower(htmlspecialchars($this->input->post('userNama', true)))),
                'prodi_id' => $this->input->post('userProdi'),
                'user_id' => $userId,
            ];
            create('dosen', $dosenData);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun berhasil dibuat, silahkan cek email untuk Verifikasi!</div>');
            return true;
        } else {
            return false;
        }
    }

    public function forgot()
    {
    }
}
