<?php
	$modulTidakDiperlukan = ['2.loginCheck.php','dashboardMhs.php','dashboardMhs.php'];
	include_once("module/module.php");
	if(strpos($_SESSION['user'],"D") === FALSE) header("Location: 404");

    $pesan = ""; //Init pesan agar bisa digunakan di bawah ini

	if (isset($_POST["editH"])){
	    $kode = $_POST["editH"];
	}
	
	if (isset($_POST["edit"])){
		$_SESSION['page']=0;
        $kode = $_POST["edit"];
        $nama = $_POST['NamaUjian'];
        $tanggal = $_POST['Tanggal'];
        $waktu = $_POST['Waktu'];
        $banyak = $_POST['BanyakSoal'];
        $jam = (string)date("G:i", strtotime($_POST['Jam']));
		$matkul= $_POST['kodeMatkul'];
        $_SESSION["banyakSoal"]=$banyak;
        $db->executeNonQuery("UPDATE `header_ujian` SET `Nama` = '$nama', `Tanggal` = STR_TO_DATE('$tanggal $jam','%Y-%m-%d %H:%i'), `Waktu` = '$waktu', `banyak` = '$banyak', `Kode Matkul` = '$matkul' WHERE `header_ujian`.`Kode` = '$kode'");
		header("Location: dashboard.php");
	}

	$_SESSION["kode"]=$kode;
	$editdis = $db->executeGetArray("Select * from header_ujian where kode = '$kode'");
	$kode = $editdis[0] ["Kode"];
	$nama = $editdis[0] ["Nama"];
	$tanggal = (string)date("Y-m-d", strtotime($editdis[0] ["Tanggal"]));
	$waktu = $editdis[0] ["Waktu"];
	$banyak = $editdis[0] ["banyak"];
	$jam = (string)date("G:i", strtotime($editdis[0] ["Tanggal"]));
	$matkul = $editdis[0]["Kode Matkul"];

    /**
     * Fungsi Untuk Melakukan Echo Pesan berhasil
     *
     * @return void
     */
    function pesan(){
        global $pesan;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <?php mainStyle(); datePickStyle(); mainScript(); datePickScript(); ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
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
                            <span class="hidden-xs"><?php namaDosen(); ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="asset/img/user.jpg" class="img-circle" alt="User Image">
                                <p>
                                    <?php namaDosen(); ?> - <?php echo $_SESSION['user']; ?>
                                </p>
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
                <p><?php namaDosen(); ?></p>
                <p><?php echo $_SESSION['user']; ?></p>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">MENU</li>
            <?php menuDosen(Array("Master Tugas","Tambah")); ?>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header"><h1>Edit Ujian</h1></section>
        <section class="content">
            <form role="form" method="post" data-toggle="validator">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Keterangan Ujian Kode Soal:
                    <?php echo $_SESSION['kode']; ?></h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Mata Kuliah</label>
                            <select name="kodeMatkul" id="txtIdDosen" class="form-control" required="" data-error="Dosen yang mengajar harus dipilih!">
                            <?php
                                $query = "SELECT m.`Kode Matkul` AS Kode, ma.`Nama Matkul` as Nama FROM onlineexam.mengajar m, onlineexam.`mata kuliah` ma where m.`Kode Matkul` = ma.`Kode Matkul` AND m.`NID` = '{$_SESSION['user']}'";
                                $data = $db->executeGetArray($query);
                                foreach($data as $dosen){
                                    echo "<option value='{$dosen['Kode']}'>{$dosen['Nama']}</option>";
                                }
                            ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Ujian</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $nama;?>" name="NamaUjian" required>
                        </div>
                        <!-- Date -->
                        <div class="form-group">
                            <label>Tanggal</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right datepicker" data-date-format="yyyy-mm-dd" name="Tanggal" required value="<?php echo $tanggal;?>">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                        <!-- time Picker -->
                        <div class="bootstrap-timepicker">
                            <div class="form-group">
                                <label>Jam</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                    <input type="text" class="form-control timepicker" name = "Jam" required value="<?php echo $jam;?>">
                                </div>
                                <!-- /.input group -->
                            </div>
                            <!-- /.form group -->
                        </div>

                        <div class="form-group">
                            <label>Durasi</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="Waktu" required value="<?php echo $waktu;?>">
                                <span class="input-group-addon">Menit</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Jumlah Soal</label>
                            <input type="number" class="form-control" id="exampleInputEmail1" name="BanyakSoal" required value="<?php echo $banyak;?>"/>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <button type="submit" class="btn btn-block btn-primary btn-lg" value="<?php echo $kode;?>" name="edit">Edit</button>
            </form>
        </section>
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs"><b>Version</b> 1.0 - Initial Release</div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2017 <a href="#">AVENGERS - APLIN SIB iSTTS</a>.</strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->
<script>
    $(function () {
        //Date picker
        $('.datepicker').datepicker({
            dateFormat: 'yyyy-mm-dd'
        });
        
        //Timepicker
        $(".timepicker").timepicker({
            showInputs: false,
            showMeridian: false
        });
    });
</script>
</body>
</html>