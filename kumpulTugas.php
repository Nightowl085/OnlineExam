<?php
    $modulTidakDiperlukan = ['2.loginCheck.php','dashboardDosen.php','dashboardAdmin.php'];
    include_once("module/module.php");
    // Jika Orang bukan seorang mahasiswa maka harus di-redirect ke 404
    if(!is_numeric($_SESSION['user']))
        header("Location: 404");
    // Jika coba brute force tanpa kode, buat ke 404
    if(!isset($_GET['kodeTugas']))
        header("Location: 404");

    // Cek apakah Mahasiswa mengambil Mata Kuliah ini? Jika tidak, buang 404
    $kodeMatkul = $db->executeGetScalar("SELECT `Kode Matkul` FROM `Tugas` WHERE `Kode Tugas` = '{$_GET['kodeTugas']}'");
    $kodeDosen = $db->executeGetScalar("SELECT `Kode Dosen` FROM `Tugas` WHERE `Kode Tugas` = '{$_GET['kodeTugas']}'");
    if($db->executeGetScalar("SELECT COUNT(*) FROM `mengambil` WHERE `NID` = '$kodeDosen' AND `Kode Matkul` = $kodeMatkul AND `NRP` = '{$_SESSION['user']}'") <= 0) 
        header("Location: 404");
    
    // Cek Apakah Sudah lewat waktu atau belum? Kalau sudah, dibuang ke 404
    if($db->executeGetScalar("SELECT COUNT(*) FROM `Tugas` WHERE `Tanggal_Kumpul` > NOW() AND `Kode Tugas` = '{$_GET['kodeTugas']}'") <= 0){
        header("Location: 404");
    }
    
    function kumpulTugas($file,$kodeMataKuliah,$kodeDosen,$kodeTugas){
        global $pesan;
        // Cek Apakah file adalah zip, jika iya disimpan ke folder tugas
        if(strtolower(pathinfo($file['name'],PATHINFO_EXTENSION)) == "zip"){
            $fileUploadedLocation = GLOBALDIR."\\tugas\\t".$kodeTugas.$kodeMataKuliah.$kodeDosen."_".$_SESSION['user'].".zip";
            move_uploaded_file($file['tmp_name'],$fileUploadedLocation);
            $pesan = "Berhasil Mengumpulkan Tugas!";
        }
        else{
            $pesanError = "File yang di upload tidak diperbolehkan!";
        }
    }
    
    if(isset($_POST['btnUploadFile'])){
        if($_FILES['fileUpload']['error'] == 0){
            $kodeDosen = $db->executeGetScalar("SELECT `Kode Dosen` from tugas WHERE `Kode Tugas` = {$_POST['kodeTugas']}");
            $kodeMataKuliah = $db->executeGetScalar("SELECT `Kode Matkul` from tugas WHERE `Kode Tugas` = {$_POST['kodeTugas']}");
            kumpulTugas($_FILES['fileUpload'],$kodeMataKuliah,$kodeDosen,$_POST['kodeTugas']);
        }
        else{
            $pesanError = "Upload file gagal! File Corrupt!";
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
                Kumpul Tugas
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
            <div class="col-xs-12">
                <form method='post' data-toggle='validator' enctype="multipart/form-data">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Tugas <?php echo $db->executeGetScalar("SELECT `Nama Tugas` FROM `Tugas` WHERE `Kode Tugas` = '{$_GET['kodeTugas']}'"); 
                        $data = $db->executeGetArray("SELECT * FROM `Tugas` WHERE `Kode Tugas` = '{$_GET['kodeTugas']}'")?>
                        </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="form-group">
                            <label>Nama Tugas : </label><?php echo $data[0]['Nama Tugas']; ?>
                            <input type="hidden" name='kodeTugas' value='<?php echo $_GET['kodeTugas']; ?>'>
                        </div>
                        <div class="form-group">
                            <label>Keterangan Tugas</label>
                            <p><?php echo $data[0]['Keterangan Tugas']; ?></p>
                        </div>
                        <div class="form-group">
                            <label for="fileUpload">File : </label>
                            <input type="file" name='fileUpload' class="form-control" id="fileUpload" placeholder="Masukkan Nama Tugas" data-error="File harus dipilih sebelum upload!" accept=".zip"  required>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label>Terakhir upload file</label><br>
                            <?php
                                $kodeTugas = $_GET['kodeTugas'];
                                $kodeDosen = $db->executeGetScalar("SELECT `Kode Dosen` from tugas WHERE `Kode Tugas` = {$kodeTugas}");
                                $kodeMataKuliah = $db->executeGetScalar("SELECT `Kode Matkul` from tugas WHERE `Kode Tugas` = {$kodeTugas}");
                                if(realpath(GLOBALDIR."/tugas/t".$kodeTugas.$kodeMatkul.$kodeDosen."_".$_SESSION['user'].".zip")){
                                    //https://stackoverflow.com/questions/10040291/converting-a-unix-timestamp-to-formatted-date-string
                                    $waktu = stat(realpath(GLOBALDIR."/tugas/t".$kodeTugas.$kodeMatkul.$kodeDosen."_".$_SESSION['user'].".zip"))['atime'];
                                    date_default_timezone_set('Asia/Jakarta'); 
                                    //$date = new DateTime(date($waktu), new DateTimeZone('Asia/Jakarta'));
                                    echo date("j-n-Y T H:i:s",$waktu);
                                    //echo $date->format("j-n-Y T H:i:s");
                                }
                                else{
                                    echo "Belum sama sekali";
                                }
                             ?>
                        </div>
                    </div>
                    <div class="box-footer">
                    <button type='submit' name='btnUploadFile' class="btn btn-primary" value='1'>Upload Tugas</button>
                    </div>
                </div> 
                </form>
            </div>
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
