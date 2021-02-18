<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Core Meta Data -->
    <?php $this->load->view("_partials/meta") ?>
    <!-- Custom styles for sb-admin -->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php $this->load->view("_partials/sidebar") ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php $this->load->view("_partials/topbar") ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Detail Pengajuan</h1>
                    <?= $this->session->flashdata('message'); ?>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="card bg-light mb-4">
                                <div class="card-body">
                                    <h2 class="card-title"><b><?= $pengajuan['judul']; ?></b></h2>
                                    <small><b>Abstraksi :</b></small>
                                    <p class="card-text"><?= $pengajuan['abstraksi']; ?></p>
                                    <small><b>Dana ajuan :</b></small>
                                    <p>Rp <?= number_format($pengajuan['dana'], 0, ',', '.'); ?></p>
                                    <small><b>Hibah :</b></small>
                                    <p><?= $keterangan['hibah']['nama']; ?></p>
                                    <small><b>Periode :</b></small>
                                    <p><?= $keterangan['periode']['tahun']; ?></p>
                                </div>
                                <div class="card-footer text-muted">
                                    <a class="btn btn-primary btn-block text-left mt-2" href="<?= base_url('uploads/pengajuan/') . $pengajuan['file']; ?>" download><i class=" fas fa-fw fa-file-alt"></i> File Proposal</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
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
                                            <p class="d-flex justify-content-between">
                                                <b><?= $keterangan['tahap']['nama']; ?> </b>
                                                <?php if (count($pengulas) == 1) : ?>
                                                    <a class="btn btn-primary btn-sm" href="<?= base_url('admin/tugaskanpengajuan') . '?id=' . $pengajuan['id']; ?>">Tambah pengulas</a>
                                                <?php else : ?>
                                                    <a class="btn btn-secondary btn-sm" href="<?= base_url('admin/tugaskanpengajuan') . '?id=' . $pengajuan['id']; ?>">Ganti pengulas</a>
                                                <?php endif; ?>
                                            </p>
                                            <?php foreach ($pengulas as $dsn) : ?>
                                                <div class="card card-body <?= $dsn['tahap_id'] <= 3 ? 'bg-white' : 'bg-light' ?> ">
                                                    <small><b>Oleh :</b></small>
                                                    <p><?= $dsn['nama']; ?> (<?= $dsn['nidn']; ?>)</p>
                                                    <small><b>Usulan :</b></small>
                                                    <p>
                                                        <?php switch ($dsn['tahap_id']):
                                                                    case '2': ?>
                                                                <span class="badge badge-secondary">Sedang diulas</span>
                                                                <?php break; ?>
                                                            <?php
                                                                    case '3': ?>
                                                                <span class="badge badge-warning">Permintaan revisi</span>
                                                                <?php break; ?>
                                                            <?php
                                                                    case '4': ?>
                                                                <span class="badge badge-danger">Permintaan ditolak</span>
                                                                <?php break; ?>
                                                            <?php
                                                                    case '5': ?>
                                                                <span class="badge badge-success">Permintaan diterima</span>
                                                                <?php break; ?>
                                                            <?php endswitch; ?>
                                                    </p>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="card-footer text-muted">
                                            <form action="<?= base_url('admin/ubahstatuspengajuan'); ?>" method="post">
                                                <p>
                                                    Setelah pengulas mengirim usulan hasil ulasan, silahkan merubah status pengajuan ke tahap sesuai usulan.
                                                </p>
                                                <div class="input-group">
                                                    <select class="custom-select form-control" id="statusPengajuan" name="statusPengajuan">
                                                        <option value="3">Permintaan Revisi</option>
                                                        <option value="4">Pengajuan Ditolak</option>
                                                        <option value="5">Pengajuan Diterima</option>
                                                    </select>
                                                </div>
                                                <input type="text" name="idPengajuan" id="idPengajuan" value="<?= $pengajuan["id"]; ?>" hidden>
                                                <button type="submit" class="btn btn-primary btn-block text-left mt-2">Ubah status pengajuan</button>
                                            </form>
                                        </div>
                                        <?php break; ?>
                                    <?php
                                    case '3': ?>
                                        <div class="card-body">
                                            <p class="d-flex justify-content-between">
                                                <b><?= $keterangan['tahap']['nama']; ?> </b>
                                            </p>
                                            <?php foreach ($pengulas as $dsn) : ?>
                                                <div class="card card-body bg-light">
                                                    <small><b>Oleh :</b></small>
                                                    <p><?= $dsn['nama']; ?> (<?= $dsn['nidn']; ?>)</p>
                                                    <small><b>Usulan :</b></small>
                                                    <p>
                                                        <?php switch ($dsn['tahap_id']):
                                                                    case '2': ?>
                                                                <span class="badge badge-secondary">Sedang diulas</span>
                                                                <?php break; ?>
                                                            <?php
                                                                    case '3': ?>
                                                                <span class="badge badge-warning">Permintaan revisi</span>
                                                                <?php break; ?>
                                                            <?php
                                                                    case '4': ?>
                                                                <span class="badge badge-danger">Permintaan ditolak</span>
                                                                <?php break; ?>
                                                            <?php
                                                                    case '5': ?>
                                                                <span class="badge badge-success">Permintaan diterima</span>
                                                                <?php break; ?>
                                                            <?php endswitch; ?>
                                                    </p>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="card-footer text-muted">
                                            <form action="<?= base_url('admin/ubahstatuspengajuan'); ?>" method="post">
                                                <p>
                                                    Setelah pengulas mengirim usulan hasil ulasan, silahkan merubah status pengajuan ke tahap sesuai usulan.
                                                </p>
                                                <div class="input-group">
                                                    <select class="custom-select form-control" id="statusPengajuan" name="statusPengajuan" disabled>
                                                        <option value="3">Permintaan Revisi</option>
                                                        <option value="4">Pengajuan Ditolak</option>
                                                        <option value="5">Pengajuan Diterima</option>
                                                    </select>
                                                </div>
                                                <input type="text" name="idPengajuan" id="idPengajuan" value="<?= $pengajuan["id"]; ?>" hidden>
                                                <button type="submit" class="btn btn-secondary btn-block text-left mt-2" disabled>Menunggu Revisi</button>
                                            </form>
                                        </div>
                                        <?php break; ?>
                                    <?php
                                    case '4': ?>
                                        <div class="card-body">
                                            <p class="d-flex justify-content-between">
                                                <b><?= $keterangan['tahap']['nama']; ?> </b>
                                            </p>
                                            <?php foreach ($pengulas as $dsn) : ?>
                                                <div class="card card-body bg-light">
                                                    <small><b>Oleh :</b></small>
                                                    <p><?= $dsn['nama']; ?> (<?= $dsn['nidn']; ?>)</p>
                                                    <small><b>Usulan :</b></small>
                                                    <p>
                                                        <?php switch ($dsn['tahap_id']):
                                                                    case '2': ?>
                                                                <span class="badge badge-secondary">Sedang diulas</span>
                                                                <?php break; ?>
                                                            <?php
                                                                    case '3': ?>
                                                                <span class="badge badge-warning">Permintaan revisi</span>
                                                                <?php break; ?>
                                                            <?php
                                                                    case '4': ?>
                                                                <span class="badge badge-danger">Permintaan ditolak</span>
                                                                <?php break; ?>
                                                            <?php
                                                                    case '5': ?>
                                                                <span class="badge badge-success">Permintaan diterima</span>
                                                                <?php break; ?>
                                                            <?php endswitch; ?>
                                                    </p>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="card-footer text-muted">
                                            <p>
                                                Pengajuan ditolak, silahkan hapus pengajuan.
                                            </p>
                                            <button type="button" class="btn btn-danger btn-block text-left mt-2" href="#" data-toggle="modal" data-target="#hapusPengajuanModal<?= $pengajuan['id']; ?>">Hapus</button>
                                            <?php $hapusPengajuan = [
                                                    'pengajuan_id' => $pengajuan['id'],
                                                    'pengajuan_judul' => $pengajuan['judul'],
                                                    'pengajuan_file' => $pengajuan['file'],
                                                ] ?>
                                            <!-- hapusPengajuan Modal -->
                                            <?php $this->load->view("user/admin/_hapusPengajuanModal", $hapusPengajuan) ?>
                                        </div>
                                        <?php break; ?>
                                    <?php
                                    case '5': ?>
                                        <form action="<?= base_url('admin/detailpengajuan'); ?>" method="post">
                                            <div class="card-body">
                                                <p><b><?= $keterangan['tahap']['nama']; ?></b></p>
                                                <p>Setelah pengajuan diterima, silahkan kirimkan informasi akun simbelmawa.</p>
                                                <p>( isikan nilai apa saja apabila tidak ada akun )</p>
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
                                                <a class="btn btn-info btn-block text-left mt-2" href="<?= base_url('uploads/laporan/') . $pengajuan['file_laporan']; ?>" download><i class=" fas fa-fw fa-file-alt"></i> Laporan Akhir</a>
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
            <?php $this->load->view("_partials/footer") ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <?php $this->load->view("_partials/scrollTop") ?>
    <!-- Logout Modal-->
    <?php $this->load->view("_partials/logoutModal") ?>

    <!-- Core Script Data -->
    <?php $this->load->view("_partials/script") ?>
    <!-- Custom scripts for sb-admin -->
    <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

</body>

</html>