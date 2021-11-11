<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard') ?>">
				<div class="sidebar-brand-icon rotate-n-15">
					<i class="fas fa-book"></i>
				</div>
				<div class="sidebar-brand-text mx-3">Pendaftaran Pelatihan</div>
			</a>
			<hr class="sidebar-divider my-0">
			<li class="nav-item <?= $aktif == 'dashboard' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('dashboard') ?>">
					<i class="fas fa-fw fa-tachometer-alt"></i>
					<span>Dashboard</span></a>
			</li>

			<hr class="sidebar-divider">
			<li class="nav-item <?= $aktif == 'pelatihan' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('pelatihan/') ?>">
					<i class="fas fa-fw fa-book"></i>
					<span>Pelatihan</span></a>
			</li>

			<hr class="sidebar-divider">
			<li class="nav-item <?= $aktif == 'peserta' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('peserta/') ?>">
					<i class="fas fa-fw fa-user-plus"></i>
					<span>Peserta</span></a>
			</li>

			<!-- Sidebar Toggler (Sidebar) -->
			<div class="text-center d-none d-md-inline">
				<button class="rounded-circle border-0" id="sidebarToggle"></button>
			</div>
		</ul>