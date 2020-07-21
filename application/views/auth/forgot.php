<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("templates/meta.php") ?>
    <title>Lupa Kata Sandi</title>
</head>

<body class="bg-gradient-primary">

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
                                        <h1 class="h4 text-gray-900 mb-2">Lupa Kata Sandi?</h1>
                                        <p class="mb-4">Masukkan alamat Emailmu di bawah dan kami akan kirim sebuah link untuk mengatur ulang kata sandi!</p>
                                    </div>
                                    <form class="user" action="<?= base_url('auth/forgot'); ?>" method="POST">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="user_email" name="user_email" placeholder="Alamat Email">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <?php $this->load->view("templates/script.php") ?>

</body>

</html>