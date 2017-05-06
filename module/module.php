<?php
	class module{
		public $module;
		public function __construct($modulTidakDiperlukan = array()){
			//Load Semua module, biar kodingnya bisa terpisah
			$modul = scandir(__DIR__); 
			/* 
				Menghilangkan .,.., dan module.php, karena error dan module.php tidak boleh memanggil dirinya sendiri 
				http://php.net/manual/en/function.array-diff.php
				http://stackoverflow.com/a/369608
			*/
			$modul = array_diff($modul,['.','..','module.php']);
			if(count($modulTidakDiperlukan) > 0) {
				$modul = array_diff($modul,$modulTidakDiperlukan);
			}
			$this->module = $modul;
		}
		
		public function load(){
			foreach($this->modul as $key => $value){
				include_once("$value"); // Di Include 1-1, semua module yang ada dipakai
			}
		}
	}
	
	/* 
		cara pakai kaya dibawah, kalau ada modul yang tidak dipakai tinggal dihapus aja pakai lempar array
		$module = new module();
		
		cara hapus modul
		$modul = new module(array("db.php"));
		
		var_dump($module->module); 
	*/
?>