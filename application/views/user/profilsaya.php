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

                    <div class="card bg-light mb-3" style="max-width: 18rem;">
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