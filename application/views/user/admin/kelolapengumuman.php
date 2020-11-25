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
                    <h1 class="h3 mb-4 text-gray-800">Kelola Pengumuman</h1>
                    <?= $this->session->flashdata('message'); ?>
                    <div class="row">
                        <div class="col-md-9">
                            <a class="small" href="<?= base_url('admin/tambahpengumuman'); ?>">
                                <button type="button" class="btn btn-primary btn-sm mb-2" href="#">Tambah Pengumuman</button>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <form action="<?= base_url('admin/kelolapengumuman'); ?>" method="POST">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="search" placeholder="Judul Pengumuman" autocomplete="off">
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
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th></th>
                                    <th>Waktu</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($pengumuman == null) : ?>
                                    <?php $caption['firstData'] = 0; ?>
                                    <tr>
                                        <td class="align-middle text-center" colspan="6">Tidak ada data</td>
                                    </tr>
                                <?php endif; ?>
                                <?php $i = $caption['firstData'];
                                foreach ($pengumuman as $pengumuman) : ?>
                                    <tr>
                                        <td class="align-middle"><?= $i++; ?></td>
                                        <td class="align-middle"><?= mb_strimwidth($pengumuman['judul'], 0, 64, "..."); ?></td>
                                        <td class="align-middle"><?= $pengumuman['gambar'] ? '<i class="fas fa-fw fa-image"></i>' : ""; ?></td>
                                        <td class="align-middle"><?= date("d M Y", strtotime($pengumuman['waktu'])); ?></td>
                                        <td class="align-middle"><?= ucfirst($pengumuman['status']); ?></td>
                                        <td class="align-middle">
                                            <a type="button" class="btn btn-primary btn-sm mb-1" href="<?= base_url('admin/editpengumuman') . '?id=' . $pengumuman['id']; ?>">&nbspUbah&nbsp</a>
                                            <button type="button" class="btn btn-danger btn-sm mb-1" href="#" data-toggle="modal" data-target="#hapusPengumumanModal<?= $pengumuman['id']; ?>">Hapus</button>
                                            <?php $this->load->view("user/admin/_hapusPengumumanModal.php", $pengumuman) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <caption class="mt-2"><small><?= $caption['firstData']; ?> - <?= $caption['lastData']; ?> dari <?= $caption['totalData']; ?> Pengumuman</small></caption>
                        </table>
                        <?= $this->pagination->create_links(); ?>
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

<!-- <th>Isi</th> -->
<!-- <th>Gambar</th> -->
<!-- <td><?php// mb_strimwidth($pengumuman['isi'], 0, 64, "..."); ?></td> -->
<!-- <td>
<figure class="figure">
<img src="<?php// base_url('assets/img/pengumuman/') . $pengumuman['gambar']; ?>" class="img-fluid rounded img-thumbnail" alt="Tidak ada Gambar">
</figure>
</td> -->