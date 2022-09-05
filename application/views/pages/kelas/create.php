<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h6>Tambah Kelas</h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('kelas/store') ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nama_kelas">Nama kelas</label>
                            <input type="text" name="nama_kelas" class="form-control" id="nama_kelas" required>
                        </div>
						<div class="form-group">
							<label for="id_jurusan">Jurusan</label>
							<select name="id_jurusan" id="id_jurusan" class="form-control" required>
								<?php foreach($jurusan as $jrs) : ?>
								 <option value="<?= $jrs->id_jurusan?>"><?= $jrs->nama_jurusan ?></option>
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
