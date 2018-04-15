<?php
class Profile extends CI_Controller {
	
	public function picture_upload() {
		if (!isset($_SESSION['user_id'])) {
			$this->session->set_flashdata('alertType', 'danger');
			$this->session->set_flashdata('alertMessage', lang('info_picture_upload_login_required'));
			redirect('profiil');
		}
		$this->load->model('files_model');
		$old_pic = $this->files_model->user_picture_path($_SESSION['user_id']);
		
		$returnData = $this->files_model->upload_user_picture();
		if ($returnData == "success") {
			$this->session->set_flashdata('alertType', 'success');
			$this->session->set_flashdata('alertMessage', lang('info_picture_upload_successful'));
		}
		else {
			$this->session->set_flashdata('alertType', 'danger');
			$this->session->set_flashdata('alertMessage', $returnData);
		}
		redirect('profiil');
	}
	
	public function picture_remove() {
		if (!isset($_SESSION['user_id'])) {
			$this->session->set_flashdata('alertType', 'danger');
			$this->session->set_flashdata('alertMessage', lang('info_picture_remove_login_required'));
			redirect('profi1iil');
		}
		
		$this->load->model('files_model');
		$user_pic = $this->files_model->user_picture_path($_SESSION['user_id']);
		if ($user_pic == false) {
			$this->session->set_flashdata('alertType', 'info');
			$this->session->set_flashdata('alertMessage', lang('info_no_picture_to_remove'));
		}
		else if ($this->files_model->delete_user_picture($_SESSION['user_id'])) {
			$this->session->set_flashdata('alertType', 'success');
			$this->session->set_flashdata('alertMessage', lang('info_picture_remove_success'));
		}
		else {
			$this->session->set_flashdata('alertType', 'danger');
			$this->session->set_flashdata('alertMessage', lang('info_picture_remove_fail'));
		}
		redirect('profiil');
	}
}