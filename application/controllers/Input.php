<?php
class Input extends CI_Controller {
	
	public function register() {
		$ajax = isset($_POST['ajax']);
		$returnData = new stdClass();
		
		$this->form_validation->set_rules('eesnimi', 'Eesnimi', 'required|regex_match[/^[a-zA-ZõäöüÕÄÖÜ -]+$/]',
			array(
				'required' => 'Eesnime väli peab olema täidetud.',
				'regex_match' => 'Ebasobiv eesnimi.'
			)
		);
		$this->form_validation->set_rules('perenimi', 'Perenimi', 'required|regex_match[/^[a-zA-ZõäöüÕÄÖÜ]+$/]',
			array(
				'required' => 'Perenime väli peab olema täidetud.',
				'regex_match' => 'Ebasobiv perenimi.'
			)
		);
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[kasutaja.email]', 
			array(
				'required' => 'E-maili väli peab olema täidetud.',
				'valid_email' => 'Ebasobiv e-mail.',
				'is_unique' => 'Sisestatud e-mail on juba kasutusel.'
			)
		);
		$this->form_validation->set_rules('salasõna', 'Salasõna', 'required|min_length[8]',
			array(
				'required' => 'Salasõna peab olema täidetud.',
				'min_length' => 'Salasõna pikkus peab olema vähemalt 8.'
			)
		);
		$this->form_validation->set_rules('korda-salasõna', 'Korda salasõna', 'required|matches[salasõna]',
			array(
				'required' => 'Korda oma salasõna uuesti.',
				'matches' => 'Salasõnad ei kattu.'
			)
		);
		
