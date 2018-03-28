<?php
class Email_model extends CI_Model {
	
	public function send_registration_email($user_email) {
		$this->config->load('email');
		
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = $this->config->item('email_out_server');
		$config['smtp_port'] = $this->config->item('email_out_port');
		$config['smtp_user'] = $this->config->item('email_username');
		$config['smtp_pass'] = $this->config->item('email_password');
		
		$this->load->library('email', $config);
		$this->email->from($this->config->item('email_address'), 'Mängumaailm');
		$this->email->to($user_email);
		$this->email->subject('Olete edukalt registreeritud - Mängumaailm');
		$this->email->message('Olete edukalt endale Mängumaailm kasutaja teinud. ' . "\n" .
			'Sisenemiseks vajutage kodulehel sisene lingile.' . "\n\n" . 'Mängumaailm');

		$this->email->send();
	}
}