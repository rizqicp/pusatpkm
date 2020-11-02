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
                    <h1 class="h3 mb-4 text-gray-800">Pengajuan</h1>

                    <a href="<?= base_url($user['role'] . '/tambahpengajuan'); ?>" class="badge badge-primary mb-3">Tambah Pengajuan</a>

                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Id</th>
                                <th scope="col">NPM</th>
                                <th scope="col">Anggota</th>
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
                                    <td><?= $pengajuan['mahasiswa_npm']; ?></td>
                                    <td><?= $pengajuan['anggota']; ?></td>
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