<?php
    $modulTidakDiperlukan = ['2.loginCheck.php'];
    include_once("module/module.php");
    if($_SESSION['user'] == "admin")
        dashboardAdmin();
    else if ($_SESSION['posisi'] == "mahasiswa")
        dashboardMhs();
    else if($_SESSION['posisi'] == "dosen")
        dashboardDosen();
?>
