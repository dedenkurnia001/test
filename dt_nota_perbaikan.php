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
include "koneksi.php";
if(isset($_GET['kd_perbaikan'])){
$kd_perbaikan=$_GET['kd_perbaikan']; 
$sql="select a.kd_perbaikan, a.tgl_perbaikan, a.no_polisi, b.id_pelanggan, c.nm_pelanggan, b.merek, b.tipe,
a.id_mekanik, d.nm_mekanik from perbaikan a, kendaraan b, pelanggan c, mekanik d 
where a.kd_perbaikan='$kd_perbaikan' and a.no_polisi = b.no_polisi
and b.id_pelanggan = c.id_pelanggan and a.id_mekanik = d.id_mekanik";
$query=mysqli_query($koneksi,$sql);
$data=mysqli_fetch_array($query);
}else{
echo "Data yang diubah belum ada";
}
?>

<?php

if(isset($_POST['batal'])){
        echo "<script language='javascript'>
        document.location='v_nota_perbaikan.php';
        </script>";
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
                        <h4 class="page-title">Detail Cetak Nota Perbaikan</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Data Transaksi</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Cetak Nota Perbaikan</li>
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
                                    <h4 class="card-title">Detail Data Cetak Nota Perbaikan</h4>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Kode Perbaikan</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="kd_sukucadang" id="kd_sukucadang" class="form-control" id="fname" placeholder="Kode Perbaikan" value="<?php echo $data['kd_perbaikan'];?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Tanggal Perbaikan</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="nm_sukucadang" id="nm_sukucadang" class="form-control" id="fname" placeholder="Tanggal Perbaikan" value="<?php echo $data['tgl_perbaikan'];?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Id Pelanggan</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="hrg_jual" id="hrg_jual" class="form-control" id="fname" placeholder="Id Pelanggan" value="<?php echo $data['id_pelanggan'];?>" readonly>
                                        </div>
                                    </div>
                                     <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Nama Pelanggan</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="stok" id="stok" class="form-control" id="fname" placeholder="Nama Pelanggan" value="<?php echo $data['nm_pelanggan'];?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">No. Polisi</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="jml_jual" id="jml_jual" class="form-control" id="fname" placeholder="No. Polisi" value="<?php echo $data['no_polisi'];?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Merek</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="jml_harga" id="jml_harga" class="form-control" id="fname" placeholder="Merek" value="<?php echo $data['merek'];?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Tipe</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="jml_harga" id="jml_harga" class="form-control" id="fname" placeholder="Tipe" value="<?php echo $data['tipe'];?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Id Mekanik</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="jml_harga" id="jml_harga" class="form-control" id="fname" placeholder="Id Mekanik" value="<?php echo $data['id_mekanik'];?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Nama Mekanik</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="jml_harga" id="jml_harga" class="form-control" id="fname" placeholder="Nama Mekanik" value="<?php echo $data['nm_mekanik'];?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Total Harga</label>
                                        <div class="col-sm-4">
                                        <?php
                                          $kd_perbaikan=$_GET['kd_perbaikan']; 
                                          $total_sukucadang="select sum(hrg_jual * jml_sukucadang) as total from dtl_sukucadang a where a.kd_perbaikan = '$kd_perbaikan'";
                                          $exec_total_sukucadang=mysqli_query($koneksi,$total_sukucadang);
                                          $data_total_sukucadang=mysqli_fetch_array($exec_total_sukucadang);

                                          $total_servis="select sum(hrg_servis) as total from dtl_servis b where b.kd_perbaikan = '$kd_perbaikan'";
                                          $exec_total_servis=mysqli_query($koneksi,$total_servis);
                                          $data_total_servis=mysqli_fetch_array($exec_total_servis);

                                          $grand_total = $data_total_sukucadang['total'] + $data_total_servis['total'];
                                        ?>
                                            <input type="text" name="total_harga" id="total_harga" class="form-control" id="fname" value="<?php echo $grand_total; ?>" placeholder="Total Harga" readonly>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Suku Cadang</th>
                                                <th>Nama Suku Cadang</th>
                                                <th>Harga Jual</th>
                                                <th>Jumlah Jual</th>
                                                <th>Jumlah Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php
                                    //session_start();
                                    //if(isset($_SESSION['username']) && isset($_SESSION['level'])){
                                    include "koneksi.php";
                                    ?>
                                    <?php
                                      $a="select * from dtl_sukucadang a, sukucadang b where a.kd_sukucadang = b.kd_sukucadang and a.kd_perbaikan = '$kd_perbaikan' order by a.kd_sukucadang";
                                      $b=mysqli_query($koneksi,$a);
                                      $no=1;
                                      while($c=mysqli_fetch_array($b)){
                                    ?>
                                            <tr>
                                                <td><?php echo $no;?></td>
                                                <td><?php echo $c['kd_sukucadang'];?></td>
                                                <td><?php echo $c['nm_sukucadang'];?></td>
                                                <td><?php echo $c['hrg_jual'];?></td>
                                                <td><?php echo $c['jml_sukucadang'];?></td>
                                                <?php $jumhar = $c['hrg_jual'] * $c['jml_sukucadang'];?>
                                                <td><?php echo $jumhar;?></td>
                                                </td>
                                            </tr>
                                    <?php $no++; } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Suku Cadang</th>
                                                <th>Nama Suku Cadang</th>
                                                <th>Harga Jual</th>
                                                <th>Jumlah Jual</th>
                                                <th>Jumlah Harga</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <div class="card-body">
                                    
                                    <div class="table-responsive">
                                    <table id="zero_config2" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Servis</th>
                                                <th>Nama Servis</th>
                                                <th>Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php
                                    //session_start();
                                    //if(isset($_SESSION['username']) && isset($_SESSION['level'])){
                                    include "koneksi.php";
                                    ?>
                                    <?php
                                      $a="select * from dtl_servis a, servis b where a.kd_servis = b.kd_servis and a.kd_perbaikan = '$kd_perbaikan' order by a.kd_servis";
                                      $b=mysqli_query($koneksi,$a);
                                      $no=1;
                                      while($c=mysqli_fetch_array($b)){
                                    ?>
                                            <tr>
                                                <td><?php echo $no;?></td>
                                                <td><?php echo $c['kd_servis'];?></td>
                                                <td><?php echo $c['nm_servis'];?></td>
                                                <td><?php echo $c['hrg_servis'];?></td>
                                                </td>
                                            </tr>
                                    <?php $no++; } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Servis</th>
                                                <th>Nama Servis</th>
                                                <th>Harga</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
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
                                <th>Harga Jual</th>
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
                                <td id='hrg_jual_<?php echo $tampil['kd_sukucadang'];?>'><?php echo $tampil['hrg_jual']; ?></td>
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
                     
                      <h5 class="modal-title" id="exampleModalLabel">Pilih Pelanggan</h5>
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
                                <th>Id Pelanggan</th>
                                <th>Nama Pelanggan</th>
                                <th>No. Polisi</th>
                                <th>Merek</th>
                                <th>Tipe</th>
                                <th>Opsi</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              $get = mysqli_query($koneksi,"select a.no_polisi, a.id_pelanggan, b.nm_pelanggan, a.merek, a.tipe,
                              a.no_rangka, a.warna from kendaraan a, pelanggan b
                              where a.id_pelanggan = b.id_pelanggan order by a.no_polisi");
                              while ($tampil=mysqli_fetch_array($get)) {
                              ?>
                              <tr>
                                <td id='id_pelanggan_<?php echo $tampil['id_pelanggan'];?>'><?php echo $tampil['id_pelanggan']; ?></td>
                                <td id='nm_pelanggan_<?php echo $tampil['id_pelanggan'];?>'><?php echo $tampil['nm_pelanggan']; ?></td>
                                <td id='no_polisi_<?php echo $tampil['id_pelanggan'];?>'><?php echo $tampil['no_polisi']; ?></td>
                                <td id='merek_<?php echo $tampil['id_pelanggan'];?>'><?php echo $tampil['merek']; ?></td>
                                <td id='tipe_<?php echo $tampil['id_pelanggan'];?>'><?php echo $tampil['tipe']; ?></td>
                                <td><button onclick="pilihPelanggan('<?php echo $tampil['id_pelanggan']; ?>')" class="btn btn-info btn-xs"><i class="fas fa-plus"></i></button></td>
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

              <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                     
                      <h5 class="modal-title" id="exampleModalLabel">Pilih Servis</h5>
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
                                <th>Kode Servis</th>
                                <th>Nama Servis</th>
                                <th>Harga</th>
                                <th>Opsi</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              $get = mysqli_query($koneksi,"SELECT * FROM servis order by kd_servis");
                              while ($tampil=mysqli_fetch_array($get)) {
                              ?>
                              <tr>
                                <td id='kd_servis_<?php echo $tampil['kd_servis'];?>'><?php echo $tampil['kd_servis']; ?></td>
                                <td id='nm_servis_<?php echo $tampil['kd_servis'];?>'><?php echo $tampil['nm_servis']; ?></td>
                                <td id='harga_<?php echo $tampil['kd_servis'];?>'><?php echo $tampil['harga']; ?></td>
                                <td><button onclick="pilihServis('<?php echo $tampil['kd_servis']; ?>')" class="btn btn-info btn-xs"><i class="fas fa-plus"></i></button></td>
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

              <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                     
                      <h5 class="modal-title" id="exampleModalLabel">Pilih Mekanik</h5>
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
                                <th>Id Mekanik</th>
                                <th>Nama Mekanik</th>
                                <th>Opsi</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              $get = mysqli_query($koneksi,"SELECT * FROM mekanik order by id_mekanik");
                              while ($tampil=mysqli_fetch_array($get)) {
                              ?>
                              <tr>
                                <td id='id_mekanik_<?php echo $tampil['id_mekanik'];?>'><?php echo $tampil['id_mekanik']; ?></td>
                                <td id='nm_mekanik_<?php echo $tampil['id_mekanik'];?>'><?php echo $tampil['nm_mekanik']; ?></td>
                                <td><button onclick="pilihMekanik('<?php echo $tampil['id_mekanik']; ?>')" class="btn btn-info btn-xs"><i class="fas fa-plus"></i></button></td>
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
        /****************************************
         *       Basic Table                   *
         ****************************************/
        $('#zero_config2').DataTable();
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
        hrg_jual     = $('#hrg_jual_'+kd_sukucadang).html();
        stok     = $('#stok_'+kd_sukucadang).html();
        $('#kd_sukucadang').val(kd_sukucadang);
        $('#nm_sukucadang').val(nm_sukucadang);
        $('#hrg_jual').val(hrg_jual);
        $('#stok').val(stok);
        $('#myModal').modal('hide');
    }

    function pilihPelanggan(id_pelanggan)
    {
        id_pelanggan = $('#id_pelanggan_'+id_pelanggan).html();
        nm_pelanggan = $('#nm_pelanggan_'+id_pelanggan).html();
        no_polisi = $('#no_polisi_'+id_pelanggan).html();
        merek = $('#merek_'+id_pelanggan).html();
        tipe = $('#tipe_'+id_pelanggan).html();
        $('#id_pelanggan').val(id_pelanggan);
        $('#nm_pelanggan').val(nm_pelanggan);
        $('#no_polisi').val(no_polisi);
        $('#merek').val(merek);
        $('#tipe').val(tipe);
        $('#myModal1').modal('hide');
    }

    function pilihServis(kd_servis)
    {
        kd_servis = $('#kd_servis_'+kd_servis).html();
        nm_servis = $('#nm_servis_'+kd_servis).html();
        harga = $('#harga_'+kd_servis).html();
        $('#kd_servis').val(kd_servis);
        $('#nm_servis').val(nm_servis);
        $('#harga').val(harga);
        $('#myModal2').modal('hide');
    }

    function pilihMekanik(id_mekanik)
    {
        id_mekanik = $('#id_mekanik_'+id_mekanik).html();
        nm_mekanik = $('#nm_mekanik_'+id_mekanik).html();
        $('#id_mekanik').val(id_mekanik);
        $('#nm_mekanik').val(nm_mekanik);
        $('#myModal3').modal('hide');
    }

    function jumhar()
    {
      var hrg_jual = parseInt($("#hrg_jual").val());
      var jml_jual = parseInt($("#jml_jual").val());
      var jumhar    = (hrg_jual*jml_jual);
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