<?php
include 'koneksi.php';

?>
<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header">
        <a class="btn btn-defaul" href="l_stok_sukucadang.php">Kembali</a>
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
            <b><u>Laporan Stok Suku Cadang</u></b>
          </div>
        </div>

<div>
  <?php
  include 'koneksi.php';
  $sql="select * from barang";
  $query=mysqli_query($koneksi,$sql);
  $data=mysqli_fetch_array($query);
  ?>
  <br>

<table width="100%" border="1" cellspacing="0">
  <tr>
    <td align="center"><b>No</b></td>
    <td align="center"><b>Kode Suku Cadang</b></td>
    <td align="center"><b>Nama Suku Cadang</b></td>
    <td align="center"><b>Jenis</b></td>
    <td align="center"><b>Harga Jual</b></td>
    <td align="center"><b>Harga Beli</b></td>
    <td align="center"><b>Stok</b></td>
    <td align="center"><b>Satuan</b></td>
  </tr>
  <?php
   $a="select * from sukucadang order by kd_sukucadang";
    $b=mysqli_query($koneksi,$a);
   $no=1;
   while($c=mysqli_fetch_array($b)){
   ?>
  <tr>
  <td><?php echo $no;?></td>
  <td><?php echo $c['kd_sukucadang'];?></td>
  <td><?php echo $c['nm_sukucadang'];?></td>
  <td><?php echo $c['jenis'];?></td>
  <td><?php echo $c['hrg_jual'];?></td>
  <td><?php echo $c['hrg_beli'];?></td>
  <td><?php echo $c['stok'];?></td>
  <td><?php echo $c['satuan'];?></td>
  </tr>
  <?php $no++; } ?> 
</table>

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
    window.frames["print_frame"].document.title = 'Laporan Stok Suku Cadang';
    window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
    window.frames["print_frame"].window.focus();
    window.frames["print_frame"].window.print();
}
//]]>
</script>
