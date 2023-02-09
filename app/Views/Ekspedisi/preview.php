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
                        <th>Tanggal Surat Kirim</th>
                        <th> : </th>
                        <td><?= $ekspedisi->Tanggal_Surat_Kirim; ?></td>
                    </tr>
                    <tr>
                        <th>Nomor Surat Kirim</th>
                        <th> : </th>
                        <td><?= $ekspedisi->Nomor_Surat_Kirim; ?></td>
                    </tr>
                    <tr>
                        <th>Perihal</th>
                        <th> : </th>
                        <td><?= $ekspedisi->Perihal; ?></td>
                    </tr>
                    <tr>
                        <th>Tujuan Surat</th>
                        <th> : </th>
                        <td><?= $ekspedisi->Tujuan_Surat; ?></td>
                    </tr>
                    <tr>
                        <th>Tanda Tangan Penerima</th>
                        <th> : </th>
                        <td> 
                            <?php if ($ekspedisi->TTD!='no_image.png'){?>
                                <img width="75px" height="60px" class="img-thumbnail" src="<?= base_url() . "/uploads/berkas/" . $ekspedisi->TTD; ?>"></td> 
                            <?php } else { ?> 
                                <img width="75px" height="60px" class="img-thumbnail" src="<?= base_url() . "/images/no_image.png" ?>"></td>
                            <?php } ?>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <th> : </th>
                        <td><?= $ekspedisi->Keterangan; ?></td>
                    </tr>
                    <tr>
                        <td>
                            <a href="<?= base_url('ekspedisi'); ?>" class="btn btn-sm btn-outline-primary">Back</a>
                            <?php if(session()->get('Role')=='Admin'||session()->get('Role')=='Staff'){?>
                                <a href="<?= base_url('ekspedisi/edit/'.$ekspedisi->id); ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                                <a href="<?= base_url('ekspedisi/delete/'.$ekspedisi->id) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ?')" class="btn btn-sm btn-outline-danger">Delete</a>
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