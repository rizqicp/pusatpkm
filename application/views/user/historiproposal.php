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
                    <h1 class="h3 mb-4 text-gray-800">Histori Pengajuan</h1>
                    <?= $this->session->flashdata('message'); ?>
                    <div class="row">
                        <div class="col-md-9">
                        </div>
                        <div class="col-md-3">
                            <form action="<?= base_url($user['role'] . '/historiproposal'); ?>" method="POST">
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
                                        <td class="align-middle">
                                            <?php switch ($pengajuan['tahap_id']):
                                                case 1: ?>
                                                    <span class="badge badge-secondary"><?= $pengajuan['tahap_nama']; ?></span>
                                                <?php break;
                                                case 2: ?>
                                                    <span class="badge badge-primary"><?= $pengajuan['tahap_nama']; ?></span>
                                                <?php break;
                                                case 3: ?>
                                                    <span class="badge badge-warning"><?= $pengajuan['tahap_nama']; ?></span>
                                                <?php break;
                                                case 4: ?>
                                                    <span class="badge badge-danger"><?= $pengajuan['tahap_nama']; ?></span>
                                                <?php break;
                                                case 5: ?>
                                                    <?php if ($pengajuan['belmawa_username'] != null && $pengajuan['belmawa_password'] != null) : ?>
                                                        <span class="badge badge-success"><?= $pengajuan['tahap_nama']; ?></span>
                                                    <?php else : ?>
                                                        <span class="badge badge-info">Menunggu Akun</span>
                                                    <?php endif; ?>
                                                <?php break;
                                                case 6: ?>
                                                    <span><?= $pengajuan['tahap_nama']; ?></span>
                                                    <?php break; ?>
                                            <?php endswitch; ?>
                                        </td>
                                        <td class="align-middle">
                                            <a type="button" class="btn btn-primary btn-sm mb-1" href="<?= base_url($user['role'] . '/detailpengajuan') . '?id=' . $pengajuan['pengajuan_id']; ?>">Detail</a>
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