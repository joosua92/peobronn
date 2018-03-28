<?php
class Input extends CI_Controller {
	
	public function register() {
		$this->form_validation->set_rules('eesnimi', 'Eesnimi', 'required|regex_match[/^[a-zA-ZõäöüÕÄÖÜ -]+$/]',
			array(
				'required' => 'Eesnime väli peab olema täidetud',
				'regex_match' => 'Ebasobiv eesnimi'
			)
		);
		$this->form_validation->set_rules('perenimi', 'Perenimi', 'required|regex_match[/^[a-zA-ZõäöüÕÄÖÜ]+$/]',
			array(
				'required' => 'Perenime väli peab olema täidetud',
				'regex_match' => 'Ebasobiv perenimi'
			)
		);
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[kasutaja.email]', 
			array(
				'required' => 'E-maili väli peab olema täidetud',
				'valid_email' => 'Ebasobiv e-mail',
				'is_unique' => 'Sisestatud e-mail on juba kasutusel'
			)
		);
		$this->form_validation->set_rules('salasõna', 'Salasõna', 'required|min_length[8]',
			array(
				'required' => 'Salasõna peab olema täidetud',
				'min_length' => 'Salasõna pikkus peab olema vähemalt 8'
			)
		);
		$this->form_validation->set_rules('korda-salasõna', 'Korda salasõna', 'required|matches[salasõna]',
			array(
				'required' => 'Korda oma salasõna uuesti',
				'matches' => 'Salasõnad ei kattu'
			)
		);
		
		$returnData = new stdClass();
		
		if ($this->form_validation->run() == FALSE) {
			// Form validation ei läinud läbi
			$errorsStr = trim(validation_errors());
			$errors = explode("\n", $errorsStr);
			$returnMessage = "";
			foreach ($errors as $error) {
				$returnMessage .= $error;
			}
			$returnData->alertType = 'danger';
			$returnData->message = $returnMessage;
		}
		else {
			// Validation läks läbi
			$this->load->model("main_model");
			$this->load->model("email_model");
			$data = array(
				'eesnimi' => $this->input->post('eesnimi'),
				'perenimi' => $this->input->post('perenimi'),
				'email' => $this->input->post('email'),
				'salasõna' => password_hash($this->input->post('salasõna'), PASSWORD_BCRYPT),
				'liik' => 'TAVALINE'
			);
			$this->main_model->insert_user($data);
			$this->email_model->send_registration_email($this->input->post('email'));
			
			$returnData->alertType = 'success';
			$returnData->message = 'Registreerumine õnnestus. <a href=' . base_url() . 'sisene>Sisene</a>';
		}
		
