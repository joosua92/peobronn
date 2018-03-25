<?php
class Pages extends CI_Controller {
	
	
	private function loadPage($page, $data) {
		if (!file_exists(APPPATH.'views/pages/' . $page . '.php')) {
			show_404();
		}
		
		$this->load->view('templates/header', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer', $data);
	}
	
	public function avaleht() {
		$data['title'] = "Mängumaailm";
		$this->loadPage("avaleht", $data);
	}
	
	public function mangud() {
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
		$data['title'] = "Broneerimine - Mängumaailm";
		$this->loadPage("broneerimine", $data);
	}
	
	public function sisene() {
		$data['title'] = "Sisene - Mängumaailm";
		$this->loadPage("sisene", $data);
	}
	
	public function registreeru() {
		$data['title'] = "Registreeru - Mängumaailm";
		$this->loadPage("registreeru", $data);
	}
	
	public function profiil() {
		$data['title'] = "Profiil - Mängumaailm";
		$this->loadPage("profiil", $data);
	}
	
	public function valjund() {
		$data['title'] = "Olete välja logitud - Mängumaailm";
		$this->loadPage("valjund", $data);
	}
}
