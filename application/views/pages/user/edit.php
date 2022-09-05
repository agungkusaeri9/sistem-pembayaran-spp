<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h6>Edit User</h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('user/store') ?>" method="post">
						<input type="number" name="id_user" value="<?= $user->id_user ?>" hidden>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control" id="nama" required value="<?= $user->nama ?>">
                        </div>
						<div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" id="username" required value="<?= $user->username ?>" readonly>
                        </div>
						<div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Kosongkan jika tidak ingin merubah password">
                        </div>
						<div class="form-group">
							<label for="level">Level</label>
							<select name="level" id="level" class="form-control">
								<option value="" selected disabled>Pilih Level</option>
								<option value="admin"
								<?php if($user->level == 'admin') : ?>
								selected
								<?php endif; ?>
								>Admin</option>
								<option value="bendahara"
								<?php if($user->level == 'bendahara') : ?>
								selected
								<?php endif; ?>
								>Bendahara</option>
								<option value="siswa"
								<?php if($user->level == 'siswa') : ?>
								selected
								<?php endif; ?>
								>Siswa</option>
							</select>
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
