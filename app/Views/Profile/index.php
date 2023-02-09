<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<link href="https://getbootstrap.com/docs/4.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<div class="container dashboard">
    <div class="card my-5">
        <div class="card-header">
            <div class="container">
            <h3 class="text-center">Profile</h3>
            </div>
        </div>
        <div class="card-body">
        <div class="container d-flex justify-content-center">
            <div class="text-center"> 
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
        <?php if (session()->get('Profile')=='profile.png'){?>
                <?php if (session()->get('Role')=='Admin'){?>
                    <img width="100" class="rounded-circle" src="<?= base_url('images/admin/'.session()->get('Profile'))?>"></td> 
                <?php } ?>
                <?php if (session()->get('Role')=='Staff'){?>
                    <img width="100" class="rounded-circle" src="<?= base_url('images/staff/'.session()->get('Profile'))?>"></td> 
                <?php } ?>
                <?php if (session()->get('Role')=='Pimpinan'){?>
                    <img width="100" class="rounded-circle" src="<?= base_url('images/pimpinan/'.session()->get('Profile'))?>"></td> 
                <?php } ?>
            <?php } else { ?> 
                <img width="100" class="rounded-circle" src="<?= base_url("uploads/profile/".$users->Profile) ?>"></td>
            <?php } ?>
            <h3 class="mt-2"><?= $users->Name ?></h3>
			<span class="mt-1 clearfix"><?= session()->get('Role') ?></span>
                            <div class="row my-3"> 
                                <a href="<?= base_url('profile/edit/'.$users->id); ?>" class="btn btn-sm btn-outline-secondary mb-1">Edit</a>
                                <a href="<?= base_url('Home'); ?>" class="btn btn-sm btn-outline-primary">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<?= $this->endSection() ?>