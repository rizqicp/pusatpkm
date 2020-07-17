<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Data -->
    <?php $this->load->view("templates/meta.php") ?>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php $this->load->view("templates/sidebar.php") ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php $this->load->view("templates/topbar.php") ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

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
                                    <input type="number" name="dana" id="dana" value="<?= set_value('dana'); ?>" placeholder="0">
                                    <?= form_error('dana', '<small class="text-danger pl-3">', '</small>'); ?>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="dosenNidn">NIDN Dosen Pembimbing</label></td>
                                <td>
                                    <input type="text" name="dosenNidn" id="dosenNidn" value="<?= set_value('dosenNidn'); ?>">
                                    <?= form_error('dosenNidn', '<small class="text-danger pl-3">', '</small>'); ?>
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
            <?php $this->load->view("templates/footer.php") ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <?php $this->load->view("templates/scrollTop.php") ?>
    <!-- Logout Modal-->
    <?php $this->load->view("templates/logoutModal.php") ?>
    <!-- Script -->
    <?php $this->load->view("templates/script.php") ?>

</body>

</html>