<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Core Meta Data -->
    <?php $this->load->view("_partials/meta.php") ?>

    <!-- Custom styles for this template -->
    <link href="<?= base_url('assets/'); ?>css/blog-home.css" rel="stylesheet" type="text/css">

</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" style="font-size: 1.5rem;" href="<?= base_url('home'); ?>"><i class="fas fa-user-graduate"></i> Pusat<span>PKM</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link mr-3 mt-1" href="<?= base_url('home'); ?>">Beranda
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item mr-3 mt-1">
                        <a class="nav-link" href="#">Panduan</a>
                    </li>
                    <li class="nav-item mr-3 mt-1">
                        <a class="nav-link" href="#">Profil</a>
                    </li>
                    <li class="nav-item mt-1">
                        <a class="nav-link btn btn-outline-secondary" href="<?= base_url('auth/login'); ?>">Masuk</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="my-4">Pengumuman</h1>
                <?php if ($pengumuman != null) : ?>
                    <?php foreach ($pengumuman as $pengumuman) : ?>
                        <!-- Blog Post -->
                        <div class="card bg-light mb-4">
                            <!-- <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap"> -->
                            <?php if ($pengumuman['gambar']) : ?>
                                <img class="card-img-top" src="<?= base_url('assets/'); ?>img/pengumuman/<?= $pengumuman['gambar']; ?>" alt="Gambar Pengumuman">
                            <?php endif; ?>
                            <div class="card-body">
                                <h2 class="card-title"><?= $pengumuman['judul']; ?></h2>
                                <p class="card-text"><?= $pengumuman['isi']; ?></p>
                                <a href="#" class="btn btn-primary">Lebih Banyak &rarr;</a>
                            </div>
                            <div class="card-footer text-muted">
                                Ditulis <?= date("d-F-Y", strtotime($pengumuman['waktu'])); ?> oleh Admin
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>Data tidak ditemukan.</p>
                <?php endif; ?>


                <!-- Pagination -->
                <ul class="pagination justify-content-center mb-4">
                    <?php $activePage = is_numeric(isset($_GET['page'])) ? $_GET['page'] : 1; ?>
                    <?php
                    if ($activePage < $page['count']) {
                        $older = "";
                    } else {
                        $older = "disabled";
                    }
                    ?>
                    <li class="page-item <?= $older; ?>">
                        <a class="page-link" href="?page=<?= $activePage + 1; ?>">&larr; Terdahulu</a>
                    </li>
                    <?php
                    if ($activePage > 1) {
                        $earlier = "";
                    } else {
                        $earlier = "disabled";
                    }
                    ?>
                    <li class="page-item <?= $earlier; ?>">
                        <a class="page-link" href="?page=<?= $activePage - 1; ?>">Terbaru &rarr;</a>
                    </li>
                </ul>

            </div>

            <!-- Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Search Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Cari Pengumuman</h5>
                    <div class="card-body">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Kata kunci...">
                            <span class="input-group-append">
                                <button class="btn btn-secondary" type="button">Go!</button>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Categories Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Categories</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <a href="#">Web Design</a>
                                    </li>
                                    <li>
                                        <a href="#">HTML</a>
                                    </li>
                                    <li>
                                        <a href="#">Freebies</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <a href="#">JavaScript</a>
                                    </li>
                                    <li>
                                        <a href="#">CSS</a>
                                    </li>
                                    <li>
                                        <a href="#">Tutorials</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Side Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Side Widget</h5>
                    <div class="card-body">
                        You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
                    </div>
                </div>

            </div>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2020</p>
        </div>
        <!-- /.container -->
    </footer>

    <!-- Core Script Data -->
    <?php $this->load->view("_partials/script.php") ?>
</body>

</html>