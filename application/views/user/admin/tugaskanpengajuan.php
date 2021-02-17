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

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Pilih Dosen</h1>
                    <?= $this->session->flashdata('message'); ?>
                    <div class="row">
                        <div class="col-md-9">
                        </div>
                        <div class="col-md-3">
                            <form action="<?= base_url('admin/tugaskanpengajuan'); ?>" method="POST">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="search" placeholder="Nama Dosen" autocomplete="off">
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
                                    <th>Nama</th>
                                    <th>NIDN</th>
                                    <th>Prodi</th>
                                    <th>Ulasan Aktif</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($dosen == null) : ?>
                                    <?php $caption['firstData'] = 0; ?>
                                    <tr>
                                        <td class="align-middle text-center" colspan="6">Tidak ada data</td>
                                    </tr>
                                <?php endif; ?>
                                <?php foreach ($dosen as $dosen) : ?>
                                    <tr>
                                        <td class="align-middle"><?= $dosen['nama']; ?></td>
                                        <td class="align-middle"><?= $dosen['nidn']; ?></td>
                                        <td class="align-middle"><?= $dosen['prodi_nama']; ?></td>
                                        <td class="align-middle"><?= $dosen['ulasan']; ?></td>
                                        <td class="align-middle">
                                            <a type="button" class="btn btn-primary btn-sm mb-1" href="#" data-toggle="modal" data-target="#tugaskanPengajuanModal<?= $dosen['nidn']; ?>">Tugaskan</a>
                                            <?php $tugas['dosen'] = $dosen; ?>
                                            <?php $tugas['pengajuan'] = $pengajuan; ?>
                                            <?php $this->load->view("user/admin/_tugaskanPengajuanModal", $tugas) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <caption class="mt-2"><small><?= $caption['firstData']; ?> - <?= $caption['lastData']; ?> dari <?= $caption['totalData']; ?> Dosen</small></caption>
                        </table>
                        <?= $this->pagination->create_links(); ?>
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

    <!-- Core Script Data -->
    <?php $this->load->view("_partials/script") ?>
    <!-- Custom scripts for sb-admin -->
    <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

</body>

</html>