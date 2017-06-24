<?php
	$modulTidakDiperlukan = ['2.loginCheck.php','dashboardMhs.php','dashboardMhs.php'];
	include_once("module/module.php");
	if(strpos($_SESSION['user'],"D") === FALSE) header("Location: 404");
	$kode = $db->executeGetScalar("select max(Kode) from header_ujian")+1;
	$_SESSION["kode"]=$kode;
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
			// Ambil Kode untuk dihapus
			$(".btnHapusUjian").click(function(){
				$("#btnKonfirmasiHapus").val($(this).val());
			});
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
                                <span class="hidden-xs">Administrator</span>
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
			</h1>
        </section>
        
        <section class="content">
            <form role="form" method="post" action="DetailUjian.php" data-toggle="validator">
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
                                    ?></select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Ujian</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukkan nama ujian" name="NamaUjian" required>
                        </div>
                        <!-- Date -->
                        <div class="form-group">
                            <label>Tanggal</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right datepicker" data-date-format="yyyy-mm-dd" name="Tanggal" required>
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
                                    <input type="text" class="form-control timepicker" name = "Jam" required>
                                </div>
                                <!-- /.input group -->
                            </div>
                            <!-- /.form group -->
                        </div>
                        
                        <div class="form-group">
                            <label>Durasi</label>
                            <div class="input-group">
                                <input type="number" min='0' class="form-control" name="Waktu" required>
                                <span class="input-group-addon">Menit</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jumlah Soal</label>
                            <input type="number" min='0' class="form-control" id="exampleInputEmail1" name="BanyakSoal" required/>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <input type="submit" class="btn btn-block btn-primary btn-lg" value="Next" name="next"/>
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
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>