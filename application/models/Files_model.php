<?php
class Files_model extends CI_Model {


	public function upload_user_picture() {
		
		$config['upload_path'] = './user_files/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '1000';
		$config['max_width'] = '2048';
		$config['max_height'] = '2048';
		
		$old_pic = $this->user_picture_path($_SESSION['user_id']);
		
		$this->load->library('upload');
		$this->upload->initialize($config);
		if ($this->upload->do_upload('kasutaja-fail')) {
			if ($old_pic !== false) {
				unlink($old_pic);
			}
			// Rename new pic, while keeping extension
			$img_data = $this->upload->data();
            $new_imgname = $_SESSION['user_id'] . '_pic' . $img_data['file_ext'];
            $new_imgpath = $img_data['file_path'] . $new_imgname;
            rename($img_data['full_path'], $new_imgpath);
			return 'success';
		}
		else {
			$errorsStr = trim($this->upload->display_errors());
			$errors = explode("\n", $errorsStr);
			$returnMessage = "";
			foreach ($errors as $error) {
				$returnMessage .= $error;
			}
			return $returnMessage;
		}
		
	}

	public function user_picture_path($user_id) {
		$user_picture_path = false;
		$pictures = scandir('user_files');
		foreach ($pictures as $pic) {
			if (preg_match('/^' . $user_id . '_pic\./', $pic) == 1) {
				$user_picture_path = 'user_files/' . $pic;
				break;
			}
		}
		return $user_picture_path;
	}
	
	public function delete_user_picture($user_id) {
		$picture_path = $this->user_picture_path($user_id);
		if ($picture_path !== false) {
			return unlink($picture_path);
		}
	}
}