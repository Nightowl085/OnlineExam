<?php
    $modulTidakDiperlukan = ['2.loginCheck.php','dashboardMhs.php','dashboardAdmin.php'];
    include_once("module/module.php");
	// Prevent Bruteforce From Other than Dosen
    if(strpos($_SESSION['user'],"D") === FALSE) header("Location: 404");

	// Paginantation 
	if(isset($_POST['whattodo']) || isset($_POST['page'])){
		if(isset($_POST['whattodo'])){
			$add = $_POST['whattodo'];
			$_SESSION['page'] += $add;
		}
		if(isset($_POST['page'])){
			$_SESSION['page'] = $_POST['page'];
		}
	}

	if($_SESSION['kode']==""){
		$kode = $_POST["kode"];
		$_SESSION['kode'] = $kode;
	}else{
		$kode = $_SESSION["kode"];
	}
	$judul=$db->executeGetScalar("select Nama from header_ujian where kode='$kode'");
	$_SESSION['banyakSoal']=$db->executeGetScalar("select banyak from header_ujian where kode='$kode'");

	$test=$db->executeGetArray("select * from detail_ujian where kode='$kode'");
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
            <h1>
				<?php echo $judul;?>
				<small>
                <?php $soalselesai=False;
                    $no = (5 * $_SESSION['page'])+1;
                    $tonext = $no+4;
                    if ($tonext >= $_SESSION["banyakSoal"]){
                        $tonext = $_SESSION["banyakSoal"];
                        $soalselesai=True;
                    }
                    echo "Halaman ". ($_SESSION['page']+1). " dari ".(ceil($_SESSION["banyakSoal"]/5));
                ?>
                </small>
			</h1>
        </section>

        <!-- Main content -->
        <section class="content">
    <?php
        for ($i = $no-1; $i < $tonext; $i++) {
    ?>
            <!-- YOUR CONTENT -->
            <form role="form" action="EditSoal.php" method="post">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $test[$i]["Nomor"];?> <button type="submit" class="btn btn-primary btn-lg" value="<?php echo $test[$i]["Nomor"]?>" name='Nomor'>Edit</button></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- textarea -->
                        <div class="form-group">
                            <label><?php echo $test[$i]["Soal"];?></label>
                        </div>
                        <div class="input-group">
                            <label>A.</label> <?php  echo $test[$i]["A"];?>
                        </div>
                        <div class="input-group">
                            <label>B.</label> <?php echo $test[$i]["B"]?>
                        </div>
                        <div class="input-group">
                            <label>C.</label> <?php echo $test[$i]["C"]?>
                        </div>
                        <div class="input-group">
                            <label>D.</label> <?php echo $test[$i]["D"]?>
                        </div>
                        <div class="input-group">
                            <label>E.</label> <?php echo $test[$i]["E"]?>
                        </div>
                        <br>
                        <div class="input-group">
                            <label>Jawaban: <?php echo $test[$i]["Jawaban"]?></label>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                </form>
    <?php
        }
    ?>
                <form method="POST">
                    <div class="btn-group">
                        <button class="btn btn-primary btn-lg" value="-1" name="whattodo"<?php if ($_SESSION['page']==0){echo "disabled";}else{echo "";}?> >BACK</button>
                        <?php for($i = 0;$i<(ceil($_SESSION["banyakSoal"]/5));$i++) {?>
                        <button class="btn btn-primary btn-lg" value="<?php echo $i;?>" name ="page"><?php echo $i+1;?></button>
                        <?php }?>
                        <button class="btn btn-primary btn-lg" value="1" name="whattodo"<?php if ($soalselesai){echo "disabled";}else{echo "";}?> >NEXT</button>
                    </div>
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