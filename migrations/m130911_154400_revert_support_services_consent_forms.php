<?php

class m130911_154400_revert_support_services_consent_forms extends CDbMigration
{

	public function up()
	{
		$event_type = Yii::app()->db->createCommand()->select("*")->from("event_type")->where("class_name=:class_name",array(":class_name"=>"OphTrConsent"))->queryRow();
		$this->update('event_type',array('support_services'=>0),"id={$event_type['id']}");
	}

	public function down()
	{
		$event_type = Yii::app()->db->createCommand()->select("*")->from("event_type")->where("class_name=:class_name",array(":class_name"=>"OphTrConsent"))->queryRow();
		$this->update('event_type',array('support_services'=>1),"id={$event_type['id']}");
	}
}
