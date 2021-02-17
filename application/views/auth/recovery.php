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
                                        <h1 class="h4 text-gray-900 mb-2">Atur Ulang Kata Sandi</h1>
                                        <p class="mb-4">Masukkan kata sandi baru untuk <b><?= $user['recoverEmail']; ?></b> !</p>
                                    </div>
                                    <?= $this->session->flashdata('message'); ?>
                                    <form class="user" action="<?= base_url('auth/recovery'); ?>" method="POST">
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="userPassword" name="userPassword" placeholder="Kata Sandi Baru" onchange="hideError('userPasswordError');">
                                            <?= form_error('userPassword', '<small id="userPasswordError" class="text-danger pl-4">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="repeatPassword" name="repeatPassword" placeholder="Ulangi Kata Sandi Baru" onchange="hideError('repeatPasswordError');">
                                            <?= form_error('repeatPassword', '<small id="repeatPasswordError" class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Atur Ulang Kata Sandi
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('auth/register'); ?>">Belum Punya Akun? Daftar!</a>
                                    </div>
                                    <div class="text-center mt-2">
                                        <a class="small" href="<?= base_url('auth/login'); ?>">Sudah Punya Akun? Masuk!</a>
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

    <!-- Core Script Data -->
    <?php $this->load->view("_partials/script") ?>
    <!-- Custom scripts for sb-admin -->
    <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

</body>

</html>