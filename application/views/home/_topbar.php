<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" style="font-size: 1.5rem;" href="<?= base_url('home/index'); ?>"><i class="fas fa-user-graduate"></i> Pusat<span>PKM</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?= $this->uri->segment(2) == 'index' ? 'active' : ($this->uri->segment(2) == '' ? 'active' : '') ?>">
                    <a class="nav-link mr-3 mt-1" href="<?= base_url('home/index'); ?>">Beranda</a>
                </li>
                <!-- <li class="nav-item <?= $this->uri->segment(2) == 'panduan' ? 'active' : '' ?> mr-3 mt-1">
                    <a class="nav-link disabled" href="<?= base_url('home/panduan'); ?>">Panduan</a>
                </li> -->
                <li class="nav-item <?= $this->uri->segment(2) == 'profil' ? 'active' : '' ?> mr-3 mt-1">
                    <a class="nav-link" href="<?= base_url('home/profil'); ?>">Profil</a>
                </li>
                <li class="nav-item mt-1">
                    <?php if (isset($user['role'])) : ?>
                        <a class="nav-link btn btn-outline-secondary" href="<?= base_url('auth/index'); ?>">Dasbor</a>
                    <?php else : ?>
                        <a class="nav-link btn btn-outline-secondary" href="<?= base_url('auth/login'); ?>">Masuk</a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
</nav>