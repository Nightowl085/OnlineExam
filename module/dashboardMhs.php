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
        <li><a href="index.php"><i class="fa fa-circle"></i> <span>Biodata</span></a></li>
        <li><a href="transkripNilai.php"><i class="fa fa-circle"></i> <span>Laporan Nilai</span></a></li>
<?php
    }
	
    function nilaiMahasiswa(){
        global $db;
        $data = $db->executeGetArray("SELECT hu.Kode as 'Kode Ujian', mat.`Kode Matkul` ,mat.`Nama Matkul`, d.`Nama` as NamaDosen, n.Nilai
        FROM
        onlineexam.nilai n, onlineexam.`mata kuliah` mat, onlineexam.header_ujian hu, onlineexam.mengajar aj, onlineexam.dosen d
        WHERE
        aj.`Kode Matkul` = mat.`Kode Matkul` and hu.`Kode Matkul` = aj.`Kode Matkul` and hu.NID = aj.NID
        AND n.`Kode Ujian` = hu.Kode and d.NID = hu.NID AND n.NRP = {$_SESSION['user']}");
?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Nilai Milik <?php namaMahasiswa(); ?></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered table-striped datatable" id="tabelTugas">
                            <thead>
                                <tr>
                                <th>Kode Ujian</th>
                                <th>Kode Mata Kuliah</th>
                                <th>Mata Kuliah</th>
                                <th>Pengajar</th>
                                <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                if($data != null){
                                    foreach($data as $value){
                                        echo "
                                        <tr>
                                        <td>{$value['Kode Ujian']}</td>
                                        <td>{$value['Kode Matkul']}</td>
                                        <td>{$value['Nama Matkul']}</td>
                                        <td>{$value['NamaDosen']}</td>
                                        <td>{$value['Nilai']}</td>";
                                    }
                                } else{
                            ?>
                                    <tr><td colspan="4" style="text-align:center">Tidak ada Nilai</td><td style="display:none"> </td><td style="display:none"> </td><td style="display:none"> </td></tr>
                            <?php
                                    //https://stackoverflow.com/a/34012324 -> Ngakali
                                }
                            ?>
                            </tbody>
                            <tfooter>
                                <tr>
                                <th>Kode Ujian</th>
                                <th>Kode Mata Kuliah</th>
                                <th>Mata Kuliah</th>
                                <th>Pengajar</th>
                                <th>Nilai</th>
                                </tr>
                            </tfooter>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
<?php
    }

	function tabelUjian(){
        $todaydate=date("Y-m-d");
        global $db;
		//Ambil Soal Ujian berdasarkan user yang login
        $data = $db->executeGetArray("SELECT * FROM header_ujian h, mengambil am where h.NID = am.NID and h.`Kode Matkul` = am.`Kode Matkul` and am.NRP = {$_SESSION['user']}");
?>
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Ujian</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="tabelUjian" class="table table-bordered table-striped datatable">
                <thead>
                    <tr>
                    <th>Nama Ujian</th>
                    <th>Tanggal</th>
                    <th>Durasi</th>
                    <th>Banyak Soal</th>
                    <th>Kerjakan Soal</th>
                    </tr>
                </thead>
                <tbody>
            <?php
                if($data != null){
					date_default_timezone_set('Asia/Jakarta');
                    foreach($data as $value){
						$checkingkode = $db->executeGetScalar("SELECT count(*) from nilai where `Kode Ujian` = {$value[0]} AND NRP = {$_SESSION['user']}");
						
                        if( new DateTime() >= new DateTime($value['Tanggal'])){
							//Tambah 15 mnt
								$limitdate = new DateTime($value['Tanggal']);
								$firstdate = $limitdate->format('H:i:s');
								$minutes_to_add = $db->executeGetScalar("SELECT Waktu from header_ujian where Kode={$value[0]}");
								$limitdate-> add(new DateInterval('PT'. $minutes_to_add . 'M'));
								
								$dateStamp = $limitdate->format('H:i:s');
								
								$now = new DateTime();
								$nowstamp = $now->format('H:i:s');
								
								if (new DateTime() > $limitdate){
									$visible = "disabled";
								}else{
									$visible= "";
									if($checkingkode>0){
								$visible= "disabled";
							}else{
								$visible="";
							}
								}
							}else{
								$visible = "disabled";
							}
                        echo "
                        <tr>
                        <td>{$value[1]}</td>
                        <td>{$value[2]}</td>
                        <td>{$value[3]}</td>
                        <td>{$value[4]}</td>
                        <td><form action='KerjakanSoal.php' method='POST'><button class='btn btn-block btn-success btn-xs' value={$value[0]} name='kode' $visible>Kerjakan</button></form></td>
                        </tr>";
                    }
                }
            ?>
                </tbody>
                <tfoot>
                    <tr>
                    <th>Nama Nama Ujian</th>
                    <th>Tanggal</th>
                    <th>Durasi</th>
                    <th>Banyak Soal</th>
                    <th>Kerjakan Soal</th>
                    </tr>
                </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
<?php
    }

    function tabelTugasMahasiswa(){
        global $db;
        $data = $db->executeGetArray("SELECT t.`Kode Tugas`,t.`Nama Tugas`, m.`Nama Matkul`, d.`Nama` as NamaDosen,t.`Tanggal_Kumpul`,t.`Keterangan Tugas` FROM `TUGAS` t, `Mengambil` am, Dosen d, `Mata Kuliah` m WHERE t.`Kode Matkul` = am.`Kode Matkul` AND t.`Kode Dosen` = am.NID AND am.NRP = {$_SESSION['user']} AND D.NID = am.NID AND m.`Kode Matkul` = am.`Kode Matkul` AND t.`Tanggal_Kumpul` >= CURDATE()");
?>
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Daftar Tugas</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-striped datatable" id="tabelTugas">
                        <thead>
                            <tr>
                            <th>Kode Tugas</th>
                            <th>Nama Tugas</th>
                            <th>Mata Kuliah</th>
                            <th>Dosen</th>
                            <th>Tanggal Kumpul</th>
                            <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            if($data != null){
                                foreach($data as $value){
                                    echo "
                                    <tr>
                                    <td>{$value['Kode Tugas']}</td>
                                    <td>{$value['Nama Tugas']}</td>
                                    <td>{$value['Nama Matkul']}</td>
                                    <td>{$value['NamaDosen']}</td>
                                    <td>{$value['Tanggal_Kumpul']}</td>
                                    <td><form method='get' action='kumpulTugas.php'><button class='btn btn-primary' name='kodeTugas' value='{$value['Kode Tugas']}' ";
                                    // Cek apakah sudah lewat dari tgl/jam kumpul? Jika iya button di disable
                                    if( new DateTime() > new DateTime($value['Tanggal_Kumpul']))
                                        echo "disabled";
                                    echo ">Kumpul</button></form></td>
                                    </tr>";
                                }
                            }
                            else{
                        ?>
                                    <tr><td colspan="6" style="text-align:center">Tidak ada Tugas</td><td style="display:none"> </td><td style="display:none"> </td><td style="display:none"> </td><td style="display:none"> </td><td style="display:none"> </td></tr>
                        <?php
                                //https://stackoverflow.com/a/34012324 -> Ngakali
                            }
                        ?>
                        </tbody>
                        <tfoot>
                            <tr>
                            <th>Kode Tugas</th>
                            <th>Nama Tugas</th>
                            <th>Mata Kuliah</th>
                            <th>Dosen</th>
                            <th>Tanggal Kumpul</th>
                            <th>Aksi</th>
                            </tr>
                        </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
<?php
    }

    /**
     * Menampilkan Dahsboard MHS
     *
     * @return void
     */
    function dashboardMhs(){
		$_SESSION['kode'] = "";
		$_SESSION['page']="";
		$_SESSION['judul']="";
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
    <script>
    $(function(){
        $(".datatable").DataTable();
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
                            <span class="hidden-xs"><?php namaMahasiswa(); ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="asset/img/user.jpg" class="img-circle" alt="User Image">
                                <p>
                                    <?php namaMahasiswa(); ?> - <?php echo $_SESSION['user']; ?>
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
                <?php menuMahasiswa("Awal");?>
            </ul>
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Dashboard</h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <?php  
                tabelTugasMahasiswa();
                tabelUjian();
            ?>
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