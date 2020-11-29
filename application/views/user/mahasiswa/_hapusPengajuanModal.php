<div class="modal fade" id="hapusPengajuanModal<?= $pengajuan_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin ingin menghapus pengajuan?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Anda akan menghapus pengajuan:<br>"<?= $pengajuan_judul; ?>"?</div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" data-dismiss="modal">Batal</button>
                <form action="<?= base_url('mahasiswa/hapuspengajuan') ?>" method="POST">
                    <input type="text" name="hapusid" value="<?= $pengajuan_id; ?>" style="display: none;">
                    <input type="text" name="hapusjudul" value="<?= $pengajuan_judul; ?>" style="display: none;">
                    <input type="text" name="hapusfile" value="<?= $pengajuan_file; ?>" style="display: none;">
                    <button type="submit" class="btn btn-danger" href="">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>