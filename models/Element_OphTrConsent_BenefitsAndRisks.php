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
 * This is the model class for table "et_ophtrconsent_benfitrisk".
 *
 * The followings are the available columns in table:
 * @property string $id
 * @property integer $event_id
 * @property string $benefits
 * @property string $risks
 *
 * The followings are the available model relations:
 *
 * @property ElementType $element_type
 * @property EventType $eventType
 * @property Event $event
 * @property User $user
 * @property User $usermodified
 */

class Element_OphTrConsent_BenefitsAndRisks extends BaseEventTypeElement
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
		return 'et_ophtrconsent_benfitrisk';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event_id, benefits, risks, ', 'safe'),
			array('benefits, risks, ', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, event_id, benefits, risks, ', 'safe', 'on' => 'search'),
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
			'benefits' => 'Benefits',
			'risks' => 'Risks',
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
		$criteria->compare('benefits', $this->benefits);
		$criteria->compare('risks', $this->risks);

		return new CActiveDataProvider(get_class($this), array(
			'criteria' => $criteria,
		));
	}

	public function getProcedures()
	{
		$procedures = array();

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
			} else if (isset($_GET['procedure_id'])) {
				$procedures[] = Procedure::model()->findByPk($_GET['procedure_id']);
			}
		}

		return $procedures;
	}

	public function getAdditional_procedures()
	{
		$procedures = array();
		$procedure_ids = array();

		foreach ($this->procedures as $proc) {
			foreach ($proc->additional as $additional) {
				if (!in_array($additional->id, $procedure_ids)) {
					$procedure_ids[] = $additional->id;
					$procedures[] = $additional;
				}
			}
		}

		return $procedures;
	}

	public function setDefaultOptions()
	{
		if (Yii::app()->getController()->getAction()->id == 'create') {
			$complication_ids = array();
			$complications = array();
			$benefit_ids = array();
			$benefits = array();

			foreach (array_merge($this->procedures,$this->additional_procedures) as $proc) {
				foreach ($proc->complications as $complication) {
					if (!in_array($complication->id,$complication_ids)) {
						$complications[] = $complication;
						$complication_ids[] = $complication->id;
					}
				}
				foreach ($proc->benefits as $benefit) {
					if (!in_array($benefit->id,$benefit_ids)) {
						$benefits[] = $benefit;
						$benefit_ids[] = $benefit->id;
					}
				}
			}

			foreach ($benefits as $i => $benefit) {
				if ($i==0) {
					$this->benefits = ucfirst($benefit->name);
				} else {
					$this->benefits .= ", ".$benefit->name;
				}
			}

			foreach ($complications as $i => $complication) {
				if ($i==0) {
					$this->risks = ucfirst($complication->name);
				} else {
					$this->risks .= ", ".$complication->name;
				}
			}
		}
	}
}
?>
