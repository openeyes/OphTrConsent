<?php

class m130111_130606_default_values extends CDbMigration
{
	public function up()
	{
		$this->alterColumn('et_ophtrconsent_permissions','tissues_id','int(10) unsigned NOT NULL DEFAULT 1');
	}

	public function down()
	{
		$this->alterColumn('et_ophtrconsent_permissions','tissues_id','int(10) unsigned NOT NULL');
	}
}
