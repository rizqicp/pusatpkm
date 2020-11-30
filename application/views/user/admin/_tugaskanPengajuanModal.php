<div class="modal fade" id="tugaskanPengajuanModal<?= $dosen['nidn']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Anda akan menugaskan dosen?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Tugaskan <?= $dosen['nama']; ?> ? <br><br>
                Pengajuan yang Sedang Diulas tidak dapat dirubah.
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
                <form action="<?= base_url('admin/tugaskanpengajuan') ?>" method="POST">
                    <input type="text" name="dosen_nidn" value="<?= $dosen['nidn']; ?>" style="display: none;">
                    <input type="text" name="pengajuan_id" value="<?= $pengajuan['id']; ?>" style="display: none;">
                    <button type="submit" class="btn btn-primary" href="">Tugaskan</button>
                </form>
            </div>
        </div>
    </div>
</div>