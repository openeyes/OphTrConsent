<?php

class m130711_092740_allow_support_service_consent_forms extends CDbMigration
{
	public function up()
	{
		$event_type = Yii::app()->db->createCommand()->select("*")->from("event_type")->where("class_name=:class_name",array(":class_name"=>"OphTrConsent"))->queryRow();
		$this->update('event_type',array('support_services'=>1),"id={$event_type['id']}");
	}

	public function down()
	{
		$event_type = Yii::app()->db->createCommand()->select("*")->from("event_type")->where("class_name=:class_name",array(":class_name"=>"OphTrConsent"))->queryRow();
		$this->update('event_type',array('support_services'=>0),"id={$event_type['id']}");
	}
}
