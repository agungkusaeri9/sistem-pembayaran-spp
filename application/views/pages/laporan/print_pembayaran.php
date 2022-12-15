<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>LAPORAN DATA PEMBAYARAN</title>
	<link rel="stylesheet" href="<?= base_url('assets/bootstrap4/css/bootstrap.min.css') ?>">
	<style>
		* {
			font-size: 12px;
			font-weight: 600;
		}

		table {
			font-size: 12px;
			font-weight: 600;
		}

		table tr th {
			padding: 0 !important;
			margin: 0 !important;
			text-align: center;
		}

		table tr td {
			padding: 0 5px !important;
			margin: 0 !important;
		}
	</style>
</head>

<body onload="window.print()">
	<?php

	use Carbon\Carbon;

	if ($this->input->get('id_siswa')) : ?>

		<div class="container-fluid" style="max-width: 600px;border:1px solid black;padding-bottom:20px">
			<div class="row justify-content-center mt-3">
				<div class="col-md-12">
					<div style="font-size: 14px; font-weight: 600" class="text-center">
						MAJELIS PENDIDIKAN DASAR DAN MENENGAH MUHAMMADIYAH <br> SMK Citeko Kaler <br> Jalan Citeko Kaler Plered Purwakarta (0545) 398753
					</div>
				</div>
			</div>

			<div class="row mt-3">
				<div class="col-md-6">
					<table class="table table-borderless" cellpadding="0">
						<tr>
							<td>Nama</td>
							<td>:</td>
							<td><?= $siswa->nama_siswa ?></td>
						</tr>
						<tr>
							<td>Kelas</td>
							<td>:</td>
							<td>
								<?php if($this->session->userdata('level') === 'siswa') : ?>
									<?= $siswa->kelas ?>
								<?php else : ?>
									<?= $kelas->nama_kelas ?>
								<?php endif; ?>
							</td>
						</tr>
					</table>
				</div>
				<div class="col-md-6">
					<table class="table table-borderless" cellpadding="0">
						<tr>
							<td>T.P </td>
							<td>:</td>
							<td><?= $tahun_pelajaran->tahun ?? 'Semua' ?></td>
						</tr>
					</table>
				</div>
			</div>

			<!-- tabel -->
			<div class="row">
				<div class="col-md-12">
				<table class="table dtable table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th>No.</th>
								<th>Nama Pembayaran</th>
								<th>Bulan</th>
								<th>Nominal</th>
								<th>KETERANGAN</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i = 1;
							?>
							<?php foreach ($pembayaran_tahun_pelajaran as $ptp) : ?>
								<tr>
									<td style="width:10px;" class="text-center"><?= $i++ ?></td>
									<td><?= $ptp->nama_jenis ?></td>
									<td><?= bulan($ptp->bulan) ?></td>
									<td>Rp. <?= number_format($ptp->nominal) ?></td>
									<td class="text-center">
										<?php cekPembayaran($this->input->get('id_siswa'), $ptp->id_pembayaran_tahun_pelajaran, $ptp->bulan) ?>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<p>Catatan : Pembayaran DBOTS paling lambat tanggal 10 setiap bulannya.</p>
				</div>
			</div>

			<div class="row mt-4">
			<div class="col-md-6">
				<div class="d-flex justify-content-end">
					<div class="text-center">
						<div>Mengetahui</div>
						<div>KEPALA SEKOLAH</div>
						<div style="margin-top:80px">
							<ins>AHKAM MUAWIS, S.PD I</ins>
							<div>NBM. 1050698</div>
						</div>
					</div>
				</div>
			</div>
				<div class="col-md-6">
					<div class="d-flex justify-content-end">
						<div class="text-center">
							<div>SAMBAS, <?= Carbon::now()->translatedFormat('d F Y') ?></div>
							<div>BENDAHARA</div>
							<div style="margin-top:80px">
								<div>APRIDA</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php else : ?>
			<div class="container-fluid">
				<div class="row justify-content-center mt-3">
					<div class="col-md-12">
						<div style="font-size: 14px; font-weight: 600" class="text-center">
							DATA PEMBAYARAN <br />
							TAHUN PELAJARAN <?= $tahun_pelajaran ?>
						</div>
					</div>
				</div>

				<div class="row mt-3">
					<div class="col-md-3">
						<table class="table table-borderless" cellpadding="0">
							<tr>
								<td>Jurusan</td>
								<td>:</td>
								<td>
									<?php if ($id_jurusan) : ?>
										<?= $jurusan->nama_jurusan ?>
									<?php else : ?>
										Semua
									<?php endif; ?>
								</td>
							</tr>
							<tr>
								<td>Kelas</td>
								<td>:</td>
								<td>
									<?php if ($id_kelas) : ?>
										<?= $kelas->nama_kelas ?>
									<?php else : ?>
										Semua
									<?php endif; ?>
								</td>
							</tr>
						</table>
					</div>
				</div>

				<!-- tabel -->
				<div class="row">
					<div class="col-md-12">
						<table class="table table-bordered">
							<tbody>
								<thead>
									<th>No.</th>
									<th>NISN</th>
									<th>Nama Siswa</th>
									<th>Kelas</th>
									<th>Jurusan</th>
									<th>Jenis Pembayaran</th>
									<th>Bulan</th>
									<th>Nominal</th>
									<th>Tanggal</th>
								</thead>
							<tbody>
								<?php
								$i = 1; ?>
								<?php foreach ($pembayaran as $pem) : ?>
									<tr>
										<td class="text-center"><?= $i++; ?></td>
										<td><?= $pem->nisn ?></td>
										<td><?= $pem->nama_siswa ?></td>
										<td><?= $pem->nama_kelas ?></td>
										<td><?= $pem->nama_jurusan ?></td>
										<td><?= $pem->nama_jenis ?></td>
										<td><?= bulan($pem->bulan) ?></td>
										<td>Rp. <?= number_format($pem->nominal) ?></td>
										<td><?= Carbon::parse($pem->tanggal_pembayaran)->translatedFormat('d/m/Y') ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
							</tbody>
						</table>
					</div>
				</div>

				<div class="row mt-4">
					<div class="col-md-11">
						<div class="d-flex justify-content-end">
							<div class="text-center">
								<div>SAMBAS, <?= Carbon::now()->translatedFormat('d F Y') ?></div>
								<div>BENDAHARA</div>
								<div style="margin-top:80px">
									<div>APRIDA</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		<?php endif; ?>
</body>

</html>
