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
        <div class="card-header"><h3 class="text-center">LAPORAN KONFIRMASI</h3></div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tgl Sewa</th>
                        <th>Total Harga</th>
                        <th class="d-print-none"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php if ($query = $connection->query("SELECT * FROM transaksi JOIN pelanggan USING(id_pelanggan) JOIN konfirmasi USING(id_transaksi) WHERE tgl_sewa BETWEEN '$_POST[start]' AND '$_POST[stop]'")): ?>
                        <?php while($row = $query->fetch_assoc()): ?>
                        <tr>
                            <td><?=$no++?></td>
                            <td><?=$row['nama']?></td>
                            <td><?=date("d-m-Y H:i:s", strtotime($row['tgl_sewa']))?></td>
                            <td><?=$row['total_harga']?></td>
                            <td class="d-print-none">
                              <a  href="../assets/img/bukti/<?=$row['bukti']?>" class="btn btn-info btn-xs fancybox">Lihat Bukti</a>
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
  <?php endif; ?>

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
