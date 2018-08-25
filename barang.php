
<!DOCTYPE html>
<html>
<head>
	<link  type="text/css" href="css/bootstrap.css" rel="stylesheet" id="bootstrap-css">
	<script src="/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!------ Include the above in your HEAD tag ---------->
	<link rel="stylesheet" href="css/a.css">
	<title>Data Barang</title>
</head>
<body>
	<div class="container fixed-top">
		<ul class="nav nav-tabs dropdown">
			<li role="presentation"><a href="dashboard.php?filterdata=own">Dashboard</a></li>
			<li role="presentation" class="active"><a href="barang.php">Data Barang</a></li>
			<li role="presentation"><a href="penjualan.php">Data Penjualan</a></li>
		</ul>
		<p>
			<h3>Data Semua Barang</h3>
		</p>
<!-- 		peringatan dari info -->
<?php
if (isset($_GET['info'])) {
	$info=$_GET['info'];
	?>
		<div class="alert alert-success">
			<strong><?php echo "$info"; ?>!<br/></strong> Muat Ulang Data dengan <a href="barang.php" class="alert-link">Refresh Data</a></a>.
		</div>
		<?php
}
?>
<!-- 		akhir peringatan -->
		<div class="row">
			<div class="col-md-9">
				<table class="table table-striped">
					<tr>
						<th>Kode Barang</th>
						<th>Nama Barang</th>
						<th>Stok</th>
						<th>Deskripsi Produk</th>
						<th>Edit</th>
					</tr>
					<?php 
					include('koneksi.php');
					$sql="select * from data_barang";
					$hasil=$konek->query($sql);
					if ($hasil===false) {
						trigger_error('Perintah SQL salah: ' . $sql . ' Error: ' . $mysqli->error, E_USER_ERROR);
					} else {
						while ($data=$hasil->fetch_array()) {
		# Tampilkan data
							echo "<tr>";
							echo "<td>$data[kode_barang]</td>"; 
							echo "<td>$data[nama_barang]</td>";
							echo "<td>$data[stok]</td>"; 
							echo "<td>$data[deskripsi]</td>"; 
							echo "<td><a href=ubah.php?kode_barang=$data[kode_barang]>Ubah</a> - <a href=hapus.php?kode_barang=$data[kode_barang] onclick=\"javascript: return confirm('Anda yakin ingin Menghapus Data Barang dengan Kode Barang : $data[kode_barang] ? Data tidak dapat dipulihkan.')\">Hapus</a></td>";
							echo "</tr>";
						}
					}
					?>
					<tr>
						<td>- -</td>
						<td>- -</td>
						<td>- -</td>
						<td>- -</td>
					</tr>
				</table>

			</div>
			<div class="col-md-3">
				<p><label><h4>Entry Data Barang Baru</h4></label>
					<?php 
					$date=date('d F Y');
					echo "<i><b>Tanggal : </i></b>";
					echo $date;
					if (isset($_POST['inputdata'])) {
	# Jika Tombol di Klik
						include('koneksi.php');
						$nama_barang=$_POST['nama_barang'];
						$stok=$_POST['stok'];
						$deskripsi=$_POST['deskripsi'];
						$sql="insert into data_barang set nama_barang='$nama_barang', stok='$stok', deskripsi='$deskripsi'";
						mysqli_query($konek, $sql);
						echo "<div class=\"alert alert-success\" role=\"alert\"><b>Data berhasil di input. </b><a href=barang.php>Refresh</a></div>";
					} 
					?>
					<form class="form-group" method="POST">
						<label>Nama Barang</label>
						<input type="text" class="form-control" name="nama_barang" placeholder="Type, MTM" required>
						<label>Jumlah Stok Masuk</label>
						<input type="number" name="stok" class="form-control" required>
						<label>Deskripsi</label>
						<textarea class="form-control" name="deskripsi" required placeholder="Spesifikasi"></textarea>
					</p>
					<button type="submit" name="inputdata" class="btn btn-success form-control">Kirim</button>
				</form>

			</div>

		</div>

	</div>
	<center>
		<?php
		include('footer.php');
		?>
	</center>
</body>
</html>