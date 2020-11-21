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
                    <a class="small" href="<?= base_url('admin/tambahuser'); ?>">
                        <button type="button" class="btn btn-primary btn-sm mb-2" href="#">Tambah User</button>
                    </a>
                    <?= $this->session->flashdata('message'); ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Peran</th>
                                    <th scope="col">Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pengguna as $pengguna) : ?>
                                    <tr>
                                        <?php if ($pengguna['role'] == 'admin') : ?>
                                            <td>Administrator</td>
                                        <?php else : ?>
                                            <td><?= $pengguna['nama']; ?></td>
                                        <?php endif; ?>
                                        <td><?= $pengguna['email']; ?></td>
                                        <td><?= $pengguna['role']; ?></td>
                                        <td><?= $pengguna['status']; ?></td>
                                        <?php if ($pengguna['role'] != 'admin') : ?>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#editUserModal">Ubah&nbsp&nbsp</button>
                                                <button type="button" class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#hapusUserModal">Hapus</button>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
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
    <!-- editUser Modal-->
    <?php $this->load->view("user/admin/_editUserModal.php") ?>
    <!-- hapusUser Modal-->
    <?php $this->load->view("user/admin/_hapusUserModal.php") ?>

    <!-- Core Script Data -->
    <?php $this->load->view("partial/_script.php") ?>
    <!-- Custom scripts for sb-admin -->
    <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

</body>

</html>