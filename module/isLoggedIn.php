<?php
	if(!isset($_SESSION['user'])){ // Jika tidak login
		header("Location: login.php");
	}
	else {
		if($_SESSION['user'] != 'admin'){// Admin dapat melakukan apa saja, sehingga tidak berlaku untuk pengecekan
			if($_SESSION['posisi'] == 'dosen' && strpos($_SESSION['user'],"D") === FALSE){ // Menghalangi Mahasiswa Akses Panel Dosen
				header("Location: 404.php");
				exit();
			}
			if($_SESSION['posisi'] == 'mahasiswa' && strpos($_SESSION['user'],"D") !== FALSE){ // Menghalangi Dosen Mengakses Panel Mahasiswa
				header("Location: 404.php");
				exit();
			}
		}
	}
?>