<?php

class m130228_085024_rename_permissions_element extends CDbMigration
{
	public function up()
	{
		$event_type = EventType::model()->find('class_name=?',array('OphTrConsent'));
		$element_type = ElementType::model()->find('event_type_id=? and class_name=?',array($event_type->id,'Element_OphTrConsent_Permissions'));

		$this->update('element_type',array('name'=>'Permissions for images'),'id='.$element_type->id);
	}

	public function down()
	{
		$event_type = EventType::model()->find('class_name=?',array('OphTrConsent'));
		$element_type = ElementType::model()->find('event_type_id=? and class_name=?',array($event_type->id,'Element_OphTrConsent_Permissions'));

		$this->update('element_type',array('name'=>'Permissions'),'id='.$element_type->id);
	}
}
