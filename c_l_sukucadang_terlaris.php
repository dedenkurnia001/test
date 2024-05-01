<?php
include 'koneksi.php';
error_reporting(0);
?>
<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header">
        <a class="btn btn-defaul" href="l_sukucadang_terlaris.php">Kembali</a>
        <a class="btn btn-default no-print" href="javascript:printDiv('area-1');">Print</a>
      </h3>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div id="area-1">
        <div>
          <div align="center">
            <img src="assets/images/logo-report.png" width="200px" alt="Logo Artha Laras"/><br>
            <!-- Jl. Dr. Ciptomangunkusumo, No. 11, Ciledug - Tangerang 15153,<br>
            Telp: 021-7319980 / 0812-1341-1361 <br><br> -->
          </div>
          <hr>
          <div align="center">
            <b><u>Laporan 5 Suku Cadang Terlaris</u></b>
          </div>
        </div>

<div>
  <?php
  include 'koneksi.php';
  $periode_awal = $_GET['periode_awal'];
  $periode_akhir=  $_GET['periode_akhir'];
  $date1 = str_replace('/', '-', $periode_awal);
  $date2 = str_replace('/', '-', $periode_akhir);
  $tgl_periode_awal= date('Y-m-d', strtotime($date1));
  $tgl_periode_akhir= date('Y-m-d', strtotime($date2));
  $sql="select b.kd_sukucadang, sum(jml_jual) as total, e.nm_sukucadang
        from nota_jual a, dtl_penjualan b, sukucadang e
        where a.kd_nota = b.kd_nota and b.kd_sukucadang = e.kd_sukucadang and
        a.tgl_nota >= '$tgl_periode_awal' and a.tgl_nota <= '$tgl_periode_akhir' group by b.kd_sukucadang, e.nm_sukucadang order by total desc limit 5";
  $query=mysqli_query($koneksi,$sql);
  $data=mysqli_fetch_array($query);
  ?>
  <br>
    <b>Periode awal :</b> <?php echo $periode_awal; ?> s/d <b>Periode akhir :</b> <?php echo $periode_akhir; ?><br>
  <br>

<table width="100%" border="1" cellspacing="0">
  <tr>
    <td align="center"><b>No</b></td>
    <td align="center"><b>Kode Suku Cadang</b></td>
    <td align="center"><b>Nama Suku Cadang</b></td>
    <td align="center"><b>Jumlah</b></td>
  </tr>
  <?php
  $no=1;
  $i= 1;
  $a="select b.kd_sukucadang, sum(jml_jual) as total, e.nm_sukucadang
        from nota_jual a, dtl_penjualan b, sukucadang e
        where a.kd_nota = b.kd_nota and b.kd_sukucadang = e.kd_sukucadang and
        a.tgl_nota >= '$tgl_periode_awal' and a.tgl_nota <= '$tgl_periode_akhir' group by b.kd_sukucadang, e.nm_sukucadang order by total desc limit 5";
    $b=mysqli_query($koneksi,$a);
   
   while($c=mysqli_fetch_array($b)){
   ?>
  <tr>
  <td><?php echo $no++;?></td>
  <td><?php echo $c['kd_sukucadang'];?></td>
  <td><?php echo $c['nm_sukucadang'];?></td>
  <td><?php echo $c['total'];?></td>
  </tr>
  <?php $i++; } ?> 
</table>
<?php
$e="select sum(b.jml_jual) as 'jumhar' from nota_jual a, dtl_penjualan b
        where a.kd_nota = b.kd_nota and
        a.tgl_nota >= '$tgl_periode_awal' and a.tgl_nota <= '$tgl_periode_akhir'";
    $f=mysqli_query($koneksi,$e);
    $total=mysqli_fetch_array($f);
?>
<b>Total: <?php echo $total['jumhar']; ?></b>
<div align="right">
  <table width="150px" border="0" height="150px">
    <tr>
      <td align="center"><b>Pemilik</b></td>
    </tr>
    <tr>
      <td align="center">( Pemilik )</td>
    </tr>
  </table>
</div>
  </div>
    </div>
  </div>
</div>
</div>
  <!-- /#page-wrapper -->



<textarea id="printing-css" style="display:none;">.no-print{display:none}</textarea>
<iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
<script type="text/javascript">
//<![CDATA[
function printDiv(elementId) {
    var a = document.getElementById('printing-css').value;
    var b = document.getElementById(elementId).innerHTML;
    window.frames["print_frame"].document.title = 'Laporan Penjualan';
    window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
    window.frames["print_frame"].window.focus();
    window.frames["print_frame"].window.print();
}
//]]>
</script>
