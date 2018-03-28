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
		if (!isset($_SESSION['email'])) {
			$this->session->set_flashdata('alertType', 'info');
			$this->session->set_flashdata('alertMessage', 'Broneerimiseks on vaja sisse logida.');
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
}
