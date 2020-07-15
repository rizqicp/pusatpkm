<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("templates/meta.php") ?>
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-md-7">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Pendaftaran Akun</h1>
                                    </div>
                                    <form class="user" action="<?= base_url('auth/register'); ?>" method="POST">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="userNama" name="userNama" value="<?= set_value('userNama'); ?>" placeholder="Nama Lengkap">
                                            <?= form_error('userNama', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <select class="custom-select" id="userProdi" name="userProdi">
                                                <option value="" disabled selected hidden>Program Studi</option>
                                                <?php foreach ($prodi as $prodi) : ?>
                                                    <option value=<?= $prodi['id']; ?>><?= $prodi['nama']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <?= form_error('userProdi', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <script>
                                            function roleCheck(role) {
                                                if (role.value == "Mahasiswa") {
                                                    document.getElementById("roleDosen").style.display = "none";
                                                    document.getElementById("roleMahasiswa").style.display = "block";
                                                } else if (role.value == "Dosen") {
                                                    document.getElementById("roleMahasiswa").style.display = "none";
                                                    document.getElementById("roleDosen").style.display = "block";
                                                } else {
                                                    document.getElementById("roleMahasiswa").style.display = "none";
                                                    document.getElementById("roleDosen").style.display = "none";
                                                }
                                            }
                                        </script>
                                        <div class="form-group col-md-12">
                                            <select class="custom-select" id="userRole" name="userRole" onchange="roleCheck(this);">
                                                <option value="" disabled selected hidden>Apakah anda Mahasiswa atau Dosen?</option>
                                                <option value="mahasiswa">Mahasiswa</option>
                                                <option value="dosen">Dosen</option>
                                            </select>
                                            <?= form_error('userRole', '<small class="text-danger pl-3">', '</small>'); ?>
                                            <?= form_error('userNpm', '<small class="text-danger pl-3">', '</small>'); ?>
                                            <?= form_error('userNidn', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group col-md-12" id="roleMahasiswa" style="display: none;">
                                            <input type="text" class="form-control form-control-user" id="userNpm" name="userNpm" value="<?= set_value('userNpm'); ?>" placeholder="NPM">
                                        </div>
                                        <div class="form-group col-md-12" id="roleDosen" style="display: none;">
                                            <input type="text" class="form-control form-control-user" id="userNidn" name="userNidn" value="<?= set_value('userNidn'); ?>" placeholder="NIDN">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="userEmail" name="userEmail" value="<?= set_value('userEmail'); ?>" placeholder="Alamat Email">
                                            <?= form_error('userEmail', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="password" class="form-control form-control-user" id="userPassword" name="userPassword" placeholder="Kata Sandi">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="password" class="form-control form-control-user" id="repeatPassword" name="repeatPassword" placeholder="Ulangi Kata Sandi">
                                            </div>
                                            <?= form_error('userPassword', '<small class="text-danger pl-4">', '</small>'); ?>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Daftarkan Akun
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('auth/forgot'); ?>">Lupa Kata Sandi?</a>
                                    </div>
                                    <div class="text-center mt-2">
                                        <a class="small" href="<?= base_url('auth/login'); ?>">Sudah Punya Akun? Masuk!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php $this->load->view("templates/script.php") ?>

</body>

</html>