<?php

class m140129_113457_missing_fields_on_et_ophtrconsent_type_version extends CDbMigration
{
	public function up()
	{
		$this->addColumn('et_ophtrconsent_type_version','draft','tinyint(1) unsigned not null');
		$this->addColumn('et_ophtrconsent_type_version','print','tinyint(1) unsigned not null');
	}

	public function down()
	{
		$this->dropColumn('et_ophtrconsent_type_version','draft');
		$this->dropColumn('et_ophtrconsent_type_version','print');
	}
}
