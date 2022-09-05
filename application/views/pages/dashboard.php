<div class="container-fluid">
	<!-- Small boxes (Stat box) -->
	<div class="row">
		<?php if ($this->session->userdata('level') === 'siswa') : ?>
			<div class="col-lg-3 col-6">
				<!-- small box -->
				<div class="small-box bg-info">
					<div class="inner">
						<h3><?= $count['tagihan'] ?></h3>

						<p>Tagihan</p>
					</div>
					<div class="icon">

					</div>
					<a href="<?= base_url('tagihan') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<div class="col-lg-3 col-6">
				<!-- small box -->
				<div class="small-box bg-success">
					<div class="inner">
						<h3><?= $count['pembayaran'] ?></h3>

						<p>Pembayaran</p>
					</div>
					<div class="icon">

					</div>
					<a href="<?= base_url('pembayaran') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
			
		<?php else : ?>
			<div class="col-lg-3 col-6">
				<!-- small box -->
				<div class="small-box bg-success">
					<div class="inner">
						<h3><?= $count['siswa'] ?></h3>

						<p>Siswa</p>
					</div>
					<div class="icon">

					</div>
					<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<div class="col-lg-3 col-6">
				<!-- small box -->
				<div class="small-box bg-info">
					<div class="inner">
						<h3><?= $count['jurusan'] ?></h3>

						<p>Jurusan</p>
					</div>
					<div class="icon">

					</div>
					<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<div class="col-lg-3 col-6">
				<!-- small box -->
				<div class="small-box bg-warning">
					<div class="inner">
						<h3><?= $count['kelas'] ?></h3>

						<p>Kelas</p>
					</div>
					<div class="icon">

					</div>
					<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<div class="col-lg-3 col-6">
				<!-- small box -->
				<div class="small-box bg-primary">
					<div class="inner">
						<h3><?= $count['tenaga_kependidikan'] ?></h3>

						<p>Tenaga Kependidikan</p>
					</div>
					<div class="icon">

					</div>
					<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<div class="col-lg-3 col-6">
				<!-- small box -->
				<div class="small-box bg-danger">
					<div class="inner">
						<h3><?= $count['jenis_pembayaran'] ?></h3>

						<p>Jenis Pembayaran</p>
					</div>
					<div class="icon">

					</div>
					<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
		<?php endif; ?>
	</div>
	<!-- /.row -->
</div>
