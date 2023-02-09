<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Tambah Data</h3>
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
            <form method="post" action="<?= base_url('ekspedisi/store') ?> " enctype="multipart/form-data">
                <?= csrf_field(); ?>

                <div class="form-group">
                    <label for="Tanggal_Surat_Kirim">Tanggal Surat Kirim</label>
                    <input type="date" placeholder="dd-mm-yyyy" class="form-control" id="Tanggal_Surat_Kirim" name="Tanggal_Surat_Kirim" value="<?= old('Tanggal_Surat_Kirim') ?>" />
                </div>

                <div class="form-group">
                    <label for="Nomor_Surat_Kirim">Nomor Surat Kirim</label>
                    <input type="text" class="form-control" id="Nomor_Surat_Kirim" name="Nomor_Surat_Kirim" value="<?= old('Nomor_Surat_Kirim') ?>" />
                </div>

                <div class="form-group">
                    <label for="Perihal">Perihal</label>
                    <input type="text" class="form-control" id="Perihal" name="Perihal" value="<?= old('Perihal') ?>" />
                </div>

                <div class="form-group">
                    <label for="Tujuan_Surat">Tujuan Surat</label>
                    <input type="text" class="form-control" id="Tujuan_Surat" name="Tujuan_Surat" value="<?= old('Tujuan_Surat') ?>" />
                </div>
            
                <div class="form-group">
                        <label for="TTD" class="form-label">TTD</label>
                        <input type="file" class="form-control" id="TTD" name="TTD">
                </div>

                <div class="form-group">
                    <label for="Keterangan">Keterangan</label>
                    <input type="text" class="form-control" id="Keterangan" name="Keterangan" value="<?= old('Keterangan') ?>" />
                </div>

                <div class="form-group">
                    <input type="submit" value="Simpan" class="btn btn-info" />
                </div>

            </form>
        </div>
    </div>
</div>
<?= $this->endSection('content'); ?>