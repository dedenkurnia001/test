<?php
include 'koneksi.php';
error_reporting(0);
?>
<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header">
        <a class="btn btn-defaul" href="l_penjualan.php">Kembali</a>
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
            <b><u>Laporan Penjualan</u></b>
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
  $sql="select a.kd_nota, a.tgl_nota, a.id_pelanggan, c.nm_pelanggan, b.kd_sukucadang, e.nm_sukucadang, b.hrg_jual, b.jml_jual, b.hrg_jual * b.jml_jual as jumhar
        from nota_jual a, dtl_penjualan b, pelanggan c, sukucadang e
        where a.kd_nota = b.kd_nota and a.id_pelanggan = c.id_pelanggan and b.kd_sukucadang = e.kd_sukucadang and
        a.tgl_nota >= '$tgl_periode_awal' and a.tgl_nota <= '$tgl_periode_akhir' order by kd_nota desc";
  $query=mysqli_query($koneksi,$sql);
  $data=mysqli_fetch_array($query);
  ?>
  <br>
    <b>Periode awal :</b> <?php echo $periode_awal; ?> s/d <b>Periode akhir :</b> <?php echo $periode_akhir; ?><br>
  <br>

<table width="100%" border="1" cellspacing="0">
  <tr>
    <td align="center"><b>No</b></td>
    <td align="center"><b>Kode Nota Penjualan</b></td>
    <td align="center"><b>Tanggal Penjualan</b></td>
    <td align="center"><b>Id Pelanggan</b></td>
    <td align="center"><b>Nama Pelanggan</b></td>
    <td align="center"><b>Kode Suku Cadang</b></td>
    <td align="center"><b>Nama Suku Cadang</b></td>
    <td align="center"><b>Harga Jual</b></td>
    <td align="center"><b>Jumlah Jual</b></td>
    <td align="center"><b>Jumlah Harga</b></td>
  </tr>
  <?php
  $no=1;
  $i= 1;
  $a="select a.kd_nota, a.tgl_nota, a.id_pelanggan, c.nm_pelanggan, b.kd_sukucadang, e.nm_sukucadang, b.hrg_jual, b.jml_jual, b.hrg_jual * b.jml_jual as jumhar
        from nota_jual a, dtl_penjualan b, pelanggan c, sukucadang e
        where a.kd_nota = b.kd_nota and a.id_pelanggan = c.id_pelanggan and b.kd_sukucadang = e.kd_sukucadang and
        a.tgl_nota >= '$tgl_periode_awal' and a.tgl_nota <= '$tgl_periode_akhir' order by kd_nota desc";
    $b=mysqli_query($koneksi,$a);
   
   while($c=mysqli_fetch_array($b)){
    $penjualan[$i] = $c['kd_nota'];
   ?>
  <tr>
  <td><?php
      if($penjualan[$i] == $penjualan[$i-1]){
        echo " ";
      }else{
        echo $no++;
      }
      ?></td>
  <td><?php
         if($penjualan[$i] == $penjualan[$i-1]){
          echo " ";
        }else{
          echo $c['kd_nota'];
        }
      ?></td>
  <td><?php
         if($penjualan[$i] == $penjualan[$i-1]){
          echo " ";
        }else{
          echo $c['tgl_nota'];
        }
      ?></td>
  <td><?php
         if($penjualan[$i] == $penjualan[$i-1]){
          echo " ";
        }else{
          echo $c['id_pelanggan'];
        }
      ?></td>
  <td><?php
         if($penjualan[$i] == $penjualan[$i-1]){
          echo " ";
        }else{
          echo $c['nm_pelanggan'];
        }
      ?></td>
  <td><?php echo $c['kd_sukucadang'];?></td>
  <td><?php echo $c['nm_sukucadang'];?></td>
  <td><?php echo $c['hrg_jual'];?></td>
  <td><?php echo $c['jml_jual'];?></td>
  <td><?php echo $c['jumhar'];?></td>
  </tr>
  <?php $i++; } ?> 
</table>
<?php
$e="select sum(b.hrg_jual * b.jml_jual) as 'jumhar' from nota_jual a, dtl_penjualan b
        where a.kd_nota = b.kd_nota and
        a.tgl_nota >= '$tgl_periode_awal' and a.tgl_nota <= '$tgl_periode_akhir'";
    $f=mysqli_query($koneksi,$e);
    $total=mysqli_fetch_array($f);
?>
<b>Grand Total: Rp <?php echo $total['jumhar']; ?></b>
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
