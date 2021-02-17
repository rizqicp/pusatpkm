<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Core Meta Data -->
    <?php $this->load->view("_partials/meta") ?>
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
                    <h1 class="h3 mb-2 text-gray-800">Tambah Hibah</h1>

                    <!-- DataTables -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <?= form_open_multipart('admin/tambahhibah'); ?>
                            <div class="form-group row">
                                <label for="hibah-nama" class="col-sm-2 col-form-label col-form-label-lg"><b>Nama :</b></label>
                                <div class="col-sm-10 pt-1">
                                    <?= form_input(array(
                                        'id'            => 'hibah-nama',
                                        'class'         => 'form-control ',
                                        'type'          => 'text',
                                        'name'          => 'hibahNama',
                                        'value'         => set_value('hibahNama'),
                                        'placeholder'   => 'Nama Hibah',
                                        'onchange'      => "hideError('hibah-nama-error')"
                                    )); ?>
                                    <?= form_error('hibahNama', '<small id="hibah-nama-error" class="text-danger pl-3">', '</small>');  ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="hibah-kategori" class="col-sm-2 col-form-label col-form-label-lg"><b>Kategori :</b></label>
                                <div class="col-sm-10 pt-1">
                                    <select class="custom-select form-control" id="hibah-kategori" name="hibahKategori">
                                        <?php foreach ($kategori as $kategori) : ?>
                                            <option value="<?= $kategori['id']; ?>"><?= $kategori['nama']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('hibahKategori', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="hibah-file" class="col-sm-2 col-form-label col-form-label-lg"><b>File Format :</b></label>
                                <div class="col-sm-10 pt-1">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="hibahFile" name="hibahFile" accept=".doc, .docx" onchange="validateFileType(); changeText('fileLabel',this.value); hideError('hibahFile');">
                                            <label class="custom-file-label" for="hibahFile" id="fileLabel" style="color: #999;">Pilih file</label>
                                        </div>
                                    <?= form_error('hibahFile', '<small id="hibahFile" class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="hibah-status" class="col-sm-2 col-form-label col-form-label-lg"><b>Status :</b></label>
                                <div class="col-sm-10 pt-1">
                                    <select class="custom-select form-control" id="hibah-status" name="hibahStatus">
                                            <option value="aktif">aktif</option>
                                            <option value="pasif">pasif</option>
                                    </select>
                                    <?= form_error('hibahStatus', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <?= form_submit(array(
                                    'class' => 'btn btn-primary btn-block',
                                    'value' => 'Tambah Hibah'
                                )); ?>
                            </div>
                            <?= form_close(); ?>
                            <div class="text-center mt-3">
                                <a class="small" href="<?= base_url('admin/kelolahibah'); ?>">&larr; Kembali &nbsp;&nbsp;</a>
                            </div>
                        </div>
                    </div>

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

    <!-- Custom Script -->
    <script>
        function hideError(error) {
            document.getElementById(error).style.display = "none";
        }

        function changeText(id, value) {
            document.getElementById(id).innerHTML = value.split('\\').pop();
        }

        function validateFileType() {
            var fileName = document.getElementById("hibahFile").value;
            var idxDot = fileName.lastIndexOf(".") + 1;
            var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
            if (extFile == "doc" || extFile == "docx") {
                //accept file
            } else {
                alert("Hanya Dokumen Word yang diperbolehkan!");
                document.getElementById("hibahFile").value = null;
            }
        }
    </script>

</body>

</html>