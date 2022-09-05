<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h6>Tambah Pembayaran</h6>
				</div>
				<div class="card-body">
					<form action="<?= base_url('pembayaran/store') ?>" method="post" enctype="multipart/form-data">
						<!-- <div class="form-group">
                            <label for="nama_kelas">Nama kelas</label>
                            <input type="text" name="nama_kelas" class="form-control" id="nama_kelas" required>
                        </div> -->
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
							<label for="id_siswa">Siswa</label>
							<select name="id_siswa" id="id_siswa" class="form-control" required>
								<option value="" selected disabled>Pilih Siswa</option>
							</select>
						</div>
						<div class="form-group">
							<label for="id_tahun_pelajaran">Tahun Pelajaran</label>
							<select name="id_tahun_pelajaran" id="id_tahun_pelajaran" class="form-control" required>
								<option value="" selected disabled>Pilih Tahun Pelajaran</option>
								<?php foreach ($tahun_pelajaran as $tp) : ?>
									<option value="<?= $tp->id_tahun_pelajaran ?>"><?= $tp->tahun  ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label for="id_jenis_pembayaran">Jenis Pembayaran</label>
							<select name="id_jenis_pembayaran" id="id_jenis_pembayaran" class="form-control" required>
								<option value="" selected disabled>Pilih Jenis Pembayaran</option>
							</select>
						</div>
						<div class="form-group">
							<label for="id_pembayaran_tahun_pelajaran">Bulan</label>
							<!-- <select name="id_pembayaran_tahun_pelajaran" id="id_pembayaran_tahun_pelajaran" class="form-control" required>
								<option value="" selected disabled>Pilih Bulan</option>
							</select> -->
							<div id="id_pembayaran_tahun_pelajaran">

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
		$('#id_kelas').on('change', function() {
			let id_kelas = $(this).val();
			$.ajax({
				url: '<?= base_url('siswa/getByKelas/') ?>' + id_kelas,
				type: 'POST',
				dataType: 'JSON',
				success: function(d_siswa) {
					$('#id_siswa').empty();
					$('#id_siswa').append('<option value="" selected disabled>Pilih Siswa</option>');
					d_siswa.forEach(res => {
						$('#id_siswa').append('<option value="' + res.id_siswa + '">' + res.nama_siswa + ' - ' + res.nisn + '</option>');
					});

				}
			})
		})
		$('#id_tahun_pelajaran').on('change', function() {
			let id_tahun_pelajaran = $(this).val();
			$.ajax({
				url: '<?= base_url('jenis_pembayaran/getByTahunPelajaran/') ?>' + id_tahun_pelajaran,
				type: 'POST',
				dataType: 'JSON',
				success: function(d_jenispembayaran) {
					$('#id_jenis_pembayaran').empty();
					$('#id_jenis_pembayaran').append('<option value="" selected disabled>Pilih Jenis Pembayaran</option>');
					d_jenispembayaran.forEach(res => {
						$('#id_jenis_pembayaran').append('<option value="' + res.id_jenis_pembayaran + '">' + res.nama_jenis + ' - ' + res.nominal + '</option>');
					});

				}
			})

			$('#id_jenis_pembayaran').on('change', function() {
				let idjp = $(this).val();
				$.ajax({
					url: '<?= base_url('pembayaran_tahun_pelajaran/getByJenisPembayaran/') ?>' + idjp,
					type: 'POST',
					dataType: 'JSON',
					success: function(d_pjp) {
						var bulan2 = '';
						$('#id_pembayaran_tahun_pelajaran').empty();
						// $('#id_pembayaran_tahun_pelajaran').append('<option value="" selected disabled>Pilih Bulan</option>');
						d_pjp.forEach(res => {
							// $('#id_pembayaran_tahun_pelajaran').append('<option value="' + res.id_pembayaran_tahun_pelajaran + '">' + res.bulan + '</option>');
							$('#id_pembayaran_tahun_pelajaran').append('<div class="form-check"><input class="form-check-input" name="id_pembayaran_tahun_pelajaran[]" type="checkbox" value="'+res.id_pembayaran_tahun_pelajaran+'" id="id_pembayaran_tahun_pelajaran"><label class="form-check-label" for="id_pembayaran_tahun_pelajaran">' + res.bulan + '</label></div>');
						});

					}
				})
			})
		})
	})
</script>
