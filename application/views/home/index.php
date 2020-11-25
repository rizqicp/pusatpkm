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

                <h1 class="my-4">Pengumuman</h1>
                <?php if ($pengumuman != null) : ?>
                    <?php foreach ($pengumuman as $pengumuman) : ?>
                        <!-- Blog Post -->
                        <div class="card bg-light mb-4">
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
                    <?php
                    if ($page['activePage'] < $page['count']) {
                        $older = "";
                    } else {
                        $older = "disabled";
                    }
                    ?>
                    <li class="page-item <?= $older; ?>">
                        <a class="page-link" href="?page=<?= $page['activePage'] + 1; ?>">&larr; Terdahulu</a>
                    </li>
                    <?php
                    if ($page['activePage'] > 1) {
                        $earlier = "";
                    } else {
                        $earlier = "disabled";
                    }
                    ?>
                    <li class="page-item <?= $earlier; ?>">
                        <a class="page-link" href="?page=<?= $page['activePage'] - 1; ?>">Terbaru &rarr;</a>
                    </li>
                </ul>

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