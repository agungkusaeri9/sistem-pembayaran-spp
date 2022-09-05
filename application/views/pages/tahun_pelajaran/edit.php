<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h6>Edit Tahun Pelajaran</h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('tahun_pelajaran/store') ?>" method="post">
					<input type="number" id="id" name="id_tahun_pelajaran" value="<?= $tahun_pelajaran->id_tahun_pelajaran ?>" hidden>
                        <div class="form-group">
                            <label for="tahun">Tahun</label>
                            <input type="text" name="tahun" class="form-control" id="tahun" value="<?= $tahun_pelajaran->tahun ?>">
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
