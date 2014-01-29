<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */

class DefaultController extends BaseEventTypeController
{
	public function actionCreate()
	{
		$errors = array();

		if (!$this->patient = Patient::model()->findByPk(@$_GET['patient_id'])) {
			throw new Exception("Patient not found: ".@$_GET['patient_id']);
		}

		if (!empty($_POST)) {
			if (@$_POST['SelectBooking'] == 'unbooked') {
				return $this->redirect(array('/OphTrConsent/Default/create?patient_id='.$this->patient->id.'&unbooked=1'));
			} elseif (preg_match('/^booking([0-9]+)$/',@$_POST['SelectBooking'],$m)) {
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
					$bookings = $api->getBookingsForEpisode($episode->id);
				}
			}

			$this->event_type = EventType::model()->find('class_name=?',array('OphTrConsent'));
			$this->title = "Please select booking";
			$this->event_tabs = array(
					array(
							'label' => 'Select a booking',
							'active' => true,
					),
			);
			$cancel_url = ($this->episode) ? '/patient/episode/'.$this->episode->id : '/patient/episodes/'.$this->patient->id;
			$this->event_actions = array(
					EventAction::button('Cancel',
							Yii::app()->createUrl($cancel_url),
							array('level'=>'cancel'),
							array('id'=>'et_cancel')
					)
			);
			$this->processJsVars();
			$this->render('select_event',array(
				'errors' => $errors,
				'bookings' => $bookings,
			), false, true);
		}
	}

	public function actionUpdate($id)
	{
		parent::actionUpdate($id);
	}

	public function actionView($id)
	{
		$this->extraViewProperties['print'] = Yii::app()->session['printConsent'];
		unset(Yii::app()->session['printConsent']);
		parent::actionView($id);
	}

	/**
	 * Print action
	 * @param integer $id event id
	 */
	public function actionPrint($id)
	{
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
		$this->printPDF($id, $elements, $template, array('vi' => (boolean) @$_GET['vi']));
	}

	public function actionUsers()
	{
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
				$consultant = $firm->consultant;
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

	public function actionDoPrint($id)
	{
		if (!$type = Element_OphTrConsent_Type::model()->find('event_id=?',array($id))) {
			throw new Exception("Consent form not found for event id: $id");
		}

		$type->print = 1;
		$type->draft = 0;

		if (!$type->save()) {
			throw new Exception("Unable to save consent form: ".print_r($type->getErrors(),true));
		}
		if (!$event = Event::model()->findByPk($id)) {
			throw new Exception("Event not found: $id");
		}
		$event->info = '';
		if (!$event->save()) {
			throw new Exception("Unable to save event: ".print_r($event->getErrors(),true));
		}
		Yii::app()->session['printConsent'] = isset($_GET['vi']) ? 2 : 1;
		echo "1";
	}

	public function actionMarkPrinted($id)
	{
		if ($type = Element_OphTrConsent_Type::model()->find('event_id=?',array($id))) {
			$type->print = 0;
			$type->draft = 0;
			if (!$type->save()) {
				throw new Exception('Unable to mark consent form printed: '.print_r($type->getErrors(),true));
			}
		}
	}
}
