<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Core Meta Data -->
    <?php $this->load->view("home/_partials/meta") ?>
</head>

<body>
    <!-- Navigation -->
    <?php $this->load->view("home/_partials/topbar") ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8 mb-5">

                <h1 class="my-4">Contact</h1>
                <!-- isi -->
                <div class="embed-responsive embed-responsive-16by9 mb-3">
                    <iframe style="border:1px solid black;" class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31657.704246327186!2d112.80017474294432!3d-7.329954924394936!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb26589947991eea1!2sUPN%20Veteran%20Jatim!5e0!3m2!1sid!2sid!4v1613644097109!5m2!1sid!2sid" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
                <p>Contact Information</p>
                <p>Jl.Raya Rungkut Madya, Gunung Anyar, Surabaya</p>
                <p>Telp : +62 (031) 870 6369</p>
                <p>Fax. : +62 (031) 870 6372</p>
                <a href="mailto:uptkwu@upnjatim.ac.id"><u>uptkwu@upnjatim.ac.id</u></a>
            </div>

            <!-- Sidebar Widgets Column -->
            <?php $this->load->view("home/_partials/sidebar", $kategori) ?>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <?php $this->load->view("home/_partials/footer") ?>

    <!-- Core Script Data -->
    <?php $this->load->view("_partials/script") ?>
</body>

</html>