<?php
class Pages extends CI_Controller {
	
	public function view($page = 'avaleht') {
		if (!file_exists(APPPATH.'views/pages/' . $page . '.php')) {
			show_404();
		}
		
		$data['title'] = 'Mängumaailm';
		
		$this->load->view('templates/header', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer', $data);
	}
}
