<?php
$update = (isset($_GET['action']) AND $_GET['action'] == 'update') ? true : false;
if ($update) {
	$sql = $connection->query("SELECT * FROM pelanggan WHERE id_pelanggan='$_GET[key]'");
	$row = $sql->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($update) {
		$sql = "UPDATE pelanggan SET no_ktp='$_POST[no_ktp]', nama='$_POST[nama]', email='$_POST[email]', alamat='$_POST[alamat]', telp='$_POST[no_telp]', username='$_POST[username]'";
		if ($_POST["password"] != "") {
			$sql .= ", password='".md5($_POST["password"])."'";
		}
		$sql .= " WHERE id_pelanggan='$_GET[key]'";
	} else {
		$sql = "INSERT INTO pelanggan VALUES (NULL, '$_POST[no_ktp]', '$_POST[nama]', '$_POST[email]', '$_POST[alamat]', '$_POST[no_telp]', '$_POST[username]', '".md5($_POST["password"])."')";
	}
  if ($connection->query($sql)) {
    echo alert("Berhasil!", "?page=pelanggan");
  } else {
		echo alert("Gagal!", "?page=pelanggan");
  }
}

if (isset($_GET['action']) AND $_GET['action'] == 'delete') {
  $connection->query("DELETE FROM pelanggan WHERE id_pelanggan='$_GET[key]'");
	echo alert("Berhasil!", "?page=pelanggan");
}
?>

<style type="text/css">
	.card{
		margin-top: 15px;
	}
</style>

<div class="row">
<div class="col-md-4 d-print-none">
	
	    <div class="card card-<?= ($update) ? "warning" : "info" ?>">
	        <div class="card-header"><h3 class="text-center"><?= ($update) ? "EDIT PELANGGAN" : "TAMBAH PELANGGAN" ?></h3></div>
	        <div class="card-body">
	            <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
	                <div class="form-group">
	                    <label for="nama">Nama</label>
	                    <input type="text" name="nama" class="form-control" <?= (!$update) ?: 'value="'.$row["nama"].'"' ?> placeholder="Masukkan Nama Lengkap">
	                </div>
	                <div class="form-group">
	                    <label for="nama">No KTP</label>
	                    <input type="text" name="no_ktp" class="form-control" <?= (!$update) ?: 'value="'.$row["no_ktp"].'"' ?> placeholder="Masukkan No KTP">
	                </div>
	                <div class="form-group">
	                    <label for="no_telp">Telp</label>
	                    <input type="text" name="no_telp" class="form-control" <?= (!$update) ?: 'value="'.$row["no_telp"].'"' ?> placeholder="Masukkan No Telp">
	                </div>
	                <div class="form-group">
	                    <label for="email">Email</label>
	                    <input type="text" name="email" class="form-control" <?= (!$update) ?: 'value="'.$row["email"].'"' ?> placeholder="Masukkan Email">
	                </div>
	                <div class="form-group">
	                    <label for="alamat">Alamat</label>
	                    <input type="text" name="alamat" class="form-control" <?= (!$update) ?: 'value="'.$row["alamat"].'"' ?> placeholder="Masukkan Alamat">
	                </div>
	                <div class="form-group">
	                    <label for="username">Username</label>
	                    <input type="text" name="username" class="form-control" <?= (!$update) ?: 'value="'.$row["username"].'"' ?> placeholder="Masukkan Username">
	                </div>
	                <div class="form-group">
	                    <label for="password">Password</label>
	                    <input type="password" name="password" class="form-control" placeholder="Masukkan Password">
			                <?php if ($update): ?>
												<span class="help-block">*) Kosongkan jika tidak diubah</span>
											<?php endif; ?>
	                </div>
	                <button type="submit" class="btn btn-<?= ($update) ? "warning" : "info" ?> btn-block">Simpan</button>
	                <?php if ($update): ?>
										<a href="?page=pelanggan" class="btn btn-info btn-block">Batal</a>
									<?php endif; ?>
	            </form>
	        </div>
	    </div><br>
	</div>
	<div class="col-md-8" style="font-size: 12px;">
	    <div class="card card-info">
	        <div class="card-header"><h3 class="text-center">DAFTAR PELANGGAN</h3></div>
	        <div class="card-body">
	            <table class="table table-condensed">
	                <thead>
	                    <tr>
	                        <th>No</th>
	                        <th>Nama</th>
	                        <th>Telp</th>
	                        <th>Email</th>
	                        <th>Username</th>
	                        <th>Alamat</th>
	                        <th></th>
	                        <th class="d-print-none" style="text-align: center;">Aksi</th>
	                    </tr>
	                </thead>
	                <tbody>
	                    <?php $no = 1; ?>
	                    <?php if ($query = $connection->query("SELECT * FROM pelanggan")): ?>
	                        <?php while($row = $query->fetch_assoc()): ?>
	                        <tr>
	                            <td><?=$no++?></td>
															<td><?=$row['nama']?></td>
															<td><?=$row['no_telp']?></td>
															<td><?=$row['email']?></td>
															<td><?=$row['username']?></td>
															<td><?=$row['alamat']?></td>
	                            <td>
	                            <td class="d-print-none" style="text-align: center;">
	                                <div class="btn-group">
	                                    <a href="?page=pelanggan&action=update&key=<?=$row['id_pelanggan']?>" class="btn btn-warning btn-sm">Edit</a>
	                                    <a href="?page=pelanggan&action=delete&key=<?=$row['id_pelanggan']?>" class="btn btn-danger btn-sm">Hapus</a>
	                                </div>
	                            </td>
	                        </tr>
	                        <?php endwhile ?>
	                    <?php endif ?>
	                </tbody>
	            </table>
	        </div>
	        	<div class="card-footer d-print-none">
			        <a onClick="window.print();return false" class="btn btn-primary" style="color: white;"><i class="fas fa-print" style="color: white;"></i> Cetak</a>
	    </div>
	</div>
</div>
