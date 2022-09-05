<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="d-flex justify-content-between">
						<h5>Data Tagihan</h5>
					</div>
				</div>
				<div class="card-body">
					<table class="table dtable table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th>No.</th>
								<th>Tahun Pelajaran</th>
								<th>Nama Pembayaran</th>
								<th>Bulan</th>
								<th>Nominal</th>
								<th>Status</th>
								<th>Bukti Pembayaran</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i = 1;
							?>
							<?php foreach ($pembayaran_tahun_pelajaran as $ptp) : ?>
								<tr>
									<td style="width:10px;" class="text-center"><?= $i++ ?></td>
									<td><?= $ptp->tahun_pelajaran ?></td>
									<td><?= $ptp->nama_jenis ?></td>
									<td><?= bulan($ptp->bulan) ?></td>
									<td>Rp. <?= number_format($ptp->nominal) ?></td>
									<td>
										<?= cekPembayaran($this->session->userdata('id_siswa'), $ptp->id_pembayaran_tahun_pelajaran, $ptp->bulan) ?>
									</td>
									<td>
										<?php

										$pm = cekPembayaran2($this->session->userdata('id_siswa'), $ptp->id_pembayaran_tahun_pelajaran, $ptp->bulan);
										?>
										<?php if ($pm === false) : ?>
											<button class="badge badge-secondary btnUpload" data-idsiswa="<?= $this->session->userdata('id_siswa') ?>" data-idpembayarantahunpelajaran="<?= $ptp->id_pembayaran_tahun_pelajaran ?>" data-nominal="<?= $ptp->nominal ?>">Upload</button>
										<?php else : ?>
											-
										<?php endif; ?>

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
<div class="modal fade" id="modalUpload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Upload Bukti Pembayaran</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="tagihan/upload_bukti" method="post" enctype="multipart/form-data">
				<div class="modal-body">
					<input type="number" name="id_siswa" id="id_siswa" hidden>
					<input type="number" name="id_pembayaran_tahun_pelajaran" id="id_pembayaran_tahun_pelajaran" hidden>
					<input type="number" name="nominal" id="nominal" hidden>
					<div class="form-group">
						<label for="bukti_pembayaran">Foto Bukti</label>
						<input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="form-control">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Upload</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script>
	$(function() {
		$('.dtable').DataTable();
		$('body').on('click', '.btnDelete', function(e) {
			var id = $(this).data('id');
			e.preventDefault();
			Swal.fire({
				title: 'Apakah anda yakin ingin menghapus data ini?',
				text: "Data yang sudah dihapus tidak bisa dikembalikan lagi!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
				if (result.isConfirmed) {
					$('#formDelete').attr('action', '<?= base_url('pembayaran_tahun_pelajaran/delete/') ?>' + id)
					$('#formDelete').submit();
				}
			})
		})

		$('body').on('click','.btnUpload',function(){
			let id_siswa = $(this).data('idsiswa');
			let id_pembayaran_tahun_pelajaran = $(this).data('idpembayarantahunpelajaran');
			let nominal = $(this).data('nominal');
			$('#id_siswa').val(id_siswa);
			$('#id_pembayaran_tahun_pelajaran').val(id_pembayaran_tahun_pelajaran);
			$('#nominal').val(nominal);
			$('#modalUpload').modal('show');
		})

	})
</script>
<?php $this->load->view('layouts/partials/alert'); ?>
