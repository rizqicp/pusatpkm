<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Core Meta Data -->
    <?php $this->load->view("_partials/meta") ?>
    <!-- Custom styles for sb-admin -->
    <link href="<?= base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet" type="text/css">
    <!-- include summernote css-->
    <link href="<?= base_url('assets/summernote/summernote-bs4.css')?>" rel="stylesheet" type="text/css">
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
                    <h1 class="h3 mb-4 text-gray-800">Edit Pengumuman</h1>
                    <form class="user" action="<?= base_url('admin/editpengumuman'); ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="judulPengumuman" class="col-sm-2 col-form-label col-form-label-lg"><b>Judul</b></label>
                            <div class="col-sm-10 pt-1">
                                <input type="text" class="form-control " id="judulPengumuman" name="judulPengumuman" value="<?= set_value('judulPengumuman') != null ? set_value('judulPengumuman') : $editpengumuman['judul']; ?>" onchange="hideError('judulPengumumanError');">
                                <?= form_error('judulPengumuman', '<small id="judulPengumumanError" class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <img class="img-fluid img-thumbnail rounded mx-auto d-block" id="imagePreview" src="<?= base_url('uploads/img/pengumuman/'); ?><?= $editpengumuman['gambar'] != null ? $editpengumuman['gambar'] : 'templateGambar.jpg'; ?>">
                        </div>
                        <div class="form-group row">
                            <label for="gambarPengumuman" class="col-sm-2 col-form-label col-form-label-lg"><b>Gambar </b><small>&#40;opsional&#41;</small></label>
                            <div class="input-group mb-3 col-sm-9">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="gambarPengumuman" name="gambarPengumuman" accept=".png, .jpg, .jpeg" onchange="validateFileType(); changeText('gambarLabel',this.value); loadImage(event);">
                                    <label class="custom-file-label" for="gambarPengumuman" id="gambarLabel" style="color: #999;">Pilih file</label>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <button class="btn btn-style-1 btn-danger ml-1" type="button" href="#" onclick="deleteImage()">Hapus</button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="text" class="form-control " id="hapusGambar" name="hapusGambar" value="" style="display: none;">
                        </div>
                        <div class="form-group row">
                            <label for="summernote" class="col-sm-2 col-form-label col-form-label-lg"><b>Isi</b></label>
                            <div class="col-sm-10 pt-1">
                                <textarea class="form-control" name="isiPengumuman" id="summernote" rows="5" onchange="hideError('isiPengumumanError');"><?= set_value('isiPengumuman') != null ? set_value('isiPengumuman') : $editpengumuman['isi']; ?></textarea>
                                <?= form_error('isiPengumuman', '<small id="isiPengumumanError" class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="statusPengumuman" class="col-sm-2 col-form-label col-form-label-lg"><b>Status</b></label>
                            <div class="col-sm-10 pt-1">
                                <select class="custom-select form-control" id="statusPengumuman" name="statusPengumuman">
                                    <option value="aktif" <?= $editpengumuman['status'] == 'aktif' ? "selected" : "" ?>>Aktif</option>
                                    <option value="pasif" <?= $editpengumuman['status'] == 'pasif' ? "selected" : "" ?>>Pasif</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mt-5">
                            <div class="d-flex flex-row-reverse">
                                <button class="btn btn-style-1 btn-success mr-2" type="submit">Simpan</button>
                                <a class="btn btn-style-1 btn-danger mr-2" href="<?= base_url('admin/kelolapengumuman'); ?>">Batal</a>
                            </div>
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

    <!-- Core Script Data -->
    <?php $this->load->view("_partials/script") ?>
    <!-- Custom scripts for sb-admin -->
    <script src="<?= base_url('assets/js/sb-admin-2.min.js'); ?>"></script>
    <!-- include summernote js -->
    <script src="<?= base_url('assets/summernote/summernote-bs4.js'); ?>"></script>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });

        function changeText(id, value) {
            document.getElementById(id).innerHTML = value.split('\\').pop();
        }

        function validateFileType() {
            var fileName = document.getElementById("gambarPengumuman").value;
            var idxDot = fileName.lastIndexOf(".") + 1;
            var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
            if (extFile == "jpg" || extFile == "jpeg" || extFile == "png") {
                //accept file
            } else {
                alert("Hanya file gambar yang diperbolehkan!");
                document.getElementById("gambarPengumuman").value = null;
            }
        }

        function loadImage(event) {
            var image = document.getElementById('imagePreview');
            image.src = URL.createObjectURL(event.target.files[0]);
            document.getElementById('hapusGambar').value = null;
        }

        function deleteImage() {
            document.getElementById('imagePreview').src = window.location.origin + "/skripsi/uploads/img/pengumuman/templateGambar.jpg";
            document.getElementById('gambarLabel').innerHTML = "Pilih file";
            document.getElementById('hapusGambar').value = "delete";
        }

        function hideError(error) {
            document.getElementById(error).style.display = "none";
        }
    </script>

</body>

</html>