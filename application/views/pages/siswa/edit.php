<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h6>Edit Siswa</h6>
				</div>
				<div class="card-body">
					<form action="<?= base_url('siswa/store') ?>" method="post">
						<input type="number" name="id_siswa" value="<?= $siswa->id_siswa ?>" hidden>
						<div class="row">
							<div class="col-6">
								<div class="form-group">
									<label for="id_tahun_pelajaran">Tahun Pelajaran</label>
									<select name="id_tahun_pelajaran" id="id_tahun_pelajaran" class="form-control" required>
										<?php foreach ($tahun_pelajaran as $tp) : ?>
											<option value="<?= $tp->id_tahun_pelajaran ?>" <?php if ($tp->id_tahun_pelajaran == $siswa->id_tahun_pelajaran) : ?> selected <?php endif; ?>><?= $tp->tahun ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="form-group">
									<label for="nis">NIS</label>
									<input type="number" name="nis" class="form-control" id="nis" required value="<?= $siswa->nis ?>">
								</div>
								<div class="form-group">
									<label for="nisn">NISN</label>
									<input type="number" name="nisn" class="form-control" id="nisn" required value="<?= $siswa->nisn ?>">
								</div>
								<div class="form-group">
									<label for="nama_siswa">Nama</label>
									<input type="text" name="nama_siswa" class="form-control" id="nama_siswa" required value="<?= $siswa->nama_siswa ?>">
								</div>
								<div class="form-group">
									<label for="id_jurusan">Jurusan</label>
									<select name="id_jurusan" id="id_jurusan" class="form-control" required>
										<option value="" selected disabled>Pilih Jurusan</option>
										<?php foreach ($jurusan as $jrs) : ?>
											<option value="<?= $jrs->id_jurusan ?>"
											<?php if ($jrs->id_jurusan == $siswa->id_jurusan) : ?> selected <?php endif; ?>><?= $jrs->nama_jurusan ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="form-group">
									<label for="id_kelas">Kelas</label>
									<select name="id_kelas" id="id_kelas" class="form-control" required>
										<option value="" selected disabled>Pilih Kelas</option>
									</select>
								</div>
								<div class="form-group">
									<label for="jenis_kelamin">Jenis Kelamin</label>
									<select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
										<option value="" selected disabled>Pilih Jenis Kelamin</option>
										<option value="L" <?php if ($siswa->jenis_kelamin === 'L') : ?> selected <?php endif; ?>>Laki-laki</option>
										<option value="P" <?php if ($siswa->jenis_kelamin === 'P') : ?> selected <?php endif; ?>>Perempuan</option>
									</select>
								</div>
								<div class="form-group">
									<label for="agama">Agama</label>
									<select name="agama" id="agama" class="form-control" required>
										<option value="" selected disabled>Pilih Agama</option>
										<option value="Islam" <?php if ($siswa->agama === 'Islam') : ?> selected <?php endif; ?>>Islam</option>
										<option value="Protestan" <?php if ($siswa->agama === 'Protestan') : ?> selected <?php endif; ?>>Protestan</option>
										<option value="Katolik" <?php if ($siswa->agama === 'Katolik') : ?> selected <?php endif; ?>>Katolik</option>
										<option value="Hindu" <?php if ($siswa->agama === 'Hindu') : ?> selected <?php endif; ?>>Hindu</option>
										<option value="Budha" <?php if ($siswa->agama === 'Budha') : ?> selected <?php endif; ?>>Budha</option>
										<option value="Khonghucu">Khonghucu</option>
									</select>
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
									<label for="tempat_lahir">Tempat Lahir</label>
									<input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" required value="<?= $siswa->tempat_lahir ?>">
								</div>
								<div class="form-group">
									<label for="tanggal_lahir">Tanggal Lahir</label>
									<input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" required value="<?= $siswa->tanggal_lahir ?>">
								</div>
								<div class="form-group">
									<label for="nama_ayah">Nama Ayah</label>
									<input type="text" name="nama_ayah" class="form-control" id="nama_ayah" required value="<?= $siswa->nama_ayah ?>">
								</div>
								<div class="form-group">
									<label for="nama_ibu">Nama Ibu</label>
									<input type="text" name="nama_ibu" class="form-control" id="nama_ibu" required value="<?= $siswa->nama_ibu ?>">
								</div>
								<div class="form-group">
									<label for="alamat_orang_tua">Alamat Orang Tua</label>
									<textarea name="alamat_orang_tua" id="alamat_orang_tua" cols="30" rows="4" class="form-control"><?= $siswa->alamat_orang_tua ?></textarea>
								</div>
							</div>
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
<script>
	$(function() {
		let id_kelas = '<?= $siswa->id_kelas ?>';
		$.ajax({
			url: '<?= base_url('kelas/getKelas/') ?>' + id_kelas,
			type: 'POST',
			dataType: 'JSON',
			success: function(response) {
				$('#id_kelas').empty();
				$('#id_kelas').append('<option value="" selected disabled>Pilih Kelas</option>');
				$.ajax({
					url: '<?= base_url('kelas/geByJurusan/') ?>' + response.id_jurusan,
					type: 'POST',
					dataType: 'JSON',
					success: function(response2) {
						$('#id_kelas').empty();
						$('#id_kelas').append('<option value="" selected disabled>Pilih Kelas</option>');
						response2.forEach(res => {
							if(res.id_kelas === response.id_kelas)
							{
								$('#id_kelas').append('<option value="' + res.id_kelas + '" selected>' + res.nama_kelas + '</option>');
							}else{
								$('#id_kelas').append('<option value="' + res.id_kelas + '">' + res.nama_kelas + '</option>');
							}
						});

					}
				})

			}
		})
		$('#id_jurusan').on('change', function() {
			let id_jurusan = $(this).val();
			$.ajax({
				url: '<?= base_url('kelas/geByJurusan/') ?>' + id_jurusan,
				type: 'POST',
				dataType: 'JSON',
				success: function(response) {
					$('#id_kelas').empty();
					$('#id_kelas').append('<option value="" selected disabled>Pilih Kelas</option>');
					response.forEach(res => {
						$('#id_kelas').append('<option value="' + res.id_kelas + '">' + res.nama_kelas + '</option>');
					});

				}
			})
		})
	})
</script>
