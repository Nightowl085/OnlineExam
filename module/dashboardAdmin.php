<?php
    function menuAdmin($active){
?>
        <?php 
            $menu[0] = array("Awal","dashboard.php");
            $menu[1] = array( -1 => "Master Dosen",
                                0 => array(
                                    array("Lihat","lihathapusupdatedosen.php"),
                                    array("Tambah","masterDosen.php"))
                                );
            $menu[2] = array("Master Mata Kuliah","masterMatakuliah.php");
            $menu[3] = array( -1 => "Master Mahasiswa",
                                0 => array(
                                    array("Lihat Mahasiswa","adminviewmhs.php"),
                                    array("Tambah/Update Mahasiswa","admininsertmhs.php")
                                ));
            foreach($menu as $data){
                if(!isset($data[-1])){
        ?>
                <li <?php 
                    if(!is_array($active)){
                        if($active == $data[0]) echo "class='active'";
                    }
                ?>><a href="<?php echo $data[1];?>"><i class="fa fa-circle-o"></i><span><?php echo $data[0];?></a></span></li>
        <?php
                }
                else{
        ?>
            <li class="treeview <?php if(is_array($active)){
                        if($active[0] == $data[-1]) echo "active";
                    }?>">
            <a href="#">
                <i class="fa fa-circle-o"></i>
                <span><?php echo $data[-1]; ?></span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu <?php if(is_array($active)){
                        if($active[0] == $data[-1]) echo "menu-open";
                    }?>">
                <?php foreach($data[0] as $child) {?>
                <li <?php if(is_array($active)){
                        if($active[1] == $child[0]) echo "class='active'";
                    } ?>><a href="<?php echo $child[1]; ?>"><i class="fa fa-circle-o"></i> <?php echo $child[0]; ?></a></li>
                <?php } ?>
            </ul>
            </li>
<?php
                }
            }
    }

    function jumlahDosen(){
        global $db;
        echo $db->executeGetScalar("SELECT COUNT(*) FROM DOSEN");
    }

    function jumlahMahasiswa(){
        global $db;
        echo $db->executeGetScalar("SELECT COUNT(*) FROM MAHASISWA");
    }

    function nilaiRataRata(){
        global $db;
        echo  $db->executeGetScalar("SELECT AVG(`Nilai`) FROM NILAI");
    }

    function jumlahSoal(){
        global $db;
        echo  $db->executeGetScalar("SELECT Count(*) as AAA FROM header_ujian");
    }

    function dashboardAdmin(){
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
                <?php menuAdmin("Awal"); ?>
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
            <!--Keterangan Dosen-->
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Jumlah Dosen</span>
                            <span class="info-box-number"><?php jumlahDosen(); ?></span>
                        </div><!--/info-box-content-->
                    </div><!--/info-box-->
                </div><!--/bs3-col-md-6-->
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Jumlah Mahasiswa</span>
                            <span class="info-box-number"><?php jumlahMahasiswa(); ?></span>
                        </div><!--/info-box-content-->
                    </div><!--/info-box-->
                </div><!--/bs3-col-md-6-->
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Jumlah Soal yang sudah dibuat</span>
                            <span class="info-box-number"><?php jumlahSoal(); ?></span>
                        </div><!--/info-box-content-->
                    </div><!--/info-box-->
                </div><!--/bs3-col-md-6-->
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Nilai Rata-rata semua ujian</span>
                            <span class="info-box-number"><?php nilaiRataRata(); ?></span>
                        </div><!--/info-box-content-->
                    </div><!--/info-box-->
                </div><!--/bs3-col-md-6-->
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
<?php
    }
?>