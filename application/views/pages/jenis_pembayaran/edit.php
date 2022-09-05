<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h6>Edit Jenis Pembayaran</h6>
				</div>
				<div class="card-body">
					<form action="<?= base_url('jenis_pembayaran/store') ?>" method="post">
						<input type="number" id="id" name="id_jenis_pembayaran" value="<?= $jenis_pembayaran->id_jenis_pembayaran ?>" hidden>
						<div class="form-group">
							<label for="nama_jenis">Nama Jenis</label>
							<input type="text" name="nama_jenis" class="form-control" id="nama_jenis" required value="<?= $jenis_pembayaran->nama_jenis ?>">
						</div>
						<div class="form-group">
							<label for="nominal">Nominal</label>
							<input type="number" name="nominal" class="form-control" id="nominal" required value="<?= $jenis_pembayaran->nominal ?>">
						</div>
						<div class="form-group">
							<label for="id_tahun_pelajaran">Tahun Pelajaran</label>
							<select name="id_tahun_pelajaran" id="id_tahun_pelajaran" class="form-control" required>
								<?php foreach ($tahun_pelajaran as $tp) : ?>
									<option value="<?= $tp->id_tahun_pelajaran ?>" <?php if ($jenis_pembayaran->id_tahun_pelajaran == $tp->id_tahun_pelajaran) : ?> selected <?php endif; ?>><?= $tp->tahun ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<button class="btn float-right btn-primary">Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
