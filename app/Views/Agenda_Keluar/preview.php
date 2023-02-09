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
                        <th>Nama Instansi Yang Dituju</th>
                        <th> : </th>
                        <td><?= $keluar->Instansi_Yang_Dituju; ?></td>
                    </tr>
                    <tr>
                        <th>Nomor</th>
                        <th> : </th>
                        <td><?= $keluar->Nomor; ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <th> : </th>
                        <td><?= $keluar->Tanggal; ?></td>
                    </tr>
                    <tr>
                        <th>Perihal</th>
                        <th> : </th>
                        <td><?= $keluar->Perihal; ?></td>
                    </tr>
                    <tr>
                        <th>Penanggung Jawab Pengelola</th>
                        <th> : </th>
                        <td><?= $keluar->Penanggung_Jawab; ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Pengiriman</th>
                        <th> : </th>
                        <td><?= $keluar->Tanggal_Pengiriman; ?></td>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <th> : </th>
                        <td><?= $keluar->Keterangan; ?></td>
                    </tr>
                    <tr>
                        <td>
                            <a href="<?= base_url('keluar'); ?>" class="btn btn-sm btn-outline-primary">Back</a>
                            <?php if(session()->get('Role')=='Admin'||session()->get('Role')=='Staff'){?>
                                <a href="<?= base_url('keluar/edit/'.$keluar->id); ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                                <a href="<?= base_url('keluar/delete/'.$keluar->id) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ?')" class="btn btn-sm btn-outline-danger">Delete</a>
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