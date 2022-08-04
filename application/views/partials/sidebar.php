<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
				<div class="sidebar-brand-icon rotate-n-15">
					<i class="fas fa-home"></i>
				</div>
				<div class="sidebar-brand-text mx-3"><?= $this->session->login['username'] ?></div>
			</a>
			<hr class="sidebar-divider my-0">
			<li class="nav-item <?= $aktif == 'dashboard' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('dashboard') ?>">
					<i class="fas fa-fw fa-tachometer-alt"></i>
					<span>Dashboard</span></a>
			</li>
			<hr class="sidebar-divider">

			<div class="sidebar-heading">
				Master
			</div>

			<li class="nav-item <?= $aktif == 'komponen' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('komponen') ?>">
					<i class="fas fa-fw fa-server"></i>
					<span>Master Komponen</span></a>
			</li>

			<li class="nav-item <?= $aktif == 'sub' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('sub') ?>">
					<i class="fas fa-fw fa-memory"></i>
					<span>Master Sub-Komponen</span></a>
			</li>

			<li class="nav-item <?= $aktif == 'user' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('user') ?>">
					<i class="fas fa-fw fa-users"></i>
					<span>Master User</span></a>
			</li>

			<li class="nav-item <?= $aktif == 'pengguna' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('pengguna') ?>">
					<i class="fas fa-fw fa-user"></i>
					<span>Master Admin</span></a>
			</li>

			<li class="nav-item <?= $aktif == 'software' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('software') ?>">
					<i class="fas fa-fw fa-globe"></i>
					<span>Master Software</span></a>
			</li>

			<!-- Divider -->
			<hr class="sidebar-divider">
	
			<div class="sidebar-heading">
				Fitur
			</div>

			<li class="nav-item <?= $aktif == 'identifikasi' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('identifikasi') ?>">
					<i class="fas fa-fw fa-user-lock"></i>
					<span>Identifikasi</span></a>
			</li>

			<li class="nav-item <?= $aktif == 'det_soft' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('det_soft') ?>">
					<i class="fas fa-fw fa-file-invoice"></i>
					<span>Lisensi</span></a>
			</li>

			<li class="nav-item <?= $aktif == 'upgrade' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('upgrade') ?>">
					<i class="fas fa-fw fa-upload"></i>
					<span>Upgrade</span></a>
			</li>

			<hr class="sidebar-divider d-none d-md-block">

			<!-- Sidebar Toggler (Sidebar) -->

			<div class="text-center d-none d-md-inline">
				<button class="rounded-circle border-0" id="sidebarToggle"></button>
			</div>
		</ul>