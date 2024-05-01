<?php
include 'koneksi.php';
error_reporting(0);
?>
<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header">
        <a class="btn btn-defaul" href="v_nota_penjualan.php">Kembali</a>
        <a class="btn btn-default no-print" href="javascript:printDiv('area-1');">Print</a>
      </h3>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div id="area-1">
        <div>
          <div align="center">
            <!-- <img src="assets/images/logo-report.png" width="200px" alt="Logo Artha Laras"/><br> -->
            <!-- Jl. Dr. Ciptomangunkusumo, No. 11, Ciledug - Tangerang 15153,<br>
            Telp: 021-7319980 / 0812-1341-1361 <br><br> -->
          </div>
          <hr>
          <!-- <div align="center">
            <b><u>Laporan Penjualan</u></b>
          </div>
        </div> -->
<div>
  <?php
  include 'koneksi.php';
  $kd_nota = $_GET['kd_nota'];
  $sql="select a.kd_nota, a.tgl_nota, a.id_pelanggan, c.nm_pelanggan, c.alamat, b.kd_sukucadang, e.nm_sukucadang, b.hrg_jual, b.jml_jual, b.hrg_jual * b.jml_jual as jumhar
        from nota_jual a, dtl_penjualan b, pelanggan c, sukucadang e
        where a.kd_nota = b.kd_nota and a.id_pelanggan = c.id_pelanggan and b.kd_sukucadang = e.kd_sukucadang and
        a.kd_nota = '$kd_nota'";
  $query=mysqli_query($koneksi,$sql);
  $data=mysqli_fetch_array($query);
  ?>
  <!-- <br>
    <b>Periode awal :</b> <?php echo $periode_awal; ?> s/d <b>Periode akhir :</b> <?php echo $periode_akhir; ?><br>
  <br> -->

  <table style='width:100%; font-size:16pt; font-family:calibri; border-collapse: collapse;' border = '0'>
<td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
<span style='font-size:14pt'><b>NOTA PENJUALAN : <?php echo $data['kd_nota'];?></b></span></br>
BENGKEL HORAS MOTOR</br>
Jl. Anggrek Rosliana 3 No. 3, Slipi, Palmerah, Jakarta Barat</br>
Telp : 021-7426611
</td>
<td style='vertical-align:top' width='30%' align='left'>
<b><span style='font-size:16pt'>Jakarta Barat, <?php echo $data['tgl_nota'];?> </span></b></br>
Kepada Yth : <?php echo $data['nm_pelanggan'];?></br>
Alamat : <?php echo $data['alamat'];?></br>
</td>
</table>
<!-- <table style='width:100%; font-size:8pt; font-family:calibri; border-collapse: collapse;' border = '0'>
<td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
Nama Supplier : Pelanggan</br>
Alamat : -</br>
No. Telpon:sasa

</td>
</table> --><br>
<!-- <table cellspacing='0' style='width:100%; font-size:8pt; font-family:calibri;  border-collapse: collapse;' border='1'>
 
<tr align='center'>
<td width='10%'>Kode Barang</td>
<td width='20%'>Nama Barang</td>
<td width='13%'>Harga</td>
<td width='4%'>Qty</td>
<td width='7%'>Discount</td>
<td width='13%'>Total Harga</td>
<tr><td>T501F</td>
<td>Asus Zenfone 5</td>
<td>Rp2.400.000,00</td>
<td>1</td>
<td>Rp0,00</td>
<td style='text-align:right'>Rp2.400.000,00</td>
<tr><td>T12</td><td>Tinta</td>
<td>Rp60.000,00</td>
<td>1</td>
<td>Rp0,00</td>
<td style='text-align:right'>Rp60.000,00</td></tr>
 
<tr>
<td colspan = '5'><div style='text-align:right'>Total Yang Harus Di Bayar Adalah : </div></td>
<td style='text-align:right'>Rp2.460.000,00</td>
</tr>
<tr>
<td colspan = '6'><div style='text-align:right'>Terbilang : Dua Juta Empat Ratus Enam Puluh  Ribu  Rupiah</div></td>
</tr>
<tr>
<td colspan = '5'><div style='text-align:right'>Cash : </div></td>
<td style='text-align:right'>Rp2.460.000,00</td>
</tr>
<tr>
<td colspan = '5'><div style='text-align:right'>Kembalian : </div></td><td style='text-align:right'>Rp0,00</td>
</tr>
<tr>
<td colspan = '5'><div style='text-align:right'>DP : </div></td>
<td style='text-align:right'>Rp0,00</td>
</tr>
<tr>
<td colspan = '5'><div style='text-align:right'>Sisa : </div></td>
<td style='text-align:right'>Rp0,00</td></tr>
</table>
 -->

 <table width="100%" border="1" cellspacing="0">
  <tr>
    <td align="center"><b>No</b></td>
    <td align="center"><b>Kode Suku Cadang</b></td>
    <td align="center"><b>Nama Suku Cadang</b></td>
    <td align="center"><b>Harga Jual</b></td>
    <td align="center"><b>Jumlah Jual</b></td>
    <td align="center"><b>Jumlah Harga</b></td>
  </tr>
  <?php
  $no=1;
  $i= 1;
  $a="select a.kd_nota, a.tgl_nota, a.id_pelanggan, c.nm_pelanggan, c.alamat, b.kd_sukucadang, e.nm_sukucadang, b.hrg_jual, b.jml_jual, b.hrg_jual * b.jml_jual as jumhar
        from nota_jual a, dtl_penjualan b, pelanggan c, sukucadang e
        where a.kd_nota = b.kd_nota and a.id_pelanggan = c.id_pelanggan and b.kd_sukucadang = e.kd_sukucadang and
        a.kd_nota = '$kd_nota'";
    $b=mysqli_query($koneksi,$a);
   
   while($c=mysqli_fetch_array($b)){
    $penjualan[$i] = $c['kd_nota'];
   ?>
  <tr>
  <td><?php echo $no++;?></td>
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
        a.kd_nota = '$kd_nota'";
    $f=mysqli_query($koneksi,$e);
    $total=mysqli_fetch_array($f);
?>
<p style="text-align:right;"><b>Grand Total: Rp <?php echo $total['jumhar']; ?></b></p>
<!-- <b>Grand Total: Rp <?php echo $total['jumhar']; ?></b> -->
<div align="right">
  <table width="150px" border="0" height="150px">
    <tr>
      <td align="center"><b>Hormat Kami</b></td>
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
    window.frames["print_frame"].document.title = 'Nota Penjualan';
    window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
    window.frames["print_frame"].window.focus();
    window.frames["print_frame"].window.print();
}
//]]>
</script>
