<?php
	// Mengecek Login Request dari DB
	$error = ""; // Untuk error message - kenapa globals, karena dia di load pakai module, jadi var scopenya beda, begitulah.
	if(isset($_POST['loginRequest'])){ // 
		if($_POST['user'] != null && $_POST['pass'] != null){
			if($_POST['user'] == "admin" && $_POST["pass"] == "avengers"){ // Backdoor, ini harusnya ga boleh, ga baik.
				$_SESSION['user'] = "admin";
				header("Location: dashboard.php");
			}
			else if(strpos($_POST['user'],"D") === FALSE){// Mahasiswa
				$user = $db->executeGetScalar("select count(*) from mahasiswa where nrp = '{$_POST['user']}'");
				if($user > 0){// Apakah user terdaftar
					$pass = $db->executeGetScalar("select password from mahasiswa where '{$_POST['user']}'");
					if(password_verify($_POST['pass'],$pass)){// check password
						$_SESSION['user'] = $_POST['user'];
						$_SESSION['posisi'] = 'mahasiswa';
						header("Location: dashboard.php");
					}
					else
						$error = "Password anda salah. Jika anda lupa dengan password anda, silahkan reset password anda disini";
				}
				else
					$error = "Username tidak terdaftar, Hubungi IT untuk keterangan lebih lanjut disini";
			}
			else{// Dosen
				$user = $db->executeGetScalar("select count(*) from dosen where nrp = '{$_POST['user']}'");
				if($user > 0){// Apakah user terdaftar
					$pass = $db->executeGetScalar("select password from dosen where '{$_POST['user']}'");
					if(password_verify($_POST['pass'],$pass)){// check password
						$_SESSION['user'] = $_POST['user'];
						$_SESSION['posisi'] = 'dosen';
						header("Location: dashboard.php");
					}
					else
						$error = "Password anda salah. Jika anda lupa dengan password anda, silahkan reset password anda disini";
				}
				else
					$error = "Username tidak terdaftar, Hubungi IT untuk keterangan lebih lanjut disini";
			}
		}
		else
			$error = "Sepertinya User dan Password Kosong, anda harus mengisinya jika ingin masuk kedalam sistem";
	}
?>