<?php
    $modulTidakDiperlukan = ['2.loginCheck.php','dashboardDosen.php','dashboardAdmin.php'];
    include_once("module/module.php");
    $nrp = $_SESSION['user'];
    $kode = $_SESSION["kode"];

    $score=0;
    // This code is for checking whether there is a kode or not, if there none we would throw it back to dashboard
    if($kode != ""){
        $checkingkode = $db->executeGetScalar("SELECT count(*) from nilai where `Kode Ujian` = $kode AND NRP = {$_SESSION['user']}");
        if($checkingkode > 0){
            header("Location:dashboard.php");
        }
    }
    else{
        header("Location:dashboard.php");
    }

    $soal=$db->executeGetArray("SELECT jawaban FROM detail_ujian where Kode ='$kode'");
    $check=$db->executeGetArray("SELECT jawaban FROM jawaban_mahasiswa where Kode ='$kode'");
    $banyaksoal=$db->executeGetScalar("SELECT banyak FROM header_ujian where Kode ='$kode'");
    $kodeM=$db->executeGetScalar("SELECT `Kode Matkul` FROM `header_ujian` WHERE Kode='$kode'");
    $NID=$db->executeGetScalar("SELECT NID FROM header_ujian where Kode = '$kode'");

	$i = 0;
    foreach($check as $a){
		$i++;
        $score += Hitung($a, $soal[$i]);
    }


    function Hitung($entry, $jawaban){
        if ($entry == $jawaban) {
            return 1;
        }else{
            return 0;
        }
    }

    function Grade($score,$banyaksoal){
        return round(($score/$banyaksoal)*100,0);
    }
    $nilai = Grade($score,$banyaksoal);

    $db->executeNonQuery("INSERT INTO `nilai` (`Kode Ujian`,`Kode Matkul`, `NID`, `NRP`, `Nilai`) VALUES ('$kode','$kodeM', '$NID', '$nrp', '$nilai')");
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
        <script>
        $(function(){
            $(".datatable").DataTable();
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
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">
            <!-- Logo -->
            <a href="index.php" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>i</b>OE</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>iSTTS</b> Online Exam</span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
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
                                <span class="hidden-xs"><?php namaMahasiswa(); ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="asset/img/user.jpg" class="img-circle" alt="User Image">
                                    <p>
                                         <?php namaMahasiswa(); ?> - <?php echo $_SESSION['user']; ?>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-right">
                                        <?php logout(); ?>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="asset/img/user.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?php namaMahasiswa(); ?></p>
                    <p><?php echo $_SESSION['user']; ?></p>
                </div>
            </div>

        <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
                <li class="header">MENU</li>
                <?php menuMahasiswa("Awal");?>
            </ul>
        <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Nilai anda
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- TABLE: UJIAN -->
            <div class="box box-info">
                <form class="form-horizontal">
                        <div class="box-header with-border">
                            <h3 class="box-title">Hasil Ujian <?php echo $db->executeGetScalar("SELECT m.`Nama Matkul` FROM `Mata Kuliah` m, `Header_Ujian` h WHERE m.`Kode Matkul` = h.`Kode Matkul` AND h.`Kode` = $kode") ?></label>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            
                        
                        <div class="form-group">
                            <label for="txtNRP" class="col-sm-2 control-label">NRP</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="txtNRP" value="<?php echo $nrp; ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtNama" class="col-sm-2 control-label">Nama</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="txtNama" value="<?php namaMahasiswa(); ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtJumlahBenar" class="col-sm-2 control-label">Jumlah Benar</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="txtJumlahBenar" value="<?php echo $score; ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtBanyakSoal" class="col-sm-2 control-label">Banyak Soal</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="txtBanyakSoal" value="<?php echo $banyaksoal; ?>" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtNilai" class="col-sm-2 control-label">Nilai</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="txtNilai" value="<?php echo $nilai; ?>" disabled>
                            </div>
                        </div>
                        
                        <!-- /.box-body -->
                    </div>
                </form>
        </section>
        <!-- /.content -->
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

<?php $_SESSION["kode"] = "" ?>