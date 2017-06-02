<?php
    $modulTidakDiperlukan = ['2.loginCheck.php','isLoggedIn.php'];
    include_once("module/module.php");
?>
<script>
    $(function(){
        $(".date").datepicker({
            dateFormat : "d-m-yy HH:ss"
        });
    });
</script>
<h1>Buat Tugas</h1>
<form method="POST">
    Nama Tugas : <input type="text" name="namaTugas"><br>
    Tanggal Kumpul : <input type="text" class="date" name="namaTugas">
    Mata Kuliah : <select name="matkul">
    <button type="submit" name="btnTambahTugas" value="1">
</form>
