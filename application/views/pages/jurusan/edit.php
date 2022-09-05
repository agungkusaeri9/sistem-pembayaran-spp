<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h6>Edit Jurusan</h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('jurusan/store') ?>" method="post">
					<input type="number" id="id" name="id_jurusan" value="<?= $jurusan->id_jurusan ?>" hidden>
                        <div class="form-group">
                            <label for="nama_jurusan">Nama</label>
                            <input type="text" name="nama_jurusan" class="form-control" id="nama_jurusan" value="<?= $jurusan->nama_jurusan ?>">
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
