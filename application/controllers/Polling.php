<?php
class Polling extends CI_Controller {
	
	public function reservationsRemoved() {
		$this->load->model('database_model');
		$realReservations = $this->database_model->get_all_reservations();
		$userReservations = $_SESSION['existing_reservations'];
		$removedReservations = array();
		foreach ($userReservations as $key => $userReservation) {
			if (!in_array($userReservation, $realReservations)) {
				array_push($removedReservations, $userReservation);
			}
		}
		$_SESSION['existing_reservations'] = $realReservations;
		$returnData = new stdClass();
		if (count($removedReservations) > 0) {
			$returnData->anyRemoved = true;
			$returnData->removedReservations = $removedReservations;
			echo json_encode($returnData);
		} else {
			$returnData->anyRemoved = false;
			echo json_encode($returnData);
		}
		return;
	}
}