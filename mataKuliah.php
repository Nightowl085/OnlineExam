<?php
    $modulTidakDiperlukan = ['2.loginCheck.php','isLoggedIn.php'];
    include_once ("module/module.php");
    if(isset($_POST['btnTambahMataKuliah'])){
        
    }
?>


<form action="" methos="post">
    Nama : <input type="text" name="namaMataKuliah">
    <button type="submit" name="btnTambahMataKuliah" value="1">Buat</button>
</form>