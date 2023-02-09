<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container mb-5">
    <div class="card">
        <div class="card-header">
            <h3>Update Data</h3>
        </div>
        <div class="card-body">
            <?php if (!empty(session()->getFlashdata('error'))) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h4>Periksa Entrian Form</h4>
                    </hr />
                    <?php echo session()->getFlashdata('error'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <form method="post" action="<?= base_url('ekspedisi/update/'.$ekspedisi->id) ?>" enctype="multipart/form-data">
                <?= csrf_field(); ?>

                <div class="form-group">
                    <label for="Tanggal_Surat_Kirim">Tanggal Surat Kirim</label>
                    <input type="date" placeholder="dd-mm-yyyy"  class="form-control" id="Tanggal_Surat_Kirim" name="Tanggal_Surat_Kirim" value="<?= $ekspedisi->Tanggal_Surat_Kirim; ?>" />
                </div>

                <div class="form-group">
                    <label for="Nomor_Surat_Kirim">Nomor Surat Kirim</label>
                    <input type="text" class="form-control" id="Nomor_Surat_Kirim" name="Nomor_Surat_Kirim" value="<?= $ekspedisi->Nomor_Surat_Kirim; ?>"/>
                </div>

                <div class="form-group">
                    <label for="Perihal">Perihal</label>
                    <input type="text" class="form-control" id="Perihal" name="Perihal" value="<?= $ekspedisi->Perihal; ?>" />
                </div>

                <div class="form-group">
                    <label for="Tujuan_Surat">Tujuan Surat</label>
                    <input type="text" class="form-control" id="Tujuan_Surat" name="Tujuan_Surat" value="<?= $ekspedisi->Tujuan_Surat; ?>" />
                </div>

                <div class="form-group">
                        <label for="TTD" class="form-label">TTD</label><br>
                        <img width="150px" class="img-thumbnail mb-3" src="<?= base_url() . "/uploads/berkas/" . $ekspedisi->TTD; ?>"/>
                        <input type="file" class="form-control" id="TTD" name="TTD">
                </div>

                <div class="form-group">
                    <label for="Keterangan">Keterangan</label>
                    <input type="text" class="form-control" id="Keterangan" name="Keterangan" value="<?= $ekspedisi->Keterangan ?>" />
                </div>

                <div class="form-group">
                    <input type="submit" value="Update" class="btn btn-info" />
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection('content'); ?>