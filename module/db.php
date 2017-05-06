<?php
	
	class db {
		private $server,$user,$pass,$db;
		
		/* 
			@parameter 	$server as string = lokasi server yang mau ditembak
						$user as string = username -> don't ask anymore, username sql server
						$pass as string = password -> don't ask anymore, pass dari username 
						$db as string = nama dbnya yang dipakai
			@comment 	See refences here man! http://php.net/manual/en/class.mysqli.php, ada mysqli->close() atau mysqli::close() atau bisa mysqli_close(), mending yang turunan langsung aja ::close() atau ->close(), -> seperti memanggil .function() di java. 
		*/
		public function __construct($server,$user,$pass,$db){ // http://stackoverflow.com/a/5598872 + http://php.net/manual/en/language.oop5.references.php
			$this->server = $server; $this->user = $user; $this->pass = $pass; $this->db = $db;
		}
		
		/* 	
			@return		object mysqli, lihat dokumentasinya disini http://php.net/manual/en/class.mysqli.php
		*/
		private function connection(){
			$db = new mysqli($this->server,$this->user,$this->pass,$this->db); // Object based, biar ga perlu terlalu banyak function
			if(!$db){
				if(isset($db->error_list)) echo "<pre>".var_dump($db->error_list)."</pre>"; // Pakai http://php.net/manual/en/mysqli.error-list.php vs http://php.net/manual/en/mysqli.error.php siapa tahu errornya banyak.
			}
			return $db;
		}
		
		/**
		 *  @brief Dapatkan select dalam bentuk array number yang dalamnya array assoc
		 *  
		 *  @param [in] $query Query yang mau dilempar ke DB
		 *  @return Return Array number yang isinya array assoc
		 *  
		 *  @details Silahkan lihat sendiri dibawah
		 */
		public function executeGetArray($query){ 
			$sql = $this->connection(); // Inisasi Koneksi
			if($sql->connect_errno == 0){
				$safeQuery = $sql->escape_string($query); // Always do this so there would be no problem anyway.
				$result = $sql->query($safeQuery); // Hasil Query
				if(count($sql->error_list) > 0) {
					echo "<pre>"; echo var_dump($sql->error_list); echo "</pre>"; //not print_r because we need the datatype, always var_dump! no print_r! http://stackoverflow.com/questions/3406171/php-var-dump-vs-print-r
				}
				else{
					$i = 0; // Data rownya di start dari nol saja
					while($row = $result->fetch_array()){
						$data[$i] = $row; // Ini sama dengan otomatis inisaiasi Variable $data
						$i++;
					}
					if(isset($data)) return $data;
				}
			}
			else{
				echo "Ada Masalah dengan Koneksi ke DB, silahkan cek kembali server anda atau hubungi developer: $sql->connect_errno $sql->connect_error";
			}
			$sql->close(); $sql = NULL; // Close and Dispose to free ram, faster than unset, see http://stackoverflow.com/a/13558543 and http://stackoverflow.com/a/20294378
		}
		
		/**
		 *  @brief Untuk Execute non Query kaya di Oracle, selain select pakai ini, update dan delete atau function, terserah.
		 *  
		 *  @param [in] $query Description for $query
		 *  @return returnya kalau execute berhasil bakalan kasih false, jadi tinggal di $insert = $db->executeNonQuery("code insert"); if($insert != false) echo $insert;, biar nge dump errornya.
		 *  
		 *  @details Ga ada detail lain, :V
		 */
		public function executeNonQuery($query){
			$sql = $this->connection();
			if($sql->connect_errno == 0){
				$safeQuery = $sql->escape_string($query); // Always do this so there would be no problem anyway.
				$result = $sql->query($safeQuery); // Hasil Query
				if(count($sql->error_list) > 0) {
					return "<pre>"; echo var_dump($sql->error_list); echo "</pre>"; //not print_r because we need the datatype, always var_dump! no print_r! http://stackoverflow.com/questions/3406171/php-var-dump-vs-print-r
				}
				else{
					return false;
				}
			}
			else{
				echo "Ada Masalah dengan Koneksi ke DB, silahkan cek kembali server anda atau hubungi developer: $sql->connect_errno $sql->connect_error";
			}
			$sql->close(); $sql = NULL; // Close and Dispose to free ram, faster than unset, see http://stackoverflow.com/a/13558543 and http://stackoverflow.com/a/20294378
		}
		/**
		 *  @brief Untuk Execute Scalar, kaya count, atau sejenis
		 *  
		 *  @param [in] $query Masukin query yang dimau, misal select count(*) from detail_ujian
		 *  @return return-nya string normal sesuai hasil 1 aja
		 *  
		 *  @details Kalau bingung lihat di executeGetArray
		 */
		public function executeGetScalar($query){
			return $this->executeGetArray($query)[0][0];
		}
	}
	
	$db = new db("localhost","root","","onlineexam");
	
	echo $db->executeGetScalar("select count(*) from detail_ujian");
?>