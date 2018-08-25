<?php 
session_start();
if (isset($_SESSION['userlogin']))
{
  header('location:dashboard.php?filterdata=own');
}
?>

<html>
  <head>

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<link rel="stylesheet" type="text/css" href="css/a.css">
<title>Program AGT - Data Barang & Penjualan</title>
  </head>
<body id="LoginForm">
<div class="container">
<div class="login-form">
<div class="main-div">
    <div class="panel">
   <h2>Data Barang & Penjualan</h2>
   <p>Silahkan Login untuk melakukan Penambahan / Perubahan Data</p>
   </div>
   <!-- Tempat pHP DISINI -->
   	<?php 
// Validasi Login
if (isset($_POST['button'])){
include_once('koneksi.php');
$username = mysqli_real_escape_string($konek,$_POST['username']);
      $password = mysqli_real_escape_string($konek,$_POST['password']); 
      $sql = "SELECT id_user FROM db_user WHERE username='$username' and password='$password'";
      $result = mysqli_query($konek,$sql);
      $row = mysqli_fetch_array($result);
      $count = mysqli_num_rows($result);

      if($count == 1) {
        // Login Berhasil
        echo "<div class=\"alert alert-success\" role=\"alert\"><b>Berhasil</b> masuk. Halaman akan otomatis dialihkan ke.. <a href='dashboard.php?filterdata=own'><b>dashboard</b></a></div>";
header('location:dashboard.php?filterdata=own');
$_SESSION['userlogin'] =$_POST['username'];

      }else {
        // Login Gagal
      	echo "<div class=\"alert alert-danger\" role=\"alert\"><b>Username</b> dan <b>Password</b> Salah.</div>";
      }
}
 ?>


    <form id="Login" method="post">

        <div class="form-group">


            <input type="username" class="form-control" id="inputUsername" placeholder="Username" name="username" required autofocus>

        </div>

        <div class="form-group">

            <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password" required="">

        </div>
        <div class="forgot">
        <a href="#" data-toggle="tooltip" title="Hooray!">Lupa password?</a>
        <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>

</div>
        <button type="submit" name='button' class="btn btn-primary">Masuk</button>
    </form>
    </div>
<p class="botto-text"> 2018 &copy; PesanComputer.com</p>
</div></div></div></div>
</body>
</html>
