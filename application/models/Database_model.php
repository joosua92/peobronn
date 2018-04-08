<?php
class Database_model extends CI_Model {
	
	public function insert_user($data) {
		$eesnimi = $this->db->escape($data['eesnimi']);
		$perenimi = $this->db->escape($data['perenimi']);
		$email = $this->db->escape($data['email']);
		$salasõna = $this->db->escape($data['salasõna']);
		$liik = $this->db->escape($data['liik']);
		
		$query = "CALL sisesta_kasutaja($email, $eesnimi, $perenimi, $liik, $salasõna);";
		$this->db->query($query);
	}
	
	public function get_user($email) {
		$email = $this->db->escape($email);
		$kasutajadQuery = "SELECT * FROM view_kasutaja WHERE email=$email;";
		$returnData = $this->db->query($kasutajadQuery);
		return $returnData->result();
	}
	
	public function insert_reservation($data) {
		$email = $this->db->escape($data['email']);
		$pakett = $this->db->escape($data['pakett']);
		$kellaaeg = $this->db->escape($data['kellaaeg']);
		$kuupäev = $this->db->escape($data['kuupäev']);
		
		$query = "CALL sisesta_broneering($email, $pakett, $kellaaeg, $kuupäev);";
		$this->db->query($query);
	}
	
	public function get_reservations($email) {
		$email = $this->db->escape($email);
		$reservationsQuery = "SELECT view_broneering.id AS id, kasutaja_id, pakett, kellaaeg, kuupäev, broneerimise_aeg " .
			"FROM view_broneering JOIN view_kasutaja ON view_broneering.kasutaja_id=view_kasutaja.id WHERE view_kasutaja.email=$email;";
		$returnData = $this->db->query($reservationsQuery);
		return $returnData->result();
	}
	
	public function get_reservation($kuupäev, $kellaaeg) {
		$kuupäev = $this->db->escape($kuupäev);
		$kellaaeg = $this->db->escape($kellaaeg);
		$reservationQuery = "SELECT * FROM view_broneering WHERE kuupäev=$kuupäev AND kellaaeg=$kellaaeg;";
		$returnData = $this->db->query($reservationQuery);
		return $returnData->result();
	}
	
	public function remove_reservation($reservation_id) {
		$reservation_id = $this->db->escape($reservation_id);
		$deleteQuery = "CALL kustuta_broneering($reservation_id );";
		$this->db->query($deleteQuery);
	}
	
	public function insert_visit($data) {
		$ip = $this->db->escape($data['ip']);
		$browser_name = $this->db->escape($data['browser_name']);
		$browser_version = $this->db->escape($data['browser_version']);
		$country = $this->db->escape($data['country']);
		$query = "CALL insert_visit($ip, $browser_name, $browser_version, $country);";
		$this->db->query($query);
	}
	
	public function get_visits() {
		$query = "SELECT * FROM view_visit;";
		$returnData = $this->db->query($query);
		return $returnData->result();
	}
	
	public function get_visit_countries() {
		$query = "SELECT * FROM view_visit_countries;";
		$returnData = $this->db->query($query);
		return $returnData->result();
	}
	
	public function get_visit_browsers() {
		$query = "SELECT * FROM view_visit_browsers;";
		$returnData = $this->db->query($query);
		return $returnData->result();
	}
	
	public function get_games($limit) {
		$query = "SELECT * FROM view_game ORDER BY id";
		if ($limit !== 'ALL') {
			$limit = $this->db->escape($limit);
			$query .= " LIMIT $limit";
		}
		$returnData = $this->db->query($query);
		return $returnData->result();
	}
}