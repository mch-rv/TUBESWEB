<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<link href="https://getbootstrap.com/docs/4.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<div class="container">
    <div class="card my-5">
        <div class="card-header">
            <h3 class="text-center">ABOUT US</h3>
        </div>
        <div class="card-body">
            <div class="container d-flex">
                <div class="col-3 d-flex justify-content-center img-fluid">
                    <img width="175" class="rounded-circle shadow img-thumbnail" src="<?= base_url('assets/40621100039.jpeg')?>">
                </div>
                <div class="col-3 d-flex justify-content-center img-fluid">
                    <img width="175" class="rounded-circle shadow img-thumbnail" src="<?= base_url('assets/40621190004.jpeg')?>">
                </div>
                <div class="col-3 d-flex justify-content-center img-fluid">
                    <img width="175" class="rounded-circle shadow img-thumbnail" src="<?= base_url('assets/40621100041.jpg')?>">
                </div>
                <div class="col-3 d-flex justify-content-center img-fluid">
                    <img width="175" class="rounded-circle shadow img-thumbnail" src="<?= base_url('assets/40621100038.jpeg')?>">
                </div>  
            </div>
            <div class="container d-flex pt-2">
                <div class="col-3 text-center">
                    <b class="fs-5">Ilham Wardi</b>
                </div>
                <div class="col-3 text-center">
                    <b class="fs-5">M Ilham Ramdani</b>
                </div>
                <div class="col-3 text-center">
                    <b class="fs-5">Mochammad Ravly</b>
                </div>
                <div class="col-3 text-center">
                    <b class="fs-5">Yohannes Rahul Rafael</b>
                </div>  
            </div>
            <div class="container d-flex">
                <div class="col-3 text-center">
                    <b>40621100039</b>
                </div>
                <div class="col-3 text-center">
                    <b>40621190004</b>
                </div>
                <div class="col-3 text-center">
                    <b>40621100041</b>
                </div>
                <div class="col-3 text-center">
                    <b>40621100038</b>
                </div>  
            </div>
        </div>
    </div><img class="img-fluid mx-auto d-block my-0" src="<?= base_url('assets/About.png')?>"> 
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<?= $this->endSection() ?>