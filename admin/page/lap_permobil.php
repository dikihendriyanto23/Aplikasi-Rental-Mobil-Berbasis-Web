<br>
<form class="form-inline d-print-none" action="<?=$_SERVER["REQUEST_URI"]?>" method="post">
		<label>Mobil :</label>
		<select class="form-control" name="id_mobil" style="margin-left: 5px; margin-right: 5px;">
			<option>---</option>
			<?php $query = $connection->query("SELECT * FROM mobil"); while ($r = $query->fetch_assoc()): ?>
				<option value="<?=$r["id_mobil"]?>"><?=$r["nama_mobil"]?> | <?=$r["no_mobil"]?></option>
			<?php endwhile; ?>
		</select>
    <label>Tanggal :</label>
    <input type="date" class="form-control" name="start" style="margin-left: 5px; margin-right: 5px;">
    <label>s/d</label>
    <input type="date" class="form-control" name="stop" style="margin-left: 5px; margin-right: 5px;">
		<button type="submit" class="btn btn-primary">Tampilkan</button>
	</form>
	<br>
	<?php if ($_POST): ?>
	  <div class="card card-info">
	    <div class="card-header"><h3 class="text-center">LAPORAN PENYEWAAN PERMOBIL</h3><br><h4 class="text-center">Tanggal: <?=$_POST["start"]." s/d ".$_POST["stop"]?></h4></div>
	    <div class="card-body">
				<?php $query = $connection->query("SELECT d.no_mobil, d.nama_mobil, d.merk FROM transaksi a JOIN pelanggan b USING(id_pelanggan) JOIN mobil d USING(id_mobil) WHERE d.id_mobil=$_POST[id_mobil] AND a.tgl_sewa BETWEEN '$_POST[start]' AND '$_POST[stop]'"); ?>
				<?php while($row = $query->fetch_assoc()): ?>
					<form class="form-inline">
						<table>
							<tr>
								<td>
									<label>Nomor Mobil</label>
								</td>
								<td>&nbsp;:&nbsp;
									<input type="text" value="<?=$row['no_mobil']?>" class="form-control" disabled="on"><br>
								</td>
							</tr>
							<tr>
								<td>
									<label>Nama Mobil</label>
								</td>
								<td>&nbsp;:&nbsp;
									<input type="text" value="<?=$row['nama_mobil']?>" class="form-control" disabled="on"><br>
								</td>
							</tr>
							<tr>
								<td>
									<label>Merk</label>
								</td>
								<td>&nbsp;:&nbsp;
									<input type="text" value="<?=$row['merk']?>" class="form-control" disabled="on">
								</td>
							</tr>
						</table>
					</form>
				<?php endwhile ?>
				<br>
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pelanggan</th>
                    <th>Harga Sewa</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
								<?php $q = $connection->query("SELECT b.nama, d.harga FROM transaksi a JOIN pelanggan b USING(id_pelanggan) JOIN mobil d USING(id_mobil) WHERE d.id_mobil=$_POST[id_mobil] AND a.tgl_sewa BETWEEN '$_POST[start]' AND '$_POST[stop]'"); ?>
                <?php while($r = $q->fetch_assoc()): ?>
                <tr>
                    <td><?=$no++?></td>
										<td><?=$r['nama']?></td>
										<td>Rp.<?=number_format($r['harga'])?></td>
										
                </tr>
                <?php endwhile ?>
            </tbody>
        </table>
	    </div>
	    <div class="card-footer d-print-none">
	        <a onClick="window.print();return false" class="btn btn-primary" style="color: white;"><i class="fas fa-print" style="color: white;"></i> Cetak</a>
	    </div>
	  </div>
<?php endif; ?>