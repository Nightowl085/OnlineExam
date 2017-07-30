<?php
    $modulTidakDiperlukan = ['2.loginCheck.php','dashboardMhs.php','dashboardAdmin.php'];
    include_once("module/module.php");
	//Lanjut Soal
	if(isset($_POST['Lanjut'])){
		$_SESSION["kode"]=$_POST['Lanjut'];
		$kode = $_SESSION["kode"];
		$banyaksoal=$db->executeGetScalar("SELECT MAX(Nomor) FROM detail_ujian WHERE Kode = '$kode'");
		$_SESSION['page'] = floor($banyaksoal/5);
		$_SESSION['banyakSoal']=$db->executeGetScalar("SELECT banyak from header_ujian where Kode = '$kode'");
	}
	
    $kode = $_SESSION["kode"];
	
	//Setelah Insert Header
    if (isset($_POST['next'])){
        $_SESSION['page']=0;
        $kode = $_SESSION["kode"];
        $nama = $_POST['NamaUjian'];
        $tanggal = $_POST['Tanggal'];
        $waktu = $_POST['Waktu'];
        $banyak = $_POST['BanyakSoal'];
        $jam = (string)date("G:i", strtotime($_POST['Jam']));
		$matkul= $_POST['kodeMatkul'];
        $_SESSION["banyakSoal"]=$banyak;
        $db->executeNonQuery("INSERT INTO header_ujian VALUES('$kode','$nama',STR_TO_DATE('$tanggal $jam','%Y-%m-%d %H:%i'),'$waktu','$banyak','{$_SESSION['user']}','$matkul')");
    }

	//Setelah Tombol next ditekan
	if(isset($_POST['btnInsert'])){
		$kode = $_SESSION["kode"];
		$soalselesai=False;
		$no = 5 * $_SESSION['page'] + 1;
		$countnilai;
		$tonext = $no+4;
		if ($tonext >= $_SESSION["banyakSoal"]){
			$tonext = $_SESSION["banyakSoal"];
			$soalselesai=True;
		}

		for($i = $no;$i<=$tonext;$i++) {
			$nomor = $i;
			$soal = $_POST['soal'][$i]['soal'];
			$jwA = $_POST['soal'][$i]['JwbA'];
			$jwB = $_POST['soal'][$i]['JwbB'];
			$jwC = $_POST['soal'][$i]['JwbC'];
			$jwD = $_POST['soal'][$i]['JwbD'];
			$jwE = $_POST['soal'][$i]['JwbE'];
			$jawaban = $_POST['soal'][$i]['Jwb'];
			$db->executeNonQuery("INSERT INTO detail_ujian VALUES('$kode','$nomor','$soal','$jwA','$jwB','$jwC','$jwD','$jwE','$jawaban')");
		}
		$_SESSION['page']+=1;
		echo $soalselesai;
		if ($soalselesai){
			header('location:Dashboard.php');
		}else{
			header('location:DetailUjian.php');
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
    <?php mainStyle(); mainScript(); ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        $(document).on("submit", "form", function(event) {
            window.onbeforeunload = null;
        });
        window.onbeforeunload = function() {
            return "Do you really want to close?";
        };
    </script>
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
                                    <?php namaDosen(); ?> -
                                    <?php echo $_SESSION['user']; ?>
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
                    <p>
                        <?php namaDosen(); ?>
                    </p>
                    <p>
                        <?php echo $_SESSION['user']; ?>
                    </p>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
                <li class="header">MENU</li>
                <?php menuDosen("Awal"); ?>
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
                Buat Ujian
                <?php echo $kode;?>
                <!--paginitation-->
                <small>Halaman <?php
                $no = 5 * $_SESSION['page'] + 1;
                $tonext = $no+4;
                if ($tonext >= $_SESSION["banyakSoal"]){
                    $tonext = $_SESSION["banyakSoal"];
                }

            echo ($_SESSION['page']+1). " dari ".(ceil($_SESSION["banyakSoal"]/5)) ?> </small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <section class="content">
            <form role="form" method="POST" data-toggle="validator">
        <?php
            for($i = $no;$i<=$tonext;$i++) {
        ?>
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <?php echo $i ?>
                        </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- textarea -->
                        <div class="form-group">
                            <label>Soal: </label>
                            <textarea class="form-control" rows="3" placeholder="Masukkan soal..." name="soal[<?php echo $i?>][soal]" required></textarea>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <input type="radio" name="soal[<?php echo $i;?>][Jwb]" value="A" required>
                                <label>A</label>
                            </span>
                            <input type="text" class="form-control" name="soal[<?php echo $i;?>][JwbA]" required>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <input type="radio" name="soal[<?php echo $i;?>][Jwb]" value="B" required>
                                <label>B</label>
                            </span>
                            <input type="text" class="form-control" name="soal[<?php echo $i;?>][JwbB]" required>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <input type="radio" name="soal[<?php echo $i;?>][Jwb]" value="C" required>
                                <label>C</label>
                            </span>
                            <input type="text" class="form-control" name="soal[<?php echo $i;?>][JwbC]" required>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <input type="radio" name="soal[<?php echo $i;?>][Jwb]" value="D" required>
                                <label>D</label>
                            </span>
                            <input type="text" class="form-control" name="soal[<?php echo $i;?>][JwbD]" required>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <input type="radio" name="soal[<?php echo $i;?>][Jwb]" value="E" required>
                                <label>E</label>
                            </span>
                            <input type="text" class="form-control" name="soal[<?php echo $i;?>][JwbE]" required>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
        <?php
            }
        ?>
                <button class="btn btn-block btn-primary btn-lg" name="btnInsert" value="1">Next</button>
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
</body>
</html>