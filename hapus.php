<?php 
// Hapus Penjualan;
if (isset($_GET['kode_penjualan'])) {
include 'koneksi.php';
$kode_penjualan=$_GET['kode_penjualan'];
$sql="delete from data_penjualan where kode_penjualan=$kode_penjualan";
if (mysqli_query($konek, $sql)) {
	echo "<h3>Data Berhasil Terhapus. - </h3>";
	echo "<a href=\"dashboard.php\">< Kembali ke Dashboard</a>";
	header("location:index.php?filterdata=own&info=Berhasil.");
} else {
echo "<br>Gagal dihapus.".mysql_error();
}
}
// Akhir Hapus Penjualan;
if (isset($_GET['kode_barang'])) {
	include 'koneksi.php';
	$kode_barang=$_GET['kode_barang'];
$sql="delete from data_barang where kode_barang=$kode_barang";
if (mysqli_query($konek, $sql)) {
	echo "<h3>Data Berhasil Terhapus. - </h3>";
	echo "<a href=\"barang.php\">< Kembali Data Barang</a>";
	header("location:barang.php?info=Data Berhasil dihapus.");
} else {
echo "<br>Gagal dihapus.".mysql_error();
echo "<a href=\"barang.php\">< Kembali ke Data Barang</a>";
}
}
 ?>
</br>
 <a href="index.php?filterdata=own"><b>< Beranda</b></a>