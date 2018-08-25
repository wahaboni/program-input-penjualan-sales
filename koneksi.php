<?php 
$databaseHost = 'localhost';
$databaseName = 'penjualan';
$databaseUsername = 'root';
$databasePassword = '';
$konek= mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 
$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $databaseName);
 ?>