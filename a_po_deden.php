<?php
session_start();
if(!isset($_SESSION['nm_pegawai'])) {
   header('location:index.php'); 
} else { 
   $id_user = $_SESSION['id_user']; 
   $nm_pegawai = $_SESSION['nm_pegawai']; 
   $role = $_SESSION['role']; 
}
?>
<?php
error_reporting(0);
include "koneksi.php";
?>

<?php
$kd_sukucadang = $_GET['kd_sukucadang'];
mysqli_query($koneksi,"DELETE FROM temp_dtl_po WHERE kd_sukucadang='$kd_sukucadang'");

if(isset($_POST['batal'])){
    $a="delete from temp_dtl_po;";
    $b=mysqli_query($koneksi,$a);
      if ($b) {
        echo "<script language='javascript'>
        document.location='v_po.php';
        </script>";
      }
    }

if(isset($_POST['tambah'])){
$kd_po=$_POST['kd_po'];
$kd_sukucadang=$_POST['kd_sukucadang'];
$hrg_beli=$_POST['hrg_beli'];
$jml_beli=$_POST['jml_beli'];
$stok=$_POST['stok'];
$cek  = "SELECT * FROM temp_dtl_po where kd_sukucadang = '$kd_sukucadang'";
$cek2 = mysqli_query($koneksi,$cek);
$cek3 = mysqli_num_rows($cek2);
      
    if (empty($kd_sukucadang) or empty($jml_beli)){
      echo "<script language='javascript'>
alert('Data belum lengkap !');
</script>";

}elseif ($cek3 >= 1) {
      echo "<script language='javascript'>
alert('Data barang sudah ada di list');
</script>";
      
}else{
    $a="insert into temp_dtl_po values('$kd_po','$kd_sukucadang','$jml_beli','$hrg_beli')";
    $b=mysqli_query($koneksi,$a);
      if ($b) {
        echo "<script language='javascript'>
        document.location='a_po.php';
        </script>";
      }
    }
  }

if(isset($_POST['simpan'])){
$kd_po=$_POST['kd_po'];
$tgl_po=$_POST['tgl_po'];
$date = str_replace('/', '-', $tgl_po);
$tgl_po2= date('Y-m-d', strtotime($date));
$id_supplier=$_POST['id_supplier'];
    if (empty($kd_po) or empty($tgl_po) or empty($id_supplier)){
      echo "<script language='javascript'>
alert('Data belum lengkap !');
</script>";
    }else{
    $a="insert into po values('$kd_po','$tgl_po2','$id_supplier')";
    $b=mysqli_query($koneksi,$a);
      if ($a) {
    $simdet  = mysqli_query($koneksi,"SELECT * FROM temp_dtl_po");
    while ($r=mysqli_fetch_row($simdet)) {
      // mysqli_query($koneksi,"UPDATE sukucadang set stok = stok + $r[2] where kd_sukucadang = '$r[1]'");
      mysqli_query($koneksi,"INSERT INTO dtl_po VALUES ('$kd_po','$r[1]','$r[2]','$r[3]')");

    }
    mysqli_query($koneksi,"TRUNCATE TABLE temp_dtl_po");
    echo "<script language='javascript'>
    alert('Cetak PO has been saved');
    document.location='v_po.php';
    </script>";   
      }
    }
  }

