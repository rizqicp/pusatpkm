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
                    <h1 class="h3 mb-4 text-gray-800">Detail Pengajuan</h1>
                    <div class="row">

                        <div class="col-md-8">
                            <div class="card bg-light mb-4">
                                <div class="card-body">
                                    <h2 class="card-title"><b><?= $pengajuan['judul']; ?></b></h2>
                                    <small><b>Abstraksi :</b></small>
                                    <p class="card-text"><?= $pengajuan['abstraksi']; ?></p>
                                    <small><b>Dana ajuan :</b></small>
                                    <p>Rp <?= number_format($pengajuan['dana'], 0, ',', '.'); ?></p>
                                </div>
                                <div class="card-footer text-muted">
                                    <a class="btn btn-primary btn-block text-left mt-2" href="<?= base_url('upload/pengajuan/') . $pengajuan['file']; ?>"><i class=" fas fa-fw fa-file-alt"></i> File Proposal</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card bg-light mb-4">
                                <h5 class="card-header"><b>Anggota Kelompok</b></h5>
                                <div class="card-body">
                                    <small><b>Pembimbing :</b></small>
                                    <p><?= $kelompok['dosen']['nama']; ?> (<?= $kelompok['dosen']['nidn']; ?>)</p>
                                    <small><b>Anggota :</b></small>
                                    <?php foreach ($kelompok['mahasiswa'] as $mahasiswa) : ?>
                                        <p><?= $mahasiswa['nama']; ?> (<?= $mahasiswa['npm']; ?>)</p>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <!-- <div class="card bg-light mb-4">
                                <h5 class="card-header"><b>Status Pengajuan</b></h5>
                                <div class="card-body">

                                </div>
                                <div class="card-footer text-muted">
                                    <a class="btn btn-primary btn-block text-left mt-2" href="#">Tugaskan</a>
                                </div>
                            </div> -->
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