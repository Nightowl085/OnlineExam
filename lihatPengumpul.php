<?php
    $modulTidakDiperlukan = ['2.loginCheck.php','dashboardMhs.php','dashboardAdmin.php'];
    include_once("module/module.php");
    if(strpos($_SESSION['user'],"D") === False) header("Location: 404");
    function pesan(){
        $pesan = $_SESSION['pesan'];
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
        $pesanError = $_SESSION['pesanError'];
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
        <script src="asset/js/oe.min.js"></script>
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
                Tugas Mata Kuliah <?php echo $db->executeGetScalar("SELECT m.`Nama Matkul` FROM `tugas` t, `Mata kuliah` m WHERE `Kode Tugas` = '{$_GET['kodeTugas']}' AND m.`Kode matkul` = t.`Kode Matkul`") ?>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Daftar Pengumpul</h3>
					<div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 200px;">
                            <a href="downloadTugas.php?kodeTugas=<?php echo $_GET['kodeTugas'] ?>"><button class="btn btn-success" style="display:inline-block;height: 30px;padding: 5px 10px; margin-right:10px;"><span class="glyphicon glyphicon-download-alt"></span> Download Semua</button></a>
                        </div>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
            <?php pesan(); pesanError();
            ?>
            <table id="tabelMataKuliah" class="table table-bordered table-striped datatable">
                <thead>
                    <tr>
                    <th>NRP</th>
                    <th>Nama</th>
                    <th>Kumpul</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $kode = $_GET['kodeTugas'];
                    $kodeMatkul = $db->executeGetScalar("SELECT `kode matkul` FROM TUGAS WHERE `kode tugas` = '$kode'");
                    $kodeDosen = $db->executeGetScalar("SELECT `kode dosen` FROM TUGAS WHERE `kode tugas` = '$kode'");
                    $data = $db->executeGetArray("SELECT * FROM mengambil m, mahasiswa mhs WHERE m.`Kode Matkul` = '$kodeMatkul' and m.`NID` = '$kodeDosen' and mhs.`NRP` = m.NRP");
                    foreach($data as $val){
                        echo "<tr><td>{$val['NRP']}</td><td>{$val['Nama']}</td><td>";
                        $coba = realpath(GLOBALDIR."/tugas/t".$kode.$kodeMatkul.$kodeDosen."_".$val['NRP'].".zip");
                        if(file_exists(realpath(GLOBALDIR."/tugas/t".$kode.$kodeMatkul.$kodeDosen."_".$val['NRP'].".zip"))){
                            echo "Sudah <a style='height:30px;padding: 5px 10px;margin-left: 20px;' class='btn btn-success' href='tugas/t".$kode.$kodeMatkul.$kodeDosen."_".$val['NRP'].".zip'>Download</a>";
                        }
                        else{
                            echo "Belum";
                        }
                        echo"</td></tr>";
                    }
                ?>
                <tbody>
                    <tfooter>
                        <tr>
                        <th>NRP</th>
                        <th>Nama</th>
                        <th>Kumpul</th>
                        </tr>
                    </tfooter>
                </table>
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
        <!-- ./wrapper -->
    </body>
</html>