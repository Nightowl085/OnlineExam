<?php
	session_start(); // Start Session Selalu, cari aman
	define("GLOBALDIR",realpath(__DIR__."/.."));
	$module = scandir(__DIR__); 
	/* 
		Menghilangkan .,.., dan module.php, karena error dan module.php tidak boleh memanggil dirinya sendiri 
		http://php.net/manual/en/function.array-diff.php
		http://stackoverflow.com/a/369608
	*/
	$module = array_diff($module,['.','..','module.php']);
	if(isset($modulTidakDiperlukan)){
		if(count($modulTidakDiperlukan) > 0) {
			$module = array_diff($module,$modulTidakDiperlukan);
		}
	}
	
	foreach($module as $value){
		if(strpos($value,".php") !== false){
			require_once($value); // Di Include 1-1, semua module yang ada dipakai
		}
	}

	/* 
		cara pakai kaya dibawah, kalau ada modul yang tidak dipakai tinggal dihapus aja pakai lempar array
		$modulTidakDiperlukan = ['isLoggedIn.php']; => array, nama file yang ga dipakai
		contoh diatas aku pakai karena kalau di login.php dibiarin load, ntar redirect terus, karena user belum login, hehehe...
		include_once("module/module.php");
	*/
?>