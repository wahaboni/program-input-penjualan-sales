<?php 
session_start();
if (isset($_SESSION['userlogin']))
{
	?>

	<!DOCTYPE html>
	<html>
	<head>
		<link  type="text/css" href="css/bootstrap.css" rel="stylesheet" id="bootstrap-css">
		<script src="js/bootstrap.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="auto.css">

		<!------ Include the above in your HEAD tag ---------->
		<link rel="stylesheet" href="css/a.css">
		<title>Dashboard - Program AGT - Data Barang & Penjualan</title>
	</head>
	<body>
		<div class="container fixed-top">
			<ul class="nav nav-tabs dropdown">

				<li role="presentation" class="active"><a href="#">Dashboard</a></li>
				<li role="presentation"><a href="barang.php">Data Barang</a></li>
				<li role="presentation"><a href="penjualan.php">Data Penjualan</a></li>
			</ul>

			<div class="row">

				<div class="col-md-8">
					<p><h3>Data Penjualan Bulan<b>
						<?php
						$date=date('F Y');
						echo $date;
						?>
					</b>
					</h3>

						<?php
if (isset($_POST['rubahpenjualan'])) {
    // Rumus Rubah data
 $kode_penjualan=$_POST['kode_penjualan'];
 $nama_barang=$_POST['nama_barang'];
 $catatan=$_POST['catatan'];
 $tanggal=$_POST['tanggal'];
 $bulan=$_POST['bulan'];
 $tahun=$_POST['tahun'];
 include 'koneksi.php';
 $perintah="UPDATE data_penjualan SET nama_barang='$nama_barang', tanggal='$tanggal', bulan='$bulan', tahun='$tahun', catatan='$catatan' where kode_penjualan='$kode_penjualan'";
 if ($conn->query($perintah)===TRUE) {
    echo "<div class=\"alert alert-success\" role=\"alert\"><b>Data berhasil di rubah. </b><a href=dashboard.php?filterdata=own>Refresh</a></div>";
}
else {
    echo "<div class=\"alert alert-danger\" role=\"alert\"><b>Data Gagal Di Input.</div>".mysqli_error($conn);
}
}
?>
						<label>Filter Hasil :</label>
						<form>
							<div class="radio">

								<?php
								if (isset($_GET['filterdata'])) {
									if ($_GET['filterdata']=="own") {
										?>
										<label><input type="radio" name="filterdata"value="own" checked="">Penjualan Sendiri</label>
										<label><input type="radio" name="filterdata" value="semua">Semua</label>
										<?php

									} else {
										?>
										<label><input type="radio" name="filterdata" value="own">Penjualan Sendiri</label>
										<label><input type="radio" name="filterdata" value="semua" checked>Semua</label>
										<?php
									}
								}
								else {
									?>
									<label><input type="radio" name="filterdata" value="own" checked="">Penjualan Sendiri</label>
									<label><input type="radio" name="filterdata" value="semua">Semua</label>
									<?php
								}

								?>
								

							</div>
							<input type="submit" name="filter" class="btn btn-info" value="OK">
						</form>
					</p>

					<table class="table table-striped">
						<tr>
							<th>Kode</th>
							<th>Nama Barang</th>
							<th>Tanggal</th>
							<th>Catatan</th>
							<th>Aksi</th>
						</tr>
						<?php 
						include('koneksi.php');
						$date=date('m');
// Rumus Filter Data
						if (isset($_GET['filterdata'])) {
							if ($_GET['filterdata']=="own") {
								$username=$_SESSION['userlogin'];
								$sql="select * from data_penjualan where bulan=$date && username='$username'";
								$jumlah="SELECT count(kode_penjualan) as hasil from data_penjualan where bulan=$date && username='$username'";
							} else {
								$sql="select * from data_penjualan where bulan=$date";
								$jumlah="SELECT count(kode_penjualan) as hasil from data_penjualan where bulan=$date";
							}
						}
						if (isset($_GET['filterdata'])===false) {
							$username=$_SESSION['userlogin'];
							$sql="select * from data_penjualan where bulan=$date && username='$username'";
								$jumlah="SELECT count(kode_penjualan) as hasil from data_penjualan where bulan=$date && username='$username'";
								}
						$hasil=$konek->query($sql);
						if ($hasil===false) {
							trigger_error('Perintah SQL salah: ' . $sql . ' Error: ' . $mysqli->error, E_USER_ERROR);
						} else {
							while ($data=$hasil->fetch_array()) {
		# Tampilkan data
								echo "<tr>";
								echo "<td>$data[kode_penjualan]</td>"; 
								echo "<td>$data[nama_barang]</td>";
								echo "<td>$data[tanggal] - $data[bulan] - $data[tahun]</td>"; 
								echo "<td>$data[catatan]</td>";
								if (isset($_GET['filterdata'])) {
									if ($_GET['filterdata']=="semua") {
										echo "<td>- -</td>";	
									} else {
										echo "<td><a href=\"#myModal\" data-id=$data[kode_penjualan] data=$data[kode_penjualan] data-toggle=\"modal\" data-target=\"#myModal\">Ubah</a> - <a href=hapus.php?kode_penjualan=$data[kode_penjualan] onclick=\"javascript: return confirm('Anda yakin ingin Menghapus Data Penjualan dengan Kode Jual : $data[kode_penjualan] ? Data tidak dapat dipulihkan.')\">Hapus</a></td>";
									}
								}
								echo "</tr>";
							}
							$result=mysqli_query($konek, $jumlah);
							$total=mysqli_fetch_assoc($result);
						}
						?>
						<tr>
							<td colspan="2"class="info"><b>Jumlah Penjualan : </b></td>
							<td class="btn-primary"  align=center><b><?php echo "$total[hasil]"; ?></b></td>
						</tr>
					</table>
				</div>
				<div class="col-md-4">
					<h3>Input Penjualan Cepat.</h3>
					<label><i>Login As <?php  echo ($_SESSION['userlogin']); ?></i></label>
					-
					<label><a href="logout.php">Keluar</a></label>
					<h5><b>
						<?php 
						$date=date('d F Y h:i:s A');
						echo $date;
						if (isset($_POST['inputpenjualan'])) {
// Simpan Input Penjualan Cepat
							include('koneksi.php');
							$nama_barang=$_POST["nama_barang"];
							$username=$_SESSION['userlogin'];
							$catatan=$_POST["catatan"];
							$tanggal=$_POST["tanggal"];
							$bulan=$_POST["bulan"];
							$tahun=$_POST["tahun"];
							$sql="insert into data_penjualan (nama_barang,username,tanggal,bulan,tahun,catatan) values ('$nama_barang','$username','$tanggal','$bulan','$tahun','$catatan')";

							if ($conn->query($sql)) {
	# Peringatan  di Input
								echo "<div class=\"alert alert-success\" role=\"alert\"><b>Data berhasil di input. </b><a href=dashboard.php>Refresh</a></div>";
							} else {
								echo "<div class=\"alert alert-danger\" role=\"alert\"><b>Data Gagal Di Input.</div>";
							}

						}



						?></b></h5>
						<form class="form-group" method="post">
							<label>Nama Barang</label>
							<input type="text" name="nama_barang" id="nama_barang" class="form-control" placeholder="Type / MTM" required>
							<label>Keterangan / Catatan</label>
							<input type=text name="catatan" class="form-control" required=""></textarea>
							<input type="hidden" name="tanggal" value="<?php 
							$date=date('d');
							echo $date;
							?>">
							<input type="hidden" name="bulan" value="<?php 
							$date=date('m');
							echo $date;
							?>">
							<input type="hidden" name="tahun" value="<?php 
							$date=date('Y');
							echo $date;
							?>">
							<hr>
							<button type="submit" name="inputpenjualan" class="btn btn-primary">Kirim</button>
						</form>

<!-- Memanggil jQuery.js -->
					<script src="jquery-3.2.1.min.js"></script>
					<!-- Memanggil Autocomplete.js -->
					<script src="jquery.autocomplete.min.js"></script>
					<script type="text/javascript">
						$(document).ready(function() {

                // Selector input yang akan menampilkan autocomplete.
                $( "#nama_barang" ).autocomplete({
                    serviceUrl: "source.php",   // Kode php untuk prosesing data.
                    dataType: "JSON",     // Tipe data JSON.
                    onSelect: function (suggestion) {
                    	$( "#nama_barang" ).val("" + suggestion.nama_barang);
                    }
                });
            })
        </script>


    </div>


</div>


</div>
			<script src="jquery-3.2.1.min.js"></script>

					<!-- Memanggil Autocomplete.js -->
					<script src="jquery.autocomplete.min.js"></script>


<!-- Coba Modal baru -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Ubah Data</h4>
                </div>
                <div class="modal-body">
                    <div class="fetched-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                </div>
            </div>
        </div>
    </div>

  <script type="text/javascript">
    $(document).ready(function(){
        $('#myModal').on('show.bs.modal', function (e) {
            var idx=$(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type:"POST",
                url:"ubah.php",
                data:"idx="+idx,
                success:function(data){
                $('.fetched-data').html(data);
                //menampilkan data ke dalam modal
                }
            });
         });
    });
</script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- Coba Modal baru akhir -->


<center>
	<?php
	include('footer.php');
	?>
</center>
</body>
</html>


<?php
}

else 
{
	echo "Harap <a href='index.php'>Login</a>.";
	header('refresh:3; url=index.php');
	echo "<br> Otomatis dialihkan dalam 3 detik.";
}
?>