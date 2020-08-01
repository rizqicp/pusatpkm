<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Data -->
    <?php $this->load->view("_partials/meta.php") ?>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php $this->load->view("_partials/sidebar.php") ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php $this->load->view("_partials/topbar.php") ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Profil Saya</h1>
                    <p>id = <?= $user['id']; ?></p>
                    <p>email = <?= $user['email']; ?></p>
                    <p>peran = <?= $user['role']; ?></p>
                    <p>status = <?= $user['aktif']; ?></p>
                    <?php if ($user['role'] == 'mahasiswa') : ?>
                        <p>nama = <?= $user['nama']; ?></p>
                        <p>npm = <?= $user['npm']; ?></p>
                        <p>prodi = <?= $user['prodi_id']; ?></p>
                    <?php elseif ($user['role'] == 'dosen') : ?>
                        <p>nama = <?= $user['nama']; ?></p>
                        <p>nidn = <?= $user['nidn']; ?></p>
                        <p>prodi = <?= $user['prodi_id']; ?></p>
                    <?php endif; ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php $this->load->view("_partials/footer.php") ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <?php $this->load->view("_partials/scrollTop.php") ?>
    <!-- Logout Modal-->
    <?php $this->load->view("_partials/logoutModal.php") ?>
    <!-- Script -->
    <?php $this->load->view("_partials/script.php") ?>

</body>

</html>