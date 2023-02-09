<!doctype html>
<html lang="en">

<head>
    <title>Login Page</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?= base_url("css/bootstrap.min.css") ?>" />
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
        body {
        margin: 0;
        font-size: 1rem;
        font-family: Arial, Helvetica, sans-serif;
    }

    #theVideo {
        position: fixed;
        min-width: 100vw;
        min-height: 100vh;
        z-index: -10; /* Makes video a background layer */
        font-family:monospace;
        background-color:white;
        position:fixed;
        opacity:0.8;
    }

    .flex-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        height: auto;
    }
    .background-overlay {
      
    }
    .content {
        width: 50vw;  /* Content spans half the screen */
        min-width: 210px; /* But will never go below 210px (mobile-friendly) */
        margin-top: 2rem;
        margin-bottom: 2rem;
        padding: 2rem;
    }

    </style>
    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/5.0/examples/sign-in/signin.css" rel="stylesheet">
</head>

<video id="theVideo" autoplay muted loop>
        <source src="<?= base_url('/Video/Profile_Widyatama.mp4') ?>" type="video/mp4">
</video>
<body class="text-center flex-container">
    <main class="form-signin content">
        <?php if (!empty(session()->getFlashdata('error'))) : ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?php echo session()->getFlashdata('error'); ?>
            </div>
        <?php endif; ?>
        <form method="post" action="<?= base_url('/Auth/logprocess') ; ?>">
            <?= csrf_field(); ?>
            <img height="75px" class="my-3" src="<?= base_url('images/logo2.png')?>"/>
            <input type="text" name="username" id="username" placeholder="Username" class="form-control shadow-lg" required autofocus>
            <input type="password" name="password" id="password" placeholder="Password" class="form-control shadow-lg" required>
            <button type="submit" class="w-100 btn btn-lg btn-primary">Login</button>
            <div class="container fw-bolder"><br>
                Made with <span style="color: #e25555;">&#9829;</span> in Widyatama
            </div>
        </form>
    </main>
</body>

</html>