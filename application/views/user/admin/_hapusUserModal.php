<div class="modal fade" id="hapusUserModal<?= $id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin ingin menghapus User?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Anda akan menghapus <?= $nama; ?> ?</div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" data-dismiss="modal">Batal</button>
                <form action="<?= base_url('admin/hapususer') ?>" method="POST">
                    <input type="text" name="hapusid" id="hapususerid" value="<?= $id; ?>" style="display: none;">
                    <input type="text" name="hapusrole" id="hapususerrole" value="<?= $role; ?>" style="display: none;">
                    <input type="text" name="hapusnama" id="hapususernama" value="<?= $nama; ?>" style="display: none;">
                    <button type="submit" class="btn btn-danger" href="">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>