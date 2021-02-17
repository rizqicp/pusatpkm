<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Core Meta Data -->
    <?php $this->load->view("_partials/meta") ?>
    <!-- Custom styles for sb-admin -->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php $this->load->view("_partials/sidebar") ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php $this->load->view("_partials/topbar") ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="container mt-5">
                        <div class="row">
                            <div class="col-lg-4 pb-3">
                                <!-- Account Sidebar-->
                                <div class="author-card-profile">
                                    <div class="author-card-avatar">
                                        <img class="img-fluid img-profile border rounded" src="<?= base_url('uploads/img/profile/defaultProfile.png'); ?>" alt="Profile Image">
                                    </div>
                                    <div class="author-card-details mt-2">
                                        <?php if ($edituser['role'] == 'mahasiswa' || $edituser['role'] == 'dosen') : ?>
                                            <h5 class="author-card-name text-lg"><b><?= $edituser['nama']; ?></b></h5>
                                        <?php endif; ?>
                                        <span class="author-card-position" id="userRole"><?= ucfirst($edituser['role']); ?></span>
                                    </div>
                                </div>

                            </div>
                            <!-- Profile Settings-->
                            <div class="col-lg-8 pb-3">
                                <form class="row" action="<?= base_url('admin/edituser'); ?>" method="POST">
                                    <?php if ($edituser['role'] == 'mahasiswa' || $edituser['role'] == 'dosen') : ?>
                                        <div class="col-12">
                                            <h5 class="author-card-name text-lg mb-3"><b>Data Diri</b></h5>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="account-fn">Nama</label>
                                                <input class="form-control" type="text" id="userNama" value="<?= $edituser['nama']; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php if ($edituser['role'] == 'mahasiswa') : ?>
                                                    <label for="account-phone">NPM</label>
                                                    <input class="form-control" type="text" id="userNpm" value="<?= $edituser['npm']; ?>" disabled>
                                                <?php elseif ($edituser['role'] == 'dosen') : ?>
                                                    <label for="account-phone">NIDN</label>
                                                    <input class="form-control" type="text" id="userNidn" value="<?= $edituser['nidn']; ?>" disabled>
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
                                            <input class="form-control" type="email" id="userEmail" name="userEmail" value="<?= $edituser['email']; ?>" onchange="hideError('userEmailError')">
                                            <?= form_error('userEmail', '<small id="userEmailError" class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="userStatus">Status Verifikasi</label>
                                            <select class="custom-select form-control" id="userStatus" name="userStatus">
                                                <option value="aktif" <?= $edituser['status'] == 'aktif' ? "selected" : "" ?>>Aktif</option>
                                                <option value="pasif" <?= $edituser['status'] == 'pasif' ? "selected" : "" ?>>Pasif</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="passwordBaru">
                                            <label for="account-pass">Password Baru</label>
                                            <input class="form-control" type="password" id="newPassword" name="newPassword" onchange="hideError('newPasswordError')">
                                            <?= form_error('newPassword', '<small id="newPasswordError" class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="passwordKonfirm">
                                            <label for="account-confirm-pass">Konfirmasi Password</label>
                                            <input class="form-control" type="password" id="repeatPassword" name="repeatPassword" onchange="hideError('repeatPasswordError')">
                                            <?= form_error('repeatPassword', '<small id="repeatPasswordError" class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <hr class="mt-2 mb-3">
                                        <div class="d-flex flex-row-reverse">
                                            <button class="btn btn-style-1 btn-success mr-2" id="saveEditButton" type="submit">Simpan</button>
                                            <a class="btn btn-style-1 btn-danger mr-2" id="stopEditButton" href="<?= base_url('admin/kelolauser'); ?>">Batal</a>
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
            <?php $this->load->view("_partials/footer") ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <?php $this->load->view("_partials/scrollTop") ?>
    <!-- Logout Modal-->
    <?php $this->load->view("_partials/logoutModal") ?>

    <script>
        function startEdit() {
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
    <?php $this->load->view("_partials/script") ?>
    <!-- Custom scripts for sb-admin -->
    <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

</body>

</html>