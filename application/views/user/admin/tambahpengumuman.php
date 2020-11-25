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
                    <h1 class="h3 mb-4 text-gray-800">Tambah Pengumuman</h1>
                    <form class="user" action="<?= base_url('admin/tambahpengumuman'); ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="judulPengumuman" class="col-sm-2 col-form-label col-form-label-lg"><b>Judul</b></label>
                            <div class="col-sm-10 pt-1">
                                <input type="text" class="form-control " id="judulPengumuman" name="judulPengumuman" value="<?= set_value('judulPengumuman'); ?>" onchange="hideError('judulPengumumanError');">
                                <?= form_error('judulPengumuman', '<small id="judulPengumumanError" class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <img class="img-fluid img-thumbnail rounded mx-auto d-block" id="imagePreview" src="<?= base_url('assets/'); ?>img/pengumuman/templateGambar.jpg">
                        </div>
                        <div class="form-group row">
                            <label for="gambarPengumuman" class="col-sm-2 col-form-label col-form-label-lg"><b>Gambar </b><small>&#40;opsional&#41;</small></label>
                            <div class="input-group mb-3 col-sm-10">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="gambarPengumuman" name="gambarPengumuman" accept=".png, .jpg, .jpeg" onchange="validateFileType(); changeText('gambarLabel',this.value); loadImage(event);">
                                    <label class="custom-file-label" for="gambarPengumuman" id="gambarLabel" style="color: #999;">Pilih file</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="isiPengumuman" class="col-sm-2 col-form-label col-form-label-lg"><b>Isi</b></label>
                            <div class="col-sm-10 pt-1">
                                <textarea class="form-control" name="isiPengumuman" id="isiPengumuman" rows="5" onchange="hideError('isiPengumumanError');"><?= set_value('isiPengumuman'); ?></textarea>
                                <?= form_error('isiPengumuman', '<small id="isiPengumumanError" class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="statusPengumuman" class="col-sm-2 col-form-label col-form-label-lg"><b>Status</b></label>
                            <div class="col-sm-10 pt-1">
                                <select class="custom-select form-control" id="statusPengumuman" name="statusPengumuman">
                                    <option value="aktif">Aktif</option>
                                    <option value="pasif">Pasif</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Buat Pengumuman
                        </button>
                        <div class="text-center mt-3">
                            <a class="small" href="<?= base_url('admin/kelolapengumuman'); ?>">&larr; Kembali &nbsp;&nbsp;</a>
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

    <!-- Scroll to Top Button-->
    <?php $this->load->view("user/_scrollTop.php") ?>
    <!-- Logout Modal-->
    <?php $this->load->view("user/_logoutModal.php") ?>

    <script>
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
        }

        function hideError(error) {
            document.getElementById(error).style.display = "none";
        }
    </script>

    <!-- Core Script Data -->
    <?php $this->load->view("partial/_script.php") ?>
    <!-- Custom scripts for sb-admin -->
    <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

</body>

</html>