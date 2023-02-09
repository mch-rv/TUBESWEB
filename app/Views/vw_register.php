<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
    <!-- Begin page content -->
    <main class="flex-shrink-0">
        <div class="container dashboard">
    <div class="card mb-5">
        <div class="card-header">
        <h3>Register Form</h3>
            Silahkan Daftarkan Identitas Anda
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
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <h4>Periksa Entrian Form</h4>
                    </hr />
                    <?php echo session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>
            <form method="post" action="<?= base_url("/Auth/regprocess") ?>">
                <?= csrf_field(); ?>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-3">
                    <label for="password_conf" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password_conf" name="password_conf">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" class="form-control form-select" id="role" placeholder="">
                        <option value=NULL> </option>
                        <option value="Admin">Admin</option>
                        <option value="Staff">Staff</option>
                        <option value="Pimpinan">Pimpinan</option>
                    </select>
                </div>
                <div class="my-3">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
            <hr />
        </div>
    </main>
<?= $this->endSection('content'); ?>