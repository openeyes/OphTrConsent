<?php

class m131210_144548_soft_deletion extends CDbMigration
{
	public function up()
	{
		$this->addColumn('ophtrconsent_leaflet','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophtrconsent_leaflet_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophtrconsent_leaflet_firm','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophtrconsent_leaflet_firm_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophtrconsent_leaflet_subspecialty','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophtrconsent_leaflet_subspecialty_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophtrconsent_leaflets','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophtrconsent_leaflets_version','deleted','tinyint(1) unsigned not null');
	}

	public function down()
	{
		$this->dropColumn('ophtrconsent_leaflet','deleted');
		$this->dropColumn('ophtrconsent_leaflet_version','deleted');
		$this->dropColumn('ophtrconsent_leaflet_firm','deleted');
		$this->dropColumn('ophtrconsent_leaflet_firm_version','deleted');
		$this->dropColumn('ophtrconsent_leaflet_subspecialty','deleted');
		$this->dropColumn('ophtrconsent_leaflet_subspecialty_version','deleted');
		$this->dropColumn('ophtrconsent_leaflets','deleted');
		$this->dropColumn('ophtrconsent_leaflets_version','deleted');
	}
}
