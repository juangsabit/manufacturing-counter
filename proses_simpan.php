<?php
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' )) {
	// panggil file config.php untuk koneksi ke database
	require_once "config/config.php";

	$line = $_POST['line'];
	$model = $_POST['model'];
	$ok = $_POST['ok'];
	$ng = $_POST['ng'];
	$time = str_replace("-",":",$_POST['time']);
	$year = $_POST['year'];
	$start = $year . " " . $time;

	$kbhB1 = $_POST['KonektorBlowHoleB1']; $kbhB2 = $_POST['KonektorBlowHoleB2'];
	$kbhB3 = $_POST['KonektorBlowHoleB3']; $kbhB4 = $_POST['KonektorBlowHoleB4'];
	$knsB1 = $_POST['KonektorNoSolderB1']; $knsB2 = $_POST['KonektorNoSolderB2'];
	$knsB3 = $_POST['KonektorNoSolderB3']; $knsB4 = $_POST['KonektorNoSolderB4'];
	
	$mvsB1 = $_POST['MOVNoSolderB1']; $mvsB2 = $_POST['MOVNoSolderB2'];
	$mvsB3 = $_POST['MOVNoSolderB3']; $mvsB4 = $_POST['MOVNoSolderB4'];
	$pksB1 = $_POST['PinKonektorShortB1']; $pksB2 = $_POST['PinKonektorShortB2'];
	$pksB3 = $_POST['PinKonektorShortB3']; $pksB4 = $_POST['PinKonektorShortB4'];

	$next_id = $mysqli->query("SELECT Auto_increment
	FROM information_schema.tables
	WHERE table_name='log'")->fetch_row();
	
	$log_id = $next_id[0];

	// perintah query untuk menyimpan data ke tabel log
	$insert = $mysqli->query("INSERT INTO log(line,model,ok,ng,start,end)
	                          VALUES('$line','$model','$ok','$ng','$start',NULL)")
	                          or die('Ada kesalahan pada query insert : '.$mysqli->error); 

	// perintah query untuk menyimpan data ke tabel ng_details
	$insert2 = $mysqli->query("INSERT INTO ng_details(`log_id`, `kbhb1`, `kbhb2`, `kbhb3`, `kbhb4`, `knsb1`, `knsb2`, `knsb3`, `knsb4`, `mvsb1`, `mvsb2`, `mvsb3`, `mvsb4`, `pksb1`, `pksb2`, `pksb3`, `pksb4`) VALUES ('$log_id','$kbhB1','$kbhB2','$kbhB3','$kbhB4','$knsB1','$knsB2','$knsB3','$knsB4','$mvsB1','$mvsB2','$mvsB3','$mvsB4','$pksB1','$pksB2','$pksB3','$pksB4')") or die('Ada kesalahan pada query insert : '.$mysqli->error);

	// cek query
	if ($insert && $insert2) {
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