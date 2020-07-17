<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Data -->
    <?php $this->load->view("templates/meta.php") ?>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php $this->load->view("templates/sidebar.php") ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php $this->load->view("templates/topbar.php") ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
                    <p>id = <?= $user['id']; ?></p>
                    <p>email = <?= $user['email']; ?></p>
                    <p>password = <?= $user['password']; ?></p>
                    <p>peran = <?= $user['role']; ?></p>
                    <p>status = <?= $user['aktif']; ?></p>
                    <p>nama = <?= $user['nama']; ?></p>
                    <?php if ($user['role'] == 'mahasiswa') : ?>
                        <p>npm = <?= $user['npm']; ?></p>
                    <?php elseif ($user['role'] == 'mahasiswa') : ?>
                        <p>nidn = <?= $user['nidn']; ?></p>
                    <?php endif; ?>
                    <p>prodi = <?= $user['prodi_id']; ?></p>



                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php $this->load->view("templates/footer.php") ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <?php $this->load->view("templates/scrollTop.php") ?>
    <!-- Logout Modal-->
    <?php $this->load->view("templates/logoutModal.php") ?>
    <!-- Script -->
    <?php $this->load->view("templates/script.php") ?>

</body>

</html>