<?php
    $modulTidakDiperlukan = ['2.loginCheck.php','dashboardMhs.php','dashboardMhs.php'];
    include_once("module/module.php");
    if($_SESSION['user'] != "admin") header("Location: 404");

    $pesan = "";

    if(isset($_POST["btnTambahMatkul"])){
        $query = "INSERT INTO `mata kuliah` VALUES(NULL,'{$_POST['txtNamaMatkul']}')";
        $db->executeNonQuery($query);
        $pesan = "Mata kuliah {$_POST['txtNamaMatkul']} berhasil ditambahkan";
    }

    function tableMataKuliah(){
        global $db;
        $data = $db->executeGetArray("SELECT * FROM `mata kuliah`");
        ?>
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Mata Kuliah</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 100px;">
                    <button id="btnTambahMataKuliah" class="btn btn-success" style="position:absolute;margin-left: 0 px;height: 30px;padding: 5px 10px;"><span class="glyphicon glyphicon-plus"></span> Tambah</button>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tabelMataKuliah" class="table table-bordered table-striped datatable">
                <thead>
                    <tr>
                    <th>Kode</th>
                    <th>Nama Mata Kuliah</th>
                    <th>Jumlah Pengajar</th>
                    </tr>
                </thead>
                <tbody>
            <?php 
                if($data != null){
                    foreach($data as $value){
                        echo "
                        <tr>
                        <td>{$value[0]}</td>
                        <td>{$value[1]}</td>
                        <td>{$db->executeGetScalar("SELECT COUNT(*) FROM MENGAJAR WHERE `Kode Matkul` = '{$value[0]}'")} <form method='get' action='#formLihatPengajar' style='display:inline-block;margin-left:10px;'><button class='btn btn-default' value='{$value[0]}' name='btnLihatPengajar'>Lihat Pengajar</button></form></td>
                        </tr>";
                    }
                }
            ?>
              </tbody>
                <tfoot>
                    <tr>
                    <th>Kode</th>
                    <th>Nama Mata Kuliah</th>
                    <th>Jumlah Pengajar</th>
                    </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <?php
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

    function lihatPengajar(){
        global $db;
        if(isset($_GET['btnLihatPengajar'])){
        ?> 
            <div class="row" id="formLihatPengajar">
                <div class="col-xs-12">
                    <div class="box box-info">
                        <div class="box-header">
                            <h3 class="box-title">Daftar Pengajar Mata Kuliah <?php
                                echo $db->executeGetScalar("SELECT `Nama Matkul` FROM `mata kuliah` where `Kode Matkul` = '{$_GET['btnLihatPengajar']}'");
                            ?></h3>
                            <div class="box-tools">
                                <div class="input-group input-group-sm" style="width: 200px;">
                                    <button id="btnTambahPengajar" class="btn btn-success" style="display:inline-block;height: 30px;padding: 5px 10px; margin-right:10px;"><span class="glyphicon glyphicon-plus"></span> Tambah</button>
                                    <button id="btnTutupPengajar" class="btn btn-danger" style="display:inline-block;height: 30px;padding: 5px 10px;"><span class="glyphicon glyphicon-remove"></span> Tutup</button>
                                </div>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered table-striped datatable">
                            <thead>
                                <tr>
                                <th>Kode Dosen</th>
                                <th>Nama Dosen</th>
                                <th>Jumlah Mahasiswa</th>
                                </tr>
                            </thead>
                                <tbody>
                            <?php 
                                $data = $db->executeGetArray("SELECT d.NID,d.Nama, am.jumlah
                                    FROM
                                    (SELECT `Kode Matkul`,NID,COUNT(*) as jumlah FROM  onlineexam.mengambil GROUP BY `Kode Matkul`, NID) am,
                                    onlineexam.dosen d
                                    where d.NID = am.NID AND `kode matkul` = '{$_GET['btnLihatPengajar']}'
                                    UNION DISTINCT
                                    SELECT d.NID, d.Nama, 0 from onlineexam.mengajar me, onlineexam.dosen d WHERE `Kode Matkul`='{$_GET['btnLihatPengajar']}' AND D.NID = me.NID
                                    AND d.nid not in (select NID FROM onlineexam.mengambil am where am.`Kode Matkul` = '{$_GET['btnLihatPengajar']}')");
                                if($data != null){
                                    foreach($data as $value){
                                        echo "
                                        <tr>
                                        <td>{$value[0]}</td>
                                        <td>{$value[1]}</td>
                                        <td>{$db->executeGetScalar("SELECT COUNT(*) FROM MENGAJAR WHERE `Kode Matkul` = '{$value[0]}'")} <button class='btn btn-danger' style='height:30px;padding: 5px; 10px;' value='{$value[0]},{$_GET['btnLihatPengajar']}' name='btnLihatPengajar'>Hapus</button></td>
                                        </tr>";
                                    }
                                }
                                else{
                                    ?>
                                        <tr><td colspan="3" style="text-align:center">Tidak ada pengajar mata kuliah</td><td style="display:none"> </td><td style="display:none"> </td></tr>
                                    <?php
                                    //https://stackoverflow.com/a/34012324 -> Ngakali
                                }
                            ?>
                            </tbody>
                            <tfooter>
                                <tr>
                                <th>Kode Dosen</th>
                                <th>Nama Dosen</th>
                                <th>Jumlah Mahasiswa</th>
                                </tr>
                            </tfooter>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
        <?php
            formTambahPengajar();
        }
    }

    //Trigger Tambah Pengajar
    if(isset($_POST["btnTambahPengajar"])){
        $db->executeNonQuery("INSERT INTO `Mengajar` VALUES('{$_POST['kodeMatKul']}','{$_POST['txtIdDosen']}')");
        $pesan = "Berhasil menambah '{$db->executeGetScalar("SELECT `Nama` FROM DOSEN WHERE NID='{$_POST['txtIdDosen']}'")}' sebagai pengajar {$db->executeGetScalar("SELECT `Nama Matkul` FROM `mata kuliah` WHERE `Kode Matkul` = '{$_POST['kodeMatKul']}'")}";
    }

    function formTambahPengajar(){
        global $db;
        $data = $db->executeGetArray("SELECT * FROM DOSEN");
        ?>
        <div class="row" id="dialogTambahPengajar">
            <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah Pengajar</h3>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <form id="formTambahMatKul" class="form-horizontal" role="form" data-toggle="validator" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="txtNamaMatkul" class="col-sm-2 control-label">Mata Kuliah</label>

                            <div class="col-sm-10" style="display: table;    vertical-align: middle;height: 30px;">
                                <span style="display: table-cell;vertical-align: middle;" ><?php echo $db->executeGetScalar("SELECT `Nama Matkul` FROM `mata kuliah` WHERE `Kode Matkul` = '{$_GET['btnLihatPengajar']}'"); ?></span>
                                <input type="hidden" name="kodeMatKul" value="<?php echo $_GET['btnLihatPengajar']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtIdDosen" class="col-sm-2 control-label">Dosen</label>

                            <div class="col-sm-10">
                                <select name="txtIdDosen" id="txtIdDosen" class="form-control" required data-error="Dosen yang mengajar harus dipilih!">
                                <?php
                                    foreach($data as $dosen){
                                        echo "<option value='{$dosen['NID']}'>{$dosen['Nama']}</option>";
                                    }
                                 ?>
                                </select>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" name="btnTambahPengajar" value="1" class="btn btn-success pull-right">Tambahkan</button>
                        <button type="button" class="btn btn-default" id="btnCancelTambahPengajar">Cancel</button>
                    </div><!-- /.box-footer -->
                </form>
            </div>
        </div>
        <?php
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
                <?php menuAdmin("Master Mata Kuliah"); ?>
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
            <?php pesan(); ?>
            <div class="row">
                <?php tableMataKuliah(); ?>
            </div>
            <div class="row" id="dialogTambahMatkul">
                <div class="col-xs-12">
                    <div class="box box-success">
                        <div class="box-header with-border">
                        <h3 class="box-title">Tambah Mata Kuliah</h3>
                        <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <form id="formTambahMatKul" class="form-horizontal" role="form" data-toggle="validator" method="post">
                            <div class="box-body">
                                    <div class="form-group">
                                        <label for="txtNamaMatkul" class="col-sm-2 control-label">Nama Mata Kuliah</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="txtNamaMatkul" name="txtNamaMatkul" placeholder="Nama Mata Kuliah" data-error="Data harus diisi!" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" name="btnTambahMatkul" value="1" class="btn btn-success pull-right">Tambahkan</button>
                                <button type="button" class="btn btn-default" id="btnCancelTambahMatkul">Cancel</button>
                            </div><!-- /.box-footer -->
                        </form>
                    </div>
                </div>
            </div>
            <?php lihatPengajar();?>
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
        <!--BS3 Validatorjs-->
        <script src="asset/js/validator.min.js"></script>
        <!--OnlineExam Min-->
        <script src="asset/js/oe.min.js"></script>
        <!-- Optionally, you can add Slimscroll and FastClick plugins.
        Both of these plugins are recommended to enhance the
        user experience. Slimscroll is required when using the
        fixed layout. -->
        <!--Data Tables-->
        <script src="asset/plugins/datatables/jquery.dataTables.min.js"></script>
        <!--BS DTB-->
        <script src="asset/plugins/datatables/dataTables.bootstrap.min.js"></script>
        <link rel="stylesheet" href="asset/plugins/datatables/dataTables.bootstrap.css">
    </body>
</html>