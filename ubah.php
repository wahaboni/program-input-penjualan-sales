
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "penjualan";

    // membuat koneksi
$koneksi = new mysqli($servername, $username, $password, $dbname);

    // melakukan pengecekan koneksi
if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
} ?>
<link  type="text/css" href="css/bootstrap.css" rel="stylesheet" id="bootstrap-css">
<script src="/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<link rel="stylesheet" href="css/a.css">
<link rel="stylesheet" type="text/css" href="auto.css">


<?php


if($_POST['idx']) {
    $kode_penjualan=$_POST['idx'];
    include 'koneksi.php';
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
    $sql = "SELECT * FROM data_penjualan WHERE kode_penjualan='$kode_penjualan'";
    $result=mysqli_query($konek, $sql);
    $data=mysqli_fetch_assoc($result);

    ?>
                            <script src="jquery-3.2.1.min.js"></script>
    <form method="post">
       <div class="form-group">
        <label>Kode Penjualan </label>
        <input type="text" class="form-control" title="Tidak dapat Merubah Kode Penjualan. Kode didapatkan dengan otomatis." value="<?php echo "$kode_penjualan"; ?>" placeholder="kode_penjualan" disabled>
        <input type="hidden" name="kode_penjualan" value="<?php echo "$kode_penjualan"; ?>">
        <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="<?php echo $data['nama_barang']; ?>" placeholder="Type / MTM" required>
            <label>Ubah Tanggal Penjualan, Asal (<?php echo $data['tanggal']; ?> - <?php echo $data['bulan']; ?> - <?php echo $data['tahun']; ?>)</label>
<div class="form-group row">
<div class="col-xs-3">
<select name="tanggal" class="form-control">
<option selected="selected" value="<?php echo $data['tanggal']; ?>"><?php echo $data['tanggal']; ?></option>
<?php
for($a=1; $a<=31; $a+=1){
    echo"<option value=$a> $a </option>";
}
?>
</select>
</div>
<div class="col-xs-4">
<select name="bulan" class="form-control">
<option selected="selected" value="<?php echo $data['bulan']; ?>"><?php echo $data['bulan']; ?></option>
<?php
for($a=1; $a<=12; $a+=1){
    echo"<option value=$a> $a </option>";
}
?>
</select>    
</div>

<div class="col-xs-4">
    <select name="tahun" class="form-control">
<option selected="selected" value="<?php echo $data['tahun']; ?>"><?php echo $data['tahun']; ?></option>
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
            <br/>
            <button class="btn btn-primary" name="rubahpenjualan" type="submit" >Rubah</button>
        </form>
    </div>
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


    <?php }
    else {
        echo "Tidak ada Data dikirim.";
    }
    $koneksi->close();
    ?>