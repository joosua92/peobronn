<?php
class Input extends CI_Controller {
	
	public function register() {
		$this->load->model("main_model");
		
		$data = array(
			'eesnimi' => $this->input->post('eesnimi'),
			'perenimi' => $this->input->post('perenimi'),
			'email' => $this->input->post('email'),
			'telefon' => $this->input->post('telefon'),
			'salasõna' => $this->input->post('salasõna')
		);
		// TODO: form validation
		
		//$this->main_model->register($data);
		
		$returnData = new stdClass();
		$returnData->alertType = 'success';
		$returnData->message = 'Registreerumine õnnestus. <a href=' . base_url() . 'sisene>Sisene</a>';
		
		echo json_encode($returnData);
	}
	
	public function login() {
		echo 'Login request received';
	}
}