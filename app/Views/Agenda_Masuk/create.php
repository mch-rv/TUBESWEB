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
            <form method="post" action="<?= base_url('masuk/store') ?> " enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="form-group">
                    <label for="Asal_Surat">Nama Instansi Yang Mengirim/Asal Surat</label>
                    <input type="text" class="form-control" id="Asal_Surat" name="Asal_Surat" value="<?= old('Asal_Surat') ?>" />
                </div>

                <div class="form-group">
                    <label for="Nomor">Nomor</label>
                    <input type="text" class="form-control" id="Nomor" name="Nomor" value="<?= old('Nomor') ?>" />
                </div>

                <div class="form-group">
                    <label for="Tanggal">Tanggal</label>
                    <input type="date" placeholder="dd-mm-yyyy" class="form-control" id="Tanggal" name="Tanggal" value="<?= old('Tanggal') ?>" />
                </div>


                <div class="form-group">
                    <label for="Perihal">Perihal</label>
                    <input type="text" class="form-control" id="Perihal" name="Perihal" value="<?= old('Perihal') ?>" />
                </div>

                <div class="form-group">
                    <label for="Penanggung_Jawab">Penanggung_Jawab</label>
                    <input type="text" class="form-control" id="Penanggung_Jawab" name="Penanggung_Jawab" value="<?= old('Penanggung_Jawab') ?>" />
                </div>
            
                <div class="form-group">
                    <label for="Tanggal_Penerimaan">Tanggal Penerimaan</label>
                    <input type="date" placeholder="dd-mm-yyyy" class="form-control" id="Tanggal_Penerimaan" name="Tanggal_Penerimaan" value="<?= old('Tanggal_Penerimaan') ?>" />
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