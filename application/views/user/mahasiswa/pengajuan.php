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
                    <h1 class="h3 mb-4 text-gray-800">Pengajuan</h1>

                    <a href="<?= base_url($user['role'] . '/tambahpengajuan'); ?>" class="badge badge-primary mb-3">Tambah Pengajuan</a>

                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Id</th>
                                <th scope="col">Periode</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Tahap</th>
                                <th scope="col">Pembimbing</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Abstraksi</th>
                                <th scope="col">Dana</th>
                                <th scope="col">File</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($pengajuan as $pengajuan) : ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $pengajuan['id']; ?></td>
                                    <td><?= $pengajuan['periode_id']; ?></td>
                                    <td><?= $pengajuan['kategori_id']; ?></td>
                                    <td><?= $pengajuan['tahap_id']; ?></td>
                                    <td><?= $pengajuan['dosen_nidn']; ?></td>
                                    <td><?= $pengajuan['judul']; ?></td>
                                    <td><?= $pengajuan['abstraksi']; ?></td>
                                    <td><?= $pengajuan['dana']; ?></td>
                                    <td><?= $pengajuan['file']; ?></td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

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