<?php
class Profile extends CI_Controller {
	
	public function picture_upload() {
		if (!isset($_SESSION['user_id'])) {
			$this->session->set_flashdata('alertType', 'danger');
			$this->session->set_flashdata('alertMessage', 'Faili üleslaadimiseks peate olema sisse logitud.');
			redirect('profiil');
		}
		$this->load->model('files_model');
		$old_pic = $this->files_model->user_picture_path($_SESSION['user_id']);
		
		$returnData = $this->files_model->upload_user_picture();
		if ($returnData == "success") {
			$this->session->set_flashdata('alertType', 'success');
			$this->session->set_flashdata('alertMessage', 'Pilt edukalt üles laetud');
		}
		else {
			$this->session->set_flashdata('alertType', 'danger');
			// Translate errors to estonian
			$returnData = str_replace('The upload path does not appear to be valid.', 'Üleslaadimise kaust ei ole saadav.', $returnData);
			$returnData = str_replace('You did not select a file to upload.', 'Valige pilt mida üles laadida (max 1MB).', $returnData);
			$returnData = str_replace('The image you are attempting to upload doesn\'t fit into the allowed dimensions.', 'Pildi mõõtmed on liiga suured (max 2048 x 2048).', $returnData);
			$returnData = str_replace('The file you are attempting to upload is larger than the permitted size.', 'Fail on liiga suur (max 1MB).', $returnData);
			$returnData = str_replace('The filetype you are attempting to upload is not allowed.', 'See failitüüp ei ole lubatud. Fail peab olema PNG, JPEG või GIF tüüpi.', $returnData);
			$this->session->set_flashdata('alertMessage', $returnData);
		}
		redirect('profiil');
	}
	
	public function picture_remove() {
		if (!isset($_SESSION['user_id'])) {
			$this->session->set_flashdata('alertType', 'danger');
			$this->session->set_flashdata('alertMessage', 'Faili eemaldamiseks peate olema sisse logitud.');
			redirect('profi1iil');
		}
		
		$this->load->model('files_model');
		$user_pic = $this->files_model->user_picture_path($_SESSION['user_id']);
		if ($user_pic == false) {
			$this->session->set_flashdata('alertType', 'info');
			$this->session->set_flashdata('alertMessage', 'Teil pole ühtegi pilti mida eemaldada.');
		}
		else if ($this->files_model->delete_user_picture($_SESSION['user_id'])) {
			$this->session->set_flashdata('alertType', 'success');
			$this->session->set_flashdata('alertMessage', 'Pilt edukalt eemaldatud.');
		}
		else {
			$this->session->set_flashdata('alertType', 'danger');
			$this->session->set_flashdata('alertMessage', 'Faili kustutamine ebaõnnestus.');
		}
		redirect('profiil');
	}
}