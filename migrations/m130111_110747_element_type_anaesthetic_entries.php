<?php

class m130111_110747_element_type_anaesthetic_entries extends CDbMigration
{
	public function up()
	{
		$event_type = EventType::model()->find('class_name=?',array('OphTrConsent'));
		$element_type = ElementType::model()->find('event_type_id=? and class_name=?',array($event_type->id,'Element_OphTrConsent_Procedure'));
		$this->insert('element_type_anaesthetic_type',array('element_type_id'=>$element_type->id,'anaesthetic_type_id'=>1,'display_order'=>1));
		$this->insert('element_type_anaesthetic_type',array('element_type_id'=>$element_type->id,'anaesthetic_type_id'=>2,'display_order'=>2));
		$this->insert('element_type_anaesthetic_type',array('element_type_id'=>$element_type->id,'anaesthetic_type_id'=>3,'display_order'=>3));
		$this->insert('element_type_anaesthetic_type',array('element_type_id'=>$element_type->id,'anaesthetic_type_id'=>4,'display_order'=>4));
		$this->insert('element_type_anaesthetic_type',array('element_type_id'=>$element_type->id,'anaesthetic_type_id'=>5,'display_order'=>5));
	}

	public function down()
	{
		$event_type = EventType::model()->find('class_name=?',array('OphTrConsent'));
		$element_type = ElementType::model()->find('event_type_id=? and class_name=?',array($event_type->id,'Element_OphTrConsent_Procedure'));
		$this->delete('element_type_anaesthetic_type','element_type_id='.$element_type->id);
	}
}
