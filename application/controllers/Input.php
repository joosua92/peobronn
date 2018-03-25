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
				'required' => 'Emaili väli peab olema täidetud',
				'valid_email' => 'Ebasobiv email',
				'is_unique' => 'Sisestatud email on juba kasutusel'
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
		}
		else
		{
			// Validation läks läbi
			$this->load->model("main_model");
			$data = array(
				'eesnimi' => $this->input->post('eesnimi'),
				'perenimi' => $this->input->post('perenimi'),
				'email' => $this->input->post('email'),
				'salasõna' => password_hash($this->input->post('salasõna'), PASSWORD_BCRYPT),
				'liik' => 'TAVALINE'
			);
			$this->main_model->insert_user($data);
			
			$returnData->alertType = 'success';
			$returnData->message = 'Registreerumine õnnestus. <a href=' . base_url() . 'sisene>Sisene</a>';
		}
		
		echo json_encode($returnData);
	}
	
	
	public function login() {
		
		$this->form_validation->set_rules('email', 'Email', 'required', array('required' => 'Palun sisesta email'));
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
				$returnData->message = 'Sellise emailiga kasutajat ei ole';
				echo json_encode($returnData);
				return;
			}
			$account = $results[0];
			if ($account->liik != 'TAVALINE') {
				$returnData->alertType = 'danger';
				if ($account->liik != 'TAVALINE') {
					$returnData->message = 'Selle emailiga kasutajaga peab sisse logima läbi Google';
				}
				else {
					$returnData->message = 'Selle emailiga kasutajaga peab sisse logima ID-kaardiga';
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
				$_SESSION['email'] = $account->email;
				$_SESSION['eesnimi'] = $account->eesnimi;
				$_SESSION['perenimi'] = $account->perenimi;
				$returnData->redirect = "profiil";
				echo json_encode($returnData);
				return;
			}
		}
	}
	
	public function logout() {
		session_unset();
		$returnData = new stdClass();
		$returnData->redirect = "valjund";
		echo json_encode($returnData);
	}
	
	/*public function google() {
		$this->form_validation->set_rules('email', 'Email', 'is_unique[kasutaja.email]', 'Teie email on juba kasutusel, logige sellega sisse või looge uus kasutaja');
		
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
		}
		else
		{
			// Validation läks läbi
			$this->load->model("main_model");
			$data = array(
				'eesnimi' => $this->input->post('eesnimi'),
				'perenimi' => $this->input->post('perenimi'),
				'email' => $this->input->post('email'),
				'salasõna' => '',
				'liik' => 'GOOGLE'
			);
			$this->main_model->insert_user($data);
			
			$returnData->alertType = 'success';
			$returnData->message = 'Registreerumine õnnestus.';
		}
		
		echo json_encode($returnData);
	}*/
}