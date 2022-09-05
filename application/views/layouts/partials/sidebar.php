<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="<?= base_url('dashboard') ?>" class="brand-link text-center mt-4">
		<img src="<?= base_url('assets/gambar/logo.png') ?>" alt="" class="img-fluid" style="max-height: 80px;">
		<br>
		<span class="brand-text font-weight-light mx-3" style="font-size: 26px;">Pembayaran SPP</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar mt-3">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="<?= base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
					alt="User Image">
			</div>
			<div class="info">
				<a href="#" class="d-block"><?= $this->session->userdata('nama') ?></a>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
				<li class="nav-item">
					<a href="<?= base_url('dashboard') ?>" class="nav-link">
						<i class="nav-icon fas fa-fw fa-tachometer-alt"></i>
						<p>
							Dashboard
						</p>
					</a>
				</li>
				<?php if($this->session->userdata('level') === 'admin') : ?>
					<li class="nav-header">Master</li>
				<li class="nav-item">
					<a href="<?= base_url('siswa') ?>" class="nav-link">
						<i class="nav-icon fas fa-fw fa-folder"></i>
						<p>
							Siswa
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('kelas') ?>" class="nav-link">
						<i class="nav-icon fas fa-fw fa-folder"></i>
						<p>
							Kelas
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('jurusan') ?>" class="nav-link">
						<i class="nav-icon fas fa-fw fa-folder"></i>
						<p>
							Jurusan
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('tahun_pelajaran') ?>" class="nav-link">
						<i class="nav-icon fas fa-fw fa-calendar-alt"></i>
						<p>
							Tahun Pelajaran
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('jenis_pembayaran') ?>" class="nav-link">
						<i class="nav-icon fas fa-fw fa-credit-card"></i>
						<p>
							Jenis Pembayaran
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('pembayaran_tahun_pelajaran') ?>" class="nav-link">
						<i class="nav-icon fas fa-fw fa-credit-card"></i>
						<p>
							Pembayaran Tahun Pelajaran
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('tenaga_kependidikan') ?>" class="nav-link">
						<i class="nav-icon fas fa-fw fa-wallet"></i>
						<p>
							Tenaga Kependidikan
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('user') ?>" class="nav-link">
						<i class="nav-icon fas fa-fw fa-users"></i>
						<p>
							User
						</p>
					</a>
				</li>
				<?php endif; ?>
				<li class="nav-header">Pembayaran</li>
				<?php if($this->session->userdata('level') === 'siswa') : ?>
					<li class="nav-item">
					<a href="<?= base_url('tagihan') ?>" class="nav-link">
						<i class="nav-icon fas fa-fw fa-exchange-alt"></i>
						<p>
							Tagihan
						</p>
					</a>
				</li>
				<?php endif; ?>
				<li class="nav-item">
					<a href="<?= base_url('pembayaran') ?>" class="nav-link">
						<i class="nav-icon fas fa-fw fa-exchange-alt"></i>
						<p>
							Pembayaran
						</p>
					</a>
				</li>
				<?php if($this->session->userdata('level') === 'admin' || $this->session->userdata('level') === 'bendahara') : ?>
				<li class="nav-header">Laporan</li>
				<?php endif; ?>
				<?php if($this->session->userdata('level') === 'admin') : ?>
					<li class="nav-item">
					<a href="<?= base_url('laporan/siswa') ?>" class="nav-link">
						<i class="nav-icon fas fa-fw fa-exchange-alt"></i>
						<p>
							Laporan Siswa
						</p>
					</a>
				</li>
				<?php endif; ?>
				<?php if($this->session->userdata('level') === 'admin' || $this->session->userdata('level') === 'bendahara') : ?>
					<li class="nav-item">
					<a href="<?= base_url('laporan/pembayaran') ?>" class="nav-link">
						<i class="nav-icon fas fa-fw fa-exchange-alt"></i>
						<p>
							Laporan Pembayaran
						</p>
					</a>
				</li>
				<?php endif; ?>
				<li class="nav-header">Pengaturan</li>
				<li class="nav-item mb-5">
					<a href="<?= base_url('auth/logout') ?>" class="nav-link">
						<i class="nav-icon fas fa-fw fa-sign-out-alt"></i>
						<p>
							Logout
						</p>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
