<?php
class Email_model extends CI_Model {
	
	public function send_registration_email($user_email) {
		if (constant('ENVIRONMENT') != 'development') {
			$subject = lang('email_register_title');
			$txt = 'Olete edukalt endale Mängumaailm kasutaja teinud. ' . "\r\n" .
				'Sisenemiseks vajutage kodulehel sisene lingile.' . "\r\n\r\n" . 'Mängumaailm';
			$headers = 'From: "Mängumaailm" <mangumaailm@online.ee>';
			if (!mail($user_email,$subject,$txt,$headers)) {
				throw new Exception('email fail');
			}
		}
		/* Old version. Works, but 000webhost doesn't allow SMTP for free users.
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
		$this->email->message('Olete edukalt endale Mängumaailm kasutaja teinud. ' . "\r\n" .
			'Sisenemiseks vajutage kodulehel sisene lingile.' . "\r\n\r\n" . 'Mängumaailm');
		$this->email->send())
		*/
	}
}