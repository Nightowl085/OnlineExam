<pre>
<?php
 	$modulTidakDiperlukan = ['2.loginCheck.php','dashboardMhs.php','dashboardAdmin.php','asset.php','logout.php'];
    include_once("module/module.php");
	// Security Reason - Harus dosen
    if(strpos($_SESSION['user'],"D") === False) header("Location: 404");
	if(!isset($_GET['kodeTugas'])){
		header("Location: 404");
	}
	
	$kode = $_GET['kodeTugas'];
	$kodeMatkul = $db->executeGetScalar("SELECT `kode matkul` FROM TUGAS WHERE `kode tugas` = '$kode'");
	$kodeDosen = $db->executeGetScalar("SELECT `kode dosen` FROM TUGAS WHERE `kode tugas` = '$kode'");
	$data = $db->executeGetArray("SELECT * FROM mengambil m, mahasiswa mhs WHERE m.`Kode Matkul` = '$kodeMatkul' and m.`NID` = '$kodeDosen' and mhs.`NRP` = m.NRP");

	$zip = new ZipArchive; //Init Zip Class
	// Something fuck up, so based on this thing, it should be working well. http://php.net/manual/en/ziparchive.open.php
	$create = $zip->open("tugas/tempTugas.$kode.zip", ZipArchive::OVERWRITE);

	function addZip(){
		global $data,$zip,$kodeMatkul,$kodeDosen,$kode;
		foreach($data as $val){
			if(realpath(GLOBALDIR."/tugas/t".$kode.$kodeMatkul.$kodeDosen."_".$val['NRP'].".zip") !== FALSE){
				echo $zip->addFile("tugas/t".$kode.$kodeMatkul.$kodeDosen."_".$val['NRP'].".zip","t".$kode.$kodeMatkul.$kodeDosen."_".$val['NRP'].".zip");
			}
		}
		$zip->close();
	}
	
	if($create === TRUE){
		addZip();
	}
	else{
		$create = $zip->open("tugas/tempTugas.$kode.zip", ZipArchive::CREATE);
		addZip();
	}
	
	$file = "tugas/tempTugas.$kode.zip";
	
	// http://php.net/manual/en/function.readfile.php
	if (file_exists($file)) {
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="'.basename($file).'"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($file));
		readfile($file);
		exit;
	}
?>