		echo json_encode($returnData);
	}
	
	
	public function login() {
		$this->form_validation->set_rules('email', 'Email', 'required', array('required' => 'Palun sisesta e-mail'));
		$this->form_validation->set_rules('salasõna', 'Salasõna', 'required', array('required' => 'Salasõna väli peab olema täidetud'));
		$returnData = new stdClass();
		
		if ($this->form_validation->run() == FALSE)
		{
			// Form validation ei läinud läbi
			$errorsStr = trim(validation_errors());
			$errors = explode("\n", $errorsStr);
			$returnMessage = "";
			foreach ($errors as $error) {
				$returnMessage .= $error;
			}
			$returnData->alertType = 'danger';
			$returnData->message = $returnMessage;
			echo json_encode($returnData);
			return;
		}
		else
		{
			// Validation läks läbi
			$email = $this->input->post('email');
			$salasõna = $this->input->post('salasõna');
			$this->load->model("main_model");
			$results = $this->main_model->get_user($email);
			if (count($results) < 1) {
				$returnData->alertType = 'danger';
				$returnData->message = 'Sellise e-mailiga kasutajat ei ole';
				echo json_encode($returnData);
				return;
			}
			$account = $results[0];
			if ($account->liik != 'TAVALINE') {
				$returnData->alertType = 'danger';
				if ($account->liik != 'TAVALINE') {
					$returnData->message = 'Selle e-mailiga kasutajaga peab sisse logima läbi Google';
				}
				else {
					$returnData->message = 'Selle e-mailiga kasutajaga peab sisse logima ID-kaardiga';
				}
				echo json_encode($returnData);
				return;
			}
			if (!password_verify($salasõna, $account->salasõna)) {
				$returnData->alertType = 'danger';
				$returnData->message = 'Vale salasõna';
				echo json_encode($returnData);
				return;
			}
			else {
				$_SESSION['id'] = $account->id;
				$_SESSION['email'] = $account->email;
				$_SESSION['eesnimi'] = $account->eesnimi;
				$_SESSION['perenimi'] = $account->perenimi;
				$_SESSION['liik'] = $account->liik;
				$returnData->redirect = "profiil";
				echo json_encode($returnData);
				return;
			}
		}
	}
	
	public function logout() {
		$returnData = new stdClass();
		if (isset($_SESSION['liik']) && $_SESSION['liik'] == 'GOOGLE') {
			$returnData->logoutStatus = 'google';
			$returnData->redirect = 'valjund';
		}
		else {
			$returnData->logoutStatus = 'normal';
			$returnData->redirect = 'valjund';
		}
		session_unset();
		echo json_encode($returnData);
	}
	
	public function google() {
		$this->load->model("main_model");
		$returnData = new stdClass();
		
		if (isset($_SESSION['email']) && $_SESSION['email'] == $this->input->post('email')) {
			// Juba sisse logitud
			$returnData->loginStatus = 'already in';
			$returnData->redirect = 'profiil';
			echo json_encode($returnData);
			return;
		}
		
		$result = $this->main_model->get_user($this->input->post('email'));
		if (count($result) > 0) {
			$account = $result[0];
			if ($account->liik == 'GOOGLE') {
				// Kasutaja olemas
				$_SESSION['id'] = $account->id;
				$_SESSION['email'] = $account->email;
				$_SESSION['eesnimi'] = $account->eesnimi;
				$_SESSION['perenimi'] = $account->perenimi;
				$_SESSION['liik'] = $account->liik;
				$returnData->loginStatus = 'already in';
				$returnData->redirect = 'profiil';
			}
			else {
				// Selle e-mailiga kasutaja juba olemas, aga pole GOOGLE tüüpi
				$returnData->loginStatus = 'õfail';
				$returnData->alertType = 'danger';
				$returnData->message = 'Selle e-mailiga kasutaja juba eksisteerib';
			}
		}
		else {
			// Kasutaja pole varem lehel sisenenud, pannakse andmed andmebaasi
			$data = array(
				'eesnimi' => $this->input->post('eesnimi'),
				'perenimi' => $this->input->post('perenimi'),
				'email' => $this->input->post('email'),
				'salasõna' => '',
				'liik' => 'GOOGLE'
			);
			$this->main_model->insert_user($data);
			$_SESSION['id'] = ($this->main_model->get_user($this->input->post('email')))[0]->id;
			$_SESSION['email'] = $this->input->post('email');
			$_SESSION['eesnimi'] = $this->input->post('eesnimi');
			$_SESSION['perenimi'] = $this->input->post('perenimi');
			$_SESSION['liik'] = 'GOOGLE';
			$returnData->loginStatus = "success";
			$returnData->redirect = "profiil";
		}
		
		echo json_encode($returnData);
	}
	
	public function reserv() {
		$returnData = new stdClass();
		$this->load->model("main_model");
		if (!isset($_SESSION['email'])) {
			// Ei tohiks siia tegelt jõuda
			$returnData->alertType = 'danger';
			$returnData->message = 'Broneerimiseks logige sisee';
			echo json_encode($returnData);
			return;
		}
		
		$this->form_validation->set_rules('kuupäev', 'Kuupäev', 'regex_match[/^\d\d\/\d\d\/\d\d\d\d$/]',
			array(
				'regex_match' => 'Ebasobiv kuupäeva formaat'
			)
		);
		$this->form_validation->set_rules('kellaaeg', 'Kellaaeg', 'required|regex_match[/^\d\d:\d\d - \d\d:\d\d$/]',
			array(
				'required' => 'Valige sobiv kellaaeg',
				'regex_match' => 'Ebasobiv kellaaja formaat'
			)
		);
		$this->form_validation->set_rules('pakett', 'Pakett', 'required|regex_match[/^Pakett [12]$/]',
			array(
				'required' => 'Valige sobiv pakett',
				'regex_match' => 'Ebasobiv paketi formaat'
			)
		);
		
		if ($this->form_validation->run() == FALSE) {
			// Form validation ei läinud läbi
			$errorsStr = trim(validation_errors());
			$errors = explode("\n", $errorsStr);
			$returnMessage = "";
			foreach ($errors as $error) {
				$returnMessage .= $error;
			}
			$returnData->alertType = 'danger';
			$returnData->message = $returnMessage;
		}
		else {
			// Validation läks läbi
			$kuupäevInput = $this->input->post('kuupäev');
			$kuupäevTükid = explode('/', $kuupäevInput);
			$kuupäevStr = $kuupäevTükid[2] . '-' . $kuupäevTükid[1] . '-' . $kuupäevTükid[0];
			
			$data = array(
				'email' => $_SESSION['email'],
				'pakett' => $this->input->post('pakett'),
				'kellaaeg' => $this->input->post('kellaaeg'),
				'kuupäev' => $kuupäevStr
			);
			
			$returnData->alertType = 'success';
			$returnData->message = 'Broneering kinnitatud. Broneeringuid saate näha profiililehelt.';
		}
		echo json_encode($returnData);
	}
}