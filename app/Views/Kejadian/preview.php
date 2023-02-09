<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container">
  <div class="card">
    <div class="card-header">
      <h3>Preview Data</h3>
    </div>
    <div class="card-body">
      <div class="px-4 my-2">
        <table class="table table-borderless table-responsive">
          <tr>
            <th>Tanggal</th>
            <th> : </th>
            <td><?= $kejadian->Tanggal; ?></td>
          </tr>
          <tr>
            <th>Pelapor</th>
            <th> : </th>
            <td><?= $kejadian->Pelapor; ?></td>
          </tr>
          <tr>
            <th>Tanggal Kejadian</th>
            <th> : </th>
            <td><?= $kejadian->Tanggal_Kejadian; ?></td>
          </tr>
          <tr>
            <th>Tempat Kejadian</th>
            <th> : </th>
            <td><?= $kejadian->Tempat_Kejadian; ?></td>
          </tr>
          <tr>
            <th>Jenis Kejadian</th>
            <th> : </th>
            <td><?= $kejadian->Jenis_Kejadian; ?></td>
          </tr>
          <tr>
            <th>Petugas</th>
            <th> : </th>
            <td><?= $kejadian->Petugas; ?></td>
          </tr>
          <tr>
            <th>Penyebab</th>
            <th> : </th>
            <td><?= $kejadian->Penyebab; ?></td>
          </tr>
          <tr>
            <th>Akibat</th>
            <th> : </th>
            <td><?= $kejadian->Akibat; ?></td>
          </tr>
          <tr>
            <th>Kerugian</th>
            <th> : </th>
            <td><?= $kejadian->Kerugian; ?></td>
          </tr>
          <tr>
            <th>Solusi</th>
            <th> : </th>
            <td><?= $kejadian->Solusi; ?></td>
          </tr>
          <tr>
            <th>Hasil</th>
            <th> : </th>
            <td><?= $kejadian->Hasil; ?></td>
          </tr>
          <tr>
            <th>Keterangan</th>
            <th> : </th>
            <td><?= $kejadian->Keterangan; ?></td>
          </tr>
          <tr>
            <td>
              <a href="<?= base_url('kejadian'); ?>" class="btn btn-sm btn-outline-primary">Back</a>
              <?php if (session()->get('Role') == 'Admin' || session()->get('Role') == 'Staff') { ?>
                <a href="<?= base_url('kejadian/edit/' . $kejadian->id); ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                <a href="<?= base_url('kejadian/delete/' . $kejadian->id) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ?')" class="btn btn-sm btn-outline-danger">Delete</a>
              <?php } ?>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>