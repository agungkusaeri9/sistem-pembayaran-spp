<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h6>Tambah Kependidikan</h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('tenaga_kependidikan/store') ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control" id="nama">
                        </div>
						<div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="3"></textarea>
                        </div>
						<div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                           <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
							<option value="" selected disabled>Pilih Jenis Kelamin</option>
							<option value="L">Laki-laki</option>
							<option value="P">Perempuan</option>
						   </select>
                        </div>
						<div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" name="jabatan" class="form-control" id="jabatan">
                        </div>
						<div class="form-group">
                            <label for="no_induk">No. Induk</label>
                            <input type="text" name="no_induk" class="form-control" id="no_induk">
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
