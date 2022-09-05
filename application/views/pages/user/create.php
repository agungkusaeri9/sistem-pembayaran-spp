<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h6>Tambah User</h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('user/store') ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control" id="nama">
                        </div>
						<div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" id="username">
                        </div>
						<div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password">
                        </div>
						<div class="form-group">
                            <label for="konfirmasi_password">Konfirmasi Password</label>
                            <input type="password" name="konfirmasi_password" class="form-control" id="konfirmasi_password">
                        </div>
						<div class="form-group">
							<label for="level">Level</label>
							<select name="level" id="level" class="form-control">
								<option value="" selected disabled>Pilih Level</option>
								<option value="admin">Admin</option>
								<option value="bendahara">Bendahara</option>
								<option value="siswa">Siswa</option>
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
