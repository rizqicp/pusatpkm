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
                    <h1 class="h3 mb-4 text-gray-800">Kelola Pengguna</h1>
                    <?= $this->session->flashdata('message'); ?>
                    <div class="row">
                        <div class="col-md-9">
                            <a class="small" href="<?= base_url('admin/tambahuser'); ?>">
                                <button type="button" class="btn btn-primary btn-sm mb-2" href="#">Tambah User</button>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <form action="<?= base_url('admin/kelolauser'); ?>" method="POST">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="search" placeholder="Email User" autocomplete="off">
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
                                    <th>Email</th>
                                    <th>Peran</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pengguna as $pengguna) : ?>
                                    <tr>
                                        <?php if ($pengguna['role'] == 'admin') : ?>
                                            <td class="align-middle">Administrator</td>
                                        <?php else : ?>
                                            <td class="align-middle"><?= $pengguna['nama']; ?></td>
                                        <?php endif; ?>
                                        <td class="align-middle"><?= $pengguna['email']; ?></td>
                                        <td class="align-middle"><?= ucfirst($pengguna['role']); ?></td>
                                        <td class="align-middle"><?= ucfirst($pengguna['status']); ?></td>
                                        <?php if ($pengguna['role'] != 'admin') : ?>
                                            <td class="align-middle">
                                                <a type="button" class="btn btn-primary btn-sm mb-1" href="<?= base_url('admin/edituser') . '?id=' . $pengguna['id']; ?>">&nbspUbah&nbsp</a>
                                                <button type="button" class="btn btn-danger btn-sm mb-1" href="#" data-toggle="modal" data-target="#hapusUserModal<?= $pengguna['id']; ?>">Hapus</button>
                                                <!-- hapusUser Modal-->
                                                <?php $this->load->view("user/admin/_hapusUserModal.php", $pengguna) ?>
                                            </td>
                                        <?php else : ?>
                                            <td class="align-middle">
                                                <button type="button" class="btn btn-secondary btn-sm mb-1" disabled>&nbspUbah&nbsp</button>
                                                <button type="button" class="btn btn-secondary btn-sm mb-1" disabled>Hapus</button>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <caption class="mt-2"><small><?= $caption['firstData']; ?> - <?= $caption['lastData']; ?> dari <?= $caption['totalData']; ?> User</small></caption>
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