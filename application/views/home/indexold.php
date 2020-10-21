<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("_partials/meta.php") ?>
</head>

<body>

    <h1>Halaman Home</h1>
    <a href="<?= base_url('auth/login'); ?>">Masuk</a>
    <a href="<?= base_url('auth/register'); ?>">Daftar Akun</a>

    <?php $this->load->view("_partials/script.php") ?>

</body>

</html>