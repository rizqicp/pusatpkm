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
                    <h1 class="h3 mb-2 text-gray-800">Tambah Periode</h1>

                    <!-- DataTables -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <?= form_open('admin/tambahperiode'); ?>
                            <div class="form-group row">
                                <label for="periode-tahun" class="col-sm-2 col-form-label col-form-label-lg"><b>Tahun :</b></label>
                                <div class="col-sm-10 pt-1">
                                    <?= form_input(array(
                                        'id'            => 'periode-tahun',
                                        'class'         => 'form-control ',
                                        'type'          => 'number',
                                        'name'          => 'periodeTahun',
                                        'value'         => set_value('periodeTahun'),
                                        'placeholder'   => 'Tahun Periode',
                                        'onchange'      => "hideError('periode-tahun-error')"
                                    )); ?>
                                    <?= form_error('periodeTahun', '<small id="periode-tahun-error" class="text-danger pl-3">', '</small>');  ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="periode-status" class="col-sm-2 col-form-label col-form-label-lg"><b>Status :</b></label>
                                <div class="col-sm-10 pt-1">
                                    <select class="custom-select form-control" id="periode-status" name="periodeStatus">
                                            <option value="pasif">pasif</option>
                                            <option value="aktif">aktif</option>
                                    </select>
                                    <?= form_error('periodeStatus', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <?= form_submit(array(
                                    'class' => 'btn btn-primary btn-block',
                                    'value' => 'Tambah Periode'
                                )); ?>
                            </div>
                            <?= form_close(); ?>
                            <div class="text-center mt-3">
                                <a class="small" href="<?= base_url('admin/kelolaperiode'); ?>">&larr; Kembali &nbsp;&nbsp;</a>
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
    </script>

</body>

</html>