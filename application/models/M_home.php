<?php
	class M_home extends CI_Model
	{
		function add_genesis($data) {
			$db2 = $this->load->database('database_kedua', TRUE);
			$db3 = $this->load->database('database_ketiga', TRUE);
			
			$this->db->insert("block", $data);
			$db2->insert("block", $data);
			$db3->insert("block", $data);
		}

		function add_genesis_satu($data) {
			$this->db->insert("block", $data);
		}

		function add_genesis_dua($data) {
			$db2 = $this->load->database('database_kedua', TRUE);
			$db2->insert("block", $data);
		}

		function add_genesis_tiga($data) {
			$db3 = $this->load->database('database_ketiga', TRUE);
			$db3->insert("block", $data);
		}

		function check_database_kesatu() {
			$data = $this->db->query("SELECT * FROM block");
    		return $data->result_array();
		}

		function check_database_kedua() {
			$db2 = $this->load->database('database_kedua', TRUE);
			$data = $db2->query("SELECT * FROM block");
    		return $data->result_array();
		}

		function check_database_ketiga() {
			$db3 = $this->load->database('database_ketiga', TRUE);
			$data = $db3->query("SELECT * FROM block");
    		return $data->result_array();
		}

		function check_data_pool() {
			$data = $this->db->query("SELECT * FROM data_pool ORDER BY timestamp_data DESC");
    		return $data->result_array();
		}

		function get_data() {
			$data = $this->db->query("SELECT * FROM block");
    		return $data->result_array();
		}

		function get_data_database_kedua() {
			$db2 = $this->load->database('database_kedua', TRUE);
			$data = $db2->query("SELECT * FROM block");
    		return $data->result_array();
		}

		function get_data_database_ketiga() {
			$db3 = $this->load->database('database_ketiga', TRUE);
			$data = $db3->query("SELECT * FROM block");
    		return $data->result_array();
		}

		function get_last_hash() {
			$data = $this->db->query("SELECT hash FROM block ORDER BY timestamp_data DESC");
    		return $data->result_array();
		}

		function get_result($hash,$id) {
			$data = $this->db->query("SELECT * FROM block WHERE id = '$id' AND hash = '$hash'");
    		return $data->result_array();
		}

		function add_block($data) {
			$db2 = $this->load->database('database_kedua', TRUE);
			$db3 = $this->load->database('database_ketiga', TRUE);

			$this->db->insert("block", $data);
			$db2->insert("block", $data);
			$db3->insert("block", $data);
		}

		function add_block_db_pertama($data) {
			$this->db->insert("block", $data);
		}

		function add_block_db_kedua($data) {
			$db2 = $this->load->database('database_kedua', TRUE);
			$db2->insert("block", $data);
		}

		function add_block_db_ketiga($data) {
			$db3 = $this->load->database('database_ketiga', TRUE);
			$db3->insert("block", $data);
		}

		function add_data_pool($data) {
			$this->db->insert("data_pool", $data);
		}

		function update_status($data,$id){
			$this->db->where('id', $id);
			$this->db->update('block', $data);
		}

		function update_status_db_kedua($data,$id){
			$db2 = $this->load->database('database_kedua', TRUE);
			$db2->where('id', $id);
			$db2->update('block', $data);
		}

		function update_status_db_ketiga($data,$id){
			$db3 = $this->load->database('database_ketiga', TRUE);
			$db3->where('id', $id);
			$db3->update('block', $data);
		}

		function delete_data_pool($id_data) {
			$this->db->where('id_data_pool', $id_data);
			$this->db->delete("data_pool");
		}

		function delete_truncate_db_pertama(){
			$this->db->truncate('block'); 
		}

		function delete_truncate_db_kedua(){
			$db2 = $this->load->database('database_kedua', TRUE);
			$db2->truncate('block'); 
		}

		function delete_truncate_db_ketiga(){
			$db3 = $this->load->database('database_ketiga', TRUE);
			$db3->truncate('block'); 
		}
	}

?>