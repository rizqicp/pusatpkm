<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Core Meta Data -->
    <?php $this->load->view("partial/_meta.php") ?>
    <!-- Custom styles for sb-admin -->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php $this->load->view("user/_sidebar.php") ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php $this->load->view("user/_topbar.php") ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Detail Pengajuan</h1>
                    <?= $this->session->flashdata('message'); ?>
                    <div class="row">

                        <div class="col-md-8">
                            <div class="card bg-light mb-4">
                                <div class="card-body">
                                    <h2 class="card-title"><b><?= $pengajuan['judul']; ?></b></h2>
                                    <small><b>Abstraksi :</b></small>
                                    <p class="card-text"><?= $pengajuan['abstraksi']; ?></p>
                                    <small><b>Dana ajuan :</b></small>
                                    <p>Rp <?= number_format($pengajuan['dana'], 0, ',', '.'); ?></p>
                                    <small><b>Kategori :</b></small>
                                    <p><?= $keterangan['kategori']['nama']; ?></p>
                                    <small><b>Periode :</b></small>
                                    <p><?= $keterangan['periode']['tahun']; ?></p>
                                </div>
                                <div class="card-footer text-muted">
                                    <a class="btn btn-primary btn-block text-left mt-2" href="<?= base_url('upload/pengajuan/') . $pengajuan['file']; ?>"><i class=" fas fa-fw fa-file-alt"></i> File Proposal</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card bg-light mb-4">
                                <h5 class="card-header"><b>Anggota Kelompok</b></h5>
                                <div class="card-body">
                                    <small><b>Pembimbing :</b></small>
                                    <p><?= $kelompok['dosen']['nama']; ?> (<?= $kelompok['dosen']['nidn']; ?>)</p>
                                    <small><b>Anggota :</b></small>
                                    <?php foreach ($kelompok['mahasiswa'] as $mahasiswa) : ?>
                                        <p><?= $mahasiswa['nama']; ?> (<?= $mahasiswa['npm']; ?>)</p>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="card bg-light mb-4">
                                <h5 class="card-header"><b>Status Pengajuan</b></h5>
                                <?php switch ($pengajuan['tahap_id']):
                                    case '1': ?>
                                        <div class="card-body">
                                            <p><b><?= $keterangan['tahap']['nama']; ?></b></p>
                                        </div>
                                        <div class="card-footer text-muted">
                                            <a class="btn btn-primary btn-block text-left mt-2" href="<?= base_url('admin/tugaskanpengajuan') . '?id=' . $pengajuan['id']; ?>">Tugaskan</a>
                                        </div>
                                        <?php break; ?>
                                    <?php
                                    case '2': ?>
                                        <div class="card-body">
                                            <p><b><?= $keterangan['tahap']['nama']; ?></b></p>
                                            <small><b>Oleh :</b></small>
                                            <p><?= $pengulas['nama']; ?> (<?= $pengulas['nidn']; ?>)</p>
                                        </div>
                                        <div class="card-footer text-muted">
                                            <a class="btn btn-primary btn-block text-left mt-2" href="<?= base_url('admin/tugaskanpengajuan') . '?id=' . $pengajuan['id']; ?>">Ganti pengulas</a>
                                        </div>
                                        <?php break; ?>
                                    <?php
                                    case '3': ?>
                                        <div class="card-body">
                                            <p><b><?= $keterangan['tahap']['nama']; ?></b></p>
                                            <small><b>Oleh :</b></small>
                                            <p><?= $pengulas['nama']; ?> (<?= $pengulas['nidn']; ?>)</p>
                                        </div>
                                        <div class="card-footer text-muted">
                                            <a class="btn btn-primary btn-block text-left mt-2" href="<?= base_url('admin/tugaskanpengajuan') . '?id=' . $pengajuan['id']; ?>">Ganti pengulas</a>
                                        </div>
                                        <?php break; ?>
                                    <?php
                                    case '4': ?>
                                        <div class="card-body">
                                            <p><b><?= $keterangan['tahap']['nama']; ?></b></p>
                                            <small><b>Oleh :</b></small>
                                            <p><?= $pengulas['nama']; ?> (<?= $pengulas['nidn']; ?>)</p>
                                        </div>
                                        <div class="card-footer text-muted">
                                            <button type="button" class="btn btn-danger btn-sm mb-1" href="#" data-toggle="modal" data-target="#hapusPengajuanModal<?= $pengajuan['id']; ?>">Hapus</button>
                                            <?php $hapusPengajuan = [
                                                'pengajuan_id' => $pengajuan['id'],
                                                'pengajuan_judul' => $pengajuan['judul'],
                                                'pengajuan_file' => $pengajuan['file'],
                                            ] ?>
                                            <!-- hapusPengajuan Modal -->
                                            <?php $this->load->view("user/admin/_hapusPengajuanModal.php", $hapusPengajuan) ?>
                                        </div>
                                        <?php break; ?>
                                    <?php
                                    case '5': ?>
                                        <form action="<?= base_url('admin/detailpengajuan'); ?>" method="post">
                                            <div class="card-body">
                                                <p><b><?= $keterangan['tahap']['nama']; ?></b></p>
                                                <small><b>Oleh :</b></small>
                                                <p><?= $pengulas['nama']; ?> (<?= $pengulas['nidn']; ?>)</p>
                                                <div>
                                                    <label for="username" class="col-form-label col-form-label-lg"><small><b>Username Simbelmawa</b></small></label>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" id="username" name="username" value="<?= $pengajuan['belmawa_username']; ?>" class="form-control">
                                                    </div>
                                                    <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                                <div>
                                                    <label for="password" class="col-form-label col-form-label-lg"><small><b>Password Simbelmawa</b></small></label>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" id="password" name="password" value="<?= $pengajuan['belmawa_password']; ?>" class="form-control">
                                                    </div>
                                                    <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                            </div>
                                            <div class="card-footer text-muted">
                                                <?php if ($pengajuan['belmawa_username'] != null && $pengajuan['belmawa_password'] != null) : ?>
                                                    <button type="submit" class="btn btn-primary btn-block text-left mt-2" href="#">Perbarui Akun Simbelmawa</button>
                                                <?php else : ?>
                                                    <button type="submit" class="btn btn-primary btn-block text-left mt-2" href="#">Kirim Akun Simbelmawa</button>
                                                <?php endif; ?>
                                            </div>
                                        </form>
                                        <?php break; ?>
                                    <?php
                                    case '6': ?>
                                        <div class="card-body">
                                            <p><b><?= $keterangan['tahap']['nama']; ?></b></p>
                                            <?php if ($pengajuan['file_laporan'] != null) : ?>
                                                <a class="btn btn-info btn-block text-left mt-2" href="<?= base_url('upload/laporan/') . $pengajuan['file_laporan']; ?>"><i class=" fas fa-fw fa-file-alt"></i> Laporan Akhir</a>
                                            <?php endif; ?>
                                        </div>
                                        <?php break; ?>
                                <?php endswitch; ?>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php $this->load->view("user/_footer.php") ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <?php $this->load->view("user/_scrollTop.php") ?>
    <!-- Logout Modal-->
    <?php $this->load->view("user/_logoutModal.php") ?>

    <!-- Core Script Data -->
    <?php $this->load->view("partial/_script.php") ?>
    <!-- Custom scripts for sb-admin -->
    <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

</body>

</html>