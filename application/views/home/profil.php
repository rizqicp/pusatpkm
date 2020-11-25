<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Core Meta Data -->
    <?php $this->load->view("partial/_meta.php") ?>
    <!-- Custom styles for blog-home -->
    <link href="<?= base_url('assets/'); ?>css/blog-home.css" rel="stylesheet" type="text/css">
</head>

<body>
    <!-- Navigation -->
    <?php $this->load->view("home/_topbar.php") ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="my-4">Profil</h1>
                <!-- isi -->
                <div class="card bg-light mb-4">
                    <img class="card-img-top" src="<?= base_url('assets/img/profile/profilPusatPKM.jpg'); ?>" alt="Gambar Profil">

                    <div class="card-body">
                        <h2 class="card-title">Tentang Pusat PKM</h2>
                        <p class="card-text">
                            Pusat PKM adalah lembaga yang mengelola proposal Program Kreativitas Mahasiswa di lingkungan Universitas Pembangunan Nasional “Veteran” Jawa Timur.
                            Setiap periodenya, banyak mahasiswa UPN “Veteran” Jatim yang ikut serta dalam Program Kreativitas Mahasiswa ini.
                            Untuk mengikuti PKM, mahasiswa diwajibkan untuk mengajukan proposal penelitian terlebih dahulu.
                            Proposal ini nantinya akan dikelola dan diseleksi terlebih dahulu oleh Pusat PKM
                        </p>
                    </div>
                </div>

            </div>

            <!-- Sidebar Widgets Column -->
            <?php $this->load->view("home/_sidebar.php") ?>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <?php $this->load->view("home/_footer.php") ?>

    <!-- Core Script Data -->
    <?php $this->load->view("partial/_script.php") ?>
</body>

</html>