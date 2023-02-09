<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<link href="https://getbootstrap.com/docs/4.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<div class="container">
  <div class="card my-5">
    <div class="card-header">
      <h3>BUKU RUPA-RUPA KEJADIAN</h3>
    </div>
    <div class="card-body">
      <div class="container">
        <?php if (!empty(session()->getFlashdata('message'))) : ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo session()->getFlashdata('message'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif; ?>
        <?php if (!empty(session()->getFlashdata('error'))) : ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo session()->getFlashdata('error'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif; ?>
      </div>
      <?php if (session()->get('Role') == 'Admin' || session()->get('Role') == 'Staff') { ?>
        <div class="row justify-content-between my-2">
          <div class="col">
            <a href="<?= base_url('Kejadian/create'); ?>" class="btn btn-primary"><i class="fa-solid fa-square-plus mr-1"></i>Tambah</a>
            <a href="<?= base_url('Kejadian/generateword'); ?>" class="btn btn-info"><i class="fa-solid fa-file-arrow-down mr-1"></i>Ekspor Data</a>
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-file-arrow-up mr-1"></i>Impor Data
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="<?= base_url('/kejadian') ?>" data-bs-toggle="modal" data-bs-target="#Excel"><i class="fa-solid fa-upload mr-1"></i>Upload Excel</a></li>
              <li><a class="dropdown-item" href="<?= base_url('Format/Contoh_Format_Buku_Rupa_Rupa_Kejadian.xlsx') ?>"><i class="fa-solid fa-download mr-1"></i>Unduh Contoh Excel</a></li>
            </ul>
          </div>
          <div class="col-4">
            <form action="" method="post">
              <div class="input-group ">
                <?= csrf_field(); ?>
                <input type="text" class="form-control" placeholder="Cari Data.." name="keyword">
                <button class="btn btn-secondary" type="submit" name="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
              </div>
            </form>
          </div>
        </div>
        <hr />
      <?php } else { ?>
        <div class="row justify-content-between my-2">
          <div class="col">
            <a href="<?= base_url('kejadian/generateword'); ?>" class="btn btn-info"><i class="fa-solid fa-file-arrow-down mr-1"></i>Ekspor Data</a>
          </div>
          <div class="col-4">
            <form action="" method="post">
              <div class="input-group ">
                <?= csrf_field(); ?>
                <input type="text" class="form-control" placeholder="Cari Data.." name="keyword">
                <button class="btn btn-secondary" type="submit" name="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
              </div>
            </form>
          </div>
        </div>
        <hr />
      <?php } ?>

      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="text-center">
              <th class="align-middle">No</th>
              <th class="align-middle">Tanggal</th>
              <th class="align-middle">Pelapor</th>
              <th class="align-middle">Tanggal Kejadian</th>
              <th class="align-middle">Tempat Kejadian</th>
              <th class="align-middle">Jenis Kejadian</th>
              <th class="align-middle">Petugas</th>
              <th class="align-middle">Penyebab</th>
              <th class="align-middle">Akibat</th>
              <th class="align-middle">Kerugian</th>
              <th class="align-middle">Solusi</th>
              <th class="align-middle">Hasil</th>
              <th class="align-middle">Keterangan</th>
              <th class="align-middle">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no  = 1 + (10 * ($currentPage - 1));
            foreach ($kejadian as $row) {
            ?>
              <tr class="text-center">
                <td><?= $no++; ?></td>
                <td><?= $row->Tanggal; ?></td>
                <td><?= $row->Pelapor; ?></td>
                <td><?= $row->Tanggal_Kejadian; ?></td>
                <td><?= $row->Tempat_Kejadian; ?></td>
                <td><?= $row->Jenis_Kejadian; ?></td>
                <td><?= $row->Petugas; ?></td>
                <td><?= $row->Penyebab; ?></td>
                <td><?= $row->Akibat; ?></td>
                <td><?= $row->Kerugian; ?></td>
                <td><?= $row->Solusi; ?></td>
                <td><?= $row->Hasil; ?></td>
                <td><?= $row->Keterangan; ?></td>
                <?php if (session()->get('Role') == 'Admin' || session()->get('Role') == 'Staff') { ?>
                  <td>
                    <a href="<?= base_url('kejadian/preview/' . $row->id); ?>" class="btn btn-sm btn-outline-primary mb-1">Preview</a>
                    <a href="<?= base_url('kejadian/edit/' . $row->id); ?>" class="btn btn-sm btn-outline-secondary mb-1">Edit</a>
                    <a href="<?= base_url('kejadian/delete/' . $row->id) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ?')" class="btn btn-sm btn-outline-danger">Delete</a>
                  </td>
                <?php } else { ?>
                  <td>
                    <a href="<?= base_url('kejadian/preview/' . $row->id); ?>" class="btn btn-sm btn-outline-primary mb-1">Preview</a>
                  </td>
                <?php } ?>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
      <?= $pager->links('Kejadian', 'Perwal'); ?>
    </div>
  </div>
</div>
<!-- Modal -->
</div>
<div class="modal fade" id="Excel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Form Upload Excel</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= site_url('kejadian/import') ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <?= csrf_field(); ?>
          <label for="file_excel" class="form-label">Masukan File</label>
          <input type="file" name="file_excel" class="form-control" id="file_excel" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </Form>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<?= $this->endSection('content'); ?>