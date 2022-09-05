<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h6>Edit Pembayaran Tahun Pelajaran</h6>
				</div>
				<div class="card-body">
					<form action="<?= base_url('pembayaran_tahun_pelajaran/store') ?>" method="post">
					<input type="number" name="id_pembayaran_tahun_pelajaran" value="<?= $data->id_pembayaran_tahun_pelajaran ?>" hidden>
						<div class="form-group">
							<label for="id_tahun_pelajaran">Tahun Pelajaran</label>
							<select name="id_tahun_pelajaran" id="id_tahun_pelajaran" class="form-control" required>
							<option value="" selected disabled>Pilih Tahun Pelajaran</option>
								<?php foreach ($tahun_pelajaran as $ta) : ?>
									<option value="<?= $ta->id_tahun_pelajaran ?>" 
									<?php if($ta->id_tahun_pelajaran == $data->id_tahun_pelajaran) : ?>
									 selected
									<?php endif; ?>
									><?= $ta->tahun ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label for="id_jenis_pembayaran">Jenis Pembayaran</label>
							<select name="id_jenis_pembayaran" id="id_jenis_pembayaran" class="form-control" required>
							<option value="" selected disabled>Pilih Jenis Pembayaran</option>
								<?php foreach ($jenis_pembayaran as $jenis) : ?>
									<option value="<?= $jenis->id_jenis_pembayaran ?>"
									<?php if($jenis->id_jenis_pembayaran == $data->id_jenis_pembayaran) : ?>
									 selected
									<?php endif; ?>
									><?= $jenis->nama_jenis ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label for="bulan">Bulan</label>
							<select name="bulan" id="bulan" class="form-control">
								<option value="" selected disabled>Pilih Bulan</option>
								<?php foreach ($bulan as $bln) : ?>
									<option value="<?= $bln['no'] ?>"
									<?php if($bln['no'] == $data->bulan) : ?>
									 selected
									<?php endif; ?>
									><?= $bln['nama'] ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<button class="btn float-right btn-primary">Tambah</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
