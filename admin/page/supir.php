<?php
$update = (isset($_GET['action']) AND $_GET['action'] == 'update') ? true : false;
if ($update) {
	$sql = $connection->query("SELECT * FROM supir WHERE id_supir='$_GET[key]'");
	$row = $sql->fetch_assoc();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($update) {
		$sql = "UPDATE supir SET nama='$_POST[nama]', telp='$_POST[telp]', alamat='$_POST[alamat]', status='$_POST[status]' WHERE id_supir='$_GET[key]'";
	} else {
		$sql = "INSERT INTO supir VALUES (NULL, '$_POST[nama]', '$_POST[telp]', '$_POST[alamat]', '$_POST[status]')";
	}
  if ($connection->query($sql)) {
    echo alert("Berhasil!", "?page=supir");
  } else {
		echo alert("Gagal!", "?page=supir");
  }
}
if (isset($_GET['action']) AND $_GET['action'] == 'delete') {
  $connection->query("DELETE FROM supir WHERE id_supir='$_GET[key]'");
	echo alert("Berhasil!", "?page=supir");
}
?>

<style type="text/css">
	.card{
		margin-top: 15px;
	}
	.label{
		border-radius: 5px;
		padding: 7px;
		padding-top: 1px;
		padding-bottom: 3px;
	}
</style>

<div class="row">
	<div class="col-md-4 d-print-none">
	    <div class="card card-<?= ($update) ? "warning" : "info" ?>">
	        <div class="card-header"><h3 class="text-center"><?= ($update) ? "EDIT SUPIR" : "TAMBAH SUPIR" ?></h3></div>
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
	                    <label for="alamat">Alamat</label>
	                    <input type="text" name="alamat" class="form-control" <?= (!$update) ?: 'value="'.$row["alamat"].'"' ?> placeholder="Masukkan Alamat">
	                </div>
	                <div class="form-group">
	                    <label for="status">Status</label>
											<select class="form-control" name="status">
												<option>- Pilih Status</option>
												<option value="0" <?= (!$update) ?: (($row["status"] != 0) ?: 'selected="on"') ?>>Tidak Tersedia</option>
												<option value="1" <?= (!$update) ?: (($row["status"] != 1) ?: 'selected="on"') ?>>Tersedia</option>
											</select>
	                </div>
	                <button type="submit" class="btn btn-<?= ($update) ? "warning" : "info" ?> btn-block">Simpan</button>
	                <?php if ($update): ?>
										<a href="?page=supir" class="btn btn-info btn-block">Batal</a>
									<?php endif; ?>
	            </form>
	        </div>
	    </div>
	</div>
	<div class="col-md-8">
	    <div class="card card-info">
	        <div class="card-header"><h3 class="text-center">DAFTAR SUPIR</h3></div>
	        <div class="card-body">
	            <table class="table table-condensed">
	                <thead>
	                    <tr>
	                        <th>No</th>
	                        <th>Nama</th>
	                        <th>Telp</th>
	                        <th>Alamat</th>
	                        <th style="text-align: center;">Status</th>
	                        <th class="d-print-none" style="text-align: center;">Aksi</th>
	                    </tr>
	                </thead>
	                <tbody>
	                    <?php $no = 1; ?>
	                    <?php if ($query = $connection->query("SELECT * FROM supir")): ?>
	                        <?php while($row = $query->fetch_assoc()): ?>
	                        <tr>
	                            <td><?=$no++?></td>
															<td><?=$row['nama']?></td>
															<td><?=$row['telp']?></td>
															<td><?=$row['alamat']?></td>
															<td><span class="label label-<?=($row['status']) ? "btn btn-success" : "btn btn-danger" ?>"><?=($row['status']) ? "Tersedia" : "Tidak Tersedia" ?></span></td>
	                            <td class="d-print-none" style="text-align: center;">
	                                <div class="btn-group">
	                                    <a href="?page=supir&action=update&key=<?=$row['id_supir']?>" class="btn btn-warning btn-sm">Edit</a>
	                                    <a href="?page=supir&action=delete&key=<?=$row['id_supir']?>" class="btn btn-danger btn-sm">Hapus</a>
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