<?php
class Pages extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		if (!isset($_SESSION['session_active'])) {
			$_SESSION['session_active'] = true;
			$this->log_visit();
		}
	}
	
	private function loadPage($page, $data) {
		if (!file_exists(APPPATH.'views/pages/' . $page . '.php')) {
			show_404();
		}
		$this->load->view('templates/header', $data);
        $this->load->view('pages/'.$page, $data);
		$this->load->view('templates/footer', $data);
	}
	
	private function log_visit() {
		$this->load->model('database_model');
		$visitData = array();
		$visitData['ip'] = $_SERVER['REMOTE_ADDR'];
		$browser = $this->getBrowser();
		$visitData['browser_name'] = $browser['browser_name'];
		$visitData['browser_version'] = $browser['browser_version'];
		// FIX THIS PART
		if ($visitData['browser_name'] === false) {
			return;
		}
		// Get ip data through online API
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://api.ipdata.co/' . $_SERVER['REMOTE_ADDR']);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
		$ipDataJSON = curl_exec($ch);
		curl_close($ch);
		$ipData = json_decode($ipDataJSON);
		if (property_exists('ipData', 'country_name')) {
			$visitData['country'] = $ipData->country_name;
		} else {
			return;
		}
		$this->database_model->insert_visit($visitData);
	}
	
	private function getBrowser() {
		// Uses online API to get browser data from HTTP_USER_AGENT
		if (isset($_SERVER['HTTP_USER_AGENT'])) {
			$userAgent = $_SERVER['HTTP_USER_AGENT'];
			$ch = curl_init();
			$url = 'http://www.useragentstring.com/?uas=' . urlencode($userAgent) . '&getText=all'; 
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
			$response = curl_exec($ch);
			curl_close($ch);
			$response = str_replace(";", "&", $response);
			parse_str($response, $agentData);
			// FIX THIS PART
			$returnData = array();
			if (isset($agentData['agent_name'])) {
				$returnData = array(
					'browser_name' => $agentData['agent_name'],
					'browser_version' => $agentData['agent_version']
				);
			} else {
				$returnData = array(
					'browser_name' => false,
					'browser_version' => false
				);
			}
			return $returnData;
		} else {
			return array('browser_name' => 'unknown', 'browser_version' => 'unknown');
		}
	}
	
	public function avaleht() {
		$data['title'] = "Mängumaailm";
		$this->loadPage("avaleht", $data);
	}
	
	public function mangud() {
		$this->load->model("database_model");
		$data['games'] = $this->database_model->get_games(8);	
		$data['title'] = "Mängud & elamused - Mängumaailm";
		$this->loadPage("mangud", $data);
	}
	
	public function hinnakiri() {
		$data['title'] = "Hinnakiri - Mängumaailm";
		$this->loadPage("hinnakiri", $data);
	}
	
	public function kkk() {
		$data['title'] = "Korduma kippuvad küsimused - Mängumaailm";
		$this->loadPage("kkk", $data);
	}
	
	public function broneerimine() {
		if (!isset($_SESSION['email'])) {
			$this->session->set_flashdata('alertType', 'info');
			$this->session->set_flashdata('alertMessage', 'Broneerimiseks on vaja sisse logida.');
			$this->session->set_flashdata('redirect', 'broneerimine');
			redirect('sisene');
		}
		else {
			$data['title'] = "Broneerimine - Mängumaailm";
			$this->loadPage("broneerimine", $data);
		}
	}
	
	public function sisene() {
		if (isset($_SESSION['email'])) {
			redirect('profiil');
		}
		else {
			$data['title'] = "Sisene - Mängumaailm";
			$this->loadPage("sisene", $data);
		}
		if (isset($_SESSION['redirect'])) {
			$this->session->set_flashdata('redirect', $_SESSION['redirect']);
		}
	}
	
	public function registreeru() {
		if (isset($_SESSION['email'])) {
			redirect('profiil');
		}
		else {
			$data['title'] = "Registreeru - Mängumaailm";
			$this->loadPage("registreeru", $data);
		}
	}
	
	public function profiil() {
		if (!isset($_SESSION['email'])) {
			$this->session->set_flashdata('alertType', 'info');
			$this->session->set_flashdata('alertMessage', 'Profiili nägemiseks on vaja sisse logida.');
			redirect('sisene');
		}
		else {
			$this->load->model("database_model");
			$this->load->model("files_model");
			$user_picture_path = $this->files_model->user_picture_path($_SESSION['user_id']);
			if ($user_picture_path === false) {
				$user_picture_path = base_url() . 'assets/images/placeholder_profile_picture.png';
			}
			$data['profile_picture_path'] = $user_picture_path;
			$data['reservations'] = $this->database_model->get_reservations($_SESSION['email']);
			$data['title'] = "Profiil - Mängumaailm";
			$this->loadPage("profiil", $data);
		}
	}
	
	public function valjund() {
		if (isset($_SESSION['email'])) {
			redirect('profiil');
		}
		else {
			$data['title'] = "Olete välja logitud - Mängumaailm";
			$this->loadPage("valjund", $data);
		}
	}
	
	public function statistika() {
		$data['title'] = "Külastajate statistika - Mängumaailm";
		$this->loadPage("statistika", $data);
	}
}