		if ($this->form_validation->run() == FALSE) {
			// Form validation didn't pass
			$errorsStr = trim(validation_errors());
			$errors = explode("\n", $errorsStr);
			$returnMessage = "";
			foreach ($errors as $error) {
				$returnMessage .= $error;
			}
			$returnData->alertType = 'danger';
			$returnData->alertMessage = $returnMessage;
		}
		else {
			// Validation passed
			$this->load->model("database_model");
			$this->load->model("email_model");
			$data = array(
				'eesnimi' => $this->input->post('eesnimi'),
				'perenimi' => $this->input->post('perenimi'),
				'email' => $this->input->post('email'),
				'salasõna' => password_hash($this->input->post('salasõna'), PASSWORD_BCRYPT),
				'liik' => 'TAVALINE'
			);
			$this->database_model->insert_user($data);
			$this->email_model->send_registration_email($this->input->post('email'));
			
			$returnData->alertType = 'success';
			$returnData->alertMessage = 'Registreerumine õnnestus. <a href=' . base_url() . 'sisene>Sisene</a>.';
		}
		if ($ajax) {
			echo json_encode($returnData);
		}
		else {
			$this->session->set_flashdata('alertType', $returnData->alertType);
			$this->session->set_flashdata('alertMessage', $returnData->alertMessage);
			redirect('registreeru');
		}
	}	
	
	public function login() {
		$ajax = isset($_POST['ajax']);
		$returnData = new stdClass();
		
		$this->form_validation->set_rules('email', 'Email', 'required', array('required' => 'Palun sisesta e-mail.'));
		$this->form_validation->set_rules('salasõna', 'Salasõna', 'required', array('required' => 'Salasõna väli peab olema täidetud.'));
		
		if ($this->form_validation->run() == FALSE) {
			// Form validation didn't pass
			$errorsStr = trim(validation_errors());
			$errors = explode("\n", $errorsStr);
			$returnMessage = "";
			foreach ($errors as $error) {
				$returnMessage .= $error;
			}
			$returnData->alertType = 'danger';
			$returnData->alertMessage = $returnMessage;
		}
		else {
			// Validation passed
			$email = $this->input->post('email');
			$salasõna = $this->input->post('salasõna');
			$this->load->model("database_model");
			$results = $this->database_model->get_user($email);
			if (count($results) < 1) {
				$returnData->alertType = 'danger';
				$returnData->alertMessage = 'Sellise e-mailiga kasutajat ei ole.';
			}
			else {
				$account = $results[0];
				if ($account->liik != 'TAVALINE') {
					$returnData->alertType = 'danger';
					if ($account->liik != 'TAVALINE') {
						$returnData->alertMessage = 'Selle e-mailiga kasutajaga peab sisse logima läbi Google.';
					}
					else {
						$returnData->alertMessage = 'Selle e-mailiga kasutajaga peab sisse logima ID-kaardiga.';
					}
				}
				else if (!password_verify($salasõna, $account->salasõna)) {
					$returnData->alertType = 'danger';
					$returnData->alertMessage = 'Vale salasõna';
				}
				else {
					$_SESSION['user_id'] = $account->id;
					$_SESSION['email'] = $account->email;
					$_SESSION['eesnimi'] = $account->eesnimi;
					$_SESSION['perenimi'] = $account->perenimi;
					$_SESSION['liik'] = $account->liik;
					if (isset($_SESSION['redirect'])) {
						$returnData->redirect = $_SESSION['redirect'];
					} else {
						$returnData->redirect = "profiil";
					}
				}
			}
		}
		if ($ajax) {
			echo json_encode($returnData);
		}
		else {
			if (property_exists('returnData', 'alertType') && property_exists('returnData', 'alertMessage')) {
				$this->session->set_flashdata('alertType', $returnData->alertType);
				$this->session->set_flashdata('alertMessage', $returnData->alertMessage);
			}
			if (property_exists('returnData', 'redirect')) {
				redirect($returnData->redirect);
			} else {
				redirect('profiil');
			}
		}
	}
	
	public function logout() {
		$ajax = isset($_POST['ajax']);
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
		$_SESSION['session_active'] = true;
		if ($ajax) {
			echo json_encode($returnData);
		}
		else {
			redirect('valjund');
		}
	}
	
	public function google_login() {
		require_once APPPATH . 'third_party/google-api-php-client-2.2.1/vendor/autoload.php';
		$CLIENT_ID = '883720088699-for1689vnajr1birt2hqrnam9bs7j6ku.apps.googleusercontent.com';
		
		$returnData = new stdClass();
		$idToken = $this->input->post('idToken');
		$client = new Google_Client(['client_id' => $CLIENT_ID]);
		$payload = $client->verifyIdToken($idToken);
		if ($payload) {
			// Valid token, user authenticated
			$userEmail = $payload['email'];
			$userFirstName = $payload['given_name'];
			$userLastName = $payload['family_name'];
			
			$this->load->model("database_model");
			if (isset($_SESSION['email']) && $_SESSION['email'] == $userEmail) {
				// Already logged in
				$returnData->loginStatus = 'already in';
				$returnData->redirect = 'profiil';
				echo json_encode($returnData);
				return;
			}
			$result = $this->database_model->get_user($userEmail);
			if (count($result) > 0) {
				$account = $result[0];
				if ($account->liik == 'GOOGLE') {
					// User has previously logged in with the same account
					$_SESSION['user_id'] = $account->id;
					$_SESSION['email'] = $account->email;
					$_SESSION['eesnimi'] = $account->eesnimi;
					$_SESSION['perenimi'] = $account->perenimi;
					$_SESSION['liik'] = $account->liik;
					$returnData->loginStatus = 'already in';
					$returnData->redirect = 'profiil';
				}
				else {
					// User with this e-mail already exists, but is not of type GOOGLE
					$returnData->loginStatus = 'fail';
					$returnData->alertType = 'danger';
					$returnData->alertMessage = 'Selle e-mailiga kasutaja juba eksisteerib.';
				}
			}
			else {
				// User hasn't logged into the site before, data inserted into database
				$data = array(
					'eesnimi' => $userFirstName,
					'perenimi' => $userLastName,
					'email' => $userEmail,
					'salasõna' => '',
					'liik' => 'GOOGLE'
				);
				$this->database_model->insert_user($data);
				$_SESSION['user_id'] = ($this->database_model->get_user($userEmail))[0]->id;
				$_SESSION['email'] = $this->input->post('email');
				$_SESSION['eesnimi'] = $this->input->post('eesnimi');
				$_SESSION['perenimi'] = $this->input->post('perenimi');
				$_SESSION['liik'] = 'GOOGLE';
				$returnData->loginStatus = "success";
				$returnData->redirect = "profiil";
				
				$this->load->model("email_model");
				$this->email_model->send_registration_email($userEmail);
			}
		} else {
			// Invalid token
			$returnData->loginStatus = 'fail';
			$returnData->alertType = 'danger';
			$returnData->alertMessage = 'Kehtetud token';
		}
		
		echo json_encode($returnData);
	}
	
	public function reserv() {
		$ajax = isset($_POST['ajax']);
		$returnData = new stdClass();
		
		$this->load->model("database_model");
		if (!isset($_SESSION['email'])) {
			// Ei tohiks siia tegelt jõuda
			$returnData->alertType = 'danger';
			$returnData->alertMessage = 'Broneerimiseks logige sisse.';
		}
		else {
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
				$returnData->alertMessage = $returnMessage;
			}
			else {
				// Validation läks läbi
				$kuupäevInput = $this->input->post('kuupäev');
				$kuupäevTükid = explode('/', $kuupäevInput);
				$kuupäevStr = $kuupäevTükid[2] . '-' . $kuupäevTükid[1] . '-' . $kuupäevTükid[0];
				// Extra check for (date, time) combination uniqueness. User shouldn't be able to select such a combination.
				$sameReservations = $this->database_model->get_reservation($kuupäevStr, $this->input->post('kellaaeg'));
				if (count($sameReservations) > 0) {
					$returnData->alertType = 'danger';
					$returnData->alertMessage = 'See aeg on juba broneeritud.';
				}
				else {
					$data = array(
						'email' => $_SESSION['email'],
						'pakett' => $this->input->post('pakett'),
						'kellaaeg' => $this->input->post('kellaaeg'),
						'kuupäev' => $kuupäevStr
					);
					$this->database_model->insert_reservation($data);
					
					$returnData->alertType = 'success';
					$returnData->alertMessage = 'Broneering kinnitatud. Broneeringuid saate näha profiililehelt.';
				}
			}
		}
		if ($ajax) {
			echo json_encode($returnData);
		}
		else {
			$this->session->set_flashdata('alertType', $returnData->alertType);
			$this->session->set_flashdata('alertMessage', $returnData->alertMessage);
			redirect('broneerimine');
		}
	}
	
	public function cancel_reservation($reservation_id) {
		$this->load->model('database_model');
		$this->database_model->remove_reservation($reservation_id);
		$this->session->set_flashdata('alertType', 'success');
		$this->session->set_flashdata('alertMessage', 'Broneering tühistatud.');
		redirect('profiil');
	}
	
	public function get_visitor_stats() {
		$this->load->model("database_model");
		// Visit time
		$visits = $this->database_model->get_visits();
		$visit_times = array();
		foreach ($visits as $visit) {
			$timestamp = strtotime($visit->time);
			$hour = (int)date('H', $timestamp);
			$time_range = null;
			if ($hour < 6) {
				$time_range = "00 - 06";
			} else if ($hour < 12) {
				$time_range = "06 - 12";
			} else if ($hour < 18) {
				$time_range = "12 - 18";
			} else {
				$time_range = "18 - 00";
			}
			if (array_key_exists($time_range, $visit_times)) {
				$visit_times[$time_range]++;
			} else {
				$visit_times[$time_range] = 1;
			}
		}
		// Browser
		$browsers = array();
		$visit_browsers = $this->database_model->get_visit_browsers();
		foreach ($visit_browsers as $visit_browser) {
			$browsers[$visit_browser->browser_name] = (int)$visit_browser->count;
		}
		// Country
		$countries = array();
		$visit_countries = $this->database_model->get_visit_countries();
		foreach ($visit_countries as $visit_country) {
			$countries[$visit_country->country] = (int)$visit_country->count;
		}
		$returnData = new stdClass();
		$returnData->browsers = $browsers;
		$returnData->countries = $countries;
		$returnData->visit_times = $visit_times;
		echo json_encode($returnData);
	}
	
	public function get_remaining_games() {
		$this->load->model("database_model");
		$games = $this->database_model->get_games('ALL');
		$games = array_slice($games, 8);
		echo json_encode($games);
	}
}