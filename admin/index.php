<?php
session_start();
require_once "../config.php";
if (!isset($_SESSION["admin"])) {
  header('location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ADMIN | NGERENTAL</title>
    <link rel="stylesheet" href="../assets/Bootstrap 4/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/navbar.css">
    <link rel="stylesheet" href="../assets/fonts/Roboto.css">
    <script src="../assets/fontawesome-free/js/all.min.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <link rel="stylesheet" href="../assets/fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="../assets/fancybox/source/helpers/jquery.fancybox-buttons.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="../assets/fancybox/source/helpers/jquery.fancybox-thumbs.css" type="text/css" media="screen" />
    <script type="text/javascript" src="../assets/fancybox/source/jquery.fancybox.pack.js"></script>
    <script type="text/javascript" src="../assets/fancybox/source/helpers/jquery.fancybox-buttons.js"></script>
    <script type="text/javascript" src="../assets/fancybox/source/helpers/jquery.fancybox-media.js"></script>
    <script type="text/javascript" src="../assets/fancybox/source/helpers/jquery.fancybox-thumbs.js"></script>
    <script type="text/javascript" src="../assets/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
</head>
<body>
    <div class="container">

        <nav class="navbar navbar-dark bg-dark navbar-expand-md" style="border-radius: 5px;">
            <div class="container">
                <a class="navbar-brand navbar-logo" href="#" style="font-size: 25px;">ADMIN | NGERENTAL</a>
                <button class="navbar-toggler d-none" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="?page=home"><i class="fas fa-home"></i> Home <span class="sr-only">(current)</span></a></li>
                        <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><i class="fas fa-pencil-alt"></i> Input</a>
                            <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item" role="presentation" href="?page=admin">Admin</a>
                                <a class="dropdown-item" role="presentation" href="?page=jenis">Jenis</a>
                                <a class="dropdown-item" role="presentation" href="?page=mobil">Mobil</a>
                                <a class="dropdown-item" role="presentation" href="?page=supir">Supir</a>
                                <a class="dropdown-item" role="presentation" href="?page=pelanggan">Pelanggan</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" data-display="static" aria-expanded="false" href="#"><i class="fas fa-server"></i> Laporan</a>
                            <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item" role="presentation" href="?page=lap_konfirmasi">Laporan Konfirmasi</a>
                                <a class="dropdown-item" role="presentation" href="?page=lap_permobil">Laporan Penyewaan Permobil</a>
                                <a class="dropdown-item" role="presentation" href="?page=lap_seringdenda">Laporan Sering Denda</a>
                                <a class="dropdown-item" role="presentation" href="?page=lap_perperiode">Penyewaan Perperiode</a>
                                <a class="dropdown-item" role="presentation" href="?page=lap_terlaris">Terlaris</a>
                                <a class="dropdown-item" role="presentation" href="?page=lap_denda">Denda</a>
                            </div>
                        </li>
                        <li class="nav-item"><a class="nav-link" data-display="static" aria-expanded="false" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        <li class="nav-item"><a class="nav-link" data-display="static" aria-expanded="false" href="#">|</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" data-display="static" aria-expanded="false" href="#" style="margin-right: 15px; font-weight: bold; color: red;"><?= ucfirst($_SESSION["admin"]["username"]) ?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="row">
            <div class="col-md-12">
              <?php include adminPage($_ADMINPAGE); ?>
            </div>
        </div>
    </div>
    <script src="../assets/Bootstrap 4/js/bootstrap.min.js"></script>
</body>
</html>