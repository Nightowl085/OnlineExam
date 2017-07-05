<?php
$modulTidakDiperlukan = ['2.loginCheck.php','dashboardMhs.php','dashboardMhs.php'];
    include_once("module/module.php");
    include_once("module/1.database.php");
    $pesan = "";

if( isset($_POST['insert'])){
      $nid = $_REQUEST['nid'];
    $pass = $_REQUEST['pass'];
    $nama = $_REQUEST['nama'];
    $alamat = $_REQUEST['alamat'];
    $telpon = $_REQUEST['telpon'];
    $email = $_REQUEST['email'];
    $pass = password_hash($_POST['pass'],PASSWORD_BCRYPT); 
  $db->executeNonQuery("Insert into dosen values ('$nid','$pass','$nama','$alamat','$telpon','$email',TRUE)");
    if (!$db){
      $pesan =' Gagal Insert, Check Kembali!';
    }else{
        $pesan = ' Sukses Insert Dosen dengan Nama :  '.$nama.' , NID : '.$nid.'!';
    }
}

function pesan(){
    global $pesan;
    if($pesan != ""){
?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-success box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Sukses</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <?php echo $pesan; ?>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
<?php
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
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="asset/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="asset/plugins/datepicker/datepicker3.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="asset/plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="asset/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins -->
    <link rel="stylesheet" href="asset/dist/css/skins/skin-blue.min.css">
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
                                <span class="hidden-xs">Administrator</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="asset/img/user.jpg" class="img-circle" alt="User Image">
                                    <p>
                                        Administrator - Avengers
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
                    <p>Administrator</p>
                    <p>Avengers - Admin</p>
                </div>
            </div>

        <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
                <li class="header">MENU</li>
                <?php menuAdmin(Array("Master Dosen","Tambah")); ?>
            </ul>
        <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>Master Dosen</h1>
            </section>

            <section class="content">
                <?php pesan(); ?>
                <form role="form"  method="POST" action='masterdosen.php' data-toggle="validator">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">NID Dosen</label>
                                <input type="text" name='nid' class="form-control" id="exampleInputEmail1" placeholder="Masukkan Nomor Induk Dosen" data-error="Data harus diisi!"  required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="password"  name='pass' class="form-control" id="exampleInputEmail1"placeholder="Masukkan Password" data-error="Data harus diisi!" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <!-- Date -->
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama</label>
                                <input type="text" name='nama' class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama Dosen" data-error="Data harus diisi!" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text"  name='alamat' class="form-control" id="exampleInputEmail1"placeholder="Masukkan Alamat"  data-error="Data harus diisi!" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <label>Nomor Telepon:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <input type="text"  name='telpon'  class="form-control" data-inputmask="&quot;mask&quot;: &quot;9999-9999-999&quot;" data-mask="" placeholder="Masukkan Nomor Telpon" data-error="Data harus diisi!" required>
                                 
                                </div>
                                <div class="help-block with-errors"></div>
                                <!-- /.input group -->
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <input type="email"  name='email' class="form-control" placeholder="Email" data-error="Data harus diisi!" required>
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <button type="submit" name='insert' class="btn btn-block btn-primary btn-lg">INSERT</button>
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

    <!-- REQUIRED JS SCRIPTS -->
    <!-- jQuery 2.2.3 -->
    <script src="asset/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="asset/js/bootstrap.min.js"></script>
    <!-- bootstrap datepicker -->
    <script src="asset/plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- bootstrap time picker -->
    <script src="asset/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <!-- AdminLTE App -->
    <script src="asset/dist/js/app.min.js"></script>
    <!-- Page script -->
    <!--BS3 Validatorjs-->
    <script src="asset/js/validator.min.js"></script>
    <!--BS DTB-->
    <script src="asset/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="asset/plugins/datatables/dataTables.bootstrap.css">
    <script>
        $(function() {
            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            });

            //Timepicker
            $(".timepicker").timepicker({
                showInputs: false
            });
        });
    </script>
</body>
</html>