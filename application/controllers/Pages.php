<?php
class Pages extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		if (!isset($_SESSION['session_active'])) {
			$_SESSION['session_active'] = true;
			$_SESSION['lang'] = 'et';
			$this->log_visit();
			// Put all reservations into session
			$this->load->model('database_model');
			$_SESSION['existing_reservations'] = $this->database_model->get_all_reservations();
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
		$data['pageDescription'] = 'Mängumaailm on üks Eesti moodsamaid ja suurimaid virtuaalreaalsuskeskusi.';
		$data['keywords'] = "mängumaailm,avaleht,tutvustus,kirjeldus,virtuaalreaalsus";
		$this->loadPage("avaleht", $data);
	}
	
	public function mangud() {
		$this->load->model("database_model");
		$data['games'] = $this->database_model->get_games(8);	
		$data['title'] = "Mängud & elamused - Mängumaailm";
		$data['pageDescription'] = 'Mängumaailma poolt pakutavad VR mängud.';
		$data['keywords'] = "mängumaailm,virtuaalreaalsus,mängud";
		$this->loadPage("mangud", $data);
	}
	
	public function hinnakiri() {
		$data['title'] = "Hinnakiri - Mängumaailm";
		$data['pageDescription'] = 'Mängumaailma teenuste hinnakiri.';
		$data['keywords'] = "mängumaailm,hinnakiri,teenused";
		$this->loadPage("hinnakiri", $data);
	}
	
	public function kkk() {
		$data['title'] = "Korduma kippuvad küsimused - Mängumaailm";
		$data['pageDescription'] = 'Korduma kippuvad küsimused seoses Mänumaailmaga.';
		$data['keywords'] = "mängumaailm,kkk,küsimused";
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
			$data['pageDescription'] = 'Broneeri endale üritus Mängumaailmas';
			$data['keywords'] = "mängumaailm,broneeri,ajad";
			$this->loadPage("broneerimine", $data);
		}
	}
	
	public function sisene() {
		if (isset($_SESSION['email'])) {
			redirect('profiil');
		}
		else {
			$data['title'] = "Sisene - Mängumaailm";
			$data['pageDescription'] = 'Sisene Mängumaailma, et broneerida endale külastuse aeg või hallata profiili.';
			$data['keywords'] = "mängumaailm,sisene,login";
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
			$data['pageDescription'] = 'Loo endale Mängumaailma kasutaja.';
			$data['keywords'] = "mängumaailm,registreerumine";
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
			$data['pageDescription'] = 'Halda oma Mängumaailma profiili.';
			$data['keywords'] = "mängumaailm,profiil,kasutaja,broneeringud";
			$this->loadPage("profiil", $data);
		}
	}
	
	public function valjund() {
		if (isset($_SESSION['email'])) {
			redirect('profiil');
		}
		else {
			$data['title'] = "Olete välja logitud - Mängumaailm";
			$data['pageDescription'] = 'Olete Mängumaailmast välja logitud.';
			$data['keywords'] = "mängumaailm,väljund";
			$this->loadPage("valjund", $data);
		}
	}
	
	public function statistika() {
		$data['title'] = "Külastajate statistika - Mängumaailm";
		$data['pageDescription'] = 'Mängumaailma veebilehe külastajate statistika.';
		$data['keywords'] = "mängumaailm,statistika,külastajate statistika";
		$this->loadPage("statistika", $data);
	}
	
	public function kontakt() {
		$data['title']= 'Kontakt - Mängumaailm';
		$data['pageDescription'] = 'Mängumaailma kontaktinfo ja keskuse plaan.';
		$data['keywords'] = "mängumaailm,kontakt,plaan";
		$this->loadPage("kontakt", $data);
	}
}
