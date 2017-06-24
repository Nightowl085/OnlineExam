<?php
    include_once "module/1.database.php";
    $nrp = $_GET['nrp'];
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $telepon = $_POST["telepon"];
    $email = $_POST["email"];

    if(isset($_POST['password'])){
        $password = password_hash($_POST['password'],PASSWORD_BCRYPT);
        $query = "UPDATE mahasiswa SET Password = '$password', Nama = '$nama', Alamat = '$alamat',Telpon =  '$telepon', Email = '$email' WHERE NRP = '$nrp'";
    }
    else{
        $query = "UPDATE mahasiswa SET Nama = '$nama', Alamat = '$alamat',Telpon =  '$telepon', Email = '$email' WHERE NRP = '$nrp'";
    }
    $hasil = $db->executeNonQuery($query);
    
    header("Location: adminviewmhs.php");
?>
