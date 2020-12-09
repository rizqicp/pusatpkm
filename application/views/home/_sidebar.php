<!-- <div class="col-md-3" style="background-color: gray; opacity: 0.1;"> -->
<div class="col-md-4">

    <!-- Pengajuan Widget -->
    <div class="card my-4">
        <h5 class="card-header">Pengajuan</h5>
        <div class="card-body">
            <a class="btn btn-primary btn-block text-center mb-2" href="<?= base_url('mahasiswa/tambahpengajuan'); ?>"><b>BUAT PENGAJUAN</b></a>
            <button id="scanbarcode" type="button" class="btn btn-secondary btn-block text-center mt-2" href="#" data-toggle="modal" data-target="#barcodeModal"><i class="fas fa-fw fa-barcode"></i> <b>CEK PENGAJUAN SAYA</b></button>
            <!-- Barcode Modal -->
            <?php $this->load->view("home/_barcodeModal.php") ?>
            <!-- Include the QuaggaJS library -->
            <script src="<?= base_url('assets/'); ?>js/quagga/dist/quagga.min.js"></script>
            <script src="<?= base_url('assets/'); ?>js/barcodeScanner.js"></script>
        </div>
    </div>

    <!-- Search Widget -->
    <!-- <div class="card my-4">
        <h5 class="card-header">Cari Pengumuman</h5>
        <div class="card-body">
            <form action="<?= base_url('home/index'); ?>" method="POST">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Kata kunci..." autocomplete="off">
                    <span class="input-group-append">
                        <button class="btn btn-secondary" type="submit">Cari</button>
                    </span>
                </div>
            </form>
        </div>
    </div> -->

    <!-- Categories Widget -->
    <div class="card my-4">
        <h5 class="card-header">Format Proposal</h5>
        <div class="card-body">
            <ul class="list-unstyled mb-0">
                <li>
                    <a class="btn btn-light btn-block text-left mt-2" href="<?= base_url('upload/templates/Format-PKM-AI.docx'); ?>" download><i class=" fas fa-fw fa-file-alt"></i>PKM Artikel Ilmiah</a>
                </li>
                <li>
                    <a class="btn btn-light btn-block text-left mt-2" href="<?= base_url('upload/templates/Format-PKM-KC.docx'); ?>" download><i class=" fas fa-fw fa-file-alt"></i>PKM Karsa Cipta</a>
                </li>
                <li>
                    <a class="btn btn-light btn-block text-left mt-2" href="<?= base_url('upload/templates/Format-PKM-M.docx'); ?>" download><i class=" fas fa-fw fa-file-alt"></i>PKM Pengabdian Kepada Masyarakat</a>
                </li>
                <li>
                    <a class="btn btn-light btn-block text-left mt-2" href="<?= base_url('upload/templates/Format-PKM-P.docx'); ?>" download><i class=" fas fa-fw fa-file-alt"></i>PKM Penelitian</a>
                </li>
                <li>
                    <a class="btn btn-light btn-block text-left mt-2" href="<?= base_url('upload/templates/Format-PKM-T.docx'); ?>" download><i class=" fas fa-fw fa-file-alt"></i>PKM Penerapan Teknologi</a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Side Widget -->
    <div class="card my-4">
        <h5 class="card-header">Bantuan</h5>
        <div class="card-body">
            Hubungi Administrator apabila anda membutuhkan bantuan atau mengalami masalah pada sistem Pusat PKM.
            <a class="btn btn-primary btn-block text-center mt-2" href="mailto:1634010056@student.upnjatim.ac.id"><i class=" fas fa-fw fa-question"></i> Hubungi Administrator</a>
        </div>
    </div>

</div>