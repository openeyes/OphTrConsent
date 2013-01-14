<?php

class DefaultController extends BaseEventTypeController {
	public function actionCreate() {
		$errors = array();

		if (!empty($_POST)) {
			if (preg_match('/^procedure([0-9]+)$/',@$_POST['SelectBooking'],$m)) {
				return $this->redirect(array('/OphTrConsent/Default/create?patient_id=1937817&procedure_id='.$m[1]));
			} else if (preg_match('/^booking([0-9]+)$/',@$_POST['SelectBooking'],$m)) {
				return $this->redirect(array('/OphTrConsent/Default/create?patient_id=1937817&booking_event_id='.$m[1]));
			}
			$errors = array('Booking' => array('Please select a booking or a procedure'));
		}

		if (isset($_GET['booking_event_id']) || isset($_GET['procedure_id'])) {
			parent::actionCreate();
		} else {
			if (!$this->patient = Patient::model()->findByPk(@$_GET['patient_id'])) {
				throw new Exception("Patient not found: ".@$_GET['patient_id']);
			}
			$episode = $this->patient->getEpisodeForCurrentSubspecialty();
			$operations = array();
			
			foreach (Yii::app()->db->createCommand()
				->select("s.date, eo.id as eoid, e.id as evid")
				->from("booking b")
				->join("session s","b.session_id = s.id")
				->join("element_operation eo","b.element_operation_id = eo.id")
				->join("event e","eo.event_id = e.id")
				->where("e.episode_id = ?",array($episode->id))
				->queryAll() as $row) {

				$row['procedures'] = array();

				if (!Element_OphTrConsent_Procedure::model()->find('booking_event_id=?',array($row['evid']))) {
					foreach (OperationProcedureAssignment::model()->findAll('operation_id=?',array($row['eoid'])) as $opa) {
						$row['procedures'][] = $opa->procedure->term;
					}
					$operations[] = $row;
				}
			}

			$this->event_type = EventType::model()->find('class_name=?',array('OphTrConsent'));
			$this->title = "Please select booking";
			$this->renderPartial('select_event',array(
				'errors' => $errors,
				'operations' => $operations,
				'procedures' => array(128 => 'Laser iridotomy'),
			), false, true);
		}
	}

	public function actionUpdate($id) {
		parent::actionUpdate($id);
	}

	public function actionView($id) {
		parent::actionView($id);
	}

	public function actionPrint($id) {
		parent::actionPrint($id);
	}
}
