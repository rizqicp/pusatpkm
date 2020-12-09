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

                <h1 class="my-4">Pengajuan Saya</h1>
                <!-- Blog Post -->
                <div class="card bg-light mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="align-middle">No</th>
                                        <th class="align-middle">Judul</th>
                                        <th class="align-middle">Pembimbing</th>
                                        <th class="align-middle">Periode</th>
                                        <th class="align-middle">Tahap</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($pengajuan == null) : ?>
                                        <?php $caption['firstData'] = 0; ?>
                                        <tr>
                                            <td class="align-middle text-center" colspan="6">Tidak ada data</td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php $i = 1; ?>
                                    <?php foreach ($pengajuan as $pengajuan) : ?>
                                        <tr>
                                            <th class="align-middle"><?= $i; ?></th>
                                            <td class="align-middle"><?= $pengajuan['pengajuan_judul']; ?></td>
                                            <td class="align-middle"><?= $pengajuan['dosen_nama']; ?></td>
                                            <td class="align-middle"><?= $pengajuan['periode_tahun']; ?></td>
                                            <td class="align-middle">
                                                <?php switch ($pengajuan['tahap_id']):
                                                    case 1: ?>
                                                        <span class="badge badge-secondary"><?= $pengajuan['tahap_nama']; ?></span>
                                                    <?php break;
                                                    case 2: ?>
                                                        <span class="badge badge-primary"><?= $pengajuan['tahap_nama']; ?></span>
                                                    <?php break;
                                                    case 3: ?>
                                                        <span class="badge badge-warning"><?= $pengajuan['tahap_nama']; ?></span>
                                                    <?php break;
                                                    case 4: ?>
                                                        <span class="badge badge-danger"><?= $pengajuan['tahap_nama']; ?></span>
                                                    <?php break;
                                                    case 5: ?>
                                                        <?php if ($pengajuan['belmawa_username'] != null && $pengajuan['belmawa_password'] != null) : ?>
                                                            <span class="badge badge-success"><?= $pengajuan['tahap_nama']; ?></span>
                                                        <?php else : ?>
                                                            <span class="badge badge-info">Menunggu Akun</span>
                                                        <?php endif; ?>
                                                    <?php break;
                                                    case 6: ?>
                                                        <span><?= $pengajuan['tahap_nama']; ?></span>
                                                        <?php break; ?>
                                                <?php endswitch; ?>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                                <caption class="mt-2"><small><?= $caption['firstData']; ?> - <?= $caption['lastData']; ?> dari <?= $caption['totalData']; ?> Pengajuan</small></caption>
                            </table>
                        </div>
                        <?= $this->pagination->create_links(); ?>
                    </div>
                    <div class="card-footer text-muted">
                        NPM Pengusul : <?= $this->session->userdata('npm'); ?>
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