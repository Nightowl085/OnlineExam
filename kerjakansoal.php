<?php
	$modulTidakDiperlukan = ['2.loginCheck.php','dashboardMhs.php','dashboardAdmin.php'];
	include_once("module/module.php");
	$nrp = $_SESSION["user"];
	if($_SESSION['kode']==""){
		$kode = $_POST["kode"];
		$_SESSION['kode'] = $kode;
	}else{
		$kode = $_SESSION["kode"];
	}


	//untuk cek supaya tidak bisa kerja jika sudah ada nilainya
	if($kode != ""){
			$checkingkode = $db->executeGetScalar("SELECT count(*) from nilai where `Kode Ujian` = $kode AND NRP = {$_SESSION['user']}");
		if($checkingkode > 0){
			header("Location:dashboard.php");
		}
	}
		else{
			header("Location:dashboard.php");
		}

	$judul=$db->executeGetScalar("select Nama from header_ujian where Kode='$kode'");
	$_SESSION['banyakSoal']=$db->executeGetScalar("select banyak from header_ujian where Kode='$kode'");
	$test=$db->executeGetArray("select * from detail_ujian where Kode='$kode'");
	//var_dump($test);

	if(isset($_POST["submit"])){
		insertPekerjaan();
	}

	function insertPekerjaan(){
		global $db,$nrp;
		$kode = $_SESSION["kode"];
		$soalselesai=False;
		$no = 5 * $_SESSION['page'] + 1;
		$jaw=$db->executeGetArray("select Jawaban from detail_ujian where kode='$kode'");
		$tonext = $no+4;
		if ($tonext >= $_SESSION["banyakSoal"]){
			$tonext = $_SESSION["banyakSoal"];
			$soalselesai=True;
		}
		
		// if ($soalselesai){
		// 	echo "Status Soal = Selesai"."<br>";
		// }else{
		// 	echo "Status Soal = Lom Selesai"."<br>";
		// }

		for($i = $no;$i<=$tonext;$i++) {
			$nomor = $i;
			$myradio = (isset($_POST['soal'][$i]['Jwb']) ? $_POST['soal'][$i]['Jwb'] : "F");
			// echo $no.". ";
			// echo "Jawaban: ".$jawaban."<br>";
			$db->executeNonQuery("INSERT INTO jawaban_mahasiswa VALUES('$kode','$nrp','$nomor','$myradio')");
		}
		$_SESSION['page']+=1;
		// echo $soalselesai;

		if ($soalselesai){
			header('location:insertnilai.php');
		}
	}
