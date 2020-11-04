<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		.label{
			border-radius: 5px;
			padding: 5px;
			padding-top: 0px;
			padding-bottom: 2px;
		}
		.page-header{
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            padding: 5px;
            padding-top: 10px;
            margin-top: 15px;
            margin-bottom: 5px;
		}
		h2{
			font-weight: bold;
		}
	</style>
</head>
<body>
	<div class="page-header" style="text-align: center;">
			<h2>SEWA MOBIL</h2>
	</div>
	<hr />
	<div class="row">
		<?php $query = $connection->query("SELECT * FROM mobil JOIN jenis USING(id_jenis)"); while ($row = $query->fetch_assoc()): ?>
			<div class="col-xs-6 col-md-3">
				<div class="card">
				<div class="thumbnail">
					<a href="assets/img/mobil/<?=$row['gambar']?>" class="fancybox">
					<img src="assets/img/mobil/<?=$row['gambar']?>" style="height:250px; width:100%" alt="<?=$row['judul']?>">
				</a>
		      <div class="card-body" style="text-align: center;">
		        <h5><?=$row["nama_mobil"]?></h5>
		        <h7>Rp.<?=$row["harga"]?>,- <?=$row["nama"]?> - <?=$row["merk"]?></h7><br>
		        <h7><?=$row["no_mobil"]?></h7><br>
				<span class="label label-<?=($row['status']) ? "btn btn-success" : "btn btn-danger" ?>"><?=($row['status']) ? "Tersedia" : "Tidak Tersedia" ?></span>
		        <p>
					<br>
					<a href="<?=($row['status']) ? "?page=transaksi&id=$row[id_mobil]" : "#" ?>" class="btn btn-primary" <?=($row['status']) ?: "disabled" ?>>Sewa Sekarang!</a>
				</p>
		      </div>
		    </div>
		    </div><br>
		  </div>
		<?php endwhile; ?>
	</div>

	<script type="text/javascript">
	$(document).ready(function(){
		$(".fancybox").fancybox({
			openEffect  : 'none',
			closeEffect : 'none',
			iframe : {
				preload: false
			}
		});
		$(".various").fancybox({
			maxWidth    : 800,
			maxHeight    : 600,
			fitToView    : false,
			width        : '70%',
			height        : '70%',
			autoSize    : false,
			closeClick    : false,
			openEffect    : 'none',
			closeEffect    : 'none'
		});
		$('.fancybox-media').fancybox({
			openEffect  : 'none',
			closeEffect : 'none',
			helpers : {
				media : {}
			}
		});
	});
	</script>
</body>
</html>