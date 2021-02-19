<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Core Meta Data -->
    <?php $this->load->view("_partials/meta") ?>
    <!-- Custom styles for sb-admin -->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-dark">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-md-7">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Halaman Masuk</h1>
                                    </div>
                                    <?= $this->session->flashdata('message'); ?>
                                    <form class="user" action="<?= base_url('auth/login'); ?>" method="POST">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="userEmail" name="userEmail" value="<?= set_value('userEmail'); ?>" placeholder="Alamat Email" onchange="hideError('userEmailError');">
                                            <?= form_error('userEmail', '<small id="userEmailError" class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="userPassword" name="userPassword" placeholder="Kata Sandi" onchange="hideError('userPasswordError');">
                                            <?= form_error('userPassword', '<small id="userPasswordError" class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Masuk</button>
                                    </form>
                                    <div class="text-center mt-2 small">atau</div>
                                    <div class="text-center mt-2">
                                        <button id="scanbarcode" type="button" class="btn btn-outline-dark btn-lg" href="#" data-toggle="modal" data-target="#barcodeModal"><i class="fas fa-barcode fa-3x"></i></button>
                                    </div>
                                    <?= form_error('userBarcode', '<div class="text-center mt-2 text-danger pl-3 small">', '</div>'); ?>
                                    <hr>
                                    <!-- <div class="text-center">
                                        <a class="small" href="<?= base_url('auth/forgot'); ?>">Lupa Kata Sandi?</a>
                                    </div> -->
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('auth/register'); ?>">Belum Punya Akun? Daftar!</a>
                                    </div>
                                    <div class="text-center mt-2">
                                        <a class="small" href="<?= base_url('home/index'); ?>">&larr; Beranda</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <script>
        function hideError(error) {
            document.getElementById(error).style.display = "none";
        }
    </script>

    <!-- Barcode Modal -->
    <?php $this->load->view("auth/_barcodeModal") ?>
    <!-- Include the QuaggaJS library -->
    <script src="<?= base_url('assets/'); ?>quaggajs/dist/quagga.min.js"></script>
    <script src="<?= base_url('assets/'); ?>quaggajs/barcodeScanner.js"></script>

    <!-- Core Script Data -->
    <?php $this->load->view("_partials/script") ?>
    <!-- Custom scripts for sb-admin -->
    <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

</body>

</html>