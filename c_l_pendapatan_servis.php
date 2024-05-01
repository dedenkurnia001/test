<?php
include 'koneksi.php';
error_reporting(0);
?>
<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header">
        <a class="btn btn-defaul" href="l_pendapatan_servis.php">Kembali</a>
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
            <b><u>Laporan Pendapatan Jasa Servis</u></b>
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
  $sql="select a.kd_perbaikan, a.tgl_perbaikan, a.no_polisi, d.nm_pelanggan, b.hrg_servis
        from perbaikan a, dtl_servis b, kendaraan c, pelanggan d
        where a.kd_perbaikan = b.kd_perbaikan and a.no_polisi = c.no_polisi and d.id_pelanggan = c.id_pelanggan and
        a.tgl_perbaikan >= '$tgl_periode_awal' and a.tgl_perbaikan <= '$tgl_periode_akhir'";
  $query=mysqli_query($koneksi,$sql);
  $data=mysqli_fetch_array($query);
  ?>
  <br>
    <b>Periode awal :</b> <?php echo $periode_awal; ?> s/d <b>Periode akhir :</b> <?php echo $periode_akhir; ?><br>
  <br>

<table width="100%" border="1" cellspacing="0">
  <tr>
    <td align="center"><b>No</b></td>
    <td align="center"><b>Kode Perbaikan</b></td>
    <td align="center"><b>Tanggal Perbaikan</b></td>
    <td align="center"><b>No. Polisi</b></td>
    <td align="center"><b>Nama Pelanggan</b></td>
    <td align="center"><b>Nama Servis</b></td>
    <td align="center"><b>Harga</b></td>
  </tr>
  <?php
  $no=1;
  $i= 1;
  $a="select a.kd_perbaikan, a.tgl_perbaikan, a.no_polisi, d.nm_pelanggan, e.nm_servis, b.hrg_servis
        from perbaikan a, dtl_servis b, kendaraan c, pelanggan d, servis e
        where a.kd_perbaikan = b.kd_perbaikan and a.no_polisi = c.no_polisi and d.id_pelanggan = c.id_pelanggan and
        b.kd_servis = e.kd_servis and a.tgl_perbaikan >= '$tgl_periode_awal' and a.tgl_perbaikan <= '$tgl_periode_akhir' order by a.id_mekanik desc";
    $b=mysqli_query($koneksi,$a);
   
   while($c=mysqli_fetch_array($b)){
    $perbaikan[$i] = $c['kd_perbaikan'];
   ?>
  <tr>
  <td><?php
      if($perbaikan[$i] == $perbaikan[$i-1]){
        echo " ";
      }else{
        echo $no++;
      }
      ?></td>
  <td><?php
         if($perbaikan[$i] == $perbaikan[$i-1]){
          echo " ";
        }else{
          echo $c['kd_perbaikan'];
        }
      ?></td>
  <td><?php
         if($perbaikan[$i] == $perbaikan[$i-1]){
          echo " ";
        }else{
          echo $c['tgl_perbaikan'];
        }
      ?></td>
  <td><?php
         if($perbaikan[$i] == $perbaikan[$i-1]){
          echo " ";
        }else{
          echo $c['no_polisi'];
        }
      ?></td>
  <td><?php
         if($perbaikan[$i] == $perbaikan[$i-1]){
          echo " ";
        }else{
          echo $c['nm_pelanggan'];
        }
      ?></td>
  <td><?php echo $c['nm_servis'];?></td>
  <td><?php echo $c['hrg_servis'];?></td>
  </tr>
  <?php $i++; } ?> 
</table>
<?php
$e="select sum(b.hrg_servis) as 'jumhar' from perbaikan a, dtl_servis b
        where a.kd_perbaikan = b.kd_perbaikan and
        a.tgl_perbaikan >= '$tgl_periode_awal' and a.tgl_perbaikan <= '$tgl_periode_akhir'";
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
    window.frames["print_frame"].document.title = 'Laporan Kinerja Mekanik';
    window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
    window.frames["print_frame"].window.focus();
    window.frames["print_frame"].window.print();
}
//]]>
</script>
