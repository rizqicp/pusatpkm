<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Data -->
    <?php $this->load->view("_partials/meta.php") ?>
    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-dark">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-md-7">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Halaman Masuk</h1>
                                    </div>
                                    <?= $this->session->flashdata('message'); ?>
                                    <form class="user" action="<?= base_url('auth/login'); ?>" method="POST">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="userEmail" name="userEmail" value="<?= set_value('userEmail'); ?>" placeholder="Alamat Email">
                                            <?= form_error('userEmail', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="userPassword" name="userPassword" placeholder="Kata Sandi">
                                            <?= form_error('userPassword', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Masuk</button>
                                    </form>
                                    <div class="text-center mt-2 small">atau</div>
                                    <div class="text-center mt-2">
                                        <button id="scanbarcode" type="button" class="btn btn-outline-dark btn-lg" href="#" data-toggle="modal" data-target="#barcodeModal"><i class="fas fa-barcode fa-3x"></i></button>
                                    </div>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('auth/forgot'); ?>">Lupa Kata Sandi?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('auth/register'); ?>">Belum Punya Akun? Daftar!</a>
                                    </div>
                                    <div class="text-center mt-2">
                                        <a class="small" href="<?= base_url('home'); ?>">&larr; Beranda</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- barcode modal -->
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
                    <form id="barcodeform" class="user" action="<?= base_url('auth/login'); ?>" method="POST">
                        <input type="hidden" name="barcode" id="barcode" />
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal" onClick="window.location.reload();">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Include the image-diff library -->
    <script src="<?= base_url('assets/'); ?>js/quagga/dist/quagga.min.js"></script>

    <script>
        var _scannerIsRunning = false;

        function startScanner(form, input) {
            Quagga.init({
                inputStream: {
                    name: "Live",
                    type: "LiveStream",
                    target: document.querySelector('#scanner-container'),
                    constraints: {
                        // width: 800,
                        // height: 600,
                        facingMode: "environment"
                    },
                },
                decoder: {
                    readers: [
                        "code_128_reader"
                        // "ean_reader",
                        // "ean_8_reader",
                        // "code_39_reader",
                        // "code_39_vin_reader",
                        // "codabar_reader",
                        // "upc_reader",
                        // "upc_e_reader",
                        // "i2of5_reader"
                    ],
                    debug: {
                        showCanvas: true,
                        showPatches: true,
                        showFoundPatches: true,
                        showSkeleton: true,
                        showLabels: true,
                        showPatchLabels: true,
                        showRemainingPatchLabels: true,
                        boxFromPatches: {
                            showTransformed: true,
                            showTransformedBox: true,
                            showBB: true
                        }
                    }
                },

            }, function(err) {
                if (err) {
                    console.log(err);
                    return
                }

                console.log("Initialization finished. Ready to start");
                Quagga.start();

                // Set flag to is running
                _scannerIsRunning = true;
            });

            Quagga.onProcessed(function(result) {
                var drawingCtx = Quagga.canvas.ctx.overlay,
                    drawingCanvas = Quagga.canvas.dom.overlay;

                if (result) {
                    if (result.boxes) {
                        drawingCtx.clearRect(0, 0, parseInt(drawingCanvas.getAttribute("width")), parseInt(drawingCanvas.getAttribute("height")));
                        result.boxes.filter(function(box) {
                            return box !== result.box;
                        }).forEach(function(box) {
                            Quagga.ImageDebug.drawPath(box, {
                                x: 0,
                                y: 1
                            }, drawingCtx, {
                                color: "green",
                                lineWidth: 2
                            });
                        });
                    }

                    if (result.box) {
                        Quagga.ImageDebug.drawPath(result.box, {
                            x: 0,
                            y: 1
                        }, drawingCtx, {
                            color: "#00F",
                            lineWidth: 2
                        });
                    }

                    if (result.codeResult && result.codeResult.code) {
                        Quagga.ImageDebug.drawPath(result.line, {
                            x: 'x',
                            y: 'y'
                        }, drawingCtx, {
                            color: 'red',
                            lineWidth: 3
                        });
                    }
                }
            });


            Quagga.onDetected(function(result) {
                console.log("Barcode detected and processed : [" + result.codeResult.code + "]", result);
                console.log(result.codeResult.code);
                jQuery(input).val(result.codeResult.code);
                jQuery(form).submit();
            });
        }


        // Start/stop scanner
        document.getElementById("scanbarcode").addEventListener("click", function() {
            if (_scannerIsRunning) {
                Quagga.stop();
                _scannerIsRunning = false;
            } else {
                startScanner('#barcodeform', '#barcode');
            }
        }, false);
    </script>

    <!-- Script Data -->
    <?php $this->load->view("_partials/script.php") ?>

    <!-- Custom scripts sb-admin pages-->
    <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

</body>

</html>