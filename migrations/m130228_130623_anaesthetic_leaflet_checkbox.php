<?php

class m130228_130623_anaesthetic_leaflet_checkbox extends CDbMigration
{
	public function up()
	{
		$this->addColumn('et_ophtrconsent_other','anaesthetic_leaflet','tinyint(1) unsigned NOT NULL DEFAULT 0');
	}

	public function down()
	{
		$this->dropColumn('et_ophtrconsent_other','anaesthetic_leaflet');
	}
}
