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
      <form method="post" action="<?= base_url('kejadian/update/' . $kejadian->id) ?>" enctype="multipart/form-data">
        <?= csrf_field(); ?>

        <div class="form-group">
          <label for="Tanggal">Tanggal</label>
          <input type="date" placeholder="dd-mm-yyyy" class="form-control" id="Tanggal" name="Tanggal" value="<?= $kejadian->Tanggal; ?>" />
        </div>

        <div class="form-group">
          <label for="Pelapor">Pelapor</label>
          <input type="text" class="form-control" id="Pelapor" name="Pelapor" value="<?= $kejadian->Pelapor; ?>" />
        </div>

        <div class="form-group">
          <label for="Tanggal_Kejadian">Tanggal Kejadian</label>
          <input type="text" class="form-control" id="Tanggal_Kejadian" name="Tanggal_Kejadian" value="<?= $kejadian->Tanggal_Kejadian; ?>" />
        </div>

        <div class="form-group">
          <label for="Tempat_Kejadian">Tempat Kejadian</label>
          <input type="text" class="form-control" id="Tempat_Kejadian" name="Tempat_Kejadian" value="<?= $kejadian->Tempat_Kejadian; ?>" />
        </div>

        <div class="form-group">
          <label for="Jenis_Kejadian">Jenis Kejadian</label>
          <input type="text" class="form-control" id="Jenis_Kejadian" name="Jenis_Kejadian" value="<?= $kejadian->Jenis_Kejadian; ?>" />
        </div>

        <div class="form-group">
          <label for="Petugas">Petugas</label>
          <input type="text" class="form-control" id="Petugas" name="Petugas" value="<?= $kejadian->Petugas; ?>" />
        </div>

        <div class="form-group">
          <label for="Penyebab">Penyebab</label>
          <input type="text" class="form-control" id="Penyebab" name="Penyebab" value="<?= $kejadian->Penyebab; ?>" />
        </div>

        <div class="form-group">
          <label for="Akibat">Akibat</label>
          <input type="text" class="form-control" id="Akibat" name="Akibat" value="<?= $kejadian->Akibat; ?>" />
        </div>

        <div class="form-group">
          <label for="Kerugian">Kerugian</label>
          <input type="text" class="form-control" id="Kerugian" name="Kerugian" value="<?= $kejadian->Kerugian; ?>" />
        </div>

        <div class="form-group">
          <label for="Solusi">Solusi</label>
          <input type="text" class="form-control" id="Solusi" name="Solusi" value="<?= $kejadian->Solusi; ?>" />
        </div>

        <div class="form-group">
          <label for="Hasil">Hasil</label>
          <input type="text" class="form-control" id="Hasil" name="Hasil" value="<?= $kejadian->Hasil; ?>" />
        </div>

        <div class="form-group">
          <label for="Keterangan">Keterangan</label>
          <input type="text" class="form-control" id="Keterangan" name="Keterangan" value="<?= $kejadian->Keterangan ?>" />
        </div>

        <div class="form-group">
          <input type="submit" value="Update" class="btn btn-info" />
        </div>
      </form>
    </div>
  </div>
</div>
<?= $this->endSection('content'); ?>