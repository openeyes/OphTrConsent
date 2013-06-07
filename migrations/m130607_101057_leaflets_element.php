<?php

class m130607_101057_leaflets_element extends CDbMigration
{
	public function up()
	{
		$event_type = Yii::app()->db->createCommand()->select("*")->from("event_type")->where("class_name=:class_name",array(':class_name'=>'OphTrConsent'))->queryRow();

		$this->update('element_type',array('display_order'=>10),"event_type_id = {$event_type['id']} and class_name = 'Element_OphTrConsent_Type'");
		$this->update('element_type',array('display_order'=>30),"event_type_id = {$event_type['id']} and class_name = 'Element_OphTrConsent_Procedure'");
		$this->update('element_type',array('display_order'=>40),"event_type_id = {$event_type['id']} and class_name = 'Element_OphTrConsent_BenefitsAndRisks'");
		$this->update('element_type',array('display_order'=>50),"event_type_id = {$event_type['id']} and class_name = 'Element_OphTrConsent_Permissions'");
		$this->update('element_type',array('display_order'=>60),"event_type_id = {$event_type['id']} and class_name = 'Element_OphTrConsent_Other'");

		$this->insert('element_type',array('name'=>'Leaflets','class_name'=>'Element_OphTrConsent_Leaflets','event_type_id'=>$event_type['id'],'display_order'=>20,'default'=>1));

		$this->createTable('et_ophtrconsent_leaflets', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophtrconsent_leaflets_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophtrconsent_leaflets_cui_fk` (`created_user_id`)',
				'KEY `et_ophtrconsent_leaflets_ev_fk` (`event_id`)',
				'CONSTRAINT `et_ophtrconsent_leaflets_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophtrconsent_leaflets_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophtrconsent_leaflets_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->createTable('ophtrconsent_leaflets', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'element_id' => 'int(10) unsigned NOT NULL',
				'leaflet_id' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophtrconsent_leaflets_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophtrconsent_leaflets_cui_fk` (`created_user_id`)',
				'KEY `ophtrconsent_leaflets_el_fk` (`element_id`)',
				'KEY `ophtrconsent_leaflets_le_fk` (`leaflet_id`)',
				'CONSTRAINT `ophtrconsent_leaflets_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophtrconsent_leaflets_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophtrconsent_leaflets_le_fk` FOREIGN KEY (`leaflet_id`) REFERENCES `ophtrconsent_leaflet` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');
	}

	public function down()
	{
		$this->dropTable('ophtrconsent_leaflets');
		$this->dropTable('et_ophtrconsent_leaflets');

		$event_type = Yii::app()->db->createCommand()->select("*")->from("event_type")->where("class_name=:class_name",array(':class_name'=>'OphTrConsent'))->queryRow();

		$this->update('element_type',array('display_order'=>1),"event_type_id = {$event_type['id']}");
		$this->delete('element_type',"{$event_type['id']} and class_name = 'Element_OphTrConsent_Leaflets'");
	}
}
