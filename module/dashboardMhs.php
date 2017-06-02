<?php
    
    /**
     * Mendapatkan NamaMahasiswa lewat database, langsung echo jadi tinggal panggil aja
     *
     * @return void
     */
    function namaMahasiswa(){
        global $db; // https://stackoverflow.com/questions/3041171/php-variable-not-working-inside-of-function
        echo $db->executeGetScalar("SELECT nama FROM MAHASISWA WHERE NRP = '{$_SESSION['user']}'");
    }

    /**
     * Menu Mahasiswa, Jadikan modul biar mudah ubah2nya
     *
     * @return void
     */
    function menuMahasiswa(){
        ?> 
        <!-- Optionally, you can add icons to the links -->
        <li class="active treeview">
            <a href="#">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i>Ujian</a></li>
                <li><a href="index2.html"><i class="fa fa-circle-o"></i>Transkrip Nilai</a></li>
            </ul>
        </li>
        <li><a href="#"><i class="fa fa-user"></i> <span>Biodata</span></a></li>
        <?php
    }
    /**
     * Menampilkan Dahsboard MHS
     *
     * @return void
     */
    function dashboardMhs(){
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
            <a href="index2.html" class="logo">
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
                                        <?php namaMahasiswa(); echo " - ".$_SESSION['user']; ?> 
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
                    <p><?php namaMahasiswa(); ?></p>
                    <p><?php echo $_SESSION['user']; ?></p>
                </div>
            </div>

        <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
                <li class="header">MENU</li>
                <?php menuMahasiswa(); ?>
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
                Dashboard
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
            <!-- NOTIF UJIAN -->
            <div class="callout callout-danger lead">
                <h4>Ujian Manajemen Keuangan!</h4>
                <p>Ujian dulu lah <a href="../starter.html">di sini</a>.</p>
            </div>
            <!-- TABLE: UJIAN -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Ujian</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>Nama Ujian</th>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
                                    <th>Durasi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Proyek Bisnis 1</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td><button type="button" class="btn btn-block btn-success btn-xs disabled">Sudah</button></td>
                                </tr>
                                <tr>
                                    <td>Desain Komunikasi Visual</td>
                                    <td>6 Juni 2017</td>
                                    <td>10.30</td>
                                    <td>60 Menit</td>
                                    <td><button type="button" class="btn btn-block btn-success btn-xs disabled">Sudah</button></td>
                                </tr>
                                <tr>
                                    <td>Technopreneurship 1</td>
                                    <td>8 Juni 2017</td>
                                    <td>10.30</td>
                                    <td>30 Menit</td>
                                    <td><button type="button" class="btn btn-block btn-danger btn-xs disabled">Terlambat</button></td>
                                </tr>
                                <tr>
                                    <td>Aplikasi Internet</td>
                                    <td>8 Juni 2017</td>
                                    <td>08.00</td>
                                    <td>90 Menit</td>
                                    <td><button type="button" class="btn btn-block btn-success btn-xs disabled">Sudah</button></td>
                                </tr>
                                <tr>
                                    <td>Analisis Sistem Informasi Bisnis</td>
                                    <td>13 Juni 2017</td>
                                    <td>08.00</td>
                                    <td>90 Menit</td>
                                    <td><button type="button" class="btn btn-block btn-success btn-xs disabled">Sudah</button></td>
                                </tr>
                                <tr>
                                    <td>Manajemen Keuangan</td>
                                    <td>13 Juni 2017</td>
                                    <td>13.00</td>
                                    <td>100 Menit</td>
                                    <td><button type="button" class="btn btn-block btn-warning btn-xs">Kerja</button></td>
                                </tr>
                                <tr>
                                    <td>Teknologi Multimedia</td>
                                    <td>14 Juni 2017</td>
                                    <td>08.00</td>
                                    <td>45 Menit</td>
                                    <td><button type="button" class="btn btn-block btn-info btn-xs disabled">Belum</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <!-- /.table-responsive -->
                </div>
            </div>
            <!-- TABLE: NILAI -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Transkrip Nilai</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>Periode</th>
                                    <th>Nama Ujian</th>
                                    <th>Nilai</th>
                                    <th>Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>GASAL 2015/2016</td>
                                    <td>ALGORITMA DAN PEMROGRAMAN 1</td>
                                    <td>88.1</td>
                                    <td>
                                        <span class="label label-success">A</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>GENAP 2015/2016</td>
                                    <td>BASIS DATA</td>
                                    <td>70.4</td>
                                    <td>
                                        <span class="label label-success">B</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>GENAP 2015/2016</td>
                                    <td>PEMROGRAMAN VISUAL</td>
                                    <td>55</td>
                                    <td>
                                        <span class="label label-danger">D</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>GASAL 2016/2017</td>
                                    <td>APLIKASI CLIENT SERVER</td>
                                    <td>57.6</td>
                                    <td>
                                        <span class="label label-success">C</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>GASAL 2016/2017</td>
                                    <td>PEMROGRAMAN BERORIENTASI OBJEK</td>
                                    <td>79.5</td>
                                    <td>
                                        <span class="label label-success">B</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>GENAP 2016/2017</td>
                                    <td>APLIKASI INTERNET</td>
                                    <td>100</td>
                                    <td>
                                        <span class="label label-success">A</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>GENAP 2016/2017</td>
                                    <td>MULTIMEDIA</td>
                                    <td>100</td>
                                    <td>
                                        <span class="label label-success">A</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <div class="box-footer clearfix">
                <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Cetak</a>
                </div>
            </div>
                <!-- /.box -->
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

        <!-- REQUIRED JS SCRIPTS -->
        <!-- jQuery 2.2.3 -->
        <!-- Bootstrap 3.3.6 -->
        <script src="asset/js/bootstrap.min.js"></script>
        <!-- AdminLTE App -->
        <script src="asset/dist/js/app.min.js"></script>

        <!-- Optionally, you can add Slimscroll and FastClick plugins.
        Both of these plugins are recommended to enhance the
        user experience. Slimscroll is required when using the
        fixed layout. -->
    </body>
</html>
        <?php
    }

    