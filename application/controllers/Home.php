<?php
	class Home extends CI_Controller
	{
		public function __construct() {
	        parent::__construct();
	    }

		function index()
		{
			// Check tiap node apakah sudah generate data genesis
			$check_1 = $this->M_home->check_database_kesatu();
			$check_2 = $this->M_home->check_database_kedua();
			$check_3 = $this->M_home->check_database_ketiga();

			// Check apakah semua node sudah generate data genesis atau belum
			if((empty($check_1)) and (empty($check_2)) and (empty($check_3))){
				
				// Membuat data genesis
				date_default_timezone_set("Asia/Bangkok");

				$data_genesis = "Genesis";
				$timestamp_data = date("Y-m-d H:i:s");
				$prevhash = "Genesis";
				$salt = "lock_block";
				$status_hash = false;
				$nonce = 0;

				// Mencari nonce
				while ($status_hash == false){
					
					// Pola untuk mencari hash (minning)
					$temp = $data_genesis.$timestamp_data.$prevhash.$nonce.$salt;
					$hash = hash ( "sha256", $temp);
					
					// Membuat pola nonce dengan 4 karakter awal = '0'
					if (($hash[0] == '0') and ($hash[1] == '0') and ($hash[2] == '0') and ($hash[3] == '0')){
						$status_hash = true;
					}
					else{
						$nonce = $nonce + 1;
					}
				}

				// Setelah nonce ketemu, generate data genesis ke semua node
				$data = array(
	                "data" => $data_genesis,
	                "timestamp_data" => $timestamp_data,
	                "hash" => $hash,
	                "prevhash" => $prevhash,
	                "nonce" => $nonce,
	            );

				$this->M_home->add_genesis($data);
			}
			// Apabila salah satu node sudah generate data genesis
			else {

				// Jika Node ke 1 belum generate data genesis
				if (empty($check_1)){
					
					// Apabila node ke 2 sudah generate data genesis
					if (!empty($check_2)){
						$timestamp_data = $check_2[0]['timestamp_data'];
						$data_isi = $check_2[0]['data'];
						$hash = $check_2[0]['hash'];
						$prevhash = $check_2[0]['prevhash'];
						$nonce = $check_2[0]['nonce'];

						$data = array(
			                "data" => $data_isi,
			                "timestamp_data" => $timestamp_data,
			                "hash" => $hash,
			                "prevhash" => $prevhash,
			                "nonce" => $nonce,
			            );

						$this->M_home->add_genesis_satu($data);
					}

					// Apabila node ke 3 sudah generate data genesis
					else if (!empty($check_3)){
						$timestamp_data = $check_3[0]['timestamp_data'];
						$data_isi = $check_3[0]['data'];
						$hash = $check_3[0]['hash'];
						$prevhash = $check_3[0]['prevhash'];
						$nonce = $check_3[0]['nonce'];

						$data = array(
			                "data" => $data_isi,
			                "timestamp_data" => $timestamp_data,
			                "hash" => $hash,
			                "prevhash" => $prevhash,
			                "nonce" => $nonce,
			            );

						$this->M_home->add_genesis_satu($data);
					}
				}

				// Jika node ke 2 belum generate data genesis
				if (empty($check_2)){
					
					// Apabila node ke 1 sudah generate data genesis
					if (!empty($check_1)){
						$timestamp_data = $check_1[0]['timestamp_data'];
						$data_isi = $check_1[0]['data'];
						$hash = $check_1[0]['hash'];
						$prevhash = $check_1[0]['prevhash'];
						$nonce = $check_1[0]['nonce'];

						$data = array(
			                "data" => $data_isi,
			                "timestamp_data" => $timestamp_data,
			                "hash" => $hash,
			                "prevhash" => $prevhash,
			                "nonce" => $nonce,
			            );

						$this->M_home->add_genesis_dua($data);
					}

					// Apabila node ke 3 sudah generate data genesis
					else if (!empty($check_3)){
						$timestamp_data = $check_3[0]['timestamp_data'];
						$data_isi = $check_3[0]['data'];
						$hash = $check_3[0]['hash'];
						$prevhash = $check_3[0]['prevhash'];
						$nonce = $check_3[0]['nonce'];

						$data = array(
			                "data" => $data_isi,
			                "timestamp_data" => $timestamp_data,
			                "hash" => $hash,
			                "prevhash" => $prevhash,
			                "nonce" => $nonce,
			            );

						$this->M_home->add_genesis_dua($data);
					}
				}

				// Jika node ke 3 belum generate data genesis
				if (empty($check_3)){
					
					// Apabila node ke 1 sudah generate data genesis
					if (!empty($check_1)){
						$timestamp_data = $check_1[0]['timestamp_data'];
						$data_isi = $check_1[0]['data'];
						$hash = $check_1[0]['hash'];
						$prevhash = $check_1[0]['prevhash'];
						$nonce = $check_1[0]['nonce'];

						$data = array(
			                "data" => $data_isi,
			                "timestamp_data" => $timestamp_data,
			                "hash" => $hash,
			                "prevhash" => $prevhash,
			                "nonce" => $nonce,
			            );

						$this->M_home->add_genesis_tiga($data);
					}

					// Apabila node ke 2 sudah generate data genesis
					else if (!empty($check_2)){
						$timestamp_data = $check_2[0]['timestamp_data'];
						$data_isi = $check_2[0]['data'];
						$hash = $check_2[0]['hash'];
						$prevhash = $check_2[0]['prevhash'];
						$nonce = $check_2[0]['nonce'];

						$data = array(
			                "data" => $data_isi,
			                "timestamp_data" => $timestamp_data,
			                "hash" => $hash,
			                "prevhash" => $prevhash,
			                "nonce" => $nonce,
			            );

						$this->M_home->add_genesis_tiga($data);
					}
				}	
			}

			$data['block'] = $this->M_home->get_data();

			$this->load->view('V_home',$data);
		}

		function Tambah_block()
		{
			// Menampilkan UI tambah block ke node
			$this->load->view('V_tambah_block');
		}

		function Tambah_data_block()
		{
			// Menyimpan data input ke data pool
			date_default_timezone_set("Asia/Bangkok");

			$data_temp = $this->input->post('data');
			$timestamp_temp = date("Y-m-d H:i:s");
			$data = array(
	                "data" => $data_temp,
	                "timestamp_data" => $timestamp_temp,
	            ); 
			$this->M_home->add_data_pool($data);

			// Mengecek apakah data pool kosong atau tidak
			$status_data_pool = false;
			while ($status_data_pool == false){
				$data_proses = $this->M_home->check_data_pool();
				
				// Jika data dalam data pool kosong
				if(empty($data_proses)){
					$status_data_pool = true;
				}

				// Jika terdapat data dalam data pool
				else{

					// Menyimpan data di data pool ke variabel lokal
					$id_data = $data_proses[0]['id_data_pool'];
					$data = $data_proses[0]['data'];
					$timestamp_data = $data_proses[0]['timestamp_data'];
					$salt = "lock_block";
					$status_hash = false;
					$nonce = 0;

					// Mencari hash data terakhir dalam block
					$data_prev_hash = $this->M_home->get_last_hash();
					$prevhash = $data_prev_hash[0]['hash'];

					// Mencari nonce
					while ($status_hash == false){
						
						// Pola mencari hash (minning)
						$temp = $data.$timestamp_data.$prevhash.$nonce.$salt;
						$hash = hash ( "sha256", $temp);
						
						// Membuat pola nonce dengan 4 karakter awal = '0'
						if (($hash[0] == '0') and ($hash[1] == '0') and ($hash[2] == '0') and ($hash[3] == '0')){
							$status_hash = true;
						}
						else{
							$nonce = $nonce + 1;
						}
					}

					// Menyimpan data ke dalam block dan menghapus data yang bersangkutan dalam data pool 
					$data_block = array(
		                "data" => $data,
		                "timestamp_data" => $timestamp_data,
		                "hash" => $hash,
		                "prevhash" => $prevhash,
		                "nonce" => $nonce,
		            ); 

					$this->M_home->add_block($data_block);
					$this->M_home->delete_data_pool($id_data);
				}
			}

			redirect('Home');
		}

		function Check()
		{
			// Cek node pertama
			$p = $this->M_home->get_data();
			$n = count($p);

			for ($i = 0; $i < $n; $i++) {
				
				$id = $p[$i]['id'];
				if($id > 1){
					$data = $p[$i]['data'];
					$timestamp_data = $p[$i]['timestamp_data'];
					$prevhash = $p[$i]['prevhash'];
					$nonce = $p[$i]['nonce'];
					$salt = "lock_block";

					// Cek apakah prev hash data sekrang sama dengan hash data sebelumnya
					// Apabila tidak, maka status data tersebut diganti "Tidak Valid"
					if($prevhash != $p[$i-1]['hash']){
						$status = "Tidak Valid";
						$data_block = array(
			                "status" => $status
			            );
			            
			            $this->M_home->update_status($data_block,$id);
					}

					// Membuat pola hash untuk pengecekan, sebut saja temp_hash
					$temp = $data.$timestamp_data.$prevhash.$nonce.$salt;
					$hash = hash ("sha256", $temp);

					$result = $this->M_home->get_result($hash,$id);

					// Cek apakah hasil temp_hash sama dengan hash data tersebut
					// Apabila tidak, maka status data tersebut diganti "Tidak Valid"
					if(empty($result)){
						$status = "Tidak Valid";
						$data_block = array(
			                "status" => $status
			            );
			            $this->M_home->update_status($data_block,$id);
					}
				}
			}

			// Cek node kedua
			$p = $this->M_home->get_data_database_kedua();
			$n = count($p);

			for ($i = 0; $i < $n; $i++) {
				
				$id = $p[$i]['id'];
				if($id > 1){
					$data = $p[$i]['data'];
					$timestamp_data = $p[$i]['timestamp_data'];
					$prevhash = $p[$i]['prevhash'];
					$nonce = $p[$i]['nonce'];
					$salt = "lock_block";

					// Cek apakah prev hash data sekrang sama dengan hash data sebelumnya
					// Apabila tidak, maka status data tersebut diganti "Tidak Valid"
					if($prevhash != $p[$i-1]['hash']){
						$status = "Tidak Valid";
						$data_block = array(
			                "status" => $status
			            );
			            
			            $this->M_home->update_status_db_kedua($data_block,$id);
					}

					// Membuat pola hash untuk pengecekan, sebut saja temp_hash
					$temp = $data.$timestamp_data.$prevhash.$nonce.$salt;
					$hash = hash ("sha256", $temp);

					$result = $this->M_home->get_result($hash,$id);

					// Cek apakah hasil temp_hash sama dengan hash data tersebut
					// Apabila tidak, maka status data tersebut diganti "Tidak Valid"
					if(empty($result)){
						$status = "Tidak Valid";
						$data_block = array(
			                "status" => $status
			            );
			            $this->M_home->update_status_db_kedua($data_block,$id);
					}
				}
			}

			// Cek node ketiga
			$p = $this->M_home->get_data_database_ketiga();
			$n = count($p);

			for ($i = 0; $i < $n; $i++) {
				
				$id = $p[$i]['id'];
				if($id > 1){
					$data = $p[$i]['data'];
					$timestamp_data = $p[$i]['timestamp_data'];
					$prevhash = $p[$i]['prevhash'];
					$nonce = $p[$i]['nonce'];
					$salt = "lock_block";

					// Cek apakah prev hash data sekrang sama dengan hash data sebelumnya
					// Apabila tidak, maka status data tersebut diganti "Tidak Valid"
					if($prevhash != $p[$i-1]['hash']){
						$status = "Tidak Valid";
						$data_block = array(
			                "status" => $status
			            );
			            
			            $this->M_home->update_status_db_ketiga($data_block,$id);
					}

					// Membuat pola hash untuk pengecekan, sebut saja temp_hash
					$temp = $data.$timestamp_data.$prevhash.$nonce.$salt;
					$hash = hash ("sha256", $temp);

					$result = $this->M_home->get_result($hash,$id);

					// Cek apakah hasil temp_hash sama dengan hash data tersebut
					// Apabila tidak, maka status data tersebut diganti "Tidak Valid"
					if(empty($result)){
						$status = "Tidak Valid";
						$data_block = array(
			                "status" => $status
			            );
			            $this->M_home->update_status_db_ketiga($data_block,$id);
					}
				}
			}

			redirect('Home');
		}

		function Restore()
		{
			$status_db_1 = true;
			$status_db_2 = true;
			$status_db_3 = true;

			$data_database_pertama = $this->M_home->get_data();
			$data_database_kedua = $this->M_home->get_data_database_kedua();
			$data_database_ketiga = $this->M_home->get_data_database_ketiga();

			// Mengecek apakah semua data pada node pertama ada yang tidak valid
			foreach ($data_database_pertama as $p) {
				if($p['status'] == "Tidak Valid"){
					$status_db_1 = false;
				}
			}

			// Mengecek apakah semua data pada node kedua ada yang tidak valid
			foreach ($data_database_kedua as $p) {
				if($p['status'] == "Tidak Valid"){
					$status_db_2 = false;
				}
			}

			// Mengecek apakah semua data pada node ketiga ada yang tidak valid
			foreach ($data_database_ketiga as $p) {
				if($p['status'] == "Tidak Valid"){
					$status_db_3 = false;
				}
			}

			// Apabila node pertama terdapat data yang tidak valid
			if ($status_db_1 == false){
				
				// Mereset semua data pada node pertama 
				$this->M_home->delete_truncate_db_pertama();
				
				// Apabila data pada node kedua valid semua
				if ($status_db_2 == true){
					
					// Menyalin semua data di node kedua ke node pertama
					foreach ($data_database_kedua as $p) {
						$timestamp_data = $p['timestamp_data'];
						$data_isi = $p['data'];
						$hash = $p['hash'];
						$prevhash = $p['prevhash'];
						$nonce = $p['nonce'];

						$data_block = array(
			                "data" => $data_isi,
			                "timestamp_data" => $timestamp_data,
			                "hash" => $hash,
			                "prevhash" => $prevhash,
			                "nonce" => $nonce,
			            );

			            $this->M_home->add_block_db_pertama($data_block);
					}
				}

				// Apabila data pada node ketiga valid semua
				else if ($status_db_3 == true){
					
					// Menyalin semua data di node ketiga ke node pertama
					foreach ($data_database_ketiga as $p) {
						$timestamp_data = $p['timestamp_data'];
						$data_isi = $p['data'];
						$hash = $p['hash'];
						$prevhash = $p['prevhash'];
						$nonce = $p['nonce'];

						$data_block = array(
			                "data" => $data_isi,
			                "timestamp_data" => $timestamp_data,
			                "hash" => $hash,
			                "prevhash" => $prevhash,
			                "nonce" => $nonce,
			            );

			            $this->M_home->add_block_db_pertama($data_block);
					}
				}
			}

			// Apabila node kedua terdapat data yang tidak valid
			if ($status_db_2 == false){
				
				// Mereset semua data pada node kedua 
				$this->M_home->delete_truncate_db_kedua();
				
				// Apabila data pada node pertama valid semua
				if ($status_db_1 == true){
					
					// Menyalin semua data di node pertama ke node kedua
					foreach ($data_database_pertama as $p) {
						$timestamp_data = $p['timestamp_data'];
						$data_isi = $p['data'];
						$hash = $p['hash'];
						$prevhash = $p['prevhash'];
						$nonce = $p['nonce'];

						$data_block = array(
			                "data" => $data_isi,
			                "timestamp_data" => $timestamp_data,
			                "hash" => $hash,
			                "prevhash" => $prevhash,
			                "nonce" => $nonce,
			            );

			            $this->M_home->add_block_db_kedua($data_block);
					}
				}
				
				// Apabila data pada node ketiga valid semua
				else if ($status_db_3 == true){
					
					// Menyalin semua data di node ketiga ke node kedua
					foreach ($data_database_ketiga as $p) {
						$timestamp_data = $p['timestamp_data'];
						$data_isi = $p['data'];
						$hash = $p['hash'];
						$prevhash = $p['prevhash'];
						$nonce = $p['nonce'];

						$data_block = array(
			                "data" => $data_isi,
			                "timestamp_data" => $timestamp_data,
			                "hash" => $hash,
			                "prevhash" => $prevhash,
			                "nonce" => $nonce,
			            );

			            $this->M_home->add_block_db_kedua($data_block);
					}
				}
			}

			// Apabila node ketiga terdapat data yang tidak valid
			if ($status_db_3 == false){
				
				// Mereset semua data pada node ketiga 
				$this->M_home->delete_truncate_db_ketiga();
				
				// Apabila data pada node pertama valid semua
				if ($status_db_1 == true){
					
					// Menyalin semua data di node pertama ke node ketiga
					foreach ($data_database_pertama as $p) {
						$timestamp_data = $p['timestamp_data'];
						$data_isi = $p['data'];
						$hash = $p['hash'];
						$prevhash = $p['prevhash'];
						$nonce = $p['nonce'];

						$data_block = array(
			                "data" => $data_isi,
			                "timestamp_data" => $timestamp_data,
			                "hash" => $hash,
			                "prevhash" => $prevhash,
			                "nonce" => $nonce,
			            );

			            $this->M_home->add_block_db_ketiga($data_block);
					}
				}
				
				// Apabila data pada node kedua valid semua
				else if ($status_db_2 == true){
					
					// Menyalin semua data di node kedua ke node ketiga
					foreach ($data_database_kedua as $p) {
						$timestamp_data = $p['timestamp_data'];
						$data_isi = $p['data'];
						$hash = $p['hash'];
						$prevhash = $p['prevhash'];
						$nonce = $p['nonce'];

						$data_block = array(
			                "data" => $data_isi,
			                "timestamp_data" => $timestamp_data,
			                "hash" => $hash,
			                "prevhash" => $prevhash,
			                "nonce" => $nonce,
			            );

			            $this->M_home->add_block_db_ketiga($data_block);
					}
				}
			}
			redirect('Home');
		}
	}
?>	