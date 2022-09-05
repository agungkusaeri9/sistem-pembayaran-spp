<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h6>Tambah Siswa</h6>
				</div>
				<div class="card-body">
					<form action="<?= base_url('siswa/store') ?>" method="post" enctype="multipart/form-data">
						<div class="row">
							<div class="col-6">
								<div class="form-group">
									<label for="id_tahun_pelajaran">Tahun Pelajaran</label>
									<select name="id_tahun_pelajaran" id="id_tahun_pelajaran" class="form-control" required>
										<?php foreach ($tahun_pelajaran as $tp) : ?>
											<option value="<?= $tp->id_tahun_pelajaran ?>"><?= $tp->tahun ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="form-group">
									<label for="nis">NIS</label>
									<input type="number" name="nis" class="form-control" id="nis" required>
								</div>
								<div class="form-group">
									<label for="nisn">NISN</label>
									<input type="number" name="nisn" class="form-control" id="nisn" required>
								</div>
								<div class="form-group">
									<label for="nama_siswa">Nama</label>
									<input type="text" name="nama_siswa" class="form-control" id="nama_siswa" required>
								</div>
								<div class="form-group">
									<label for="id_jurusan">Jurusan</label>
									<select name="id_jurusan" id="id_jurusan" class="form-control" required>
										<option value="" selected disabled>Pilih Jurusan</option>
										<?php foreach ($jurusan as $jrs) : ?>
											<option value="<?= $jrs->id_jurusan ?>"><?= $jrs->nama_jurusan ?></option>
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
										<option value="L">Laki-laki</option>
										<option value="P">Perempuan</option>
									</select>
								</div>
								<div class="form-group">
									<label for="agama">Agama</label>
									<select name="agama" id="agama" class="form-control" required>
										<option value="" selected disabled>Pilih Agama</option>
										<option value="Islam">Islam</option>
										<option value="Protestan">Protestan</option>
										<option value="Katolik">Katolik</option>
										<option value="Hindu">Hindu</option>
										<option value="Budha">Budha</option>
										<option value="Khonghucu">Khonghucu</option>
									</select>
								</div>
								<div class="form-group">
									<label for="tempat_lahir">Tempat Lahir</label>
									<input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" required>
								</div>
							</div>
							<div class="col-6">
								
								<div class="form-group">
									<label for="tanggal_lahir">Tanggal Lahir</label>
									<input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" required>
								</div>
								<div class="form-group">
									<label for="nama_ayah">Nama Ayah</label>
									<input type="text" name="nama_ayah" class="form-control" id="nama_ayah" required>
								</div>
								<div class="form-group">
									<label for="nama_ibu">Nama Ibu</label>
									<input type="text" name="nama_ibu" class="form-control" id="nama_ibu" required>
								</div>
								<div class="form-group">
									<label for="alamat_orang_tua">Alamat Orang Tua</label>
									<textarea name="alamat_orang_tua" id="alamat_orang_tua" cols="30" rows="4" class="form-control"></textarea>
								</div>
								<div class="form-group">
									<label for="username">Username</label>
									<input type="text" name="username" class="form-control" id="username" required readonly>
								</div>
								<div class="form-group">
									<label for="password">Password</label>
									<input type="text" name="password" class="form-control" id="password" required>
								</div>
							</div>
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
<script>
	$(function() {
		$('#nisn').on('keyup', function(){
			let nisn = $(this).val();
			console.log(nisn);
			$('#username').val(nisn);
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
