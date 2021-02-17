<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url('home/index'); ?>">
            <img src="<?= base_url('uploads/img/logoupnbaru.png'); ?>" width="40" height="40" alt="Logo"> UPT Pengembangan Karir & Kewirausahaan
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?= $this->uri->segment(2) == 'index' ? 'active' : ($this->uri->segment(2) == '' ? 'active' : '') ?>">
                    <a class="nav-link mr-3 mt-1" href="<?= base_url('home/index'); ?>">Beranda</a>
                </li>
                <li class="nav-item mr-3 mt-1">
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" type="button" id="dropdownMenuLink" data-toggle="dropdown">
                            Profil
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item <?= $this->uri->segment(2) == 'kewirausahaan' ? 'active' : '' ?>" href="<?= base_url('home/kewirausahaan'); ?>">Kewirausahaan</a>
                            <a class="dropdown-item <?= $this->uri->segment(2) == 'karir' ? 'active' : '' ?>" href="<?= base_url('home/karir'); ?>">Karir</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item <?= $this->uri->segment(2) == 'panduan' ? 'active' : '' ?> mr-3 mt-1">
                    <a class="nav-link" href="<?= base_url('home/panduan'); ?>">Panduan</a>
                </li>
                <li class="nav-item <?= $this->uri->segment(2) == 'contact' ? 'active' : '' ?> mr-3 mt-1">
                    <a class="nav-link" href="<?= base_url('home/contact'); ?>">Contact</a>
                </li>
                <li class="nav-item mt-1">
                    <?php if ($this->session->userdata('email')) : ?>
                        <a class="nav-link btn btn-outline-secondary" href="<?= base_url('auth/index'); ?>">Dasbor</a>
                    <?php else : ?>
                        <a class="nav-link btn btn-outline-secondary" href="<?= base_url('auth/login'); ?>">Masuk</a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
</nav>