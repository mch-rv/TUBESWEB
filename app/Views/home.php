<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
    <main class="container">
        <div class="dashboard text-center px-3">
        <iframe src="<?= base_url("assets/welcome.gif")?>" width="360px" height="240px" frameBorder="0" allowFullScreen></iframe>   
            <h1>Hai <?= session()->get('Name'); ?>! </h1>
            <p class="lead">Selamat Datang di dashboard <?= session()->get('Role'); ?>!</p>
        </div>
    </main><!-- /.container -->
<?= $this->endSection('content'); ?>


