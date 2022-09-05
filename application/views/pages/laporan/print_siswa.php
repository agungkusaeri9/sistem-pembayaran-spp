<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>LAPORAN DATA SISWA</title>
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
	<div class="container-fluid">
		<div class="row justify-content-center mt-3">
			<div class="col-md-12">
				<div style="font-size: 14px; font-weight: 600" class="text-center">
					DAFTAR SISWA (MODEL 832) <br />
					TAHUN PELAJARAN <?= $tahun_pelajaran ?>
				</div>
			</div>
		</div>

		<div class="row mt-3">
			<div class="col-md-7">
				<table class="table table-borderless" cellpadding="0">
					<tr>
						<td>Nama Sekolah</td>
						<td>:</td>
						<td>SMA Muhammadiyah Sambas</td>
					</tr>
					<tr>
						<td>NSS</td>
						<td>:</td>
						<td>302610000031</td>
					</tr>
					<tr>
						<td>No. Telepon</td>
						<td>:</td>
						<td>0891212412</td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>:</td>
						<td>Jalan Masudi</td>
					</tr>
					<tr>
						<td>Kecamatan</td>
						<td>:</td>
						<td>Sambas</td>
					</tr>
					<tr>
						<td>Kabupaten/Kota</td>
						<td>:</td>
						<td>Sambas</td>
					</tr>
					<tr>
						<td>Provinsi</td>
						<td>:</td>
						<td>Kalimantan Barat</td>
					</tr>
				</table>
			</div>
			<div class="col-md-4">
				<table class="table table-borderless" cellpadding="0">
					<tr>
						<td>Kelas</td>
						<td>:</td>
						<td>
							<?php if($kelas) : ?>
							 <?= $kelas->nama_kelas ?>
							<?php else : ?>
							Semua
							<?php endif; ?>
						</td>
					</tr>
					<tr>
						<td>Program</td>
						<td>:</td>
						<td>
						<?php if($jurusan) : ?>
							 <?= $jurusan->nama_jurusan ?>
							<?php else : ?>
							Semua
							<?php endif; ?>
						</td>
					</tr>
					<tr>
						<td>Akreditas</td>
						<td>:</td>
						<td>A</td>
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
							<tr>
								<th colspan="2" class="text-center">No</th>
								<th rowspan="2" class="align-middle">NISN</th>
								<th rowspan="2" class="align-middle">Nama Siswa</th>
								<th rowspan="2" class="align-middle">L/P</th>
								<th rowspan="2" class="align-middle">Tempat dan Tanggal Lahir</th>
								<th rowspan="2" class="align-middle">Agama</th>
								<th colspan="2">Nama Orang Tua</th>
								<th rowspan="2" class="align-middle">Alamat Orang Tua/Wali</th>
							</tr>
							<tr>
								<th class="text-center">Urt</th>
								<th class="text-center">Induk</th>
								<th class="text-center">Ayah</th>
								<th class="text-center">Ibu</th>
							</tr>
							<tr>
								<th class="text-center">1</th>
								<th class="text-center">2</th>
								<th class="text-center"></th>
								<th class="text-center">3</th>
								<th class="text-center">4</th>
								<th class="text-center">5</th>
								<th class="text-center">6</th>
								<th class="text-center">7</th>
								<th class="text-center"></th>
								<th class="text-center">8</th>
							</tr>
						</thead>
					<tbody>
						<?php
						$i = 1;
						$laki_laki = 0;
						$perempuan = 0;
						 ?>
						<?php foreach ($siswa as $sw) : ?>
							<?php if($sw->jenis_kelamin === 'L') : ?>
							<?php $laki_laki = $laki_laki + 1 ?>
							<?php else: ?>
							<?php $perempuan = $perempuan + 1 ?>
							<?php endif; ?>
							<tr>
								<td class="text-center"><?= $i++ ?></td>
								<td class="text-center"><?= $sw->nis ?></td>
								<td class="text-center"><?= $sw->nisn ?></td>
								<td><?= $sw->nama_siswa ?></td>
								<td class="text-center"><?= $sw->jenis_kelamin ?></td>
								<td><?= $sw->tempat_lahir . ', ' . $sw->tanggal_lahir ?></td>
								<td class="text-center"><?= $sw->agama ?></td>
								<td><?= $sw->nama_ayah ?></td>
								<td><?= $sw->nama_ibu ?></td>
								<td><?= $sw->alamat_orang_tua ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
					</tbody>
				</table>
			</div>
		</div>

		<div class="row mt-4">
			<div class="col-md-1"></div>
			<div class="col-md-3">
				<div class="d-flex justify-content-between">
					<div>
						REKAP :
					</div>
					<div>
						LAKI-LAKI = <?= $laki_laki ?>
						<br>PEREMPUAN = <?= $perempuan ?>
					</div>
				</div>
			</div>
			<div class="col-md-7">
				<div class="d-flex justify-content-end">
					<div class="text-center">
						<div>SAMBAS, <?= $tanggal ?></div>
						<div>KEPALA SMA MUHAMMADIYAH SAMBAS</div>
						<div style="margin-top:80px">
							<ins>AHKAM MUAWIS, S.PD I</ins>
							<div>NBM. 1050698</div>
						</div>
					</div>
				</div>

			</div>
		</div>

	</div>

</body>

</html>
