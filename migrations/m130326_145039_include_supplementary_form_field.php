<?php

class m130326_145039_include_supplementary_form_field extends CDbMigration
{
	public function up()
	{
		$this->addColumn('et_ophtrconsent_other','include_supplementary_consent','tinyint(1) unsigned NOT NULL DEFAULT 0');
	}

	public function down()
	{
		$this->dropColumn('et_ophtrconsent_other','include_supplementary_consent');
	}
}
