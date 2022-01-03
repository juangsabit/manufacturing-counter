<?php
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' )) {
	// panggil file config.php untuk koneksi ke database
	require_once "config/config.php";

	$model = $_POST['A1'];

	// perintah query untuk menyimpan data ke tabel log
	$insert = $mysqli->query("INSERT INTO log(model,ok,ng,start,end)
	                          VALUES('$model','$ok','$ng', '$start',NULL)")
	                          or die('Ada kesalahan pada query insert : '.$mysqli->error); 
	// cek query
	if ($insert) {
	    // jika berhasil tampilkan pesan berhasil simpan data
	    echo "sukses";
	} else {
		// jika gagal tampilkan pesan gagal simpan data
	    echo "gagal";
	}
	// tutup koneksi
	$mysqli->close();   
} else {
    echo '<script>window.location="index.php"</script>';
}
?>