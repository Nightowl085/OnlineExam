<?php
    $modulTidakDiperlukan = ['2.loginCheck.php','dashboardMhs.php','dashboardAdmin.php'];
    include_once("module/module.php");
    if(strpos($_SESSION['user'],"D") === False) header("Location: 404");
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

    function pesanError(){
        global $pesanError;
        if($pesanError != ""){
?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-danger box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Gagal</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <?php echo $pesanError; ?>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
<?php
        }
    }

    if(isset($_POST['hapus'])){
        deleteTugas($_POST['hapus']);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <?php mainStyle(); dataTableStyle(); mainScript(); dataTableScript();?>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="asset/js/oe.min.js"></script>
        <!-- Optionally, you can add Slimscroll and FastClick plugins.
        Both of these plugins are recommended to enhance the
        user experience. Slimscroll is required when using the
        fixed layout. -->
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
                <?php menuDosen(Array("Master Tugas","Lihat")); ?>
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
                Master Mata Kuliah
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Daftar Tugas</h3>
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 200px;">
                            <a href="buatTugas.php"><button id="btnTambahPengajar" class="btn btn-success" style="display:inline-block;height: 30px;padding: 5px 10px; margin-right:10px;"><span class="glyphicon glyphicon-plus"></span> Tambah</button></a>
                        </div>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
            <?php pesan(); pesanError(); ?>
            <table id="tabelMataKuliah" class="table table-bordered table-striped datatable">
                <thead>
                    <tr>
                        <th>Kode Tugas</th>
                        <th>Nama Tugas</th>
                        <th>Tanggal Kumpul</th>
                        <th>Keterangan</th>
                        <th>Mata Kuliah</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
            <?php
                $data = $db->executeGetArray("SELECT * FROM Tugas WHERE `kode Dosen` = '{$_SESSION['user']}'");
                if(count($data) > 0){
                    foreach($data as $val){
                        echo "<tr><td>{$val[0]}</td><td>{$val[5]}</td><td>{$val[3]}</td><td>{$val[4]}</td><td>{$db->executeGetScalar("SELECT `nama matkul` from `mata kuliah` where `kode matkul` = '{$val[1]}'")}</td><td><a href='lihatPengumpul.php?kodeTugas={$val[0]}' class='btn btn-info btn-xs'>Lihat Pengumpul</a></td><td><form style='display:inline' method='post'><button name='hapus' value='{$val[0]}' class='btn btn-danger btn-xs'>Hapus Tugas</button></form></td></tr>";
                    }
                }
            ?>
            <tbody>
                <tfoot>
                    <tr>
                        <th>Kode Tugas</th>
                        <th>Nama Tugas</th>
                        <th>Tanggal Kumpul</th>
                        <th>Keterangan</th>
                        <th>Mata Kuliah</th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
            <Script>
            $(function(){
                //$(".datatable").datatable();
            });
            </script>
            </div></div></div>
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

    </body>
</html>