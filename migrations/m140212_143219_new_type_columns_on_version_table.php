<?php

class m140212_143219_new_type_columns_on_version_table extends CDbMigration
{
	public function up()
	{
		$this->addColumn('et_ophtrconsent_type_version','draft','tinyint(1) unsigned not null');
		$this->addColumn('et_ophtrconsent_type_version','print','tinyint(1) unsigned not null');
	}

	public function down()
	{
		$this->dropColumn('et_ophtrconsent_type_version','print');
		$this->dropColumn('et_ophtrconsent_type_version','draft');
	}
}
