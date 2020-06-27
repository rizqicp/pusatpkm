<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("templates/header.php") ?>
</head>

<body>

    <h1>Home Page</h1>
    <a href="<?= base_url('auth/login'); ?>">Login</a>
    <a href="<?= base_url('auth/register'); ?>">Register</a>

    <?php $this->load->view("templates/footer.php") ?>

</body>

</html>