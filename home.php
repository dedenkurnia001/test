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
    <link href="assets/libs/flot/css/float-chart.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.min.js"></script>
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
                                <li class="sidebar-item"><a href="v_supplier.php" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Data Supplier </span></a></li>
                                <li class="sidebar-item"><a href="v_kendaraan.php" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Data Kendaraan </span></a></li>
                                <li class="sidebar-item"><a href="v_servis.php" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Data Servis </span></a></li>
                            </ul>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Data Transaksi </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
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
                        <h4 class="page-title">Dashboard</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
                <!-- Sales Cards  -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1>
                                <?php
                                include "koneksi.php";
                                $sql="select count(kd_sukucadang) as 'totalsukucadang' from sukucadang";
                                $query=mysqli_query($koneksi,$sql);
                                $data=mysqli_fetch_array($query);
                                ?>
                                <h6 class="text-white"><?php echo $data['totalsukucadang'];?> Suku Cadang</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                   
                     <!-- Column -->
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-warning text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-collage"></i></h1>
                                <?php
                                include "koneksi.php";
                                $sql="select count(id_pelanggan) as 'totalpelanggan' from pelanggan";
                                $query=mysqli_query($koneksi,$sql);
                                $data=mysqli_fetch_array($query);
                                ?>
                                <h6 class="text-white"><?php echo $data['totalpelanggan'];?> Data Pelanggan</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-danger text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-border-outside"></i></h1>
                                <?php
                                include "koneksi.php";
                                $sql="select count(no_polisi) as 'totalno_polisi' from kendaraan";
                                $query=mysqli_query($koneksi,$sql);
                                $data=mysqli_fetch_array($query);
                                ?>
                                <h6 class="text-white"><?php echo $data['totalno_polisi'];?> Data Kendaraan</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-info text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-border-outside"></i></h1>
                                <?php
                                include "koneksi.php";
                                $sql="select count(kd_perbaikan) as 'totalperbaikan' from perbaikan";
                                $query=mysqli_query($koneksi,$sql);
                                $data=mysqli_fetch_array($query);
                                ?>
                                <h6 class="text-white"><?php echo $data['totalperbaikan'];?> Data Perbaikan</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                   
                    <!-- Column -->
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-info text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-relative-scale"></i></h1>
                                <?php
                                include "koneksi.php";
                                $sql="select count(kd_nota) as 'totalkd_nota' from nota_jual";
                                $query=mysqli_query($koneksi,$sql);
                                $data=mysqli_fetch_array($query);
                                ?>
                                <h6 class="text-white"><?php echo $data['totalkd_nota'];?> Data Penjualan</h6>
                            </div>
                        </div>
                    </div>
                     <!-- Column -->
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-relative-scale"></i></h1>
                                <?php
                                include "koneksi.php";
                                $sql="select count(kd_po) as 'totalkd_po' from po";
                                $query=mysqli_query($koneksi,$sql);
                                $data=mysqli_fetch_array($query);
                                ?>
                                <h6 class="text-white"><?php echo $data['totalkd_po'];?> Data Pembelian</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    
                    <!-- Column -->
                    
                    <!-- Column -->
                </div>
                <!-- ============================================================== -->
                <!-- Sales chart -->
                <!-- ============================================================== -->
                <div class="col-md-14">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Grafik Penjualan</h5>
                                <?php
                                    //include 'koneksi.php';
                                    
                                    $conn = new mysqli('localhost', 'root', '', 'db_penjualan');
                                    $sql = "SELECT m.mon,  COALESCE(YEAR(a.tgl_nota), YEAR(CURDATE())) as 'tahun',
                                    SUM(a.jml_biaya) AS jumlah_omzet
                             FROM (SELECT 1 as mon UNION ALL
                                   SELECT 2 UNION ALL
                                   SELECT 3 UNION ALL
                                   SELECT 4 UNION ALL
                                   SELECT 5 UNION ALL
                                   SELECT 6 UNION ALL
                                   SELECT 7 UNION ALL
                                   SELECT 8 UNION ALL
                                   SELECT 9 UNION ALL
                                   SELECT 10 UNION ALL
                                   SELECT 11 UNION ALL
                                   SELECT 12
                                  ) m LEFT JOIN
                                  nota_jual a
                                  ON MONTH(a.tgl_nota) = m.mon
                             GROUP BY m.mon";
                                    $nama_bulan = $conn->query($sql);
                                    $total_omzet = $conn->query($sql);
                                ?>
                                <div style="height: 75%; width: 100%;">
                                <canvas id="myChart" class="chart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- ============================================================== -->
                <!-- Sales chart -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Recent comment and chats -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- column -->
                   
                    <!-- column -->

                    
                </div>
                <!-- ============================================================== -->
                <!-- Recent comment and chats -->
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
    <script src="assets/libs/chart/matrix.interface.js"></script>
    <script src="assets/libs/chart/excanvas.min.js"></script>
    <script src="assets/libs/flot/jquery.flot.js"></script>
    <script src="assets/libs/flot/jquery.flot.pie.js"></script>
    <script src="assets/libs/flot/jquery.flot.time.js"></script>
    <script src="assets/libs/flot/jquery.flot.stack.js"></script>
    <script src="assets/libs/flot/jquery.flot.crosshair.js"></script>
    <script src="assets/libs/chart/jquery.peity.min.js"></script>
    <script src="assets/libs/chart/matrix.charts.js"></script>
    <script src="assets/libs/chart/jquery.flot.pie.min.js"></script>
    <script src="assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="assets/libs/chart/turning-series.js"></script>
    <script src="dist/js/pages/chart/chart-page-init.js"></script>
    <script>
      var ctx = document.getElementById("myChart").getContext('2d');
      var myChart = new Chart(ctx, {
      type: 'bar',        //Tipe tampilan grafik, sobat bisa menggunakan tampilan bar, pie, line, radar dan sebagainya
      data: {
        labels: [<?php while($b = mysqli_fetch_array($nama_bulan)) { echo '"' . $b['mon'] . '",'; } ?>], //keterangan nama-nama label
        datasets: [{
            label: 'GRAFIK', //Judul Grafik
            data: [<?php while($a = mysqli_fetch_array($total_omzet)) { 
                $tahun= date('Y');
                if($a['tahun']==$tahun){
                $aa = $a['jumlah_omzet'];
            }else{
                $aa = 0;
            }
                echo $aa . ', '; } ?>], //Data Grafik
            backgroundColor: [
                'blue',  //Warna Background
                'red', //Warna Background
                'green', //Warna Background
                'silver', //Warna Background
                'black', //Warna Background
                'yellow', //Warna Background
                'purple', //Warna Background
                'brown', //Warna Background
                'magenta', //Warna Background
                'gold', //Warna Background
                '#9BD0F5', //Warna Background
                '#FFB1C1' //Warna Background
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
    });
  </script>
</body>

</html>