<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container mb-5">
    <div class="card">
        <div class="card-header">
            <h3>Update Profile</h3>
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
            <form method="post" action="<?= base_url('profile/update/'.$users->id) ?>" enctype="multipart/form-data">
                <?= csrf_field(); ?>

                <div class="form-group">
                    <label for="Name">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $users->Name ?>" />
                </div>

                <div class="form-group">
                        <label for="Profile" class="form-label">Foto Profil</label><br>
                        <img width="150px" class="img-thumbnail mb-3" src="<?= base_url() . "/uploads/profile/" . $users->Profile; ?>"/>
                        <input type="file" class="form-control" id="profile" name="profile">
                </div>

                <div class="form-group">
                    <input type="submit" onclick="return confirm('Anda akan Diarah Ke Halaman Login, Apakah Anda Yakin Untuk Mengubah Data?')" value="Update" class="btn btn-info" />
                    <a href="<?= base_url('profile/index/'.$users->id); ?>" class="btn btn-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection('content'); ?>