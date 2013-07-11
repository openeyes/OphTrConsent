<?php

class m130711_072157_firm_leaflets_required_for_support_services extends CDbMigration
{
	public function up()
	{
		$this->createTable('ophtrconsent_leaflet_firm', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'leaflet_id' => 'int(10) unsigned NOT NULL',
				'firm_id' => 'int(10) unsigned NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophtrconsent_leaflet_firm_leaflet_id_fk` (`leaflet_id`)',
				'KEY `ophtrconsent_leaflet_firm_firm_id_fk` (`firm_id`)',
				'KEY `ophtrconsent_leaflet_firm_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophtrconsent_leaflet_firm_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophtrconsent_leaflet_firm_leaflet_id_fk` FOREIGN KEY (`leaflet_id`) REFERENCES `ophtrconsent_leaflet` (`id`)',
				'CONSTRAINT `ophtrconsent_leaflet_firm_firm_id_fk` FOREIGN KEY (`firm_id`) REFERENCES `firm` (`id`)',
				'CONSTRAINT `ophtrconsent_leaflet_firm_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophtrconsent_leaflet_firm_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');
	}

	public function down()
	{
		$this->dropTable('ophtrconsent_leaflet_firm');
	}
}
