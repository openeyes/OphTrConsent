<?php

class m130605_093254_consent_form_list extends CDbMigration
{
	public function up()
	{
		$this->createTable('ophtrconsent_leaflet', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(1024) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophtrconsent_leaflet_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophtrconsent_leaflet_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophtrconsent_leaflet_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophtrconsent_leaflet_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->createTable('ophtrconsent_leaflet_subspecialty', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'leaflet_id' => 'int(10) unsigned NOT NULL',
				'subspecialty_id' => 'int(10) unsigned NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophtrconsent_leaflet_subspecialty_leaflet_id_fk` (`leaflet_id`)',
				'KEY `ophtrconsent_leaflet_subspecialty_subspecialty_id_fk` (`subspecialty_id`)',
				'KEY `ophtrconsent_leaflet_subspecialty_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophtrconsent_leaflet_subspecialty_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophtrconsent_leaflet_subspecialty_leaflet_id_fk` FOREIGN KEY (`leaflet_id`) REFERENCES `ophtrconsent_leaflet` (`id`)',
				'CONSTRAINT `ophtrconsent_leaflet_subspecialty_subspecialty_id_fk` FOREIGN KEY (`subspecialty_id`) REFERENCES `subspecialty` (`id`)',
				'CONSTRAINT `ophtrconsent_leaflet_subspecialty_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophtrconsent_leaflet_subspecialty_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');
	}

	public function down()
	{
		$this->dropTable('ophtrconsent_leaflet_subspecialty');
		$this->dropTable('ophtrconsent_leaflet');
	}
}
