<div class="container-fluid">
<div class="row">
		<div class="col-md-12">
			<div class="card">
				<form action="<?= base_url('laporan/pembayaran') ?>" method="post">
					<div class="card-body row">
						<div class="col-md-3">
							<div class="form-group">
								<label for="id_tahun_pelajaran">Pilih Tahun Pelajaran</label>
								<select name="id_tahun_pelajaran" id="id_tahun_pelajaran" class="form-control">
								<option value="" selected>Semua Tahun Pelajaran</option>
									<?php foreach ($tahun_pelajaran as $tp) : ?>
										<option value="<?= $tp->id_tahun_pelajaran ?>"><?= $tp->tahun ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="id_jurusan">Pilih Jurusan</label>
								<select name="id_jurusan" id="id_jurusan" class="form-control">
									<option value="" selected>Semua Jurusan</option>
									<?php foreach ($jurusan as $jrs) : ?>
										<option value="<?= $jrs->id_jurusan ?>"><?= $jrs->nama_jurusan ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="id_kelas">Pilih Kelas</label>
								<select name="id_kelas" id="id_kelas" class="form-control">
									<option value="" selected>Semua Kelas</option>
									
								</select>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="id_siswa">Pilih Siswa</label>
								<select name="id_siswa" id="id_siswa" class="form-control">
									<option value="" selected>Semua Siswa</option>
									
								</select>
							</div>
						</div>
						<div class="col-md-1 align-self-end">
							<div class="form-group">
								<button class="btn btn-secondary btn-block">Filter</button>
							</div>
						</div>
						<div class="col-md-1 align-self-end">
							<div class="form-group">
							<a href="<?= base_url('laporan/print_pembayaran') ?>?id_tahun_pelajaran=<?= $id_tahun_pelajaran ?? '' ?>&id_jurusan=<?= $id_jurusan ?? '' ?>&id_kelas=<?= $id_kelas ?? '' ?>&id_siswa=<?= $id_siswa ?? '' ?>" target="_blank" class="btn btn-danger btn-block">Print</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h5>Data Pembayaran</h5>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table dtable table-striped table-bordered dt-responsive nowra">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>NISN</th>
								<th>Nama Siswa</th>
								<th>Kelas</th>
								<th>Jurusan</th>
								<th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 1;
                            ?>
                            <?php foreach($pembayaran as $pmb) : ?>
                            <tr>
                                <td style="width:10px;" class="text-center"><?= $i++ ?></td>
								<td><?= $pmb->nisn ?></td>
                                <td><?= $pmb->nama_siswa ?></td>
								<td><?= $pmb->nama_kelas ?></td>
								<td><?= $pmb->nama_jurusan ?></td>
								<td>
									<button class="btn btn-sm btn-info btnDetail" data-idsiswa="<?= $pmb->id_siswa ?>" data-url="<?= base_url('laporan/detail_pembayaran/' . $pmb->id_siswa) ?>">Detail</button>
								</td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script>
	$(function(){
		$('.dtable').DataTable();
		$('#id_jurusan').on('change', function() {
			let id_jurusan = $(this).val();
			$.ajax({
				url: '<?= base_url('kelas/geByJurusan/') ?>' + id_jurusan,
				type: 'POST',
				dataType: 'JSON',
				success: function(response) {
					$('#id_kelas').empty();
					$('#id_kelas').append('<option value="" selected>Semua Kelas</option>');
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
				success: function(response) {
					$('#id_siswa').empty();
					$('#id_siswa').append('<option value="" selected>Semua Kelas</option>');
					response.forEach(res => {
						$('#id_siswa').append('<option value="' + res.id_siswa + '">' + res.nama_siswa + ' - ' + res.nisn + '</option>');
					});

				}
			})
		})

		$('body').on('click','.btnDetail', function(){
			let id_siswa = $(this).data('idsiswa');
			let url = $(this).data('url');
			$('#modalDetail').modal('show');
			$('#modalDetail').find('.modal-body').load(url);
			console.log(id_siswa);
		})
		
	})
</script>

