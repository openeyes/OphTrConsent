<?php

class m130228_142350_consultant_field extends CDbMigration
{
	public function up()
	{
		$this->addColumn('et_ophtrconsent_other','consultant_id','int(10) unsigned NOT NULL');
		$this->createIndex('et_ophtrconsent_other_consultant_id_fk','et_ophtrconsent_other','consultant_id');
		$this->addForeignKey('et_ophtrconsent_other_consultant_id_fk','et_ophtrconsent_other','consultant_id','user','id');
	}

	public function down()
	{
		$this->dropForeignKey('et_ophtrconsent_other_consultant_id_fk','et_ophtrconsent_other');
		$this->dropIndex('et_ophtrconsent_other_consultant_id_fk','et_ophtrconsent_other');
		$this->dropColumn('et_ophtrconsent_other','consultant_id');
	}
}
