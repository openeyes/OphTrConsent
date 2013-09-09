<?php

class m130909_111400_anaesthetic_type_sort extends OEMigration
{
	public function up()
	{
		$element_type_id = ElementType::model()->find('class_name = ?',array('Element_OphTrConsent_Procedure'))->id;
		$this->delete('element_type_anaesthetic_type','element_type_id = ?',array($element_type_id));
		$migrations_path = dirname(__FILE__);
		$this->initialiseData($migrations_path);
	}

	public function down()
	{
	}
}
