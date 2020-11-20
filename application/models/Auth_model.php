<?php defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
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
            $userExist = $this->db->get_where('user', ['email' => $userEmail])->row_array();
            $userRole = ($userExist) ? $userExist['role'] : null;

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

    public function loginBarcode()
    {
        // validasi form
        foreach ($this->db->get('mahasiswa')->result_array() as $mahasiswa) {
            $mahasiswaNpm[] = $mahasiswa['npm'];
        }
        $this->form_validation->set_rules('userBarcode', 'Barcode', 'required|in_list[' . implode(',', $mahasiswaNpm) . ']', [
            'required' => 'Mohon pindai ulang Barcode!',
            'in_list' => 'Mahasiswa tidak terdaftar!'
        ]);

        // ambil data user
        if ($this->form_validation->run() == true) {
            $this->db->select('*');
            $this->db->from('user');
            $this->db->join('mahasiswa', 'user.id = mahasiswa.user_id');
            $this->db->where('npm', $this->input->post('userBarcode'));
            $user = $this->db->get()->row_array();

            // set session
            if ($user) {
                if ($user['status'] == 'aktif') {
                    $this->session->set_userdata($user);
                    return true;
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Mahasiswa belum diverifikasi!</div>');
                    return false;
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Mahasiswa tidak terdaftar!</div>');
                return false;
            }
        } else {
            return false;
        }
    }

    public function logout()
    {
        unsetSessionHelper();
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah mengakhiri sesi!</div>');
    }

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
                'status' => 'pasif'
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

            // send email
            $this->load->library('phpmailer_lib');
            $mail = $this->phpmailer_lib->load();
            $mail->setFrom('1634010056@student.upnjatim.ac.id', 'Pusat PKM');
            $mail->addAddress($userData['email']);
            $mail->Subject = 'Verifikasi Pendaftaran';
            $mail->isHTML(true);
            $mailContent = "
            <h4>Terima kasih sudah mendaftar di Pusat PKM!</h4>
            <p>Akun anda telah berhasil dibuat, berikut informasi akun anda dan dapat digunakan setelah mengaktifkan akun menggunakan link dibawah.</p>
            <p>    
            ----------------------------------<br>
            Email       : " . $userData['email'] . "<br>
            Password    : " . str_repeat('*', strlen($this->input->post('userPassword')) - 4) . substr($this->input->post('userPassword'), -4) . "<br>
            ----------------------------------
            </p>
            <p>Silahkan klik link dibawah untuk verifikasi akun: <br>
            " . base_url('auth/verifikasi') . "?email=" . $userData['email'] . "&hash=" . $userData['password'] . "</p>
            ";
            $mail->Body = $mailContent;
            try {
                $mail->send();
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun berhasil dibuat, silahkan cek email untuk Verifikasi!</div>');
                return true;
            } catch (Exception $e) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email verifikasi gagal dikirim!</div>');
                return false;
            }
        } else {
            return false;
        }
    }

    public function verifikasi()
    {
        $userEmail = $this->input->get('email');
        $userHash = $this->input->get('hash');
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email', $userEmail);
        $user = $this->db->get()->row_array();

        if ($user['email'] == $userEmail && $user['password'] == $userHash) {
            $this->db->set('status', 'aktif');
            $this->db->where('email', $userEmail);
            $this->db->update('user');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Email berhasil diverifikasi, silahkan login!</div>');
            return true;
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Verifikasi email gagal!</div>');
            return false;
        }
    }

    public function forgot()
    {
        // validasi form
        $this->form_validation->set_rules('userEmail', 'Email', 'required|trim|valid_email', [
            'required' => 'Silahkan masukkan Email!',
            'valid_email' => 'Email tidak valid!'
        ]);
        if ($this->form_validation->run() == true) {
            // get user data
            $this->db->select('*');
            $this->db->from('user');
            $this->db->where('email', $this->input->post('userEmail'));
            $userData = $this->db->get()->row_array();

            // send email
            $this->load->library('phpmailer_lib');
            $mail = $this->phpmailer_lib->load();
            $mail->setFrom('1634010056@student.upnjatim.ac.id', 'Pusat PKM');
            $mail->addAddress($this->input->post('userEmail'));
            $mail->Subject = 'Pemulihan Akun';
            $mail->isHTML(true);
            $mailContent = "
            <h4>Terima kasih sudah menghubungi Pusat PKM!</h4>
            <p>Kami menerima permintaan pemulihan akun dari anda, abaikan pesan ini jika anda tidak mengirim permintaan.<br>
            berikut informasi akun anda.</p>
            <p>    
            ----------------------------------<br>
            Email       : " . $userData['email'] . "<br>
            ----------------------------------
            </p>
            <p>Silahkan klik link dibawah untuk atur ulang kata sandi: <br>
            " . base_url('auth/recovery') . "?email=" . $userData['email'] . "&hash=" . $userData['password'] . "</p>
            ";
            $mail->Body = $mailContent;
            try {
                $mail->send();
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Permintaan pemulihan berhasil, silahkan cek email untuk atur ulang kata sandi!</div>');
                return true;
            } catch (Exception $e) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Permintaan pemulihan gagal!</div>');
                return false;
            }
        } else {
            return false;
        }
    }

    public function recovery()
    {
        $this->form_validation->set_rules('userPassword', 'Password', 'required|trim|min_length[6]|matches[repeatPassword]', [
            'required' => 'Password harus diisi!',
            'min_length' => 'Password terlalu pendek!',
            'matches' => ''
        ]);
        $this->form_validation->set_rules('repeatPassword', 'Repeat', 'required|trim|matches[userPassword]', [
            'required' => 'Ketik ulang Password!',
            'matches' => 'Password tidak cocok!'
        ]);

        if ($this->form_validation->run() == true) {
            $this->db->set('password', password_hash($this->input->post('userPassword'), PASSWORD_DEFAULT));
            $this->db->where('email', $this->session->userdata('recoverEmail'));
            $this->db->update('user');
            $this->session->unset_userdata('recoverEmail');
            $this->session->unset_userdata('recoverHash');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kata sandi berhasil di atur ulang, silahkan login!</div>');
            return true;
        } else {
            return false;
        }
    }

    public function editProfil()
    {
        // make edit profile function

    }
}