?>
	
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>iSTTS Online Exam</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php assetLoad(); ?>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- Optionally, you can add Slimscroll and FastClick plugins.
        Both of these plugins are recommended to enhance the
        user experience. Slimscroll is required when using the
        fixed layout. -->
        <!--Data Tables-->


		
		<script>
        $(function(){
            $(".datatable").DataTable();
                // Ambil Kode untuk dihapus
                $(".btnHapusUjian").click(function(){
                    $("#btnKonfirmasiHapus").val($(this).val());
        });

        // Ambil dari DB, Tabel baru namanya header_jawaban
        var jamTest = "<?php 
            $waktu = $db->executeGetScalar("SELECT waktu FROM header_ujian WHERE Kode = '$kode'");
            $mulai = $db->executeGetScalar("SELECT UNIX_TIMESTAMP(`tanggal`)+($waktu*60)-UNIX_TIMESTAMP(NOW()) FROM header_ujian WHERE Kode = '$kode'");
            date_default_timezone_set('GMT'); // agar mulai dari nol
            echo date("H:i:s",$mulai);
            if($mulai < 0 ) header("Location: 404");
         ?>";
        
        String.prototype.padLeft = function (length, character) { 
            return new Array(length - this.length + 1).join(character || '0') + this;
        }

        var timerUjian = setInterval(function() {
            var jam = jamTest.substr(0,2);
            var menit = jamTest.substr(3,2);
            var detik = jamTest.substr(6,2);

            if(detik-1 >= 0){
                detik = parseInt(detik-1);
            }
            else{
                if(menit-1 >= 0){
                    menit = parseInt(menit) - 1;
                    detik = 59;
                }
                else{
                    if(jam-1>=0){
                        jam = parseInt(jam) - 1;
                        menit = 59; detik = 59;
                    }
                    else{
						window.location = "insertnilai.php";
                        clearTimeout(timerUjian);
                    }
                }
            }
            jam = jam.toString().padLeft(2,'0');
            menit = menit.toString().padLeft(2,'0');
            detik = detik.toString().padLeft(2,'0');
            jamTest = jam+":"+menit+":"+detik;
            $("#timer").text(jamTest);
        }, 1000);
    });
	</script>
    </head>
    <!--
    BODY TAG OPTIONS:
    =================
    Apply one or more of the following classes to get the
    desired effect
    |---------------------------------------------------------|
    | SKINS         | skin-blue                               |
    |               | skin-black                              |
    |               | skin-purple                             |
    |               | skin-yellow                             |
    |               | skin-red                                |
    |               | skin-green                              |
    |---------------------------------------------------------|
    |LAYOUT OPTIONS | fixed                                   |
    |               | layout-boxed                            |
    |               | layout-top-nav                          |
    |               | sidebar-collapse                        |
    |               | sidebar-mini                            |
    |---------------------------------------------------------|
    -->
    <body class="skin-blue sidebar-mini sidebar-collapse">
        <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">
            <!-- Logo -->
            <a href="index.php" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>i</b>OE</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-mini"><b>iSTTS</b> Online Exam</span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="asset/img/user.jpg" class="user-image" alt="User Image">
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs"id="timer"></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <?php echo $judul;?>
                    <small><?php $soalselesai=False;
                                $no = (5 * $_SESSION['page'])+1;
                                $tonext = $no+4;
                                if ($tonext >= $_SESSION["banyakSoal"]){
                                    $tonext = $_SESSION["banyakSoal"];
                                    $soalselesai=True;
                                }
                                
                                    echo "Halaman ". ($_SESSION['page']+1). " dari ".(ceil($_SESSION["banyakSoal"]/5))   ?></small>
                </h1>
            </section>

            <section class="content">
                <?php
    for ($i = $no-1; $i < $tonext; $i++) {?>
                <!-- YOUR CONTENT -->
                <form role="form" method="post">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $test[$i]["Nomor"];?></h3><h1><?php echo $test[$i]["Soal"];?></h1></label>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <!-- textarea -->
                            <div class="form-group">
                                
                            </div>
                            <div class="input-group">
                                <input type="radio" name="soal[<?php echo $i+1;?>][Jwb]" value="A">
                                <label>A.</label> <?php  echo $test[$i]["A"];?>
                            </div>
                            <div class="input-group">
                                <input type="radio" name="soal[<?php echo $i+1;?>][Jwb]" value="B">
                                <label>B.</label> <?php echo $test[$i]["B"]?>
                            </div>
                            <div class="input-group">
                                <input type="radio" name="soal[<?php echo $i+1;?>][Jwb]" value="C">
                                <label>C.</label> <?php echo $test[$i]["C"]?>
                            </div>
                            <div class="input-group">
                                <input type="radio" name="soal[<?php echo $i+1;?>][Jwb]" value="D">
                                <label>D.</label> <?php echo $test[$i]["D"]?>
                            </div>
                            <div class="input-group">
                                <input type="radio" name="soal[<?php echo $i+1;?>][Jwb]" value="E">
                                <label>E.</label> <?php echo $test[$i]["E"]?>
                            </div>
                            <br>
                        </div>
                        <!-- /.box-body -->
                    </div>
                <?php
    }
?>
                <button type="submit" class="btn btn-block btn-primary btn-lg" name="submit" value="1">Next</button>
                </form>
            </section>
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.0 - Initial Release
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2017 <a href="#">AVENGERS - APLIN SIB iSTTS</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->
</body>
</html>