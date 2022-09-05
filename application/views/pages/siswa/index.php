<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h5>Data Siswa</h5>
                        <a href="<?= base_url('siswa/create') ?>" class="btn btn-primary">Tambah Siswa</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table dtable table-striped table-bordered dt-responsive nowra">
                        <thead>
                            <tr>
                                <th>No.</th>
								<th>NIS</th>
								<th>NISN</th>
                                <th>Nama</th>
								<th>Kelas</th>
								<th>Jurusan</th>
								<th>Jenis Kelamin</th>
								<th>Tempat/Tanggal Lahir</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                                    use Carbon\Carbon;

                                $i = 1;
                            ?>
                            <?php foreach($siswa as $sw) : ?>
                            <tr>
                                <td style="width:10px;" class="text-center"><?= $i++ ?></td>
                                <td><?= $sw->nis ?></td>
								<td><?= $sw->nisn ?></td>
								<td><?= $sw->nama_siswa ?></td>
								<td><?= $sw->kelas ?></td>
								<td><?= $sw->jurusan ?></td>
								<td><?= $sw->jenis_kelamin ?></td>
								<td><?= $sw->tempat_lahir . ', ' . Carbon::parse($sw->tanggal_lahir)->translatedFormat('d F Y') ?></td>
                                <td>
									<a href="<?= base_url('siswa/edit/') . $sw->id_siswa ?>" class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Edit</a>
									<form action="" method="post" id="formDelete" class="d-inline">
										<button class="btn btn-sm btn-danger btnDelete" data-id="<?= $sw->id_siswa ?>"><i class="fas fa-trash"></i> Hapus</button>
									</form>
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
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script>
	$(function(){
		$('.dtable').DataTable({
			
		});
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
                $('#formDelete').attr('action','<?= base_url('siswa/delete/') ?>' + id)
				$('#formDelete').submit();
				}
			})
		})
		
	})
</script>
<?php $this->load->view('layouts/partials/alert'); ?>

