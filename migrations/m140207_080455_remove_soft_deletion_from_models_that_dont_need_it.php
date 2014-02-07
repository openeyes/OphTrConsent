<?php

class m140207_080455_remove_soft_deletion_from_models_that_dont_need_it extends CDbMigration
{
	public $tables = array(
		'et_ophtrconsent_benfitrisk',
		'et_ophtrconsent_leaflets',
		'et_ophtrconsent_other',
		'et_ophtrconsent_permissions',
		'et_ophtrconsent_procedure',
		'et_ophtrconsent_procedure_add_procs_add_procs',
		'et_ophtrconsent_procedure_proc_defaults',
		'et_ophtrconsent_procedure_procedures_procedures',
		'et_ophtrconsent_type',
		'ophtrconsent_leaflet_firm',
		'ophtrconsent_leaflet_subspecialty',
		'ophtrconsent_leaflets',
	);

	public function up()
	{
		foreach ($this->tables as $table) {
			$this->dropColumn($table,'deleted');
			$this->dropColumn($table.'_version','deleted');

			$this->dropForeignKey("{$table}_aid_fk",$table."_version");
		}
	}

	public function down()
	{
		foreach ($this->tables as $table) {
			$this->addColumn($table,'deleted','tinyint(1) unsigned not null');
			$this->addColumn($table."_version",'deleted','tinyint(1) unsigned not null');

			$this->addForeignKey("{$table}_aid_fk",$table."_version","id",$table,"id");
		}
	}
}
