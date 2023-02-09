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
                        <th>Nama Instansi Yang Mengirim/Asal Surat</th>
                        <th> : </th>
                        <td><?= $masuk->Asal_Surat; ?></td>
                    </tr>
                    <tr>
                        <th>Nomor</th>
                        <th> : </th>
                        <td><?= $masuk->Nomor; ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <th> : </th>
                        <td><?= $masuk->Tanggal; ?></td>
                    </tr>
                    <tr>
                        <th>Perihal</th>
                        <th> : </th>
                        <td><?= $masuk->Perihal; ?></td>
                    </tr>
                    <tr>
                        <th>Penanggung Jawab Pengelola</th>
                        <th> : </th>
                        <td><?= $masuk->Penanggung_Jawab; ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Penerimaan</th>
                        <th> : </th>
                        <td><?= $masuk->Tanggal_Penerimaan; ?></td>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <th> : </th>
                        <td><?= $masuk->Keterangan; ?></td>
                    </tr>
                    <tr>
                        <td>
                            <a href="<?= base_url('masuk'); ?>" class="btn btn-sm btn-outline-primary">Back</a>
                            <?php if(session()->get('Role')=='Admin'||session()->get('Role')=='Staff'){?>
                                <a href="<?= base_url('masuk/edit/'.$masuk->id); ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                                <a href="<?= base_url('masuk/delete/'.$masuk->id) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ?')" class="btn btn-sm btn-outline-danger">Delete</a>
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