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

                        <div class="col-md-7">
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

                        <div class="col-md-5">
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
                            <div class="card bg-light mb-">
                                <h5 class="card-header"><b>Status Pengajuan</b></h5>
                                <?php switch ($pengajuan['tahap_id']):
                                    case '1': ?>
                                        <div class="card-body">
                                            <p><b><?= $keterangan['tahap']['nama']; ?></b></p>
                                        </div>
                                        <div class="card-footer text-muted">
                                            <a class="btn btn-secondary btn-block text-left mt-2 disabled" href="#">Menunggu ditugaskan</a>
                                        </div>
                                        <?php break; ?>
                                    <?php
                                    case '2': ?>
                                        <?php if ($pengulas[0]['nidn'] == $user['nidn'] || $pengulas[1]['nidn'] == $user['nidn']) : ?>
                                            <?php if ($pengulas[array_search($user['nidn'], array_column($pengulas, 'nidn'))]['tahap_id'] == 2) : ?>
                                                <form action="<?= base_url('dosen/detailpengajuan'); ?>" method="post" enctype="multipart/form-data">
                                                    <div class="card-body">
                                                        <p><b>Hasil ulasan</b></p>
                                                        <div class="form-group row">
                                                            <div class="col-sm-12 pt-1">
                                                                <select class="custom-select form-control" id="tahap" name="tahap">
                                                                    <option value="" readonly <?= !set_value('tahap') ? "selected" : ""; ?> hidden>Usulan status</option>
                                                                    <?php for ($i = 2; $i < (count($tahap) - 1); $i++) : ?>
                                                                        <option value=<?= $tahap[$i]['id']; ?> <?= set_value('tahap') == $tahap[$i]['id'] ? "selected" : ""; ?>><?= $tahap[$i]['nama']; ?></option>
                                                                    <?php endfor; ?>
                                                                </select>
                                                                <?= form_error('tahap', '<small class="text-danger pl-3">', '</small>'); ?>
                                                            </div>
                                                        </div>
                                                        <label for="komentar" class="col-form-label col-form-label-lg"><small><b>Komentar</b> (opsional)</small></label>
                                                        <div class="form-group row">
                                                            <div class="col-sm-12 pt-1">
                                                                <textarea class="form-control" name="komentar" id="komentar" rows="3" onchange="hideError('komentarError');"><?= set_value('komentar'); ?></textarea>
                                                                <?= form_error('komentar', '<small id="komentarError" class="text-danger pl-3">', '</small>'); ?>
                                                            </div>
                                                        </div>
                                                        <label for="userFile" class="col-form-label col-form-label-lg"><small><b>File Ulasan</b> (opsional)</small></label>
                                                        <div class="form-group row">
                                                            <div class="input-group col-sm-12">
                                                                <div class="input-group">
                                                                    <div class="custom-file">
                                                                        <input type="file" class="custom-file-input" id="userFile" name="userFile" accept=".doc, .docx, .pdf" onchange="validateFileType(); changeText('fileLabel',this.value); hideError('userFile');">
                                                                        <label class="custom-file-label" for="userFile" id="fileLabel" style="color: #999;">Pilih file</label>
                                                                    </div>
                                                                </div>
                                                                <?= form_error('userFile', '<small id="userFile" class="text-danger pl-3">', '</small>'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer text-muted">
                                                        <button type="submit" class="btn btn-primary btn-block text-left mt-2" href="#">Kirim Ulasan</button>
                                                    </div>
                                                </form>
                                            <?php else : ?>
                                                <div class="card-body">
                                                    <p><b>Hasil ulasan</b></p>
                                                    <div class="form-group row">
                                                        <div class="col-sm-12 pt-1">
                                                            <?php switch ($pengulas[array_search($user['nidn'], array_column($pengulas, 'nidn'))]['tahap_id']):
                                                                            case '3': ?>
                                                                    <input class="custom-select form-control" value="Permintaan Revisi" disabled>
                                                                <?php break;
                                                                            case '4': ?>
                                                                    <input class="custom-select form-control" value="Pengajuan Ditolak" disabled>
                                                                <?php break;
                                                                            case '5': ?>
                                                                    <input class="custom-select form-control" value="Pengajuan Diterima" disabled>
                                                                <?php endswitch; ?>
                                                        </div>
                                                    </div>
                                                    <label for="komentar" class="col-form-label col-form-label-lg"><small><b>Komentar</b></small></label>
                                                    <div class="form-group row">
                                                        <div class="col-sm-12 pt-1">
                                                            <textarea class="form-control" name="komentar" id="komentar" rows="3" readonly><?= $pengulas[array_search($user['nidn'], array_column($pengulas, 'nidn'))]['komentar']; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <label for="userFile" class="col-form-label col-form-label-lg"><small><b>File Ulasan</b></small></label>
                                                    <?php if ($pengulas[array_search($user['nidn'], array_column($pengulas, 'nidn'))]['file'] != NULL) : ?>
                                                        <a class="btn btn-secondary btn-block text-left mt-2" href="<?= base_url('uploads/ulasan/') . $pengulas[array_search($user['nidn'], array_column($pengulas, 'nidn'))]['file']; ?>" download><i class=" fas fa-fw fa-file-alt"></i> File Ulasan</a>
                                                    <?php else : ?>
                                                        <p>Tidak ada file</p>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="card-footer text-muted">
                                                    <button type="submit" class="btn btn-secondary btn-block text-left mt-2" disabled>Ulasan telah dikirim</button>
                                                </div>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <div class="card-body">
                                                <p>
                                                    <b><?= $keterangan['tahap']['nama']; ?> </b>
                                                </p>
                                                <?php foreach ($pengulas as $dsn) : ?>
                                                    <div class="card card-body bg-light">
                                                        <small><b>Oleh :</b></small>
                                                        <p><?= $dsn['nama']; ?> (<?= $dsn['nidn']; ?>)</p>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                            <div class="card-footer text-muted">
                                                <a class="btn btn-secondary btn-block text-left mt-2 disabled" href="#">Menunggu Ulasan</a>
                                            </div>
                                        <?php endif; ?>
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
                                                    <small><b>Komentar :</b></small>
                                                    <?php if ($dsn['komentar'] != NULL) : ?>
                                                        <textarea class="form-control" rows="3" readonly><?= $dsn['komentar']; ?></textarea>
                                                    <?php else : ?>
                                                        <p>Tidak ada komentar</p>
                                                    <?php endif; ?>
                                                    <small><b>File :</b></small>
                                                    <?php if ($dsn['file'] != NULL) : ?>
                                                        <a class="btn btn-secondary btn-block text-left mt-2" href="<?= base_url('uploads/ulasan/') . $dsn['file']; ?>" download><i class=" fas fa-fw fa-file-alt"></i> File Ulasan</a>
                                                    <?php else : ?>
                                                        <p>Tidak ada file</p>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="card-footer text-muted">
                                                <a class="btn btn-secondary btn-block text-left mt-2 disabled" href="#">Menunggu Revisi</a>
                                            </div>
                                        <?php break; ?>
                                    <?php
                                    case '4': ?>
                                        <div class="card-body">
                                        <p class="d-flex justify-content-between">
                                                <b><?= $keterangan['tahap']['nama']; ?></b>
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
                                                    <small><b>Komentar :</b></small>
                                                    <?php if ($dsn['komentar'] != NULL) : ?>
                                                        <textarea class="form-control" rows="3" readonly><?= $dsn['komentar']; ?></textarea>
                                                    <?php else : ?>
                                                        <p>Tidak ada komentar</p>
                                                    <?php endif; ?>
                                                    <small><b>File :</b></small>
                                                    <?php if ($dsn['file'] != NULL) : ?>
                                                        <a class="btn btn-secondary btn-block text-left mt-2" href="<?= base_url('uploads/ulasan/') . $dsn['file']; ?>" download><i class=" fas fa-fw fa-file-alt"></i> File Ulasan</a>
                                                    <?php else : ?>
                                                        <p>Tidak ada file</p>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="card-footer text-muted">
                                            <a class="btn btn-danger btn-block text-left mt-2 disabled" href="#">Menunggu Pengajuan Dihapus</a>
                                        </div>
                                        <?php break; ?>
                                    <?php
                                    case '5': ?>
                                        <?php if ($pengajuan['belmawa_username'] != null && $pengajuan['belmawa_password'] != null) : ?>
                                            <div class="card-body">
                                                <p><b><?= $keterangan['tahap']['nama']; ?></b></p>
                                                <?php if ($user['nidn'] == $kelompok['dosen']['nidn']) : ?>
                                                    <label for="username" class="col-form-label col-form-label-lg"><small><b>Username Simbelmawa</b></small></label>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" id="username" value="<?= $pengajuan['belmawa_username']; ?>" class="form-control" readonly>
                                                    </div>
                                                    <label for="password" class="col-form-label col-form-label-lg"><small><b>Password Simbelmawa</b></small></label>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" id="password" value="<?= $pengajuan['belmawa_password']; ?>" class="form-control" readonly>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="card-footer text-muted">
                                                <a class="btn btn-secondary btn-block text-left mt-2 disabled" href="#">Menunggu Laporan Akhir</a>
                                            </div>
                                        <?php else : ?>
                                            <div class="card-body">
                                                <p><b><?= $keterangan['tahap']['nama']; ?></b></p>
                                            </div>
                                            <div class="card-footer text-muted">
                                                <a class="btn btn-secondary btn-block text-left mt-2 disabled" href="#">Menunggu Akun Simbelmawa</a>
                                            </div>
                                        <?php endif; ?>
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

    <script>
        function changeText(id, value) {
            document.getElementById(id).innerHTML = value.split('\\').pop();
        }

        function validateFileType() {
            var fileName = document.getElementById("userFile").value;
            var idxDot = fileName.lastIndexOf(".") + 1;
            var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
            if (extFile == "doc" || extFile == "docx" || extFile == "pdf") {
                //accept file
            } else {
                alert("Hanya Dokumen Word yang diperbolehkan!");
                document.getElementById("userFile").value = null;
            }
        }

        function hideError(error) {
            document.getElementById(error).style.display = "none";
        }
    </script>

    <!-- Core Script Data -->
    <?php $this->load->view("_partials/script") ?>
    <!-- Custom scripts for sb-admin -->
    <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

</body>

</html>