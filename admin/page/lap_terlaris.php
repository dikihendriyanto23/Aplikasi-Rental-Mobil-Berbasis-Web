<br>
<form class="form-inline d-print-none" action="<?=$_SERVER["REQUEST_URI"]?>" method="post">
	<label>Periode</label>
	<input type="date" class="form-control" name="start" style="margin-left: 5px; margin-right: 5px;">
	<label>s/d</label>
	<input type="date" class="form-control" name="stop" style="margin-left: 5px; margin-right: 5px;">
	<button type="submit" class="btn btn-primary btn-sm">Tampilkan</button>
</form>
<br>
<?php if ($_POST): ?>
<div class="card card-info">
		<div class="card-header"><h3 class="text-center">LAPORAN PENYEWAAN TERLARIS PERPERIODE</h3></div>
		<div class="card-body">
				<table class="table table-condensed">
						<thead>
								<tr>
										<th>No</th>
										<th>Nama</th>
										<th>Nomor</th>
										<th>Merk</th>
										<th style="text-align: center;">Total Penyewa</th>
								</tr>
						</thead>
						<tbody>
								<?php $no = 1; ?>
								<?php if ($query = $connection->query("SELECT m.no_mobil, m.merk, m.nama_mobil, (SELECT COUNT(*) FROM transaksi WHERE id_mobil=t.id_mobil) AS jml FROM transaksi t JOIN mobil m USING(id_mobil) WHERE t.tgl_sewa BETWEEN '$_POST[start]' AND '$_POST[stop]'")): ?>
										<?php while($row = $query->fetch_assoc()): ?>
										<tr>
												<td><?=$no++?></td>
												<td><?=$row['nama_mobil']?></td>
												<td><?=$row['no_mobil']?></td>
												<td><?=$row['merk']?></td>
												<td style="text-align: center;"><?=$row['jml']?></td>
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
<?php endif; ?>