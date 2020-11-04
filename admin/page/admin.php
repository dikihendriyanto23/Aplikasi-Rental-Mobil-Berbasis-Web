<?php
$update = (isset($_GET['action']) AND $_GET['action'] == 'update') ? true : false;
if ($update) {
	$sql = $connection->query("SELECT * FROM admin WHERE id_admin='$_GET[key]'");
	$row = $sql->fetch_assoc();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($update) {
		$sql = "UPDATE admin SET nama='$_POST[nama]', email='$_POST[email]', alamat='$_POST[alamat]', telp='$_POST[telp]', username='$_POST[username]'";
		if ($_POST["password"] != "") {
			$sql .= ", password='".md5($_POST["password"])."'";
		}
		$sql .= " WHERE id_admin='$_GET[key]'";
	} else {
		$sql = "INSERT INTO admin VALUES (NULL, '$_POST[nama]', '$_POST[email]', '$_POST[alamat]', '$_POST[telp]', '$_POST[username]', '".md5($_POST["password"])."')";
	}
  if ($connection->query($sql)) {
    echo alert("Berhasil!", "?page=admin");
  } else {
		echo alert("Gagal!", "?page=admin");
  }
}
if (isset($_GET['action']) AND $_GET['action'] == 'delete') {
  $connection->query("DELETE FROM admin WHERE id_admin='$_GET[key]'");
	echo alert("Berhasil!", "?page=admin");
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
	        <div class="card-header"><h3 class="text-center"><?= ($update) ? "EDIT ADMIN" : "TAMBAH ADMIN" ?></h3></div>
	        <div class="card-body">
	            <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
	                <div class="form-group">
	                    <label for="nama">Nama</label>
	                    <input type="text" name="nama" class="form-control" <?= (!$update) ?: 'value="'.$row["nama"].'"' ?> placeholder="Masukkan Nama">
	                </div>
	                <div class="form-group">
	                    <label for="telp">Telp</label>
	                    <input type="text" name="telp" class="form-control" <?= (!$update) ?: 'value="'.$row["telp"].'"' ?> placeholder="Masukkan No Telp">
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
										<a href="?page=admin" class="btn btn-info btn-block">Batal</a>
									<?php endif; ?>
	            </form>
	        </div>
	    </div><br>
	</div>
	<div class="col-md-8">
	    <div class="card">
	        <div class="card-header"><h3 class="text-center">DAFTAR ADMIN</h3></div>
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
	                        <th class="d-print-none" style="text-align: center;">Aksi</th>
	                    </tr>
	                </thead>
	                <tbody>
	                    <?php $no = 1; ?>
	                    <?php if ($query = $connection->query("SELECT * FROM admin")): ?>
	                        <?php while($row = $query->fetch_assoc()): ?>
	                        <tr>
	                            <td><?=$no++?></td>
															<td><?=$row['nama']?></td>
															<td><?=$row['telp']?></td>
															<td><?=$row['email']?></td>
															<td><?=$row['username']?></td>
															<td><?=$row['alamat']?></td>
	                            <td class="d-print-none" style="text-align: center;">
	                                <div class="btn-group">
	                                    <a href="?page=admin&action=update&key=<?=$row['id_admin']?>" class="btn btn-warning btn-sm">Edit</a>
	                                    <a href="?page=admin&action=delete&key=<?=$row['id_admin']?>" class="btn btn-danger btn-sm">Hapus</a>
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
</div>