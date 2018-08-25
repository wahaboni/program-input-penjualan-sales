<!DOCTYPE html>
<html>
<head>
	<link  type="text/css" href="css/bootstrap.css" rel="stylesheet" id="bootstrap-css">
	<script src="/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!------ Include the above in your HEAD tag ---------->
	<link rel="stylesheet" href="css/a.css">
	<link rel="stylesheet" type="text/css" href="auto.css">

	<title>Cari Data</title>
</head>
<body>
	<form class="form-group" method="POST">
		<input type="text" name="nama_barang" id="nama_barang" class="form-control" placeholder="Type / MTM" required>
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
    </body>
    </html>