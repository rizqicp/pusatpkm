<div class="modal fade" id="barcodeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pindai KTM anda</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close" onClick="window.location.reload();"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div id="scanner-container">
                    <video src=""></video>
                    <canvas class="drawingBuffer"></canvas>
                </div>
                <form id="barcodeform" class="user" action="<?= base_url('auth/loginBarcode'); ?>" method="POST">
                    <input type="hidden" name="userBarcode" id="userBarcode" />
                </form>
                <small>* Scanner mungkin tidak bekerja untuk kamera resolusi rendah</small>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal" onClick="window.location.reload();">Batal</button>
            </div>
        </div>
    </div>
</div>

<style>
    #scanner-container video,
    canvas {
        width: 100%;
        height: auto;
    }

    #scanner-container video.drawingBuffer,
    canvas.drawingBuffer {
        display: none;
    }
</style>