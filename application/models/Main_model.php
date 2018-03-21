<?php
class Main_model extends CI_Model {
	
	public function register($data) {
		$this->db->insert('kasutaja', $data);
	}
}