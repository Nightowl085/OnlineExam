<?php

    /**
     * Fungsi Menambah Tugas, panggil Fungsi Ini, agar tugasnya bisa dibuat
     *
     * @param String $namaTugas Nama Tugas baru
     * @param String $tanggalKumpul Tanggal Tugas formatnya dd-mm-yyyy
     * @param String $jamKumpul Jam kumpul dari data yang ada HH24:ss
     * @param String $kodeDosen Kode Dosen yang mengajar
     * @param String $kodeMatkul Kode Mata Kuliah yang diberikan tugas
     * @param String $keterangan Keterangan tugas yang harus dilakukan
     * @return void
     */
    $_SESSION['pesan'] = ""; $_SESSION['pesanError'] = "";
	
    function buatTugas($namaTugas,$tanggalKumpul,$jamKumpul,$kodeDosen,$kodeMatkul,$keterangan){
        global $db;
        $namaMatkul = $db->executeGetScalar("SELECT `nama matkul` from `Mata Kuliah` WHERE `Kode Matkul` = '$kodeMatkul'");
        $query = "INSERT INTO `tugas` VALUES(NULL,'$kodeMatkul','$kodeDosen',STR_TO_DATE('$tanggalKumpul $jamKumpul','%d-%m-%Y %H:%s'),'$keterangan','$namaTugas')";
        $db->executeNonQuery($query);
        $_SESSION['pesan'] = "Berhasil Menambahkan Tugas Mata Kuliah ".$namaMatkul;
    }
    
     function namaDosen(){
        global $db; // https://stackoverflow.com/questions/3041171/php-variable-not-working-inside-of-function
        echo $db->executeGetScalar("SELECT nama FROM DOSEN WHERE NID = '{$_SESSION['user']}'");
    }
	//Disabling Lanjutan Soal
	function soalSelesai($kode){
		global $db;
		$jmlSoal=$db->executeGetScalar("select banyak FROM header_ujian WHERE Kode = '$kode'");
		$banyaksoal=$db->executeGetScalar("SELECT MAX(Nomor) FROM detail_ujian WHERE Kode = '$kode'");
		
		if ($jmlSoal == $banyaksoal){
			return "disabled";
		}else{
			return "";
		}
	}
	
	//Disabling Lihat Soal
	function BolehLihat($kode){
		if (soalSelesai($kode)!= "disabled"){
			return "disabled";
		}else{
			return "";
		}
	}

    /**
     * Fungsi untuk melakukan update pada Tugas yang dipilih
     *
     * @param String $kodeTugas
     * @param String $namaTugas
     * @param String $tanggalKumpul
     * @param String $jamKumpul
     * @param String $kodeDosen
     * @param String $kodeMatkul
     * @param String $keterangan
     * @return void
     */
    function updateTugas($kodeTugas,$namaTugas,$tanggalKumpul,$jamKumpul,$kodeDosen,$kodeMatkul,$keterangan){
        global $db;
        $namaMatkul = $db->executeGetScalar("SELECT `nama matkul` from `Mata Kuliah` WHERE `Kode Matkul` = '$kodeMatkul'");
        $query = "UPDATE `tugas` set `Kode Matkul` = '$kodeMatkul', `Kode Dosen` = '$kodeDosen', `Tanggal_Kumpul` = STR_TO_DATE('$tanggalKumpul $jamKumpul','%d-%m-%Y %H:%s'), `Keterangan Tugas` = '$keterangan', `Nama Tugas` = '$namaTugas' WHERE `Kode Tugas` = '$kodeTugas'";
        $db->executeNonQuery($query);
        $_SESSION['pesan'] = "Berhasil mengupdate Tugas Mata Kuliah ".$namaMatkul;
    }

    /**
     * Fungsi Delete Tugas
     *
     * @param String $kodeMatkul
     * @param String $kodeDosen
     * @return void
     */
    function deleteTugas($kodeTugas){
        global $db;
        $namaMatkul = $db->executeGetScalar("SELECT `nama matkul` from `Mata Kuliah`m, tugas t WHERE m.`Kode matkul` = t.`kode matkul` AND t.`Kode Tugas` = '$kodeTugas'");
        $kodeMatkul = $db->executeGetScalar("SELECT m.`kode matkul` from `Mata Kuliah`m, tugas t WHERE m.`Kode matkul` = t.`kode matkul` AND t.`Kode Tugas` = '$kodeTugas'");
        $kodeDosen = $db->executeGetScalar("SELECT `kode dosen` FROM `tugas` where `kode tugas` = '$kodeTugas'");
        $query = "DELETE FROM `Tugas` WHERE `Kode Tugas` = '$kodeTugas'";
        $db->executeNonQuery($query);
        $dataMahasiswa = $db->executeGetArray("SELECT `NRP` FROM `mengambil` WHERE `Kode Matkul` = $kodeMatkul AND `NID` = '$kodeDosen'");

        foreach($dataMahasiswa as $val){
            if(realpath(GLOBALDIR."/tugas/t".$kodeTugas.$kodeMatkul.$kodeDosen."_".$val[0].".zip")){
                $lokasi = GLOBALDIR."\\tugas\\t".$kodeTugas.$kodeMatkul.$kodeDosen."_".$val[0].".zip";
                unlink($lokasi);
            }
        }
        $_SESSION['pesan'] = "Tugas Mata Kuliah ".$namaMatkul." Berhasil dihapus!";
    }


    function nilaiMataKuliah($kodeMataKuliah){
        global $db;
        $data = $db->executeGetArray("SELECT mhs.NRP, mhs.Nama, n.Nilai  FROM onlineexam.mengajar aj, onlineexam.header_ujian, onlineexam.nilai n , onlineexam.mengambil am, onlineexam.mahasiswa mhs WHERE aj.NID = am.NID and aj.`Kode Matkul` = am.`Kode Matkul` and mhs.NRP = am.NRP and n.NRP = am.NRP and mhs.NRP = am.NRP and am.`Kode Matkul` = n.`Kode Matkul` and aj.NID = n.NID and aj.NID = '{$_SESSION['user']}' AND aj.`Kode Matkul` = $kodeMataKuliah
        UNION
        SELECT mhs.NRP, mhs.Nama, 0 as Nilai FROM onlineexam.mahasiswa mhs, onlineexam.mengambil am WHERE am.NRP = mhs.NRP and am.`Kode Matkul` = $kodeMataKuliah and am.NID = '{$_SESSION['user']}' and  mhs.nrp not in (SELECT mhs.NRP FROM onlineexam.mengajar aj, onlineexam.header_ujian, onlineexam.nilai n , onlineexam.mengambil am, onlineexam.mahasiswa mhs WHERE aj.NID = am.NID and aj.`Kode Matkul` = am.`Kode Matkul` and mhs.NRP = am.NRP and n.NRP = am.NRP and mhs.NRP = am.NRP and am.`Kode Matkul` = n.`Kode Matkul` and aj.NID = n.NID and aj.NID = '{$_SESSION['user']}' AND aj.`Kode Matkul` = $kodeMataKuliah)");
        ?>
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Nilai Mata Kuliah <?php echo $db->executeGetScalar("SELECT `nama matkul` FROM `Mata Kuliah` where `Kode Matkul` = '$kodeMataKuliah'"); ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="tabelNilaiUjian" class="table table-bordered table-striped datatable">
                        <thead>
                        <tr>
                            <th>NRP</th>
                            <th>Nama Mahasiswa</th>
                            <th>Nilai</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data as $value) {?>
                            <tr>
                            <td><?php echo $value["NRP"]; ?></td>
                            <td><?php echo $value["Nama"]; ?></td>
                            <td><?php echo $value["Nilai"]; ?></td>
                            </tr>
                        <?php
                            }
                        ?>
                        </tbody>
                    </table>
                    
                </div>
            </div>
        <?php
    }

    function tabelMengajar(){
        global $db;
        $data = $db->executeGetArray("SELECT * FROM `mengajar` aj, `Mata Kuliah` m WHERE aj.`Kode Matkul` = m.`Kode Matkul` AND aj.NID = '{$_SESSION['user']}'");
        ?>
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Kuliah Yang Diajar</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="tabelNilaiUjian" class="table table-bordered table-striped datatable">
                    <thead>
                    <tr>
                        <th>Kode Matkul</th>
                        <th>Nama Mata Kuliah</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $value) {?>
                        <tr>
                        <td><?php echo $value["Kode Matkul"]; ?></td>
                        <td><?php echo $value["Nama Matkul"]; ?></td>
                        <td><form method='get' action='lihatNilaiDosen.php'><button name='btnLihatNilai' value='<?php echo $value['Kode Matkul'] ?>'>List Nilai Mahasiswa</button></form></td>
                        </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
    }

    function menuDosen($active){
        ?> 
        <?php 
            $menu[0] = array("Awal","dashboard.php");
            $menu[1] = array( -1 => "Master Tugas",
                                0 => array(
                                    array("Lihat","lihatTugas.php"),
                                    array("Tambah","buatTugas.php"))
                                );
            $menu[2] = array("Laporan Mengajar","lihatMengajarDosen.php");
            foreach($menu as $data){
                if(!isset($data[-1])){
        ?>
                <li <?php 
                    if(!is_array($active)){
                        if($active == $data[0]) echo "class='active'";
                    }
                ?> ><a href="<?php echo $data[1];?>"><i class="fa fa-circle-o"></i><span><?php echo $data[0];?></a></span></li>
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
	// Modal Delete Punya Abraham
	function delete(){?>
        <form method="post">
            <div class="modal modal-danger fade" id="dialogDeleteUjian" role="dialog" aria-labelledby="modalDeleteUjian">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalDeleteMatkul">Hapus Ujian?</h4>
                    </div>
                    <div class="modal-body">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" id="btnKonfirmasiHapus" name="btnHapusUjian">Hapus</button>
                    </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            </form>
        <?php
    }
	// tabel ujian abraham
    function tabel_ujian(){
        global $db;
        $test = $db->executeGetArray("select * from header_ujian WHERE `NID` = '{$_SESSION['user']}'");
	?>

            <!-- TABLE: UJIAN -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Ujian</h3>
					<div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 200px;">
                            <a href="buatUjian.php"><button id="btnTambahSoal" class="btn btn-success" style="display:inline-block;height: 30px;padding: 5px 10px; margin-right:10px;"><span class="glyphicon glyphicon-plus"></span> Tambah</button></a>
                        </div>
                    </div>
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
							<th>Edit Header</th>
							<th>Edit Soal</th>
							<th>Delete Soal</th>
							<th>Lanjutkan Soal</th>
						  </tr>
						</thead>
						<tbody>
							<?php for ($i = 0; $i < count($test); $i++) {?>
						<tr>
							<td><?php echo $test[$i]["Nama"]; ?></td>
							<td><?php echo $test[$i]["Tanggal"]; ?></td>
							<td><?php echo $test[$i]["Waktu"]; ?></td>
							<td><?php echo $test[$i]["banyak"]; ?></td>
							<td>
								<form action="editHeader.php" method="POST"><button class="btn btn-block btn-success btn-xs" value="<?php echo $test[$i]["Kode"]?>" name="editH">Edit</button>
								</form>
							</td>
							<td>
								<form action="adminviewsoal.php" method="POST"><button class="btn btn-block btn-success btn-xs" value="<?php echo $test[$i]["Kode"]?>" name="kode" <?php echo BolehLihat($test[$i]["Kode"]);?>>Lihat</button>
								</form>
							</td>
							<td>
								<button type='button' class='btnHapusUjian btn btn-block btn-danger btn-xs' data-toggle='modal' data-target='#dialogDeleteUjian' value='<?php echo $test[$i]["Kode"]; ?>' >Hapus</button>
							</td>
							<td>
								<form action="DetailUjian.php" method="POST"><button class="btn btn-block btn-success btn-xs" value="<?php echo $test[$i]["Kode"]?>" <?php echo soalSelesai($test[$i]["Kode"]); ?> name="Lanjut">Lanjutkan</button>
							</form>
							</td>
							
								<!--<form action="HapusHSoal.php" method="POST"><button class="btn btn-block btn-danger btn-xs" data-toggle="modal" data-target="#myModal">Hapus</button></form></td>-->
							</tr>
						<?php
							}
						?>
						</tbody>
					</table>
                </div>
            </div>
	<?php
	delete();
    }
	
    function dashboardDosen(){
		$_SESSION['kode'] = "";
		$_SESSION['page']="";
		$_SESSION['judul']="";
		global $db;
		// Trigger delete - Abraham
		if(isset($_POST["btnHapusUjian"])){
			$kode=$_POST['btnHapusUjian'];
			// Hapus dari Detail
			$db->executeNonQuery("DELETE FROM `detail_ujian` WHERE `detail_ujian`.`Kode` = '$kode'");
			//Hapus dari Header
			$db->executeNonQuery("DELETE FROM `header_ujian` WHERE `header_ujian`.`Kode` = '$kode'");
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
        <!-- Optionally, you can add Slimscroll and FastClick plugins.
        Both of these plugins are recommended to enhance the
        user experience. Slimscroll is required when using the
        fixed layout. -->
        <!--Data Tables-->
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
                Dashboard
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- TABLE: UJIAN -->
            <?php tabel_ujian(); ?>
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