<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Core Meta Data -->
    <?php $this->load->view("partial/_meta.php") ?>
    <!-- Custom styles for sb-admin -->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php $this->load->view("user/_sidebar.php") ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php $this->load->view("user/_topbar.php") ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Tambah User</h1>
                    <form class="user" action="<?= base_url('admin/tambahuser'); ?>" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control " id="userNama" name="userNama" value="<?= set_value('userNama'); ?>" placeholder="Nama Lengkap" onchange="hideError('userNamaError');">
                            <?= form_error('userNama', '<small id="userNamaError" class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group col-md-12">
                            <select class="custom-select" id="userProdi" name="userProdi" onchange="hideError('userProdiError');">
                                <option value="" disabled <?= !set_value('userProdi') ? "selected" : ""; ?> hidden>Program Studi</option>
                                <?php foreach ($prodi as $prodi) : ?>
                                    <option value=<?= $prodi['id']; ?> <?= set_value('userProdi') == $prodi['id'] ? "selected" : ""; ?>><?= $prodi['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('userProdi', '<small id="userProdiError" class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group col-md-12">
                            <select class="custom-select" id="userRole" name="userRole" onchange="roleCheck(this);hideError('userRoleError');">
                                <option value="" disabled <?= !set_value('userRole') ? "selected" : ""; ?> hidden>Apakah anda Mahasiswa atau Dosen?</option>
                                <option value="mahasiswa" <?= set_value('userRole') == 'mahasiswa' ? "selected" : ""; ?>>Mahasiswa</option>
                                <option value="dosen" <?= set_value('userRole') == 'dosen' ? "selected" : ""; ?>>Dosen</option>
                            </select>
                            <?= form_error('userRole', '<small id="userRoleError" class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group col-md-12" id="roleMahasiswa" style="display: none;">
                            <input type="text" class="form-control " id="userNpm" name="userNpm" value="<?= set_value('userNpm'); ?>" placeholder="NPM" onchange="hideError('userNpmError');">
                            <?= form_error('userNpm', '<small id="userNpmError" class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group col-md-12" id="roleDosen" style="display: none;">
                            <input type="text" class="form-control " id="userNidn" name="userNidn" value="<?= set_value('userNidn'); ?>" placeholder="NIDN" onchange="hideError('userNidnError');">
                            <?= form_error('userNidn', '<small id="userNidnError" class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control " id="userEmail" name="userEmail" value="<?= set_value('userEmail'); ?>" placeholder="Alamat Email" onchange="hideError('userEmailError');">
                            <?= form_error('userEmail', '<smal id="userEmailError" class="text-danger pl-3">', '</smal>'); ?>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control " id="userPassword" name="userPassword" placeholder="Kata Sandi" onchange="hideError('userPasswordError');">
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control " id="repeatPassword" name="repeatPassword" placeholder="Ulangi Kata Sandi" onchange="hideError('userPasswordError');">
                            </div>
                            <?= form_error('userPassword', '<small id="userPasswordError" class="text-danger pl-4">', '</small>'); ?>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Daftarkan Akun
                        </button>
                    </form>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php $this->load->view("user/_footer.php") ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <?php $this->load->view("user/_scrollTop.php") ?>
    <!-- Logout Modal-->
    <?php $this->load->view("user/_logoutModal.php") ?>

    <script>
        function roleCheck(role) {
            if (role.value == "mahasiswa") {
                document.getElementById("roleDosen").style.display = "none";
                document.getElementById("roleMahasiswa").style.display = "block";
            } else if (role.value == "dosen") {
                document.getElementById("roleMahasiswa").style.display = "none";
                document.getElementById("roleDosen").style.display = "block";
            } else {
                document.getElementById("roleMahasiswa").style.display = "none";
                document.getElementById("roleDosen").style.display = "none";
            }
        }

        function hideError(error) {
            document.getElementById(error).style.display = "none";
        }
        window.onload = roleCheck(userRole);
    </script>

    <!-- Core Script Data -->
    <?php $this->load->view("partial/_script.php") ?>
    <!-- Custom scripts for sb-admin -->
    <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

</body>

</html>