<?php
class Profile extends CI_Controller {
	
	public function picture_upload() {
		$this->load->helper('form');
		if (!isset($_SESSION['id'])) {
			$this->session->set_flashdata('alertType', 'danger');
			$this->session->set_flashdata('alertMessage', 'Faili üleslaadimiseks peate olema sisse logitud');
			redirect('profiil');
		}
		$config['upload_path'] = './user_files/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '1000';
		$config['max_width'] = '2048';
		$config['max_height'] = '2048';
		
		$old_pic = $this->get_user_picture();
		
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('kasutaja-fail')) {
			if ($old_pic != false) {
				unlink($old_pic);
			}
			// Rename new pic, while keeping extension
			$img_data = $this->upload->data();
            $new_imgname = $_SESSION['id'] . '_pic' . $img_data['file_ext'];
            $new_imgpath = $img_data['file_path'] . $new_imgname;
            rename($img_data['full_path'], $new_imgpath);
			
			$this->session->set_flashdata('alertType', 'success');
			$this->session->set_flashdata('alertMessage', 'Pilt edukalt üles laetud');
		}
		else {
			$errorsStr = trim($this->upload->display_errors());
			$errors = explode("\n", $errorsStr);
			$returnMessage = "";
			foreach ($errors as $error) {
				$returnMessage .= $error;
			}
			$this->session->set_flashdata('alertType', 'danger');
			$this->session->set_flashdata('alertMessage', $returnMessage);
		}
		redirect('profiil');
	}
	
	public function picture_remove() {
		if (!isset($_SESSION['id'])) {
			$this->session->set_flashdata('alertType', 'danger');
			$this->session->set_flashdata('alertMessage', 'Faili eemaldamiseks peate olema sisse logitud');
			redirect('profi1iil');
		}
		
		$user_pic = $this->get_user_picture();
		if ($user_pic == false) {
			$this->session->set_flashdata('alertType', 'info');
			$this->session->set_flashdata('alertMessage', 'Teil pole ühtegi pilti mida eemaldada');
		}
		else if (unlink($user_pic)) {
			$this->session->set_flashdata('alertType', 'success');
			$this->session->set_flashdata('alertMessage', 'Pilt edukalt eemaldatud');
		}
		else {
			$this->session->set_flashdata('alertType', 'danger');
			$this->session->set_flashdata('alertMessage', 'Faili kustutamine ebaõnnestus');
		}
		redirect('profiil');
	}
	
	private function get_user_picture() {
		$user_picture_path = false;
		$pictures = scandir('user_files');
		foreach ($pictures as $pic) {
			if (preg_match('/^' . $_SESSION['id'] . '_pic\./', $pic) == 1) {
				$user_picture_path = 'user_files/' . $pic;
				break;
			}
		}
		return $user_picture_path;
	}
}