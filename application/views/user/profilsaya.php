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
                    <div class="container mt-5">
                        <div class="row">
                            <div class="col-lg-4 pb-3">
                                <!-- Account Sidebar-->
                                <div class="author-card-profile">
                                    <div class="author-card-avatar">
                                        <img class="img-fluid img-profile border rounded" src="<?= base_url('assets/img/profile/defaultProfile.png'); ?>" alt="Profile Image">
                                    </div>
                                    <div class="author-card-details mt-2">
                                        <?php if ($user['role'] == 'mahasiswa' || $user['role'] == 'dosen') : ?>
                                            <h5 class="author-card-name text-lg"><b><?= $user['nama']; ?></b></h5>
                                        <?php endif; ?>
                                        <span class="author-card-position" id="userRole"><?= ucfirst($user['role']); ?></span>
                                    </div>
                                </div>

                            </div>
                            <!-- Profile Settings-->
                            <div class="col-lg-8 pb-3">
                                <form class="row" action="<?= base_url('auth/editProfil'); ?>" method="POST">
                                    <?php if ($user['role'] == 'mahasiswa' || $user['role'] == 'dosen') : ?>
                                        <div class="col-12">
                                            <h5 class="author-card-name text-lg mb-3"><b>Data Diri</b></h5>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="account-fn">Nama</label>
                                                <input class="form-control" type="text" id="userNama" value="<?= $user['nama']; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php if ($user['role'] == 'mahasiswa') : ?>
                                                    <label for="account-phone">NPM</label>
                                                    <input class="form-control" type="text" id="userNpm" value="<?= $user['npm']; ?>" disabled>
                                                <?php elseif ($user['role'] == 'dosen') : ?>
                                                    <label for="account-phone">NIDN</label>
                                                    <input class="form-control" type="text" id="userNidn" value="<?= $user['nidn']; ?>" disabled>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="account-fn">Prodi</label>
                                                <input class="form-control" type="text" id="userProdi" value="<?= $prodi['nama']; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="account-fn">Fakultas</label>
                                                <input class="form-control" type="text" id="userFakultas" value="<?= $fakultas['nama']; ?>" disabled>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-12">
                                        <hr>
                                        <h5 class="author-card-name text-lg mb-3"><b>Informasi Login</b></h5>
                                        <?= $this->session->flashdata('message'); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="account-email">Alamat E-mail</label>
                                            <input class="form-control" type="email" id="userEmail" name="userEmail" value="<?= $user['email']; ?>" onchange="hideError('userEmailError')" disabled>
                                            <?= form_error('userEmail', '<small id="userEmailError" class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="account-email">Status Verifikasi</label>
                                            <input class="form-control" type="text" id="userStatus" value="<?= ucfirst($user['status']); ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="passwordBaru" style="display: none;">
                                            <label for="account-pass">Password Baru</label>
                                            <input class="form-control" type="password" id="newPassword" name="newPassword" onchange="hideError('newPasswordError')">
                                            <?= form_error('newPassword', '<small id="newPasswordError" class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="passwordKonfirm" style="display: none;">
                                            <label for="account-confirm-pass">Konfirmasi Password</label>
                                            <input class="form-control" type="password" id="repeatPassword" name="repeatPassword" onchange="hideError('repeatPasswordError')">
                                            <?= form_error('repeatPassword', '<small id="repeatPasswordError" class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <hr class="mt-2 mb-3">
                                        <div class="d-flex flex-row-reverse">
                                            <button class="btn btn-style-1 btn-primary" id="startEditButton" type="button" onclick="startEdit()">Edit Info Login</button>
                                            <button class="btn btn-style-1 btn-success mr-2" id="saveEditButton" type="submit" style="display: none;">Simpan</button>
                                            <button class="btn btn-style-1 btn-danger mr-2" id="stopEditButton" type="button" onclick="window.location.href = window.location.href" style="display: none;">Batal</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

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
        function startEdit() {
            document.getElementById("userEmail").disabled = false;
            document.getElementById("passwordBaru").style.display = "block";
            document.getElementById("passwordKonfirm").style.display = "block";
            document.getElementById("startEditButton").style.display = "none";
            document.getElementById("saveEditButton").style.display = "block";
            document.getElementById("stopEditButton").style.display = "block";
        }

        var newFormError = document.getElementById("newPasswordError");
        var repeatFormError = document.getElementById("repeatPasswordError");
        if (typeof(newFormError) != 'undefined' && newFormError != null) {
            startEdit();
        } else if (typeof(repeatFormError) != 'undefined' && repeatFormError != null) {
            startEdit();
        }

        function hideError(error) {
            document.getElementById(error).style.display = "none";
        }
    </script>

    <!-- Core Script Data -->
    <?php $this->load->view("partial/_script.php") ?>
    <!-- Custom scripts for sb-admin -->
    <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

</body>

</html>