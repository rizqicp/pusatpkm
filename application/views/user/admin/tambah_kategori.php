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
                    <h1 class="h3 mb-2 text-gray-800">Tambah Kategori</h1>

                    <!-- DataTables -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <?= form_open('admin/tambahkategori'); ?>
                            <div class="form-group row">
                                <label for="kategori-nama" class="col-sm-2 col-form-label col-form-label-lg"><b>Nama :</b></label>
                                <div class="col-sm-10 pt-1">
                                    <?= form_input(array(
                                        'id'            => 'kategori-nama',
                                        'class'         => 'form-control ',
                                        'type'          => 'text',
                                        'name'          => 'kategoriNama',
                                        'value'         => set_value('kategoriNama'),
                                        'placeholder'   => 'Nama Kategori',
                                        'onchange'      => "hideError('kategori-nama-error')"
                                    )); ?>
                                    <?= form_error('kategoriNama', '<small id="kategori-nama-error" class="text-danger pl-3">', '</small>');  ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kategori-kependekan" class="col-sm-2 col-form-label col-form-label-lg"><b>Kependekan :</b></label>
                                <div class="col-sm-10 pt-1">
                                    <?= form_input(array(
                                        'id'            => 'kategori-kependekan',
                                        'class'         => 'form-control',
                                        'type'          => 'text',
                                        'name'          => 'kategoriKependekan',
                                        'value'         => set_value('kategoriKependekan'),
                                        'placeholder'   => 'Kependekan Kategori',
                                        'onchange'      => "hideError('kategori-kependekan-error')"
                                    )); ?>
                                    <?= form_error('kategoriKependekan', '<small id="kategori-kependekan-error" class="text-danger pl-3">', '</small>');  ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <?= form_submit(array(
                                    'class' => 'btn btn-primary btn-block',
                                    'value' => 'Tambah Kategori'
                                )); ?>
                            </div>
                            <?= form_close(); ?>
                            <div class="text-center mt-3">
                                <a class="small" href="<?= base_url('admin/kelolakategori'); ?>">&larr; Kembali &nbsp;&nbsp;</a>
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