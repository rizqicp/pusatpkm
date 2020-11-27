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

                        <div class="form-group row">
                            <label for="periode" class="col-sm-2 col-form-label col-form-label-lg"><b>Periode</b></label>
                            <div class="col-sm-10 pt-1">
                                <select class="custom-select form-control" id="periode" name="periode">
                                    <?php foreach ($periode as $periode) : ?>
                                        <option value="<?= $periode['id']; ?>"><?= $periode['tahun']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('periode', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kategori" class="col-sm-2 col-form-label col-form-label-lg"><b>Kategori</b></label>
                            <div class="col-sm-10 pt-1">
                                <select class="custom-select form-control" id="kategori" name="kategori">
                                    <?php foreach ($kategori as $kategori) : ?>
                                        <option value="<?= $kategori['id']; ?>"><?= $kategori['nama']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('kategori', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row mt-5">
                            <label for="judul" class="col-sm-2 col-form-label col-form-label-lg"><b>Judul</b></label>
                            <div class="col-sm-10 pt-1">
                                <input type="text" class="form-control " id="judul" name="judul" value="<?= set_value('judul'); ?>" onchange="hideError('judulError');">
                                <?= form_error('judul', '<small id="judulError" class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="abstraksi" class="col-sm-2 col-form-label col-form-label-lg"><b>Abstraksi</b></label>
                            <div class="col-sm-10 pt-1">
                                <textarea class="form-control" name="abstraksi" id="abstraksi" rows="5" onchange="hideError('abstraksiError');"><?= set_value('abstraksi'); ?></textarea>
                                <?= form_error('abstraksi', '<small id="abstraksiError" class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dana" class="col-sm-2 col-form-label col-form-label-lg"><b>Dana Ajuan</b></label>
                            <div class="col-sm-10 pt-1">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="text" class="form-control " id="dana" name="dana" value="<?= set_value('dana'); ?>" min="0" max="999999999" placeholder="0" onchange="hideError('danaError');">
                                    <?= form_error('dana', '<small id="danaError" class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dosen" class="col-sm-2 col-form-label col-form-label-lg"><b>NIDN Pembimbing</b></label>
                            <div class="col-sm-10 pt-1">
                                <input type="text" class="form-control " id="dosen" name="dosen" value="<?= set_value('dosen'); ?>" placeholder="NIDN" onchange="hideError('dosenError');">
                                <?= form_error('dosen', '<small id="dosenError" class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row" id="newAnggota">
                            <label for="anggota" class="col-sm-2 col-form-label col-form-label-lg"><b>NPM Anggota</b></label>
                            <div class="col-sm-2 pt-1">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control " id="anggota" name="anggota[]" value="<?= $user['npm']; ?>" readonly>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary" type="button" onclick="addAnggota()"><i class="fas fa-fw fa-plus"></i></button>
                                    </div>
                                </div>
                                <?= form_error('anggota', '<small id="anggotaError" class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row mt-5">
                            <label for="userFile" class="col-sm-2 col-form-label col-form-label-lg"><b>Proposal</b></label>
                            <div class="input-group mb-3 col-sm-10">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="userFile" name="userFile" accept=".doc, .docx" onchange="validateFileType(); changeText('fileLabel',this.value);">
                                    <label class="custom-file-label" for="userFile" id="fileLabel" style="color: #999;">Pilih file</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" alue="upload" class="btn btn-primary btn-user btn-block">Buat Pengajuan</button>
                        <div class="text-center mt-3">
                            <a class="small" href="<?= base_url('mahasiswa/pengajuan'); ?>">&larr; Kembali &nbsp;&nbsp;</a>
                        </div>
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

    <script>
        function changeText(id, value) {
            document.getElementById(id).innerHTML = value.split('\\').pop();
        }

        function validateFileType() {
            var fileName = document.getElementById("userFile").value;
            var idxDot = fileName.lastIndexOf(".") + 1;
            var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
            if (extFile == "doc" || extFile == "docx") {
                //accept file
            } else {
                alert("Hanya Dokumen Word yang diperbolehkan!");
                document.getElementById("userFile").value = null;
            }
        }

        function hideError(error) {
            document.getElementById(error).style.display = "none";
        }

        var idAnggota = 0;
        var jumlahAnggota = 1;

        function addAnggota() {
            if (jumlahAnggota < 5) {
                var formAnggota = document.createElement('div');
                formAnggota.className = 'col-sm-2 pt-1';
                formAnggota.id = 'anggota' + idAnggota++;
                formAnggota.innerHTML =
                    '<div class="input-group mb-3">' +
                    '<input type="text" class="form-control" name="anggota[' + idAnggota + ']" placeholder="NPM">' +
                    '<div class="input-group-append">' +
                    '<button class="btn btn-outline-danger" type="button" onclick="removeAnggota(\'' + formAnggota.id + '\')"><i class="fas fa-fw fa-minus"></i></button>' +
                    '</div>' +
                    '</div>';
                document.getElementById("newAnggota").appendChild(formAnggota);
                jumlahAnggota++;
            }
        }

        function removeAnggota(id) {
            var anggota = document.getElementById(id);
            anggota.remove();
            jumlahAnggota--;
        }
    </script>

    <!-- Core Script Data -->
    <?php $this->load->view("partial/_script.php") ?>
    <!-- Custom scripts for sb-admin -->
    <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

</body>

</html>