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
                    <h1 class="h3 mb-4 text-gray-800">Edit Pengajuan</h1>

                    <form action="<?= base_url('mahasiswa/editpengajuan'); ?>" method="post" enctype="multipart/form-data">

                        <div class="form-group row">
                            <label for="periode" class="col-sm-2 col-form-label col-form-label-lg"><b>Periode</b></label>
                            <div class="col-sm-10 pt-1">
                                <input type="text" class="form-control" id="periode" name="periode" value="<?= $periode['id']; ?>" hidden>
                                <input type="text" class="form-control" placeholder="<?= $periode['tahun']; ?>" disabled>
                                <?= form_error('periode', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hibah" class="col-sm-2 col-form-label col-form-label-lg"><b>Hibah</b></label>
                            <div class="col-sm-10 pt-1">
                                <select class="custom-select form-control" id="hibah" name="hibah">
                                    <?php foreach ($hibah as $hibah) : ?>
                                        <option value="<?= $hibah['id']; ?>" <?= $editpengajuan['hibah_id'] == $hibah['id'] ? "selected" : "" ?>>
                                            <?= $hibah['nama']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('hibah', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row mt-5">
                            <label for="judul" class="col-sm-2 col-form-label col-form-label-lg"><b>Judul</b></label>
                            <div class="col-sm-10 pt-1">
                                <input type="text" class="form-control " id="judul" name="judul" value="<?= set_value('judul') != null ? set_value('judul') : $editpengajuan['judul']; ?>" onchange="hideError('judulError');">
                                <?= form_error('judul', '<small id="judulError" class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="abstraksi" class="col-sm-2 col-form-label col-form-label-lg"><b>Abstraksi</b></label>
                            <div class="col-sm-10 pt-1">
                                <textarea class="form-control" name="abstraksi" id="abstraksi" rows="5" onchange="hideError('abstraksiError');"><?= set_value('abstraksi') != null ? set_value('abstraksi') : $editpengajuan['abstraksi']; ?></textarea>
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
                                    <input type="text" class="form-control " id="dana" name="dana" value="<?= set_value('dana') != null ? set_value('dana') : $editpengajuan['dana']; ?>" min="0" max="999999999" placeholder="0" onchange="hideError('danaError');">
                                    <?= form_error('dana', '<small id="danaError" class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dosen" class="col-sm-2 col-form-label col-form-label-lg"><b>NIDN Pembimbing</b></label>
                            <div class="col-sm-10 pt-1">
                                <input type="text" class="form-control " id="dosen" name="dosen" value="<?= set_value('dosen') != null ? set_value('dosen') : $editpengajuan['dosen_nidn']; ?>" placeholder="NIDN" onchange="hideError('dosenError');">
                                <?= form_error('dosen', '<small id="dosenError" class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row" id="newAnggota">
                            <label for="anggota" class="col-sm-2 col-form-label col-form-label-lg"><b>NPM Anggota</b></label>
                            <div class="col-sm-2 pt-1">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="anggota1" name="anggota1" value="<?= $editpengajuan['anggota1']; ?>" readonly>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary" type="button" onclick="addAnggota();"><i class="fas fa-fw fa-plus"></i></button>
                                    </div>
                                </div>
                                <?= form_error('anggota1', '<small id="anggota1Error" class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="col-sm-2 pt-1" id="formAnggota2" style="display: none ;">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="anggota2" name="anggota2" value="<?= set_value('anggota2') != null ? set_value('anggota2') : (array_key_exists('anggota2', $editpengajuan) ? $editpengajuan['anggota2'] : ''); ?>" placeholder="Anggota 2" onchange="hideError('anggota2Error');" disabled>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-danger" type="button" onclick="removeAnggota(2)"><i class="fas fa-fw fa-minus"></i></button>
                                    </div>
                                </div>
                                <?= form_error('anggota2', '<small id="anggota2Error" class="erroranggota text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="col-sm-2 pt-1" id="formAnggota3" style="display: none ;">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="anggota3" name="anggota3" value="<?= set_value('anggota3') != null ? set_value('anggota3') : (array_key_exists('anggota3', $editpengajuan) ? $editpengajuan['anggota3'] : ''); ?>" placeholder="Anggota 3" onchange="hideError('anggota3Error');" disabled>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-danger" type="button" onclick="removeAnggota(3)"><i class="fas fa-fw fa-minus"></i></button>
                                    </div>
                                </div>
                                <?= form_error('anggota3', '<small id="anggota3Error" class="erroranggota text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="col-sm-2 pt-1" id="formAnggota4" style="display: none ;">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="anggota4" name="anggota4" value="<?= set_value('anggota4') != null ? set_value('anggota4') : (array_key_exists('anggota4', $editpengajuan) ? $editpengajuan['anggota4'] : ''); ?>" placeholder="Anggota 4" onchange="hideError('anggota4Error');" disabled>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-danger" type="button" onclick="removeAnggota(3)"><i class="fas fa-fw fa-minus"></i></button>
                                    </div>
                                </div>
                                <?= form_error('anggota4', '<small id="anggota4Error" class="erroranggota text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="col-sm-2 pt-1" id="formAnggota5" style="display: none ;">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="anggota5" name="anggota5" value="<?= set_value('anggota5') != null ? set_value('anggota5') : (array_key_exists('anggota5', $editpengajuan) ? $editpengajuan['anggota5'] : ''); ?>" placeholder="Anggota 5" onchange="hideError('anggota5Error');" disabled>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-danger" type="button" onclick="removeAnggota(3)"><i class="fas fa-fw fa-minus"></i></button>
                                    </div>
                                </div>
                                <?= form_error('anggota5', '<small id="anggota5Error" class="erroranggota text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row mt-5">
                            <label for="userFile" class="col-sm-2 col-form-label col-form-label-lg"><b>Proposal</b></label>
                            <div class="input-group mb-3 col-sm-10">
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="userFile" name="userFile" accept=".doc, .docx" onchange="validateFileType(); changeText('fileLabel',this.value); hideError('userFile');">
                                        <label class="custom-file-label" for="userFile" id="fileLabel" style="color: #999;"><?= $editpengajuan['file']; ?></label>
                                    </div>
                                </div>
                                <?= form_error('userFile', '<small id="userFile" class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <button type="submit" alue="upload" class="btn btn-primary btn-user btn-block">Perbarui Pengajuan</button>
                        <div class="text-center mt-3">
                            <a class="small" href="<?= base_url('mahasiswa/pengajuan'); ?>">&larr; Kembali &nbsp;&nbsp;</a>
                        </div>
                    </form>

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

        var jumlahAnggota = 1;

        function addAnggota() {
            var anggota = document.getElementById('formAnggota' + (jumlahAnggota + 1));
            anggota.style.display = 'block';
            document.getElementById('anggota' + (jumlahAnggota + 1)).disabled = false;
            jumlahAnggota++;
        }

        function removeAnggota(id) {
            $(".erroranggota").hide();

            if (jumlahAnggota > id) {
                while (id < jumlahAnggota) {
                    var anggotaValue = document.getElementById('anggota' + (id + 1)).value;
                    document.getElementById('anggota' + id).value = anggotaValue;
                    document.getElementById('anggota' + (id + 1)).value = null;
                    id++;
                }
            } else {
                document.getElementById('anggota' + (id)).value = null;
            }
            document.getElementById('formAnggota' + (id)).style.display = 'none';
            document.getElementById('anggota' + (id)).disabled = true;
            jumlahAnggota--;
        }

        for (idAnggota = 2; idAnggota <= 5; idAnggota++) {
            if (document.getElementById("anggota" + idAnggota).value || document.getElementById("anggota" + idAnggota + "Error")) {
                addAnggota();
            }
        }
    </script>

    <!-- Core Script Data -->
    <?php $this->load->view("_partials/script") ?>
    <!-- Custom scripts for sb-admin -->
    <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

</body>

</html>