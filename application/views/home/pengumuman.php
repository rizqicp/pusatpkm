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
            <div class="col-md-12">

                <h1 class="my-4">Pengumuman</h1>
                <!-- Blog Post -->
                <div class="card bg-light mb-4">
                    <?php if ($pengumuman['gambar']) : ?>
                        <img class="card-img-top" src="<?= base_url('assets/'); ?>img/pengumuman/<?= $pengumuman['gambar']; ?>" alt="Gambar Pengumuman">
                    <?php endif; ?>
                    <div class="card-body">
                        <h2 class="card-title"><?= $pengumuman['judul']; ?></h2>
                        <p class="card-text"><?= $pengumuman['isi']; ?></p>
                    </div>
                    <div class="card-footer text-muted">
                        Ditulis <?= date("d-F-Y", strtotime($pengumuman['waktu'])); ?> oleh Admin
                    </div>
                    <a href="<?= base_url('home/index') ?>" class="btn btn-primary mt-2">&larr; Kembali</a>
                </div>

            </div>

            <!-- Sidebar Widgets Column -->

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