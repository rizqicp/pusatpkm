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
            <div class="col-md-8">

                <h1 class="my-4">Contact</h1>
                <!-- isi -->

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