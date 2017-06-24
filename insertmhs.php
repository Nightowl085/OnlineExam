<?php
    include_once "module/1.database.php";

    $nrp = $_POST["nrp"];
    $password = password_hash("123456",PASSWORD_BCRYPT);
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $telepon = $_POST["telepon"];
    $email = $_POST["email"];

    $db->executeNonQuery("INSERT INTO mahasiswa VALUES('$nrp','$password','$nama','$alamat','$telepon','$email',true)");

    header("location: adminviewmhs.php");
?>
