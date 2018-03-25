<?php
class Main_model extends CI_Model {
	
	public function insert_user($data) {
		$eesnimi = $this->db->escape($data['eesnimi']);
		$perenimi = $this->db->escape($data['perenimi']);
		$email = $this->db->escape($data['email']);
		$salasõna = $this->db->escape($data['salasõna']);
		$liik = $this->db->escape($data['liik']);
		
		$query = "CALL sisesta_kasutaja(" . $email . ", " . $eesnimi . ", " . $perenimi . ", " . $liik . ", " . $salasõna . ");";
		$this->db->query($query);
	}
	
	public function get_user($email) {
		$email = $this->db->escape($email);
		$kasutajadQuery = "SELECT * FROM view_kasutaja WHERE email=" . $email . ";";
		$returnData = $this->db->query($kasutajadQuery);
		return $returnData->result();
	}
}