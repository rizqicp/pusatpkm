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
                    <?= $this->session->flashdata('message'); ?>
                    <div class="row">
                        <div class="col-md-9">
                            <a class="small" href="<?= base_url($user['role'] . '/tambahpengajuan'); ?>">
                                <button type="button" class="btn btn-primary btn-sm mb-2" href="#">Tambah Pengajuan</button>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <form action="<?= base_url('mahasiswa/pengajuan'); ?>" method="POST">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="search" placeholder="Judul Pengajuan" autocomplete="off">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit">Cari</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th class="align-middle">No</th>
                                    <th class="align-middle">Judul</th>
                                    <th class="align-middle">Pembimbing</th>
                                    <th class="align-middle">Periode</th>
                                    <th class="align-middle">Tahap</th>
                                    <th class="align-middle">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($pengajuan == null) : ?>
                                    <?php $caption['firstData'] = 0; ?>
                                    <tr>
                                        <td class="align-middle text-center" colspan="6">Tidak ada data</td>
                                    </tr>
                                <?php endif; ?>
                                <?php $i = 1; ?>
                                <?php foreach ($pengajuan as $pengajuan) : ?>
                                    <tr>
                                        <th class="align-middle"><?= $i; ?></th>
                                        <td class="align-middle"><?= $pengajuan['pengajuan_judul']; ?></td>
                                        <td class="align-middle"><?= $pengajuan['dosen_nama']; ?></td>
                                        <td class="align-middle"><?= $pengajuan['periode_tahun']; ?></td>
                                        <td class="align-middle"><?= $pengajuan['tahap_nama']; ?></td>
                                        <td class="align-middle">
                                            <a type="button" class="disabled btn btn-primary btn-sm mb-1 <?= $pengajuan['tahap_id'] > 1 ? 'disabled' : '' ?>" href="#">&nbspUbah&nbsp</a>
                                            <button type="button" class="btn btn-danger btn-sm mb-1" href="#" data-toggle="modal" data-target="#hapusPengajuanModal<?= $pengajuan['pengajuan_id']; ?>">Hapus</button>
                                            <!-- hapusPengajuan Modal -->
                                            <?php $this->load->view("user/mahasiswa/_hapusPengajuanModal.php", $pengajuan) ?>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                            <caption class="mt-2"><small><?= $caption['firstData']; ?> - <?= $caption['lastData']; ?> dari <?= $caption['totalData']; ?> Pengajuan</small></caption>
                        </table>
                    </div>
                    <?= $this->pagination->create_links(); ?>

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