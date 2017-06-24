<?php
	include_once("module/1.database.php");
	if(isset($_POST['genPass'])){
		if($_POST['user'] != null && $_POST['pass'] != null){
			$jenis = "";
			if($_POST['jenis'] == "m") $jenis = "MAHASISWA";
			else $jenis ="DOSEN";
			$pass = password_hash($_POST['pass'],PASSWORD_BCRYPT); // Pakai BCRYPT untuk 60 Char, biar ga boros, PHP >= 5.5.0 http://php.net/manual/en/function.password-hash.php
			// Masukin data ke DB
			if(!$db->executeNonQuery("INSERT INTO $jenis VALUES('{$_POST['user']}','$pass','','','','')"))
				echo "Data Ditambahkan";
		}
		else 
			echo "WOI DATA LU KOSONG!";
	}
	session_start();
	var_dump(strpos("1D","D") === FALSE);
	//var_dump($db->executeGetArray("SELECT * FROM DOSEN"));
	var_dump(password_verify("123",'$2y$10$ioG9sv8nKpe5n0RtxhGBCOOBSaS2zZiLYH88EnLq06h6ReuAZV8bq'));

	echo pathinfo("D:\halo.zip",PATHINFO_EXTENSION);
	echo __DIR__;
	echo realpath(__DIR__."/tugas");
	var_dump(stat(__DIR__."\\testtext.txt"));
?>
<h1>Gen Username Password</h1>
<form method="post">
	Username : <input type="text" name="user"><br>
	Password : <input type="password" name="pass"><br>
	<input type="radio" name="jenis" value="m" checked>Mahasiswa <input type="radio" name="jenis" value="d">Dosen<br>
	<button type="submit" value="1" name="genPass">Login</button>
</form>