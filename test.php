<?php
	include_once("module/1.database.php");
	if(isset($_POST['genPass'])){
		if($_POST['user'] != null && $_POST['pass'] != null){
			$jenis = "";
			if($_POST['jenis']) $jenis = "MAHASISWA";
			else $jenis ="DOSEN";
			$pass = password_hash($_POST['pass'],PASSWORD_BCRYPT); // Pakai BCRYPT untuk 60 Char, biar ga boros, PHP >= 5.5.0 http://php.net/manual/en/function.password-hash.php
			// Masukin data ke DB
			if(!$db->executeNonQuery("INSERT INTO $jenis VALUES('{$_POST['user']}','$pass','','','','')"))
				echo "Data Ditambahkan";
		}
		else 
			echo "WOI DATA LU KOSONG!";
	}
?>
<h1>Gen Username Password</h1>
<form method="post">
	Username : <input type="text" name="user"><br>
	Password : <input type="password" name="pass"><br>
	<input type="radio" name="jenis" value="m" checked>Mahasiswa <input type="radio" name="jenis" value="d">Dosen<br>
	<button type="submit" value="1" name="genPass">Login</button>
</form>