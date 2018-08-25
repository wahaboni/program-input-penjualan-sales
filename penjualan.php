	<!DOCTYPE html>
	<html>
	<head>
		<link  type="text/css" href="css/bootstrap.css" rel="stylesheet" id="bootstrap-css">
		<script src="/js/bootstrap.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<!------ Include the above in your HEAD tag ---------->
		<link rel="stylesheet" href="css/a.css">
		<script src="js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="auto.css">
		<title>Data Penjualan</title>
	</head>
	<body>
		<div class="container fixed-top">
			<ul class="nav nav-tabs dropdown">
				<li role="presentation"><a href="dashboard.php?filterdata=own">Dashboard</a></li>
				<li role="presentation"><a href="barang.php">Data Barang</a></li>
				<li role="presentation" class="active"><a href="penjualan.php">Data Penjualan</a></li>
			</ul>
			<p>
				<h3>Data Semua Penjualan Sendiri</h3>
				<h4><?php  
				session_start();
				echo "<b>(";
				echo ($_SESSION['userlogin']); 
				echo ")</b>";
				?>
			</h4>
		</p>
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
				echo "<div class=\"alert alert-success\" role=\"alert\"><b>Data berhasil di rubah. </b><a href=penjualan.php>Refresh</a></div>";
			}
			else {
				echo "<div class=\"alert alert-danger\" role=\"alert\"><b>Data Gagal Di Input.</div>".mysqli_error($conn);
			}
		}
		?>

		<div class="row">
			<div class="col-md-9">
				<table class="table table-striped">
					<tr>
						<th>Kode Penjualan</th>
						<th>Nama Barang</th>
						<th>Tanggal</th>
						<th>Catatan</th>
						<th>Edit</th>
					</tr>
					<?php 
					include('koneksi.php');
					$username=$_SESSION['userlogin'];
					$sql="select * from data_penjualan where username='$username'";
					$jumlah="SELECT count(kode_penjualan) as hasil from data_penjualan where username='$username'";
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
							echo "<td><a href=\"#myModal\" data-id=$data[kode_penjualan] data=$data[kode_penjualan] data-toggle=\"modal\" data-target=\"#myModal\">Ubah</a> - <a href=hapus.php?kode_penjualan=$data[kode_penjualan] onclick=\"javascript: return confirm('Anda yakin ingin Menghapus Data Penjualan dengan Kode Penjualan : $data[kode_penjualan] ? Data tidak dapat dipulihkan.')\">Hapus</a></td>";
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

			<script src="jquery-3.2.1.min.js"></script>
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

			<div class="col-md-3">
				<p><label><h3>Input Penjualan Baru</h3></label>
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
						<input type="text" name="nama_barang" id="nama_barang" class="form-control" placeholder="Type / MTM" required>
						<div class="form-group row">
							<div class="col-xs-4">
								<select name="tanggal" class="form-control">
									<option selected="selected" value="<?php 
							$date=date('d');
							echo $date;
							?>"><?php 
							$date=date('d');
							echo $date;
							?></option>
									<?php
									for($a=1; $a<=31; $a+=1){
										echo"<option value=$a> $a </option>";
									}
									?>
								</select>
							</div>
							<div class="col-xs-4">
								<select name="bulan" class="form-control">
									<option selected="selected" value="<?php 
							$date=date('m');
							echo $date;
							?>"><?php 
							$date=date('m');
							echo $date;
							?></option>
									<?php
									for($a=1; $a<=12; $a+=1){
										echo"<option value=$a> $a </option>";
									}
									?>
								</select>    
							</div>

							<div class="col-xs-5">
								<select name="tahun" class="form-control">
									<option selected="selected" value="<?php 
							$date=date('Y');
							echo $date;
							?>"><?php 
							$date=date('Y');
							echo $date;
							?></option>
									<?php
									for($i=2020; $i>=1905; $i-=1){
										echo"<option value=$i> $i </option>";
									}
									?>
								</select>
							</div>

						</div>

						<label>Catatan</label>
						<textarea class="form-control" rows="5" name="catatan" ><?php echo $data['catatan']; ?></textarea>

					</p>
					<button type="submit" name="inputdata" class="btn btn-success form-control">Kirim</button>
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
<center>
	<?php
	include('footer.php');
	?>
</center>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!-- Coba Modal baru akhir -->

</body>

</html>