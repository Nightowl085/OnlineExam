<?php
    $modulTidakDiperlukan = ['2.loginCheck.php','dashboardMhs.php','dashboardMhs.php'];
    include_once("module/module.php");
    if($_SESSION['user'] != "admin") header("Location: 404");

    $pesan = ""; $pesanError = "";

    if(isset($_POST["btnTambahMatkul"])){
        $query = "INSERT INTO `mata kuliah` VALUES(NULL,'{$_POST['txtNamaMatkul']}',TRUE)";
        $db->executeNonQuery($query);
        $pesan = "Mata kuliah {$_POST['txtNamaMatkul']} berhasil ditambahkan";
    }

    function tableMataKuliah(){
        global $db;
        $data = $db->executeGetArray("SELECT * FROM `mata kuliah` WHERE STATUS = TRUE");
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
                            <th></th>
                            <th></th>
                            <th></th>
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
                            <td>{$db->executeGetScalar("SELECT COUNT(*) FROM MENGAJAR WHERE `Kode Matkul` = '{$value[0]}'")}</td>
                            <td><form method='get' action='#formLihatPengajar'><button class='btn btn-default btn-block btn-sm' value='{$value[0]}' name='btnLihatPengajar'>Lihat Pengajar</button></form></td>
                            <td><form method='get' action='#dialogUpdate' method='get' action='#dialogUpdateMatkul'><button class='btn btn-info btn-block btn-sm' value='{$value[0]}' name='btnUpdateMatkul'>Update</button></form></td>
                            <td><button type='button' class='btn btn-danger btn-block btn-sm' data-toggle='modal' data-target='#dialogDeleteMatkul' value='{$value[0]}' name='btnHapusMatkul'>Hapus</button></td>
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
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
<?php
        deleteMataKuliah();
    }

    // Trigger untuk update nama mata kuliah
    if(isset($_POST['btnUpdateMatkul'])){
        $namaLama = $db->executeGetScalar("SELECT `nama matkul` from `Mata Kuliah` WHERE `kode matkul` = '{$_POST['txtIdUpdateMatkul']}'");
        $pesan = "Berhasil melakukan update mata kuliah dari $namaLama menjadi '{$_POST['txtNamaUpdateMatkul']}'";
        $Query = "UPDATE `Mata Kuliah` SET `Nama Matkul` = '{$_POST['txtNamaUpdateMatkul']}' WHERE `Kode Matkul` = '{$_POST['txtIdUpdateMatkul']}'";
        $db->executeNonQuery($Query);
    }

    function updateMataKuliah(){
        global $db;
        if(isset($_GET['btnUpdateMatkul'])){
?>
        <div class="row" id="dialogUpdateMatkul">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                    <h3 class="box-title">Update Mata Kuliah <?php echo $db->executeGetScalar("SELECT `NAMA matkul` FROM `mata kuliah` WHERE `kode matkul` = {$_GET['btnUpdateMatkul']}"); ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <form id="formUpdateMatKul" class="form-horizontal" role="form" data-toggle="validator" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="txtNamaUpdateMatkul" class="col-sm-2 control-label">Nama Mata Kuliah</label>

                                <div class="col-sm-10">
                                    <input type="hidden" name="txtIdUpdateMatkul" value="<?php echo $_GET['btnUpdateMatkul']; ?>" >
                                    <input type="text" class="form-control" id="txtNamaUpdateMatkul" name="txtNamaUpdateMatkul" placeholder="Nama Mata Kuliah baru untuk '<?php echo 
                                    $db->executeGetScalar("SELECT `NAMA matkul` FROM `mata kuliah` WHERE `kode matkul` = {$_GET['btnUpdateMatkul']}"); ?>'" data-error="Data harus diisi!" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" name="btnUpdateMatkul" value="1" class="btn btn-success pull-right">Ubah</button>
                            <button type="button" class="btn btn-default" id="btnCancelUpdateMatkul">Cancel</button>
                        </div><!-- /.box-footer -->
                    </form>
                </div>
                <!-- /.box -->
            </div>
        </div>
<?php
        }
    }

    //Trigger Delete Mata Kuliah = Hide
    if(isset($_POST['txtIdDeleteMatkul'])){
        $Query = "UPDATE `Mata Kuliah` SET status = false WHERE `Kode Matkul` = '{$_POST['txtIdDeleteMatkul']}'";
        $db->executeNonQuery($Query);
        $pesan = "Berhasil Menghapus mata kuliah ". $db->executeGetScalar("SELECT `Nama Matkul` FROM `Mata Kuliah` WHERE `Kode Matkul` = '{$_POST['txtIdDeleteMatkul']}'");
    }

    function deleteMataKuliah(){
?>
            <form method="post">
            <div class="modal modal-danger fade" id="dialogDeleteMatkul" role="dialog" aria-labelledby="modalDeleteMatkul">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalDeleteMatkul">Hapus mata kuliah?</h4>
                    </div>
                    <div class="modal-body">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary">Hapus</button>
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
                                    <button id="btnTambahPengajar" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus"></span> Tambah</button>
                                    <button id="btnTutupPengajar" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span> Tutup</button>
                                </div>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered table-striped datatable" id="mengajar">
                            <thead>
                                <tr>
                                <th>Kode Dosen</th>
                                <th>Nama Dosen</th>
                                <th>Jumlah Mahasiswa</th>
                                <th></th>
                                <th></th>
                                </tr>
                            </thead>
                                <tbody>
                            <?php 
                                $data = $db->executeGetArray("SELECT d.NID,d.Nama, am.jumlah
                                    FROM
                                    (SELECT `Kode Matkul`,NID,COUNT(*) as jumlah FROM  onlineexam.mengambil GROUP BY `Kode Matkul`, NID) am,
                                    onlineexam.dosen d
                                    where d.NID = am.NID AND `kode matkul` = '{$_GET['btnLihatPengajar']}'
                                    UNION
                                    SELECT d.NID, d.Nama, 0 from onlineexam.mengajar me, onlineexam.dosen d WHERE `Kode Matkul`='{$_GET['btnLihatPengajar']}' AND D.NID = me.NID
                                    AND d.nid not in (select NID FROM onlineexam.mengambil am where am.`Kode Matkul` = '{$_GET['btnLihatPengajar']}')");
                                if($data != null){
                                    foreach($data as $value){
                                        echo "
                                        <tr>
                                        <td>{$value[0]}</td>
                                        <td>{$value[1]}</td>
                                        <td>{$value[2]}</td>
                                        <td><form class='formLihatMahasiswa' method='get' action='#dataMahasiswaMengambil'><input type='hidden' name='btnLihatPengajar' value='{$_GET['btnLihatPengajar']}'><button class='btn btn-default btn-block btn-sm' value='{$value[0]}' name='btnLihatMahasiswa'>Lihat Mahasiswa</button></form></td>
										<td><form method='post'><button class='btn btn-danger btn-block btn-sm' value='{$value[0]},{$_GET['btnLihatPengajar']}' name='btnHapusPengajar'>Hapus</button></form></td>
                                        </tr>";
                                    }
                                }
                                else{
                            ?>
                                        <tr>
                                            <td colspan="3" style="text-align:center">Tidak ada pengajar mata kuliah</td>
                                            <td style="display:none"></td>
                                            <td style="display:none"></td>
                                        </tr>
                            <?php
                                    //https://stackoverflow.com/a/34012324 -> Ngakali
                                }
                            ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                <th>Kode Dosen</th>
                                <th>Nama Dosen</th>
                                <th>Jumlah Mahasiswa</th>
                                <th></th>
                                <th></th>
                                </tr>
                            </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
<?php
            formTambahPengajar(); lihatMahasiswa();
        }
    }
	
    //Trigger Tambah Pengajar
    if(isset($_POST["btnTambahPengajar"])){
        $db->executeNonQuery("INSERT INTO `Mengajar` VALUES('{$_POST['kodeMatKul']}','{$_POST['txtIdDosen']}')");
        $pesan = "Berhasil menambah '{$db->executeGetScalar("SELECT `Nama` FROM DOSEN WHERE NID='{$_POST['txtIdDosen']}'")}' sebagai pengajar {$db->executeGetScalar("SELECT `Nama Matkul` FROM `mata kuliah` WHERE `Kode Matkul` = '{$_POST['kodeMatKul']}'")}";
    }
	// Trigger Hapus Pengajar mata Kuliah
	if(isset($_POST['btnHapusPengajar'])){
		$data = explode(",",$_POST['btnHapusPengajar']);
		$query = "DELETE FROM `mengajar` WHERE ";
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
        </div>
<?php
    }

    function lihatMahasiswa(){
        global $db;
        if(isset($_GET['btnLihatMahasiswa'])){
?> 
        <div class="row" id="dataMahasiswaMengambil">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Daftar Mahasiswa yang mengambil Mata Kuliah <?php
                            echo $db->executeGetScalar("SELECT `Nama Matkul` FROM `mata kuliah` where `Kode Matkul` = '{$_GET['btnLihatPengajar']}'");
                        ?></h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 200px;">
                                <button id="btnTambahMengambil" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus"></span> Tambah</button>
                                <form method="get" style="display:inline-block;" action="#formLihatPengajar">
                                    <input type="hidden" name="btnLihatPengajar" value="<?php echo $_GET['btnLihatPengajar']; ?>">
                                    <button id="btnTutupMengambil" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span> Tutup</button>
                                </form>
                            </div>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-striped datatable" id="mengambil">
                        <thead>
                            <tr>
                            <th>NRP</th>
                            <th>Nama Mahasiswa</th>
                            <th>Nilai</th>
                            <th>Aksi</th>
                            </tr>
                        </thead>
                            <tbody>
                        <?php 
                            $data = $db->executeGetArray("SELECT m.NRP, m.Nama, n.Nilai, am.`kode matkul`, am.NID
                            from onlineexam.mahasiswa m, onlineexam.mengambil am,(SELECT nrp,nilai
                            FROM onlineexam.nilai
                            where nid = '{$_GET['btnLihatMahasiswa']}' and `kode matkul` = '{$_GET['btnLihatPengajar']}'
                            union
                            select nrp, 0
                            from onlineexam.mengambil
                            where nid = '{$_GET['btnLihatMahasiswa']}' and `kode matkul` = '{$_GET['btnLihatPengajar']}' and nrp not in (SELECT nrp
                            FROM onlineexam.nilai
                            where nid = '{$_GET['btnLihatMahasiswa']}' and `kode matkul` = '{$_GET['btnLihatPengajar']}')) n
                            where am.NRP = m.NRP and am.`Kode Matkul`= '{$_GET['btnLihatPengajar']}' and am.NID = '{$_GET['btnLihatMahasiswa']}' and n.NRP = m.NRP;");
                            if($data != null){
                                foreach($data as $value){
                                    echo "
                                    <tr>
                                    <td>{$value[0]}</td>
                                    <td>{$value[1]}</td>
                                    <td>{$value[2]}</td>
                                    <td><form method='post'><button class='btn btn-danger btn-block btn-sm' value='{$value[0]},{$value[3]},{$value[4]}' name='btnHapusMhsAmbil'>Hapus</button></form></td>
                                    </tr>";
                                }
                            }
                            else{
                        ?>
                                    <tr><td colspan="4" style="text-align:center">Tidak ada mahasiswa mengambil mata kuliah</td><td style="display:none"> </td><td style="display:none"> </td><td style="display:none"> </td></tr>
                        <?php
                                //https://stackoverflow.com/a/34012324 -> Ngakali
                            }
                        ?>
                        </tbody>
                        <tfooter>
                            <tr>
                            <th>NRP</th>
                            <th>Nama Mahasiswa</th>
                            <th>Nilai</th>
                            <th>Aksi</th>
                            </tr>
                        </tfooter>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
<?php formMahasiswaMengambil();
        }
    }

    if(isset($_POST['btnHapusMhsAmbil'])){
        $data = explode(",",$_POST['btnHapusMhsAmbil']);
        $query = "DELETE FROM `Mengambil` WHERE NID = '{$data[2]}' AND NRP = {$data[0]} and `Kode Matkul` = {$data[1]} AND NID = '{$data[2]}'";
        // ekesekusi hapus dari mata kuliah bersangkutan
        if($db->executeGetScalar("SELECT COUNT(*) FROM NILAI WHERE NID = '{$data[2]}' AND NRP = {$data[0]} and `Kode Matkul` = {$data[1]} AND NID = '{$data[2]}'") > 0){
            $db->executeNonQuery("DELETE FROM `Nilai` WHERE NID = '{$data[2]}' AND NRP = {$data[0]} and `Kode Matkul` = {$data[1]} AND NID = '{$data[2]}'");
        }
        if($db->executeNonQuery($query) == false){
            $pesan = "Berhasil menghapus mahasiswa dari mengambil mata kuliah";
        }
    }

    //Triger Tambah Pengambil
    if(isset($_POST['btnTambahMengambil'])){
        if($db->executeGetScalar("SELECT COUNT(*) FROM Mahasiswa WHERE NRP = '{$_POST['txtNrpMhs']}'") > 0 ){
            $Query = "INSERT INTO mengambil VALUES('{$_POST['txtNrpMhs']}','{$_POST['kodeDosen']}','{$_POST['kodeMatKul']}')";
            $db->executeNonQuery($Query);
            $pesan = "Berhasil menambahkan ".$db->executeGetScalar("SELECT NAMA FROM Mahasiswa WHERE NRP = '{$_POST['txtNrpMhs']}'");
        }
        else{

        }
    }

    function formMahasiswaMengambil(){
        global $db;
?>
        <div class="row" id="dialogTambahPengambil">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tambah Mahasiswa Mengambil Mata Kuliah <?php echo $db->executeGetScalar("SELECT `Nama Matkul` FROM `mata kuliah` WHERE `Kode Matkul` = '{$_GET['btnLihatPengajar']}'"); ?></h3>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <form id="formTambahMatKul" class="form-horizontal" role="form" data-toggle="validator" method="post" >
                        <div class="box-body">
                            <div class="form-group">
                                <label for="txtNamaMatkul" class="col-sm-2 control-label">Mata Kuliah</label>

                                <div class="col-sm-10" style="display: table;    vertical-align: middle;height: 30px;">
                                    <span style="display: table-cell;vertical-align: middle;" ><?php echo $db->executeGetScalar("SELECT `Nama Matkul` FROM `mata kuliah` WHERE `Kode Matkul` = '{$_GET['btnLihatPengajar']}'"); ?></span>
                                    <input type="hidden" name="kodeMatKul" value="<?php echo $_GET['btnLihatPengajar']; ?>">
                                    <input type="hidden" name="kodeDosen" value="<?php echo $_GET['btnLihatMahasiswa']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtNrpMhs" class="col-sm-2 control-label">NRP</label>

                                <div class="col-sm-10">
                                    <input type="text" name="txtNrpMhs" id="txtNrpMhs" class="form-control" required data-error="NRP Mahasiswa harus dimasukan!">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" name="btnTambahMengambil" value="1" class="btn btn-success pull-right">Tambahkan</button>
                            <button type="button" class="btn btn-default" id="btnCancelTambahPengambil">Cancel</button>
                        </div><!-- /.box-footer -->
                    </form>
                </div>
            </div> 
        </div>
<?php
    }
?>
<!DOCTYPE html>
<html>
<head>
    <?php mainStyle(); dataTableStyle(); mainScript(); validatorScript(); dataTableScript(); ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="asset/js/oe.min.js"></script>
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
                                <p>Administrator - Avengers</p>
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
        <h1>Master Mata Kuliah</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php pesan(); pesanError();?>
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
        <?php updateMataKuliah(); lihatPengajar();?>
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