<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h6>Edit Pembayaran</h6>
				</div>
				<div class="card-body">
					<form action="<?= base_url('pembayaran/store') ?>" method="post">
						<input type="number" id="id" name="id_pembayaran" value="<?= $pembayaran->id_pembayaran ?>" hidden>
						<div class="form-group">
							<label for="nisn">NISN</label>
							<input type="text" name="nisn" class="form-control" id="nisn" value="<?= $pembayaran->nisn ?>" readonly>
						</div>
						<div class="form-group">
							<label for="id_siswa">Nama</label>
							<input type="text" name="id_siswa" class="form-control" id="id_siswa" value="<?= $pembayaran->nama_siswa ?>" readonly>
						</div>
						<div class="form-group">
							<label for="id_kelas">Kelas</label>
							<input type="text" name="id_kelas" class="form-control" id="id_kelas" value="<?= $pembayaran->nama_kelas ?>" readonly>
						</div>
						<div class="form-group">
							<label for="id_jurusan">Jurusan</label>
							<input type="text" name="id_jurusan" class="form-control" id="id_jurusan" value="<?= $pembayaran->nama_jurusan ?>" readonly>
						</div>
						<div class="form-group">
							<label for="id_tahun_pelajaran">Tahun Pelajaran</label>
							<input type="text" name="id_tahun_pelajaran" class="form-control" id="id_tahun_pelajaran" value="<?= $pembayaran->tahun_pelajaran ?>" readonly>
						</div>
						<div class="form-group">
							<label for="id_jenis_pembayaran">Jenis Pembayaran</label>
							<input type="text" name="id_jenis_pembayaran" class="form-control" id="id_jenis_pembayaran" value="<?= $pembayaran->nama_jenis ?>" readonly>
						</div>
						<div class="form-group">
							<label for="nominal">Nominal</label>
							<input type="text" name="nominal" class="form-control" id="nominal" value="<?= number_format($pembayaran->nominal) ?>" readonly>
						</div>
						<div class="form-group">
							<label for="status">Status</label>
							<select name="status" id="status" class="form-control">
								<option value="0" <?php if ($pembayaran->status == 0) : ?> selected <?php endif; ?>>Dalam Proses</option>
								<option value="1" <?php if ($pembayaran->status == 1) : ?> selected <?php endif; ?>>Lunas</option>
								<option value="2" <?php if ($pembayaran->status == 2) : ?> selected <?php endif; ?>>Belum</option>
							</select>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<label for="bukti_pembayaran">Bukti Pembayaran</label>
								<?php if ($pembayaran->bukti_pembayaran) : ?>
									<img src="<?= base_url() ?>uploads/bukti_pembayaran/<?= $pembayaran->bukti_pembayaran ?>" class="img-fluid img" alt="" data-src="<?= base_url() ?>uploads/bukti_pembayaran/<?= $pembayaran->bukti_pembayaran ?>">
								<?php else : ?>
									Tidak Ada
								<?php endif; ?>
							</div>
							<div class="col-md-9 align-self-center">
								<input type="file" name="bukti_pembayaran" class="form-control" id="bukti_pembayaran">
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
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <img src="" class="img-fluid w-100 modalImage" alt="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
	$(function(){
		$('.img').on('click',function(){
			let src = $(this).data('src');
			console.log(src);
			$('.modalImage').attr('src',src);
			$('#myModal').modal('show');
		})
	})
</script>
