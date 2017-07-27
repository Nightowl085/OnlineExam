<?php
    $modulTidakDiperlukan = ['2.loginCheck.php','dashboardMhs.php','dashboardAdmin.php'];
    include_once("module/module.php");
    
	
	if(isset($_POST["Nomor"])){
		$kode = $_SESSION['kode'];
		$nomor = $_POST["Nomor"];
		$_SESSION['nomor']= $nomor;
		$test=$db->executeGetArray("select * from detail_ujian where kode='$kode' AND Nomor='$nomor'");
		$jawaban = $test[0]["Jawaban"];
	}
	
	if(isset($_POST["Edit"])){
		$kode = $_SESSION['kode'];
		$nomor = $_SESSION["nomor"];
		echo $nomor;
		$soal = $_POST["soal"];
		$jwbA=$_POST["jwbA"];
		$jwbB=$_POST["jwbB"];
		$jwbC=$_POST["jwbC"];
		$jwbD=$_POST["jwbD"];
		$jwbE=$_POST["jwbE"];
		$jwb=$_POST["jwb"];
		$db->executeNonQuery("UPDATE `detail_ujian` SET `Soal` = '$soal', `A` = '$jwbA', `B` = '$jwbB', `C` = '$jwbC', `D` = '$jwbD', `E` = '$jwbE', `Jawaban` = '$jwb' WHERE `detail_ujian`.`Kode` = '$kode' AND `detail_ujian`.`Nomor` = '$nomor'");
		header('Location: adminviewsoal.php');
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
        <section class="content-header">
            <h1>Edit Ujian</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>
        <section class="content">
            <form role="form" method="POST" name="add" data-toggle="validator">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Nomor <?php echo $nomor?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- textarea -->
                        <div class="form-group">
                            <label>Soal: </label>
                            <textarea class="form-control" rows="3" placeholder="Masukkan soal..." name="soal" required><?php echo $test[0]["Soal"];?></textarea>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <input type="radio" name="jwb" value="A" <?php echo ($jawaban=='A')?'checked':''?>>
                                <label>A</label>
                            </span>
                            <input type="text" class="form-control" name="jwbA" value="<?php echo $test[0]["A"]?>" required>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <input type="radio" name="jwb" value="B" <?php echo ($jawaban=='B')?'checked':''?>>
                                <label>B</label>
                            </span>
                            <input type="text" class="form-control" name="jwbB" value="<?php echo $test[0]["B"]?>" required>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <input type="radio" name="jwb" value="C" <?php echo ($jawaban=='C')?'checked':''?>>
                                <label>C</label>
                            </span>
                            <input type="text" class="form-control" name="jwbC" value="<?php echo$test[0]["C"]?>" required>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <input type="radio" name="jwb" value="D" <?php echo ($jawaban=='D')?'checked':''?>>
                                <label>D</label>
                            </span>
                            <input type="text" class="form-control" name="jwbD" value="<?php echo$test[0]["D"]?>" required>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <input type="radio" name="jwb" value="E" <?php echo ($jawaban=='E')?'checked':''?>>
                                <label>E</label>
                            </span>
                            <input type="text" class="form-control" name="jwbE" value="<?php echo$test[0]["E"]?>"required>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <button type="submit" class="btn btn-block btn-primary btn-lg" Name="Edit">Edit</button>
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
</body>
</html>