<?php

class DefaultController extends BaseEventTypeController {
	public function actionCreate() {
		$errors = array();

		if (!$this->patient = Patient::model()->findByPk(@$_GET['patient_id'])) {
			throw new Exception("Patient not found: ".@$_GET['patient_id']);
		}

		if (!empty($_POST)) {
			if (@$_POST['SelectBooking'] == 'unbooked') {
				return $this->redirect(array('/OphTrConsent/Default/create?patient_id='.$this->patient->id.'&unbooked=1'));
			} else if (preg_match('/^booking([0-9]+)$/',@$_POST['SelectBooking'],$m)) {
				return $this->redirect(array('/OphTrConsent/Default/create?patient_id='.$this->patient->id.'&booking_event_id='.$m[1]));
			}
			$errors = array('Consent form' => array('Please select a booking or Unbooked procedures'));
		}

		if (isset($_GET['booking_event_id']) || @$_GET['unbooked']) {
			parent::actionCreate();
		} else {
			$bookings = array();

			if ($api = Yii::app()->moduleAPI->get('OphTrOperationbooking')) {
				if ($episode = $this->patient->getEpisodeForCurrentSubspecialty()) {
					$bookings = $api->getOpenBookingsForEpisode($episode->id);
				}
			}

			$this->event_type = EventType::model()->find('class_name=?',array('OphTrConsent'));
			$this->title = "Please select booking";
			$this->renderPartial('select_event',array(
				'errors' => $errors,
				'bookings' => $bookings,
			), false, true);
		}
	}

	public function actionUpdate($id) {
		parent::actionUpdate($id);
	}

	public function actionView($id) {
		parent::actionView($id);
	}

	/**
	 * Print action
	 * @param integer $id event id
	 */
	public function actionPrint($id) {
		$this->printInit($id);
		$elements = array();
		
		$template = 'print';

		/*if (isset($_GET['lang_id'])) {
			if (!$language = Language::model()->findByPK($_GET['lang_id'])) {
				throw new Exception("Language not found: ".print_r($language->getErrors(),true));
			}
		} else {*/
			$language = Language::model()->find('name=?',array('English'));
		//}

		foreach ($this->getDefaultElements('print') as $element) {
			$elements[get_class($element)] = $element;
		}

		preg_match('/^([0-9]+)/',$elements['Element_OphTrConsent_Type']->type->name,$m);
		$template_id = $m[1];

		$template = "print{$template_id}_$language->name";

		$this->printLog($id, true);
		$this->printPDF($id, $elements, $template, array('vi' => (boolean)@$_GET['vi']));
	}

	public function actionUsers() {
		$users = array();

		$criteria = new CDbCriteria;

		$criteria->addCondition(array("active = :active"));
		$criteria->addCondition(array("LOWER(concat_ws(' ',first_name,last_name)) LIKE :term"));

		$params[':active'] = 1;
		$params[':term'] = '%' . strtolower(strtr($_GET['term'], array('%' => '\%'))) . '%';

		$criteria->params = $params;
		$criteria->order = 'first_name, last_name';

		$firm = Firm::model()->findByPk(Yii::app()->session['selected_firm_id']);
		$consultant = null;
		// only want a consultant for medical firms
		if ($specialty = $firm->getSpecialty()) {
			if ($specialty->medical) {
				$consultant = $firm->getConsultantUser();
			}
		}

		foreach (User::model()->findAll($criteria) as $user) {
			if ($contact = $user->contact) {

				$consultant_name = false;

				// if we have a consultant for the firm, and its not the matched user, attach the consultant name to the entry
				if ($consultant && $user->id != $consultant->id) {
					$consultant_name = trim($consultant->contact->title.' '.$consultant->contact->first_name.' '.$consultant->contact->last_name);
				}

				$users[] = array(
					'id' => $user->id,
					'value' => trim($contact->title.' '.$contact->first_name.' '.$contact->last_name.' '.$contact->qualifications).' ('.$user->role.')',
					'fullname' => trim($contact->title.' '.$contact->first_name.' '.$contact->last_name.' '.$contact->qualifications),
					'role' => $user->role,
					'consultant' => $consultant_name,
				);
			}
		}

		echo json_encode($users);
	}
}
