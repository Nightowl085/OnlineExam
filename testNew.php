<?php include_once("module/1.database.php"); include_once("module/asset.php"); assetLoad();?>
<script>
    $(function(){
        // Ambil dari DB, Tabel baru namanya header_jawaban
        var jamTest = "<?php 
            $waktu = $db->executeGetScalar("SELECT waktu FROM header_ujian WHERE KODE = '{$_GET['kodeUjian']}'");
            $mulai = $db->executeGetScalar("SELECT UNIX_TIMESTAMP(`tanggal`)+($waktu*60)-UNIX_TIMESTAMP(NOW()) FROM header_ujian WHERE KODE = {$_GET['kodeUjian']}");
            date_default_timezone_set('GMT'); // agar mulai dari nol
            echo date("H:i:s",$mulai);
            if($mulai < 0 ) header("Location: 404");
         ?>";
        
        String.prototype.padLeft = function (length, character) { 
            return new Array(length - this.length + 1).join(character || '0') + this;
        }

        var timerUjian = setInterval(function() {
            var jam = jamTest.substr(0,2);
            var menit = jamTest.substr(3,2);
            var detik = jamTest.substr(6,2);

            if(detik-1 >= 0){
                detik = parseInt(detik-1);
            }
            else{
                if(menit-1 >= 0){
                    menit = parseInt(menit) - 1;
                    detik = 59;
                }
                else{
                    if(jam-1>=0){
                        jam = parseInt(jam) - 1;
                        menit = 59; detik = 59;
                    }
                    else{
						window.location = "http://google.com";
                        clearTimeout(timerUjian);
                    }
                }
            }
            jam = jam.toString().padLeft(2,'0');
            menit = menit.toString().padLeft(2,'0');
            detik = detik.toString().padLeft(2,'0');
            jamTest = jam+":"+menit+":"+detik;
            $("#jamUjian").text(jamTest);
        }, 1000);
    });
</script>
<p id="jamUjian">
	
</p>