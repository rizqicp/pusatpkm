<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <i class="fas fa-university"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Pusat PKM</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Heading -->
    <div class="sidebar-heading">
        <?= $user['role']; ?>
    </div>

    <!-- Nav Item - Profil Saya -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url($user['role'] . '/profilsaya'); ?>">
            <i class=" fas fa-fw fa-user-circle"></i>
            <span>Profil Saya</span>
        </a>
    </li>

    <?php switch ($user['role']):
        case 'admin': ?>
            <!-- Nav Item - Kelola Pengguna -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url($user['role'] . '/kelolapengguna'); ?>">
                    <i class=" fas fa-fw fa-user-edit"></i>
                    <span>Kelola Pengguna</span>
                </a>
            </li>
            <?php break; ?>
        <?php
        case 'mahasiswa': ?>
            <!-- Nav Item - pengajuan -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url($user['role'] . '/pengajuan'); ?>">
                    <i class="fas fa-fw fa-file-alt"></i>
                    <span>Pengajuan</span>
                </a>
            </li>
            <?php break; ?>
        <?php
        case 'dosen': ?>
            <!-- Nav Item - ulasan -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url($user['role'] . '/ulasan'); ?>">
                    <i class="fas fa-fw fa-file-alt"></i>
                    <span>Ulasan</span>
                </a>
            </li>
            <?php break; ?>
    <?php endswitch ?>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>