<?php
error_reporting(0);
include "koneksi.php";
if(isset($_POST['login'])){
$username=$_POST['username'];
$password=$_POST['password'];

$a="select * from user a, pegawai b where id_user ='$username' and password='$password' and a.id_user = b.id_pegawai";
$b=mysqli_query($koneksi,$a);
$hasil = mysqli_fetch_array($b);
$result   = mysqli_num_rows($b);
  if($result>0){
  session_start();
  $_SESSION['id_user'] = $hasil['id_user'];
  $_SESSION['nm_pegawai'] = $hasil['nm_pegawai'];
  $_SESSION['role'] = $hasil['role'];
}else
  {
    echo "<script language='javascript'>
  alert('Data user tidak sesuai');
  </script>";
  }
if($hasil['role'] == "Pegawai")
      { 
          header("location: home.php");
      }
else if($hasil['role'] == "Staff")
  {
    header("location:home.php");
  }
else if($hasil['role'] == "Owner")
  {
    header("location:home.php");
  }
else
  {
    
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Bengkel Horas Motor</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist_log/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><b>HORAS MOTOR</b><br><h4>SISTEM INFORMASI BENGKEL</h4></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Login here!</p>

    <form  method="post">
      <div class="form-group has-feedback">
        <input type="text" name="username" class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>