function autonumber($tabel, $kolom, $lebar=0, $awalan='')
{
  $host="localhost";
  $user="root";
  $pass="";
  $db="db_penjualan";
  $koneksi=mysqli_connect($host,$user,$pass,$db);

  $query="select $kolom from $tabel order by $kolom desc limit 1";
  $hasil=mysqli_query($koneksi,$query);
  $jumlahrecord = mysqli_num_rows($hasil);
  if($jumlahrecord == 0)
    $nomor=1;
  else
  {
    $row=mysqli_fetch_array($hasil);
    $nomor=intval(substr($row[0],strlen($awalan)))+1;
  }
  if($lebar>0)
    $angka = $awalan.str_pad($nomor,$lebar,"0",STR_PAD_LEFT);
  else
    $angka = $awalan.$nomor;
  return $angka;
}
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Bengkel Horas Motor</title>
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="assets/extra-libs/multicheck/multicheck.css">
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link href="dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="home.php">
                        <!-- Logo icon -->
                        <b class="logo-icon p-l-10">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="assets/images/logo-icon.png" alt="homepage" class="light-logo" />
                           
                        </b>
                        <!--End Logo icon -->
                         <!-- Logo text -->
                        <span class="logo-text">
                             <!-- dark Logo text -->
                             <img src="assets/images/logo-text.png" alt="homepage" class="light-logo" />
                            
                        </span>
                        <!-- Logo icon -->
                        <!-- <b class="logo-icon"> -->
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <!-- <img src="../../assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->
                            
                        <!-- </b> -->
                        <!--End Logo icon -->
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                        <!-- ============================================================== -->
                        <!-- create new -->
                        <!-- ============================================================== -->
                       
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <font color="white"> <?php echo $nm_pegawai;?> - <?php echo $role;?></font><a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31"></a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated">
                                <a class="dropdown-item" href="akun.php?id_user=<?php echo $id_user;?>"><i class="ti-settings m-r-5 m-l-5"></i> Account Setting</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                                
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="home.php" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                       
                        
                        
                       
                       <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Data Master </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="v_sukucadang.php" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Data Suku Cadang </span></a></li>
                                <li class="sidebar-item"><a href="v_pelanggan.php" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Data Pelanggan </span></a></li>
                                <li class="sidebar-item"><a href="v_mekanik.php" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Data Mekanik </span></a></li>
                            </ul>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Data Transaksi </span></a>
                            <ul aria-expanded="false" class="treeview-menu">
                                <li class="sidebar-item"><a href="v_nota_penjualan.php" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Cetak Nota Penjualan </span></a></li> 
                                <li class="sidebar-item"><a href="v_perbaikan.php" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Perbaikan </span></a></li>   
                                <li class="sidebar-item"><a href="v_nota_perbaikan.php" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Cetak Nota Perbaikan </span></a></li>   
                                <li class="sidebar-item"><a href="v_po.php" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Cetak PO </span></a></li>   
                                <li class="sidebar-item"><a href="v_penerimaan.php" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Cetak Penerimaan </span></a></li>  
                            </ul>
                        </li> 
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Data Laporan </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="l_stok_sukucadang.php" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">Lap. Stok Suku Cadang </span></a></li> 
                                <li class="sidebar-item"><a href="l_kinerja_mekanik.php" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">Lap. Kinerja Mekanik </span></a></li> 
                                <li class="sidebar-item"><a href="l_penjualan.php" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">Lap. Penjualan </span></a></li>   
                                <li class="sidebar-item"><a href="l_perbaikan.php" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">Lap. Perbaikan </span></a></li>   
                                <li class="sidebar-item"><a href="l_pembelian.php" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">Lap. Pembelian </span></a></li>   
                                <li class="sidebar-item"><a href="l_pendapatan_servis.php" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">Lap. Pendapatan Jasa Servis </span></a></li>   
                                <li class="sidebar-item"><a href="l_sukucadang_terlaris.php" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">Lap. 5 Suku Cadang Terlaris </span></a></li>   
                            </ul>
                        </li> 
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Add Cetak PO</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Data Transaksi</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Cetak PO</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                                <form class="form-horizontal" method="post">
                                <div class="card-body">
                                    <h4 class="card-title">Cetak PO</h4>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">id pelanggan</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="kd_sukucadang" id="id_pelanggan" class="form-control" id="fname" placeholder="id_pelanggan" readonly>
                                        </div><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#popup" >Cari</button>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Nama pelangan</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="nm_sukucadang" id="nm_pelanggan" class="form-control" id="fname" placeholder="nama_pelanggan" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">jenis kelamin</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="hrg_beli" id="jenkel" class="form-control" id="jenis_kelamin" placeholder="jenis_kelamin" readonly>
                                        </div>
                                    </div>
                                     <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">notelpon</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="stok" id="no_telpon" class="form-control" id="notelpon" placeholder="notelpon" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">alamat</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="jml_beli" id="alamat" class="form-control" id="alamat" placeholder="alamat" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Jumlah Harga</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="jml_harga" id="jml_harga" class="form-control" id="fname" placeholder="Jumlah Harga" readonly>
                                        </div><input type="submit" name="tambah" value="Tambah" class="btn btn-success">
                                    </div>
                                    <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Suku Cadang</th>
                                                <th>Nama Suku Cadang</th>
                                                <th>Harga Beli</th>
                                                <th>Jumlah Beli</th>
                                                <th>Jumlah Harga</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php
                                    //session_start();
                                    //if(isset($_SESSION['username']) && isset($_SESSION['level'])){
                                    include "koneksi.php";
                                    ?>
                                    <?php
                                      $a="select * from temp_dtl_po a, sukucadang b where a.kd_sukucadang = b.kd_sukucadang order by a.kd_sukucadang";
                                      $b=mysqli_query($koneksi,$a);
                                      $no=1;
                                      while($c=mysqli_fetch_array($b)){
                                    ?>
                                            <tr>
                                                <td><?php echo $no;?></td>
                                                <td><?php echo $c['kd_sukucadang'];?></td>
                                                <td><?php echo $c['nm_sukucadang'];?></td>
                                                <td><?php echo $c['hrg_beli'];?></td>
                                                <td><?php echo $c['jml_beli'];?></td>
                                                <?php $jumhar = $c['hrg_beli'] * $c['jml_beli'];?>
                                                <td><?php echo $jumhar;?></td>
                                                <td><center><a href='a_po.php?kd_sukucadang=<?php echo $c['kd_sukucadang']; ?>' class="btn btn-danger btn-xs"><i class="far fa-trash-alt"></i></a></center>
                                                </td>
                                            </tr>
                                    <?php $no++; } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Suku Cadang</th>
                                                <th>Nama Suku Cadang</th>
                                                <th>Harga Beli</th>
                                                <th>Jumlah Beli</th>
                                                <th>Jumlah Harga</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Kode PO</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="kd_po" class="form-control" id="fname" placeholder="Kode PO" value="<?=autonumber("po","kd_po",7,"PO")?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Tanggal PO</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="tgl_po" class="form-control" id="datepicker-autoclose" placeholder="dd/mm/yyyy">
                                        </div>
                                    </div>
                                  <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Id Supplier</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="id_supplier" id="id_supplier" class="form-control" id="fname" placeholder="Id Supplier" readonly>
                                        </div><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal1" >Cari</button>
                                    </div>
                                  <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Nama Supplier</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="nm_supplier" id="nm_supplier" class="form-control" id="fname" placeholder="Nama Supplier" readonly>
                                        </div>
                                    </div>
                                  <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Total Harga</label>
                                        <div class="col-sm-4">
                                        <?php
                                          $a="select sum(hrg_beli * jml_beli) as total from temp_dtl_po";
                                          $b=mysqli_query($koneksi,$a);
                                          while($c=mysqli_fetch_array($b)){
                                        ?>
                                            <input type="text" name="total_harga" id="total_harga" class="form-control" id="fname" value="<?php echo $c['total']; }?>" placeholder="Total Harga" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <input type="submit" name="simpan" class="btn btn-primary" value="Save">
                                        <input type="submit" name="batal" class="btn btn-danger" value="Cancel">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                Arnold - 2023
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <div class="modal fade" id="popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                     
                      <h5 class="modal-title" id="exampleModalLabel">Pilih pelanggan</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true ">&times;</span>
                                                </button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="table-responsive">
                          <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                              <tr>
                                <th>id pelanggan</th>
                                <th>Nama pelanggan</th>
                                <th>jenis kelamin</th>
                                <th>no telpon</th>
                                <th>alamat</th>
                                <th>opsi</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              $get = mysqli_query($koneksi,"SELECT * FROM pelanggan order by id_pelanggan");
                              while ($tampil=mysqli_fetch_array($get)) {
                              ?>
                              <tr>
                                <td id='id_pelanggan_<?php echo $tampil['id_pelanggan'];?>'><?php echo $tampil['id_pelanggan']; ?></td>
                                <td id='nm_pelanggan_<?php echo $tampil['id_pelanggan'];?>'><?php echo $tampil['nm_pelanggan']; ?></td>
                                <td id='jenkel_<?php echo $tampil['id_pelanggan'];?>'><?php echo $tampil['jenkel']; ?></td>
                                <td id='no_telpon_<?php echo $tampil['id_pelanggan'];?>'><?php echo $tampil['no_telpon']; ?></td>
                                <td id='alamat_<?php echo $tampil['id_pelanggan'];?>'><?php echo $tampil['alamat']; ?></td>
                                <td><button onclick="pilihpelanggan('<?php echo $tampil['id_pelanggan']; ?>')" class="btn btn-info btn-xs"><i class="fas fa-plus"></i></button></td>
                              </tr>
                              <?php } ?>

                            </tbody>
                          </table>
                        </div>
                          <!-- /.table-responsive -->
                        </div>
                        <!-- /.col-lg-12 -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                     
                      <h5 class="modal-title" id="exampleModalLabel">Pilih Suku Cadang</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true ">&times;</span>
                                                </button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="table-responsive">
                          <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                              <tr>
                                <th>Kode Suku Cadang</th>
                                <th>Nama Suku Cadang</th>
                                <th>Harga Beli</th>
                                <th>Stok</th>
                                <th>Opsi</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              $get = mysqli_query($koneksi,"SELECT * FROM sukucadang order by kd_sukucadang");
                              while ($tampil=mysqli_fetch_array($get)) {
                              ?>
                              <tr>
                                <td id='kd_sukucadang_<?php echo $tampil['kd_sukucadang'];?>'><?php echo $tampil['kd_sukucadang']; ?></td>
                                <td id='nm_sukucadang_<?php echo $tampil['kd_sukucadang'];?>'><?php echo $tampil['nm_sukucadang']; ?></td>
                                <td id='hrg_beli_<?php echo $tampil['kd_sukucadang'];?>'><?php echo $tampil['hrg_beli']; ?></td>
                                <td id='stok_<?php echo $tampil['kd_sukucadang'];?>'><?php echo $tampil['stok']; ?></td>
                                <td><button onclick="pilihSukuCadang('<?php echo $tampil['kd_sukucadang']; ?>')" class="btn btn-info btn-xs"><i class="fas fa-plus"></i></button></td>
                              </tr>
                              <?php } ?>

                            </tbody>
                          </table>
                        </div>
                          <!-- /.table-responsive -->
                        </div>
                        <!-- /.col-lg-12 -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>




<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                     
                      <h5 class="modal-title" id="exampleModalLabel">Pilih Supplier</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true ">&times;</span>
                                                </button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="table-responsive">
                          <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                              <tr>
                                <th>Id Supplier</th>
                                <th>Nama Supplier</th>
                                <th>No. Telpon</th>
                                <th>Alamat</th>
                                <th>Opsi</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              $get = mysqli_query($koneksi,"SELECT * FROM supplier order by id_supplier");
                              while ($tampil=mysqli_fetch_array($get)) {
                              ?>
                              <tr>
                                <td id='id_supplier_<?php echo $tampil['id_supplier'];?>'><?php echo $tampil['id_supplier']; ?></td>
                                <td id='nm_supplier_<?php echo $tampil['id_supplier'];?>'><?php echo $tampil['nm_supplier']; ?></td>
                                <td id='no_telpon_<?php echo $tampil['id_supplier'];?>'><?php echo $tampil['no_telpon']; ?></td>
                                <td id='alamat_<?php echo $tampil['id_supplier'];?>'><?php echo $tampil['alamat']; ?></td>
                                <td><button onclick="pilihSupplier('<?php echo $tampil['id_supplier']; ?>')" class="btn btn-info btn-xs"><i class="fas fa-plus"></i></button></td>
                              </tr>
                              <?php } ?>

                            </tbody>
                          </table>
                        </div>
                          <!-- /.table-responsive -->
                        </div>
                        <!-- /.col-lg-12 -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>       
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
    <!-- this page js -->
    <script src="assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
    <script src="assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/extra-libs/multicheck/jquery.multicheck.js"></script>
    <script src="assets/extra-libs/DataTables/datatables.min.js"></script>
    <script>
        /****************************************
         *       Basic Table                   *
         ****************************************/
        $('#zero_config').DataTable();
    </script>
    <script>
       jQuery('.mydatepicker').datepicker();
        jQuery('#datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true
        });
        var quill = new Quill('#editor', {
            theme: 'snow'
        });
    </script>
    <script type="text/javascript">
    function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
        return true;
    }

    function huruf(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if ((charCode < 65 || charCode > 90)&&(charCode < 97 || charCode > 122)&&charCode>32)
        return false;
        return true;
    }

    function pilihSukuCadang(kd_sukucadang)
    {
        kd_sukucadang = $('#kd_sukucadang_'+kd_sukucadang).html();
        nm_sukucadang     = $('#nm_sukucadang_'+kd_sukucadang).html();
        hrg_beli     = $('#hrg_beli_'+kd_sukucadang).html();
        stok     = $('#stok_'+kd_sukucadang).html();

        $('#kd_sukucadang').val(kd_sukucadang);
        $('#nm_sukucadang').val(nm_sukucadang);
        $('#hrg_beli').val(hrg_beli);
        $('#stok').val(stok);

        $('#myModal').modal('hide');
    }

    function pilihpelanggan(id_pelanggan)
    {
        id_pelanggan = $('#id_pelanggan_'+id_pelanggan).html();
        nm_pelanggan     = $('#nm_pelanggan_'+id_pelanggan).html();
        jenkel    = $('#jenkel_'+id_pelanggan).html();
        no_telpon    = $('#no_telpon_'+id_pelanggan).html();
        alamat     = $('#alamat_'+id_pelanggan).html();

        $('#id_pelanggan').val(id_pelanggan);
        $('#nm_pelanggan').val(nm_pelanggan);
        $('#jenkel').val(jenkel);
        $('#no_telpon').val(no_telpon);
        $('#alamat').val(alamat);

        $('#popup').modal('hide');
    }

    function pilihSupplier(id_supplier)
    {
        id_supplier = $('#id_supplier_'+id_supplier).html();
        nm_supplier = $('#nm_supplier_'+id_supplier).html();
        $('#id_supplier').val(id_supplier);
        $('#nm_supplier').val(nm_supplier);
        $('#myModal1').modal('hide');
    }

    function jumhar()
    {
      var hrg_beli = parseInt($("#hrg_beli").val());
      var jml_beli = parseInt($("#jml_beli").val());
      var jumhar    = (hrg_beli*jml_beli);
      $("#jml_harga").val(jumhar);
    }

    function pembayaran_harga()
    {
      var bayar = parseInt($("#bayar").val());
      var total_harga = parseInt($("#total_harga").val());
      var kmb    = (bayar-total_harga);
      $("#kembalian").val(kmb);
    }


</script>

</body>

</html>