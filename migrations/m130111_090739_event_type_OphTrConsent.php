<?php
class m130111_090739_event_type_OphTrConsent extends CDbMigration
{
	public function up()
	{
		// --- EVENT TYPE ENTRIES ---

		// create an event_type entry for this event type name if one doesn't already exist
		if (!$this->dbConnection->createCommand()->select('id')->from('event_type')->where('class_name=:class_name', array(':class_name'=>'OphTrConsent'))->queryRow()) {
			$group = $this->dbConnection->createCommand()->select('id')->from('event_group')->where('name=:name',array(':name'=>'Treatment events'))->queryRow();
			$this->insert('event_type', array('class_name' => 'OphTrConsent', 'name' => 'Consent form','event_group_id' => $group['id']));
		}
		// select the event_type id for this event type name
		$event_type = $this->dbConnection->createCommand()->select('id')->from('event_type')->where('class_name=:class_name', array(':class_name'=>'OphTrConsent'))->queryRow();

		// --- ELEMENT TYPE ENTRIES ---

		// create an element_type entry for this element type name if one doesn't already exist
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Type',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Type','class_name' => 'Element_OphTrConsent_Type', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}
		// select the element_type_id for this element type name
		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Type'))->queryRow();
		// create an element_type entry for this element type name if one doesn't already exist
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Procedure',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Procedure','class_name' => 'Element_OphTrConsent_Procedure', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}
		// select the element_type_id for this element type name
		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Procedure'))->queryRow();
		// create an element_type entry for this element type name if one doesn't already exist
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Benefits and risks',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Benefits and risks','class_name' => 'Element_OphTrConsent_BenefitsAndRisks', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}
		// select the element_type_id for this element type name
		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Benefits and risks'))->queryRow();
		// create an element_type entry for this element type name if one doesn't already exist
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Permissions',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Permissions','class_name' => 'Element_OphTrConsent_Permissions', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}
		// select the element_type_id for this element type name
		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Permissions'))->queryRow();
		// create an element_type entry for this element type name if one doesn't already exist
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Other',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Other','class_name' => 'Element_OphTrConsent_Other', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}
		// select the element_type_id for this element type name
		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Other'))->queryRow();

		// element lookup table et_ophtrconsent_type_type
		$this->createTable('et_ophtrconsent_type_type', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophtrconsent_type_type_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophtrconsent_type_type_cui_fk` (`created_user_id`)',
				'CONSTRAINT `et_ophtrconsent_type_type_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophtrconsent_type_type_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('et_ophtrconsent_type_type',array('name'=>'Patient agreement to investigation or treatment','display_order'=>1));
		$this->insert('et_ophtrconsent_type_type',array('name'=>'Parental agreement to investigation or treatment for a child or young person','display_order'=>2));
		$this->insert('et_ophtrconsent_type_type',array('name'=>'Patient/parental agreement to investigation or treatment (procedures where consciousness not impaired)','display_order'=>3));
		$this->insert('et_ophtrconsent_type_type',array('name'=>'Form for adults who are unable to consent to investigation or treatment','display_order'=>4));



		// create the table for this element type: et_modulename_elementtypename
		$this->createTable('et_ophtrconsent_type', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'type_id' => 'int(10) unsigned NOT NULL', // Type
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophtrconsent_type_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophtrconsent_type_cui_fk` (`created_user_id`)',
				'KEY `et_ophtrconsent_type_ev_fk` (`event_id`)',
				'KEY `et_ophtrconsent_type_type_fk` (`type_id`)',
				'CONSTRAINT `et_ophtrconsent_type_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophtrconsent_type_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophtrconsent_type_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
				'CONSTRAINT `et_ophtrconsent_type_type_fk` FOREIGN KEY (`type_id`) REFERENCES `et_ophtrconsent_type_type` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');


		// defaults table
		$this->createTable('et_ophtrconsent_procedure_proc_defaults', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'value_id' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophtrconsent_procedure_proc_defaults_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophtrconsent_procedure_proc_defaults_cui_fk` (`created_user_id`)',
				'CONSTRAINT `et_ophtrconsent_procedure_proc_defaults_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophtrconsent_procedure_proc_defaults_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		// create the table for this element type: et_modulename_elementtypename
		$this->createTable('et_ophtrconsent_procedure', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'eye_id' => 'int(10) unsigned NOT NULL DEFAULT 2', // Eye
				'anaesthetic_type_id' => 'int(10) unsigned NOT NULL DEFAULT 1', // Anaesthetic type
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophtrconsent_procedure_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophtrconsent_procedure_cui_fk` (`created_user_id`)',
				'KEY `et_ophtrconsent_procedure_ev_fk` (`event_id`)',
				'KEY `et_ophtrconsent_procedure_eye_id_fk` (`eye_id`)',
				'KEY `et_ophtrconsent_procedure_anaesthetic_type_id_fk` (`anaesthetic_type_id`)',
				'CONSTRAINT `et_ophtrconsent_procedure_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophtrconsent_procedure_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophtrconsent_procedure_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
				'CONSTRAINT `et_ophtrconsent_procedure_eye_id_fk` FOREIGN KEY (`eye_id`) REFERENCES `eye` (`id`)',
				'CONSTRAINT `et_ophtrconsent_procedure_anaesthetic_type_id_fk` FOREIGN KEY (`anaesthetic_type_id`) REFERENCES `anaesthetic_type` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->createTable('et_ophtrconsent_procedure_procedures_procedures', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'element_id' => 'int(10) unsigned NOT NULL',
				'proc_id' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophtrconsent_procedure_procedures_procedures_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophtrconsent_procedure_procedures_procedures_cui_fk` (`created_user_id`)',
				'KEY `et_ophtrconsent_procedure_procedures_procedures_ele_fk` (`element_id`)',
				'KEY `et_ophtrconsent_procedure_procedures_procedures_lku_fk` (`proc_id`)',
				'CONSTRAINT `et_ophtrconsent_procedure_procedures_procedures_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophtrconsent_procedure_procedures_procedures_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophtrconsent_procedure_procedures_procedures_ele_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophtrconsent_procedure` (`id`)',
				'CONSTRAINT `et_ophtrconsent_procedure_procedures_procedures_lku_fk` FOREIGN KEY (`proc_id`) REFERENCES `proc` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->createTable('et_ophtrconsent_procedure_add_procs_add_procs', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'element_id' => 'int(10) unsigned NOT NULL',
				'proc_id' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophtrconsent_procedure_add_procs_add_procs_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophtrconsent_procedure_add_procs_add_procs_cui_fk` (`created_user_id`)',
				'KEY `et_ophtrconsent_procedure_add_procs_add_procs_ele_fk` (`element_id`)',
				'KEY `et_ophtrconsent_procedure_add_procs_add_procs_lku_fk` (`proc_id`)',
				'CONSTRAINT `et_ophtrconsent_procedure_add_procs_add_procs_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophtrconsent_procedure_add_procs_add_procs_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophtrconsent_procedure_add_procs_add_procs_ele_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophtrconsent_procedure` (`id`)',
				'CONSTRAINT `et_ophtrconsent_procedure_add_procs_add_procs_lku_fk` FOREIGN KEY (`proc_id`) REFERENCES `proc` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');



		// create the table for this element type: et_modulename_elementtypename
		$this->createTable('et_ophtrconsent_benfitrisk', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'benefits' => 'text DEFAULT \'\'', // Benefits
				'risks' => 'text DEFAULT \'\'', // Risks
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophtrconsent_benfitrisk_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophtrconsent_benfitrisk_cui_fk` (`created_user_id`)',
				'KEY `et_ophtrconsent_benfitrisk_ev_fk` (`event_id`)',
				'CONSTRAINT `et_ophtrconsent_benfitrisk_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophtrconsent_benfitrisk_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophtrconsent_benfitrisk_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		// element lookup table et_ophtrconsent_permissions_tissues
		$this->createTable('et_ophtrconsent_permissions_tissues', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophtrconsent_permissions_tissues_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophtrconsent_permissions_tissues_cui_fk` (`created_user_id`)',
				'CONSTRAINT `et_ophtrconsent_permissions_tissues_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophtrconsent_permissions_tissues_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('et_ophtrconsent_permissions_tissues',array('name'=>'Keep for education, audit, and research','display_order'=>1));
		$this->insert('et_ophtrconsent_permissions_tissues',array('name'=>'Disposal','display_order'=>2));



		// create the table for this element type: et_modulename_elementtypename
		$this->createTable('et_ophtrconsent_permissions', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'tissues_id' => 'int(10) unsigned NOT NULL', // Tissues
				'images' => 'tinyint(1) unsigned NOT NULL', // Agree for use in education audit and research
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophtrconsent_permissions_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophtrconsent_permissions_cui_fk` (`created_user_id`)',
				'KEY `et_ophtrconsent_permissions_ev_fk` (`event_id`)',
				'KEY `et_ophtrconsent_permissions_tissues_fk` (`tissues_id`)',
				'CONSTRAINT `et_ophtrconsent_permissions_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophtrconsent_permissions_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophtrconsent_permissions_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
				'CONSTRAINT `et_ophtrconsent_permissions_tissues_fk` FOREIGN KEY (`tissues_id`) REFERENCES `et_ophtrconsent_permissions_tissues` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');



		// create the table for this element type: et_modulename_elementtypename
		$this->createTable('et_ophtrconsent_other', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'information' => 'tinyint(1) unsigned NOT NULL', // An information leaflet has been provided
				'witness_required' => 'tinyint(1) unsigned NOT NULL', // Witness required
				'interpreter_required' => 'tinyint(1) unsigned NOT NULL', // Interpreter required
				'parent_guardian' => 'varchar(255) DEFAULT \'\'', // Parent guardian
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophtrconsent_other_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophtrconsent_other_cui_fk` (`created_user_id`)',
				'KEY `et_ophtrconsent_other_ev_fk` (`event_id`)',
				'CONSTRAINT `et_ophtrconsent_other_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophtrconsent_other_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophtrconsent_other_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

	}

	public function down()
	{
		// --- drop any element related tables ---
		// --- drop element tables ---
		$this->dropTable('et_ophtrconsent_type');
		$this->dropTable('et_ophtrconsent_type_type');
		$this->dropTable('et_ophtrconsent_procedure_procedures_procedures');
		$this->dropTable('et_ophtrconsent_procedure_add_procs_add_procs');
		$this->dropTable('et_ophtrconsent_procedure');
		$this->dropTable('et_ophtrconsent_procedure_proc_defaults');
		$this->dropTable('et_ophtrconsent_benfitrisk');
		$this->dropTable('et_ophtrconsent_permissions');
		$this->dropTable('et_ophtrconsent_permissions_tissues');
		$this->dropTable('et_ophtrconsent_other');

		// --- delete event entries ---
		$event_type = $this->dbConnection->createCommand()->select('id')->from('event_type')->where('class_name=:class_name', array(':class_name'=>'OphTrConsent'))->queryRow();

		foreach ($this->dbConnection->createCommand()->select('id')->from('event')->where('event_type_id=:event_type_id', array(':event_type_id'=>$event_type['id']))->queryAll() as $row) {
			$this->delete('audit', 'event_id='.$row['id']);
			$this->delete('event', 'id='.$row['id']);
		}

		// --- delete entries from element_type ---
		$this->delete('element_type', 'event_type_id='.$event_type['id']);

		// --- delete entries from event_type ---
		$this->delete('event_type', 'id='.$event_type['id']);

		// echo "m000000_000001_event_type_OphTrConsent does not support migration down.\n";
		// return false;
		echo "If you are removing this module you may also need to remove references to it in your configuration files\n";
		return true;
	}
}
?>
