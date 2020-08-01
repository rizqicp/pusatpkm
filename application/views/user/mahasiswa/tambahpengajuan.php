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
                    <h1 class="h3 mb-4 text-gray-800">Tambah Pengajuan</h1>

                    <form action="<?= base_url('mahasiswa/tambahpengajuan'); ?>" method="post" enctype="multipart/form-data">
                        <table border="1">
                            <tr>
                                <td><label for="periode">Periode</label></td>
                                <td>
                                    <select name="periode" id="periode" value="<?= set_value('periode'); ?>">
                                        <?php foreach ($periode as $periode) : ?>
                                            <option value="<?= $periode['id']; ?>"><?= $periode['tahun']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('periode', '<small class="text-danger pl-3">', '</small>'); ?>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="kategori">Kategori</label></td>
                                <td>
                                    <select name="kategori" id="kategori" value="<?= set_value('kategori'); ?>">
                                        <?php foreach ($kategori as $kategori) : ?>
                                            <option value="<?= $kategori['id']; ?>"><?= $kategori['nama']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('kategori', '<small class="text-danger pl-3">', '</small>'); ?>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="judul">Judul</label></td>
                                <td>
                                    <input type="text" name="judul" id="judul" value="<?= set_value('judul'); ?>">
                                    <?= form_error('judul', '<small class="text-danger pl-3">', '</small>'); ?>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="abstraksi">Abstraksi</label></td>
                                <td>
                                    <textarea name="abstraksi" id="abstraksi" value="<?= set_value('abstraksi'); ?>" cols="30" rows="10"></textarea>
                                    <?= form_error('abstraksi', '<small class="text-danger pl-3">', '</small>'); ?>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="dana">Pengajuan Dana</label></td>
                                <td>
                                    <input type="number" name="dana" id="dana" value="<?= set_value('dana'); ?>" min="0" max="999999999">
                                    <?= form_error('dana', '<small class="text-danger pl-3">', '</small>'); ?>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="dosenNidn">NIDN Dosen Pembimbing</label></td>
                                <td>
                                    <input name="dosenNidn" id="dosenNidn" value="<?= set_value('dosenNidn'); ?>">
                                    <?= form_error('dosenNidn', '<small class="text-danger pl-3">', '</small>'); ?>
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="2"><label for="pengusul">Anggota Tim</label></td>
                                <td>
                                    <?= "Anggota 1 : " . $user['nama']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <a href="#" class="badge badge-warning" data-toggle="modal" data-target="#tambahAnggotaModal">Tambah Anggota</a> #dalam perbaikan
                                </td>
                            </tr>
                            <tr>
                                <td><label for="file">File Pengajuan</label></td>
                                <td>
                                    <input type="file" name="file" id="file" value="<?= set_value('file'); ?>">
                                    <?= form_error('file', '<small class="text-danger pl-3">', '</small>'); ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <button type="submit" value="upload">
                                        Buat Pengajuan
                                    </button>
                                </td>
                            </tr>
                        </table>






                        <br>


                        <br>


                        <br>


                        <br>

                    </form>

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

    <!-- input form Modal-->
    <?php $this->load->view("_partials/tambahAnggotaModal.php") ?>

    <!-- Scroll to Top Button-->
    <?php $this->load->view("_partials/scrollTop.php") ?>
    <!-- Logout Modal-->
    <?php $this->load->view("_partials/logoutModal.php") ?>
    <!-- Script -->
    <?php $this->load->view("_partials/script.php") ?>

</body>

</html>