<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Core Meta Data -->
    <?php $this->load->view("home/_partials/meta") ?>
</head>

<body>
    <!-- Navigation -->
    <?php $this->load->view("home/_partials/topbar") ?>

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
                                <img class="card-img-top" src="<?= base_url('uploads/'); ?>img/pengumuman/<?= $pengumuman['gambar']; ?>" alt="Gambar Pengumuman">
                            <?php endif; ?>
                            <div class="card-body">
                                <h2 class="card-title"><?= $pengumuman['judul']; ?></h2>
                                <div class="card-text">
                                    <?= htmlspecialchars_decode($pengumuman['isi']); ?>
                                </div>
                                <a href="<?= base_url('home/pengumuman') . '?id=' . $pengumuman['id']; ?>" class="btn btn-primary">Lebih Banyak &rarr;</a>
                            </div>
                            <div class="card-footer text-muted">
                                Ditulis <?= date("d-F-Y", strtotime($pengumuman['waktu'])); ?> oleh Admin
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <?php $caption['firstData'] = 0; ?>
                    <p>Data tidak ditemukan.</p>
                <?php endif; ?>
                <caption class="mt-2"><small><?= $caption['firstData']; ?> - <?= $caption['lastData']; ?> dari <?= $caption['totalData']; ?> Pengumuman</small></caption>
                <?= $this->pagination->create_links(); ?>
            </div>

            <!-- Sidebar Widgets Column -->
            <?php $this->load->view("home/_partials/sidebar", $kategori) ?>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <?php $this->load->view("home/_partials/footer") ?>

    <!-- Core Script Data -->
    <?php $this->load->view("_partials/script") ?>
</body>

</html>