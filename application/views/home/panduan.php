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

                <h1 class="my-4">Panduan</h1>
                <!-- isi -->
                <?php foreach ($panduan as $panduan) : ?>
                    <div class="card bg-light mb-4">
                        <div class="card-header">
                            <h5 class="card-title"><?= $panduan['nama']; ?> (<?= $panduan['kependekan']; ?>)</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <?php foreach($panduan['hibah'] AS $hibah): ?>
                                <li class="list-group-item"><a class="badge badge-light" href="<?= base_url('uploads/format/' . $hibah['file']); ?>"><i class=" fas fa-fw fa-file-alt"></i></a><?= ' '.$hibah['nama']; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                <?php endforeach; ?>

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