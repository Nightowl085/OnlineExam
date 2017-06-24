<?php 
    $modulTidakDiperlukan = ['2.loginCheck.php','dashboardMhs.php','dashboardMhs.php'];
    include_once("module/module.php");
    if($_SESSION['user'] != "admin") header("Location: 404");
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
                <?php menuAdmin(Array("Master Mahasiswa","Tambah/Update Mahasiswa")); ?>
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
                <?php if(!isset($_GET['update'])){
                  echo "Insert mahasiswa";
                }else{
                    echo "Update Mahasiswa";
                }?>
                </h1>
            </section>

            <section class="content">
              <?php  if(!isset($_GET['update'])){?>
                <form role="form" action="insertmhs.php" method="post" data-toggle="validator">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Mahasiswa</label>
                                <input type="text" class="form-control" placeholder="Masukkan nama mahasiswa" name="nama" data-error="Nama harus diisi! Masa mahasiswa ga punya nama?" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">NRP</label>
                                <input type="text" class="form-control" name="nrp" data-error="Bruh, that email address is invalid" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <!-- /.form group -->

                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="alamat" class="form-control" required></textarea>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <label>Nomor Telepon:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <input type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask name="telepon" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <!-- /.input group -->
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <input type="email" class="form-control" placeholder="Email" name="email" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                    </div>
                    <button type="submit" class="btn btn-block btn-primary btn-lg">INSERT</button>
                </form>
              <?php } else {
                $conn = new mysqli("localhost", "root", "", "onlineexam");
                $sql = "SELECT * FROM mahasiswa WHERE NRP = $_GET[nrp]";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();

                ?>
                <form role="form" action="updatemhs.php?nrp=<?php echo $_GET['nrp']?>" method="post">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Mahasiswa</label>
                                <input type="text" class="form-control" placeholder="Masukkan nama mahasiswa" name="nama" value="<?php echo $row['Nama']?>">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">NRP</label>
                                <input type="text" class="form-control" name="nrp" value="<?php echo $_GET['nrp'] ?>" disabled>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>

                            <!-- /.form group -->
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="alamat" class="form-control" ><?php echo $row['Alamat']?></textarea>
                            </div>

                            <div class="form-group">
                                <label>Nomor Telepon:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <input type="text" class="form-control" data-inputmask="&quot;mask&quot;: &quot;9999-9999-999&quot;" data-mask="" name="telepon" value=<?php echo $row['Telpon']?>>
                                </div>
                                <!-- /.input group -->
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo $row['Email']?>">
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                    </div>
                    <button type="submit" class="btn btn-block btn-primary btn-lg">UPDATE</button>
                </form>
              <?php } ?>
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
