<?php
    include_once "module/1.database.php";

    $nrp = $_GET['nrp'];
    $db->executeNonQuery("UPDATE `Mahasiswa` SET status = FALSE WHERE NRP = '$nrp'");

    header("Location: adminviewmhs.php");
?>
