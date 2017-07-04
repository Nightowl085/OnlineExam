<?php
    $modulTidakDiperlukan = ['2.loginCheck.php','dashboardMhs.php','dashboardMhs.php'];
    include_once("module/module.php");
    if($_SESSION['user'] != "admin") header("Location: 404");
?>
<!DOCTYPE html>
<html>
    <head>
        <?php mainStyle(); dataTableStyle(); mainScript(); dataTableScript(); ?>
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
                <?php menuAdmin(array("Master Mahasiswa","Lihat Mahasiswa")); ?>
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
                    Data Mahasiswa
                </h1>
            </section>

            <section class="content">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data Mahasiswa</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="mahasiswa" class="table table-bordered table-striped datatable">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>NRP</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                    <th>Email</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $conn = new mysqli("localhost", "root", "", "onlineexam");
                                $sql = "SELECT * FROM mahasiswa WHERE status = true ORDER BY Nama";
                                $result = $conn->query($sql);
                                    if ($result->num_rows > 0){
                                            while($row = $result->fetch_assoc()) {
                                            print "<tr><td>";
                                            echo $row['Nama'];
                                            print "</td><td>";
                                            echo $row['NRP'];
                                            print "</td><td>";
                                            echo $row['Alamat'];
                                            print "</td><td>";
                                            echo $row['Telpon'];
                                            print "</td><td>";
                                            echo $row['Email'];
                                            print "</td><td><a href='admininsertmhs.php?nrp=";
                                            echo $row['NRP'];
                                            print "&update=true'><button type='button' class='btn btn-block btn-success btn-xs'>Update</button><a></td><td>";
                                            print "<a href='deletemhs.php?nrp=";
                                            echo $row['NRP'];
                                            print "'><button type='button' class='btn btn-block btn-danger btn-xs'>Delete</button></a></td></tr>";
                                        }
                                    }?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
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
