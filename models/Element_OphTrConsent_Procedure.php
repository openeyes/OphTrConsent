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

/**
 * This is the model class for table "et_ophtrconsent_procedure".
 *
 * The followings are the available columns in table:
 * @property string $id
 * @property integer $event_id
 * @property integer $eye_id
 * @property integer $anaesthetic_type_id
 *
 * The followings are the available model relations:
 *
 * @property ElementType $element_type
 * @property EventType $eventType
 * @property Event $event
 * @property User $user
 * @property User $usermodified
 * @property Eye $eye
 * @property EtOphtrconsentProcedureProceduresProcedures $proceduress
 * @property AnaestheticType $anaesthetic_type
 * @property EtOphtrconsentProcedureAddProcsAddProcs $add_procss
 */

class Element_OphTrConsent_Procedure extends BaseEventTypeElement
{
	public $service;

	/**
	 * Returns the static model of the specified AR class.
	 * @return the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'et_ophtrconsent_procedure';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event_id, eye_id, anaesthetic_type_id, booking_event_id', 'safe'),
			array('eye_id, anaesthetic_type_id, ', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, event_id, eye_id, anaesthetic_type_id, ', 'safe', 'on' => 'search'),
		);
	}
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'element_type' => array(self::HAS_ONE, 'ElementType', 'id','on' => "element_type.class_name='".get_class($this)."'"),
			'eventType' => array(self::BELONGS_TO, 'EventType', 'event_type_id'),
			'event' => array(self::BELONGS_TO, 'Event', 'event_id'),
			'user' => array(self::BELONGS_TO, 'User', 'created_user_id'),
			'usermodified' => array(self::BELONGS_TO, 'User', 'last_modified_user_id'),
			'eye' => array(self::BELONGS_TO, 'Eye', 'eye_id'),
			'anaesthetic_type' => array(self::BELONGS_TO, 'AnaestheticType', 'anaesthetic_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'event_id' => 'Event',
			'eye_id' => 'Eye',
			'procedures' => 'Procedures',
			'anaesthetic_type_id' => 'Anaesthetic type',
			'add_procs' => 'Additional procedures',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('event_id', $this->event_id, true);
		$criteria->compare('eye_id', $this->eye_id);
		$criteria->compare('procedures', $this->procedures);
		$criteria->compare('anaesthetic_type_id', $this->anaesthetic_type_id);
		$criteria->compare('add_procs', $this->add_procs);
		
		return new CActiveDataProvider(get_class($this), array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Set default values for forms on create
	 */
	public function setDefaultOptions()
	{
		if (Yii::app()->getController()->getAction()->id == 'create') {
			if (!$patient = Patient::model()->findByPk(@$_GET['patient_id'])) {
				throw new Exception("Patient not found: $patient->id");
			}

			if ($episode = $patient->getEpisodeForCurrentSubspecialty()) {
				if (isset($_GET['booking_event_id'])) {
					if (!$event = Event::model()->findByPk($_GET['booking_event_id'])) {
						throw new Exception("Can't find event: ".$_GET['booking_event_id']);
					}
					$this->booking_event_id = $event->id;
					if ($event->episode_id != $episode->id) {
						throw new Exception("Selected event is not in the current episode");
					}
					if ($api = Yii::app()->moduleAPI->get('OphTrOperationbooking')) {
						if ($eo = $api->getOperationForEvent($event->id)) {
							$this->eye_id = $eo->eye_id;
							$this->anaesthetic_type_id = $eo->anaesthetic_type_id;
						}
					}
				}
			}

			$this->booking_event_id = @$_GET['booking_event_id'];
		}
	}

	public function getProcedures() {
		$procedures = array();

		if (Yii::app()->getController()->getAction()->id == 'create') {
			if (!$patient = Patient::model()->findByPk(@$_GET['patient_id'])) {
				throw new Exception("Patient not found: $patient->id");
			}

			if ($episode = $patient->getEpisodeForCurrentSubspecialty()) {
				if (isset($_GET['booking_event_id'])) {
					if (!$event = Event::model()->findByPk($_GET['booking_event_id'])) {
						throw new Exception("Can't find event: ".$_GET['booking_event_id']);
					}
					if ($event->episode_id != $episode->id) {
						throw new Exception("Selected event is not in the current episode");
					}
					if ($api = Yii::app()->moduleAPI->get('OphTrOperationbooking')) {
						if ($eo = $api->getOperationForEvent($event->id)) {
							$procedures = $eo->procedures;
						}
					}
				}
			}
		} else {
			foreach (EtOphtrconsentProcedureProceduresProcedures::model()->findAll('element_id=?',array($this->id)) as $proc) {
				$procedures[] = $proc->proc;
			}
		}

		return $procedures;
	}

	public function getAdditional_procedures() {
		$procedures = array();

		if (Yii::app()->getController()->getAction()->id == 'create') {
			$procedure_ids = array();

			foreach ($this->procedures as $proc) {
				foreach ($proc->additional as $additional) {
					if (!in_array($additional->id, $procedure_ids)) {
						$procedure_ids[] = $additional->id;
						$procedures[] = $additional;
					}
				}
			}

		} else {
			foreach (EtOphtrconsentProcedureAddProcsAddProcs::model()->findAll('element_id=?',array($this->id)) as $proc) {
				$procedures[] = $proc->proc;
			}
		}

		return $procedures;
	}

	protected function beforeSave() {
		return parent::beforeSave();
	}

	protected function afterSave()
	{
		foreach ($_POST['Procedures_procedures'] as $procedure_id) {
			if (!EtOphtrconsentProcedureProceduresProcedures::model()->find('element_id=? and proc_id=?',array($this->id,$procedure_id))) {
				$p = new EtOphtrconsentProcedureProceduresProcedures;
				$p->element_id = $this->id;
				$p->proc_id = $procedure_id;
				if (!$p->save()) {
					throw new Exception("Unable to save procedure item: ".print_r($p->getErrors(),true));
				}
			}
		}

		foreach (EtOphtrconsentProcedureProceduresProcedures::model()->findAll('element_id=?',array($this->id)) as $p) {
			if (!in_array($p->proc_id,$_POST['Procedures_procedures'])) {
				if (!$p->delete()) {
					throw new Exception("Unable to delete procedure item: ".print_r($p->getErrors(),true));
				}
			}
		}

		if (isset($_POST['Procedures_additional'])) {
			foreach ($_POST['Procedures_additional'] as $procedure_id) {
				if (!EtOphtrconsentProcedureAddProcsAddProcs::model()->find('element_id=? and proc_id=?',array($this->id,$procedure_id))) {
					$p = new EtOphtrconsentProcedureAddProcsAddProcs;
					$p->element_id = $this->id;
					$p->proc_id = $procedure_id;
					if (!$p->save()) {
						throw new Exception("Unable to save additional procedure item: ".print_r($p->getErrors(),true));
					}
				}
			}

			foreach (EtOphtrconsentProcedureAddProcsAddProcs::model()->findAll('element_id=?',array($this->id)) as $p) {
				if (!in_array($p->proc_id,$_POST['Procedures_additional'])) {
					if (!$p->delete()) {
						throw new Exception("Unable to delete additional procedure item: ".print_r($p->getErrors(),true));
					}
				}
			}
		} else {
			foreach (EtOphtrconsentProcedureAddProcsAddProcs::model()->findAll('element_id=?',array($this->id)) as $p) {
				if (!$p->delete()) {
					throw new Exception("Unable to delete additional procedure item: ".print_r($p->getErrors(),true));
				}
			}
		}

		return parent::afterSave();
	}
}
?>
