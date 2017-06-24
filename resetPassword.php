<?php
    session_start();
    if(isset($_SESSION['user'])) header("Location: 404");
    include_once("module/1.database.php");
    $pesan = ""; $pesanError = "";
    function mailSend($tujuan){
        global $db,$pesan, $pesanError;
        if(strpos($tujuan,"D") !== FALSE){
            $nama = $db->executeGetScalar("SELECT `NAMA` FROM `DOSEN` WHERE NID = '$tujuan'");
            $email = $db->executeGetScalar("SELECT `Email` FROM `DOSEN` WHERE NID = '$tujuan'");
        }
        else{
            $nama = $db->executeGetScalar("SELECT `NAMA` FROM `MAHASISWA` WHERE NRP = $tujuan");
            $email = $db->executeGetScalar("SELECT `Email` FROM `MAHASISWA` WHERE NRP = $tujuan");
        }

        $code = $db->executeGetScalar("SELECT `kode` FROM `reset_password` WHERE USERID = '$tujuan' AND STATUS = FALSE");

        include_once("module/mailer/PHPMailerAutoload.php");
        $mail = new PHPMailer;

        //$mail->SMTPDebug = 3;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.mail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'online.exam@mail.com';                 // SMTP username
        $mail->Password = '0nl1n33x4m@STTS';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->setFrom('online.exam@mail.com', 'Online Exam');
        $mail->addAddress("$email", "$nama");     // Add a recipient
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'Online Exam Reset Password';
        $mail->Body    = "Halo, sepertinya anda telah meminta password baru. Silahkan kunjungi http://localhost/oe/resetPassword.php?reqPassCode=$code untuk mereset password anda. Terima kasih!";
        $mail->AltBody = "Halo, sepertinya anda telah meminta password baru. Silahkan kunjungi http://localhost/oe/resetPassword.php?reqPassCode=$code untuk mereset password anda. Terima kasih!";

        if(!$mail->send()) {
            $pesanError = 'Message could not be sent Mailer Error: ' . $mail->ErrorInfo;
        } else {
            $pesan = "Request Reset Password sudah dikirim! Silahkan Cek E-Mail anda!";
        }

    }

    function RandomString(){ //https://stackoverflow.com/questions/4356289/php-random-string-generator with change
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 10; $i++) {
            $randstring .= $characters[rand(0, strlen($characters)-1)];
        }
        return $randstring;
    }

    function codeReset(){
        global $db;
        $code = "";
        do{
            $code = RandomString();
            $query = "SELECT COUNT(*) FROM `reset_password` WHERE kode = '".RandomString()."'";
        }
        while($db->executeGetScalar($query) > 0);
        return $code;
    }

    if(isset($_POST['btnReqPass'])) {
        if(substr($_POST['userid'],0,1) == "D"){
            $query = "SELECT COUNT(*) FROM DOSEN WHERE NID = '{$_POST['userid']}'";
            if($db->executeGetScalar($query) > 0){
                $query = "SELECT COUNT(*) FROM `reset_password` WHERE status = false and USERID = '{$_POST['userid']}'";
                if($db->executeGetScalar($query) > 0) {
                    $query = "UPDATE `reset_password` SET status = true WHERE status = false and userid = '{$_POST['userid']}'";
                    $db->executeNonQuery($query);
                }
                // Token di Update, Buat Token baru, biar ga ada security Holes
                $query = "INSERT INTO onlineexam.reset_password VALUES('".codeReset()."','{$_POST['userid']}',current_timestamp,DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 2 DAY),FALSE);";
                $db->executeNonQuery($query);   
                mailSend($_POST['userid']);
            }
            else{
                $pesanError = "Maaf Bapak/Ibu, User ID anda tidak terdaftar!";
            }
        }
        else{
            $query = "SELECT COUNT(*) FROM MAHASISWA WHERE NRP = '{$_POST['userid']}'";
            if($db->executeGetScalar($query) > 0){
                $query = "SELECT COUNT(*) FROM `reset_password` WHERE status = false and USERID = '{$_POST['userid']}'";
                if($db->executeGetScalar($query) > 0) {
                    $query = "UPDATE `reset_password` SET status = true WHERE status = false and userid = '{$_POST['userid']}'";
                    $db->executeNonQuery($query);
                }
                // Token di Update, Sehingga ga ada security Holes
                $query = "INSERT INTO onlineexam.reset_password VALUES('".codeReset()."','{$_POST['userid']}',current_timestamp,DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 2 DAY),FALSE);";
                $db->executeNonQuery($query);
                mailSend($_POST['userid']);
            }
            else{
                $pesanError = "Maaf User ID anda tidak terdaftar!";
            }
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

    function pesan(){
        global $pesan;
        if($pesan != ""){
        ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-success box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Berhasil</h3>

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

    include_once("module/asset.php");
    assetLoad();
?><title>Reset Password</title> <?php
    if(isset($_POST['btnGenPass'])){
        $newPassword = password_hash($_POST['password'],PASSWORD_BCRYPT); 
        if(strpos($db->executeGetScalar("SELECT USERID From `reset_password` where kode = '{$_POST['reqKey']}'"),"D") !== FALSE){
            $Query = "UPDATE DOSEN SET PASSWORD = '$newPassword' WHERE NID = '".$db->executeGetScalar("SELECT USERID From `reset_password` where kode = '{$_POST['reqKey']}'")."'";
        }else{
            $Query = "UPDATE MAHASISWA SET PASSWORD = '$newPassword' WHERE NRP = {$db->executeGetScalar("SELECT USERID From `reset_password` where kode = '{$_POST['reqKey']}'")}";
        }
        $db->executeNonQuery($Query);
        $Query = "UPDATE `reset_password` SET STATUS = TRUE WHERE kode = '{$_POST['reqKey']}'";
        $db->executeNonQuery($Query);
        $pesan = "Password telah direset!";
    }

    if(isset($_GET['reqPassCode'])){
        if($db->executeGetScalar("SELECT COUNT(*) FROM `reset_password` where kode = '{$_GET['reqPassCode']}' and status = false") > 0){
?>
    <div class="content-wrapper" style="margin:0;">
    
    <!-- Main content -->
    <section class="content">
      <div class="error-page">
          <br><br><br><br><br><br>
          <?php pesanError(); pesan(); ?>
        <h2 style="margin-top:20px;" class="headline text-Yellow">🔑</h2>

        <div class="error-content">
            
          <h3><i class="fa fa-warning text-yellow"></i> Reset Password</h3>

          <p>
            Silahkan memasukan Password Baru anda.
            <form id="reqPassword" method="post" action="resetPassword.php">
                <input type="hidden" name="reqKey" value="<?php echo $_GET['reqPassCode']; ?>">
                <input type="password" class="form-control" maxlength="10" name='password' placeholder="Passsord Baru" Required><br>
                <button name="btnGenPass" class="btn btn-primary" value="1">Reset Password</button>
            </form>
          </p>

        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
    <!-- /.content -->
  </div>

<?php
        }
        else{
            header("Location: 404");
        }
?> 
    
<?php
    }
    else{
?>

<div class="content-wrapper" style="margin:0;">
    
    <!-- Main content -->
    <section class="content">
      <div class="error-page">
          <br><br><br><br><br><br>
          <?php pesanError(); pesan(); ?>
        <h2 style="margin-top:20px;" class="headline text-Yellow">🔑</h2>

        <div class="error-content">
            
          <h3><i class="fa fa-warning text-yellow"></i> Reset Password</h3>

          <p>
            Lupa password? Silahkan Masukan NRP/NID Anda. Kami akan mengirimkan E-Mail Reset Password kepada anda agar anda bisa mereset password anda
            <form id="reqPassword" method="post">
                <input type="text" class="form-control" maxlength="10" name='userid' placeholder="NRP/NID Anda"><br>
                <button name="btnReqPass" class="btn btn-primary" value="1">Reset Password</button>
            </form>
          </p>

        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
    <!-- /.content -->

<?php } ?>
  <!-- Bootstrap 3.3.6 -->
<script src="asset/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="asset/dist/js/app.min.js"></script>