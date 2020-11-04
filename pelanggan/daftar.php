<?php

$update = ((isset($_GET['action']) AND $_GET['action'] == 'update') OR isset($_SESSION["pelanggan"])) ? true : false;
if ($update) {
	$sql = $connection->query("SELECT * FROM pelanggan WHERE id_pelanggan='$_SESSION[pelanggan][id]'");
	$row = $sql->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($update) {
		$sql = "UPDATE pelanggan SET no_ktp='$_POST[no_ktp]', nama='$_POST[nama]', email='$_POST[email]', no_telp='$_POST[no_telp]', alamat='$_POST[alamat]', username='$_POST[username]'";
		if ($_POST["password"] != "") {
			$sql .= ", password='".md5($_POST["password"])."'";
		}
		$sql .= " WHERE id_pelanggan='$_SESSION[pelanggan][id]'";
	} else {
		$sql = "INSERT INTO pelanggan VALUES (NULL, '$_POST[no_ktp]', '$_POST[nama]', '$_POST[email]', '$_POST[no_telp]', '$_POST[alamat]', '$_POST[username]', '".md5($_POST["password"])."')";
	}
  if ($connection->query($sql)) {
    echo alert("Berhasil! Silahkan login", "login.php");
  } else {
		echo alert("Gagal!", "?page=pelanggan");
  }
}

if (isset($_GET['action']) AND $_GET['action'] == 'delete') {
  $connection->query("DELETE FROM pelanggan WHERE id_pelanggan='$_SESSION[pelanggan][id]'");
	echo alert("Berhasil!", "?page=pelanggan");
}
?>
<style type="text/css">
	.page-header{
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            padding: 5px;
            padding-top: 10px;
            margin-top: 15px;
            margin-bottom: 5px; 
	}
	h2{
		text-align: center;
		font-weight: bold;
	}
	label{
		font-weight: bold;
	}
</style>
<div class="container">
		<div class="container col-md-2"></div>
		<div class="container col-md-8">
			<div class="page-header">
				<?php if ($update): ?>
					<h2>Update <small>Data</small></h2>
				<?php else: ?>
					<h2>Pendaftaran User</h2>
				<?php endif; ?>
			</div>
			<hr />
			<form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
				<div class="form-group">
					<label for="nama">Nama</label>
					<input type="text" name="nama" class="form-control" autofocus="on" placeholder="Masukkan Nama Lengkap Anda"<?= (!$update) ?: 'value="'.$row["nama"].'"' ?>>
				</div>
				<div class="form-group">
					<label for="no_ktp">No KTP</label>
					<input type="text" name="no_ktp" class="form-control" placeholder="Masukkan No KTP Anda"<?= (!$update) ?: 'value="'.$row["no_ktp"].'"' ?>>
				</div>
				<div class="form-group">
					<label for="no_telp">No Telp</label>
					<input type="text" name="no_telp" class="form-control" placeholder="Masukkan No Telp Anda"<?= (!$update) ?: 'value="'.$row["no_telp"].'"' ?>>
				</div>
				<div class="form-group">
					<label for="alamat">Alamat</label>
					<textarea rows="2" name="alamat" class="form-control" placeholder="Masukkan Alamat Lengkap Anda"><?= (!$update) ? "" : $row["alamat"] ?></textarea>
				</div>
				<div class="form-group">
					<label for="Email">Email</label>
					<input type="email" name="email" class="form-control" placeholder="Masukkan Email Anda"<?= (!$update) ?: 'value="'.$row["email"].'"' ?>>
				</div>
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" name="username" class="form-control" placeholder="Username"<?= (!$update) ?: 'value="'.$row["username"].'"' ?>>
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" name="password" class="form-control" placeholder="Password">
				</div>
				<?php if ($update): ?>
					<div class="row">
							<div class="col-md-10">
								<button type="submit" class="btn btn-warning btn-block">Update</button>
							</div>
							<div class="col-md-2">
								<a href="?page=kriteria" class="btn btn-default btn-block">Batal</a>
							</div>
					</div>
				<?php else: ?>
					<div class="row" style="margin-bottom: 10px;">
							<div class="col-md-9"></div>
							<div class="col-md-3" style="text-align: center;">
								<button type="submit" class="btn btn-primary btn-block">Daftar</button>
					</div>
				<?php endif; ?>
		</form>
		</div>
		<div class="col-md-2"></div>
</div>
