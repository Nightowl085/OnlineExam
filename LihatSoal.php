<?php
include 'module/1.database.php';
session_start();

if($_SESSION['kode']==""){
    $kode = $_POST["kode"];
    $_SESSION['kode'] = $kode;
}else{
    $kode = $_SESSION["kode"];
}

$_SESSION['banyakSoal']=$db->executeGetScalar("select banyak from header_ujian where kode='$kode'");
echo "Banyak Soal: ". $_SESSION['banyakSoal'];
$test=$db->executeGetArray("select * from detail_ujian where kode='$kode'");
//var_dump($test);
?>

<html>
    <head>
        <style></style>
    </head>
    <body>
    <?php
    $soalselesai=False;
    $no = (5 * $_SESSION['page'])+1;
    $tonext = $no+4;
    

    if ($tonext >= $_SESSION["banyakSoal"]){
        $tonext = $_SESSION["banyakSoal"];
        $soalselesai=True;
    }
echo 'Nomor awal '.$no." sampai nomor ".$tonext;
    if ($soalselesai){
        echo "Status Soal = Selesai"."<br>";
    }else{
       echo "Status Soal = Lom Selesai"."<br>";
    }
        echo "Kode Soal ". $test[0]["Kode"] . "<br>";   
    for ($i = $no-1; $i < $tonext; $i++) {
        echo $test[$i]["Nomor"].". ";
        echo $test[$i]["Soal"]."<br>";
        echo "A. ". $test[$i]["A"]."<br>";
        echo "B. ". $test[$i]["B"]."<br>";
        echo "C. ". $test[$i]["C"]."<br>";
        echo "D. ". $test[$i]["D"]."<br>";
        echo "E. ". $test[$i]["E"]."<br>";
        echo "Jawaban: ". $test[$i]["Jawaban"]."<br>";
        ?>
        <form action="ujian2_edit.php" method="POST">
            <button value="<?php echo $test[$i]["Nomor"]?>" name="Nomor">Edit</button>
        </form>
        <?php
    }
?>
        <form action="page_change.php" method="POST">
            <button class="btn btn-primary btn-lg" value="-1" name="whattodo"<?php if ($_SESSION['page']==0){echo "disabled";}else{echo "";}?> >BACK</button>
            <button class="btn btn-primary btn-lg" value="1" name="whattodo"<?php if ($soalselesai){echo "disabled";}else{echo "";}?> >NEXT</button>
        </form>
    </body>
</html>
