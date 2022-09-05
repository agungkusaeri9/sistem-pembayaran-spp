<div class="container-fluid">
	<?php if($this->session->userdata('level') === 'siswa') : ?>
	 <div class="row">
		<div class="col-md-12">
			<div class="card">
			<form action="<?= base_url('pembayaran') ?>" method="post">
					<div class="card-body row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="id_tahun_pelajaran">Pilih Tahun Pelajaran</label>
								<select name="id_tahun_pelajaran" id="id_tahun_pelajaran" class="form-control">
									<?php foreach ($tahun_pelajaran as $tp) : ?>
										<option value="<?= $tp->id_tahun_pelajaran ?>"><?= $tp->tahun ?></option>
									<?php endforeach; ?>
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
							<a href="<?= base_url('laporan/print_pembayaran') ?>?id_tahun_pelajaran=<?= $id_tahun_pelajaran ?? '' ?>&id_siswa=<?= $id_siswa ?? '' ?>" target="_blank" class="btn btn-danger btn-block">Print</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	 </div>
	<?php endif; ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h5>Data Pembayaran</h5>
                       <?php if($this->session->userdata('level') !== 'siswa') : ?>
						<a href="<?= base_url('pembayaran/create') ?>" class="btn btn-primary">Tambah Pembayaran</a>
					   <?php endif; ?>
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
								<th>Tahun Pelajaran</th>
								<th>Jenis Pembayaran</th>
								<th>Bulan</th>
								<th>Nominal</th>
								<th>Status</th>
                               <?php if($this->session->userdata('level') === 'siswa') : ?>
								<?php else : ?>
									<th>Aksi</th>
							   <?php endif; ?>
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
								<td><?= $pmb->tahun_pelajaran ?></td>
								<td><?= $pmb->nama_jenis ?></td>
								<td><?= bulan($pmb->bulan) ?></td>
								<td><?= number_format($pmb->nominal) ?></td>
								<td>
									<?php if($pmb->status == 1) : ?>
									 <span class="badge badge-success">Lunas</span>
									<?php elseif($pmb->status == 2) : ?>
										<span class="badge badge-danger">Belum</span>
									<?php else: ?>
										<span class="badge badge-warning">Dalam Proses</span>
									<?php endif; ?>
								</td>
								<?php if($this->session->userdata('level') === 'siswa') : ?>
								<?php else : ?>
									<td>
									<a href="<?= base_url('pembayaran/edit/') . $pmb->id_pembayaran ?>" class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Edit</a>
									<form action="" method="post" id="formDelete" class="d-inline">
										<button class="btn btn-sm btn-danger btnDelete" data-id="<?= $pmb->id_pembayaran ?>"><i class="fas fa-trash"></i> Hapus</button>
									</form>
								</td>
							   <?php endif; ?>
                               
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
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
		$('body').on('click','.btnDelete', function(e){
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
                $('#formDelete').attr('action','<?= base_url('pembayaran/delete/') ?>' + id)
				$('#formDelete').submit();
				}
			})
		})
		
	})
</script>
<?php $this->load->view('layouts/partials/alert'); ?>

