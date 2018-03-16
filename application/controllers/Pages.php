<?php
class Pages extends CI_Controller {
	
	
	public function loadPage($page, $data) {
		if (!file_exists(APPPATH.'views/pages/' . $page . '.php')) {
			show_404();
		}
		
		$this->load->helper('url');
		
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
}
