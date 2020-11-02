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
                    <h1 class="h3 mb-4 text-gray-800">Tambah Pengajuan</h1>

                    <form action="<?= base_url('mahasiswa/tambahpengajuan'); ?>" method="post" enctype="multipart/form-data">

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Periode</label>
                            </div>
                            <select class="custom-select" name="periode" id="periode" value="<?= set_value('periode'); ?>">
                                <?php foreach ($periode as $periode) : ?>
                                    <option value="<?= $periode['id']; ?>"><?= $periode['tahun']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('periode', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Kategori</label>
                            </div>
                            <select class="custom-select" name="kategori" id="kategori" value="<?= set_value('kategori'); ?>">
                                <?php foreach ($kategori as $kategori) : ?>
                                    <option value="<?= $kategori['id']; ?>"><?= $kategori['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('kategori', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Judul</span>
                            </div>
                            <input type="text" class="form-control" name="judul" id="judul" value="<?= set_value('judul'); ?>">
                            <?= form_error('judul', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>


                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Abstraksi</span>
                            </div>
                            <textarea class="form-control" name="abstraksi" id="abstraksi" value="<?= set_value('abstraksi'); ?>" cols="30" rows="10"></textarea>
                            <?= form_error('abstraksi', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Dana Ajuan</span>
                            </div>
                            <input type="number" class="form-control" name="dana" id="dana" value="<?= set_value('dana'); ?>" min="0" max="999999999">
                            <?= form_error('dana', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">NIDN Dosen Pembimbing</span>
                            </div>
                            <input type="text" class="form-control" name="dosenNidn" id="dosenNidn" value="<?= set_value('dosenNidn'); ?>">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="button-addon2">Cari</button>
                            </div>
                            <?= form_error('dosenNidn', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">NPM Anggota Tim</span>
                            </div>
                            <input type="text" class="form-control" name="mahasiswaNpm" id="mahasiswaNpm" value="<?= set_value('mahasiswaNpm'); ?>">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="button-addon2" data-toggle="modal" data-target="#tambahAnggotaModal">Tambah</button>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="userFile" id="userFile">
                                <label class="custom-file-label" for="userFile">Choose file</label>
                            </div>
                        </div>

                        <button class="btn btn-primary mb-3" type="submit" value="upload">Buat Pengajuan</button>

                    </form>

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

    <!-- input form Modal-->
    <?php $this->load->view("user/mahasiswa/_tambahAnggotaModal.php") ?>

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