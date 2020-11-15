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

                    <!-- <div class="card bg-light mb-3" style="max-width: 18rem;">
                        <div class="card-header">Profil Saya</div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $user['role']; ?></h5>
                            <p class="card-text">Id = <?= $user['id']; ?></p>
                            <p class="card-text">Email = <?= $user['email']; ?></p>
                            <p class="card-text">Status = <?= $user['status']; ?></p>
                            <?php if ($user['role'] == 'mahasiswa') : ?>
                                <p class="card-text">Nama = <?= $user['nama']; ?></p>
                                <p class="card-text">NPM = <?= $user['npm']; ?></p>
                                <p class="card-text">Prodi = <?= $user['prodi_id']; ?></p>
                            <?php elseif ($user['role'] == 'dosen') : ?>
                                <p class="card-text">Nama = <?= $user['nama']; ?></p>
                                <p class="card-text">NIDN = <?= $user['nidn']; ?></p>
                                <p class="card-text">Prodi = <?= $user['prodi_id']; ?></p>
                            <?php endif; ?>
                        </div>
                    </div> -->

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
                                        <span class="author-card-position"><?= $user['role']; ?></span>
                                    </div>
                                </div>

                            </div>
                            <!-- Profile Settings-->
                            <div class="col-lg-8 pb-3">
                                <form class="row">
                                    <?php if ($user['role'] == 'mahasiswa' || $user['role'] == 'dosen') : ?>
                                        <div class="col-12">
                                            <h5 class="author-card-name text-lg mb-3"><b>Data Diri</b></h5>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="account-fn">Nama</label>
                                                <input class="form-control" type="text" id="account-fn" value="<?= $user['nama']; ?>" required="" disabled="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="account-phone">NPM</label>
                                                <input class="form-control" type="text" id="account-phone" value="<?= $user['npm']; ?>" required="" disabled="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="account-fn">Prodi</label>
                                                <input class="form-control" type="text" id="account-fn" value="<?= $user['prodi_id']; ?>" required="" disabled="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="account-fn">Fakultas</label>
                                                <input class="form-control" type="text" id="account-fn" value="Ilmu Komputer" required="" disabled="">
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-12">
                                        <hr>
                                        <h5 class="author-card-name text-lg mb-3"><b>Informasi Login</b></h5>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="account-email">Alamat E-mail</label>
                                            <input class="form-control" type="email" id="account-email" value="rizqi@gmail.com" disabled="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="account-pass">Password Lama</label>
                                            <input class="form-control" type="password" id="account-pass" disabled="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="account-pass">Password Baru</label>
                                            <input class="form-control" type="password" id="account-pass" disabled="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="account-confirm-pass">Konfirmasi Password</label>
                                            <input class="form-control" type="password" id="account-confirm-pass" disabled="">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <hr class="mt-2 mb-3">
                                        <div class="d-flex flex-wrap justify-content-between align-items-center">
                                            <div class="custom-control custom-checkbox d-block">
                                                <input class="custom-control-input" type="checkbox" id="subscribe_me" checked="">
                                                <label class="custom-control-label" for="subscribe_me">Subscribe me to Newsletter</label>
                                            </div>
                                            <button class="btn btn-style-1 btn-primary" type="button" data-toast="" data-toast-position="topRight" data-toast-type="success" data-toast-icon="fe-icon-check-circle" data-toast-title="Success!" data-toast-message="Your profile updated successfuly.">Update Profile</button>
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

    <!-- Core Script Data -->
    <?php $this->load->view("partial/_script.php") ?>
    <!-- Custom scripts for sb-admin -->
    <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

</body>

</html>