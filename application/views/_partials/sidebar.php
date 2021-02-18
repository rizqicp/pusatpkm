<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar" style="transition: 0.3s;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url($user['role'] . '/profilsaya'); ?>">
        <div class="sidebar-brand-icon">
            <i class="fas fa-university"></i>
        </div>
        <div class="sidebar-brand-text mx-3">UPT PKK</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Heading -->
    <div class="sidebar-heading">
        <?= $user['role']; ?>
    </div>

    <!-- Nav Item - Profil Saya -->
    <li class="nav-item <?= $this->uri->segment(2) == 'profilsaya' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url($user['role'] . '/profilsaya'); ?>">
            <i class=" fas fa-fw fa-user-circle"></i>
            <span>Profil Saya</span>
        </a>
    </li>

    <?php switch ($user['role']):
        case 'admin': ?>
            <!-- Nav Item - Kelola Pengajuan -->
            <li class="nav-item <?= $this->uri->segment(2) == 'kelolapengajuan' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url($user['role'] . '/kelolapengajuan'); ?>">
                    <i class="fas fa-fw fa-file-alt"></i>
                    <span>Kelola Pengajuan</span>
                </a>
            </li>
            <!-- Nav Item - Kelola Pengumuman -->
            <!-- <li class="nav-item <?= $this->uri->segment(2) == 'kelolapengumuman' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url($user['role'] . '/kelolapengumuman'); ?>">
                    <i class=" fas fa-fw fa-bullhorn"></i>
                    <span>Kelola Pengumuman</span>
                </a>
            </li> -->
            <!-- Nav Item - Kelola Pengguna -->
            <!-- <li class="nav-item <?= $this->uri->segment(2) == 'kelolauser' ? 'active' : '' ?>">
                <a class="nav-link " href="<?= base_url($user['role'] . '/kelolauser'); ?>">
                    <i class="fas fa-fw fa-user-edit"></i>
                    <span>Kelola Users</span>
                </a>
            </li> -->
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMaster"
                    aria-expanded="true" aria-controls="collapseMaster">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Data Master</span>
                </a>
                <div id="collapseMaster" class="collapse <?= in_array($this->uri->segment(2),['kelolauser','kelolapengumuman','kelolakategori','kelolahibah']) ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Data:</h6>
                        <a class="collapse-item <?= $this->uri->segment(2) == 'kelolauser' ? 'active' : '' ?>" href="<?= base_url($user['role'] . '/kelolauser'); ?>">Data User</a>
                        <a class="collapse-item <?= $this->uri->segment(2) == 'kelolapengumuman' ? 'active' : '' ?>" href="<?= base_url($user['role'] . '/kelolapengumuman'); ?>">Data Pengumuman</a>
                        <a class="collapse-item <?= $this->uri->segment(2) == 'kelolakategori' ? 'active' : '' ?>" href="<?= base_url($user['role'] . '/kelolakategori'); ?>">Data Kategori</a>
                        <a class="collapse-item <?= $this->uri->segment(2) == 'kelolahibah' ? 'active' : '' ?>" href="<?= base_url($user['role'] . '/kelolahibah'); ?>">Data Hibah</a>
                        <a class="collapse-item <?= $this->uri->segment(2) == 'kelolaperiode' ? 'active' : '' ?>" href="<?= base_url($user['role'] . '/kelolaperiode'); ?>">Data Periode</a>
                    </div>
                </div>
            </li>
            <?php break; ?>
        <?php
        case 'mahasiswa': ?>
            <!-- Nav Item - pengajuan -->
            <li class="nav-item <?= $this->uri->segment(2) == 'pengajuan' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url($user['role'] . '/pengajuan'); ?>">
                    <i class="fas fa-fw fa-file-alt"></i>
                    <span>Pengajuan</span>
                </a>
            </li>
            <?php break; ?>
        <?php
        case 'dosen': ?>
            <!-- Nav Item - ulasan -->
            <li class="nav-item <?= $this->uri->segment(2) == 'ulasan' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url($user['role'] . '/ulasan'); ?>">
                    <i class="fas fa-fw fa-file-alt"></i>
                    <span>Ulasan</span>
                </a>
            </li>
            <!-- Nav Item - bimbingan -->
            <li class="nav-item <?= $this->uri->segment(2) == 'bimbingan' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url($user['role'] . '/bimbingan'); ?>">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Bimbingan</span>
                </a>
            </li>
            <?php break; ?>
    <?php endswitch ?>

    <!-- Nav Item - Histori Proposal -->
    <li class="nav-item <?= $this->uri->segment(2) == 'historiproposal' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url($user['role'] . '/historiproposal'); ?>">
            <i class=" fas fa-fw fa-folder-open"></i>
            <span>Histori Proposal</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>