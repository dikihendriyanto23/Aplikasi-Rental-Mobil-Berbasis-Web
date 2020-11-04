<?php
session_start();
require_once "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NGERENTAL</title>
    <link rel="shortcut icon" href="assets/img/favicon (1).ico">
    <link rel="stylesheet" href="assets/Bootstrap 4/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/navbar.css">
    <link rel="stylesheet" href="assets/fonts/Roboto.css">
    <script src="assets/fontawesome-free/js/all.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="assets/fancybox/source/helpers/jquery.fancybox-buttons.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="assets/fancybox/source/helpers/jquery.fancybox-thumbs.css" type="text/css" media="screen" />
    <script type="text/javascript" src="assets/fancybox/source/jquery.fancybox.pack.js"></script>
    <script type="text/javascript" src="assets/fancybox/source/helpers/jquery.fancybox-buttons.js"></script>
    <script type="text/javascript" src="assets/fancybox/source/helpers/jquery.fancybox-media.js"></script>
    <script type="text/javascript" src="assets/fancybox/source/helpers/jquery.fancybox-thumbs.js"></script>
    <script type="text/javascript" src="assets/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-mainbg" style="border-radius: 5px;">
            <img src="assets/img/logo.png" style="float: left; margin-left: 5px;" width="10%">
            <a class="navbar-brand navbar-logo" href="#" style="font-style: italic; font-size: 27px;">NGERENTAL</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars text-white"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <div class="hori-selector"><div class="left"></div><div class="right"></div></div>
                    <li><a class="nav-link" href="?page=home"><i class="fas fa-home"></i> Home <span class="sr-only">(current)</span></a></li>
                    <?php if (isset($_SESSION["pelanggan"])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=sewamobil"><i class="fas fa-car"></i> Sewa Mobil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=faqs"><i class="far fa-question-circle"></i> FAQS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=profil"><i class="fas fa-user-alt"></i> Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </li>
                    <li class="nav-item">
                        <a href="#">|</a>
                    </li>
                    <li class="nav-item" style="margin-right: 15px;">
                        <a href="#" style="font-weight: bold; color: black;"><?= ucfirst($_SESSION["pelanggan"]["username"]) ?><span class="caret"></span></a>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=faqs"><i class="far fa-question-circle"></i> FAQS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=tentangkami"><i class="fas fa-users"></i> Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=daftar"><i class="fas fa-user-alt"></i> Daftar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>

        <div class="row">
            <div class="col-md-12">
              <?php include page($_PAGE); ?>
            </div>
        </div>
    </div>
    <script src="assets/Bootstrap 4/js/bootstrap.min.js"></script>
    <script src="assets/navbar.js"></script>
</body>
</html>