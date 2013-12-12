<?php

class m131206_150663_soft_deletion extends CDbMigration
{
	public function up()
	{
		$this->addColumn('et_ophtrconsent_benfitrisk','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophtrconsent_leaflets','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophtrconsent_other','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophtrconsent_permissions','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophtrconsent_permissions_images','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophtrconsent_procedure','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophtrconsent_procedure_add_procs_add_procs','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophtrconsent_procedure_proc_defaults','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophtrconsent_procedure_procedures_procedures','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophtrconsent_type','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophtrconsent_type_type','deleted','tinyint(1) unsigned not null');
	}

	public function down()
	{
		$this->dropColumn('et_ophtrconsent_benfitrisk','deleted');
		$this->dropColumn('et_ophtrconsent_leaflets','deleted');
		$this->dropColumn('et_ophtrconsent_other','deleted');
		$this->dropColumn('et_ophtrconsent_permissions','deleted');
		$this->dropColumn('et_ophtrconsent_permissions_images','deleted');
		$this->dropColumn('et_ophtrconsent_procedure','deleted');
		$this->dropColumn('et_ophtrconsent_procedure_add_procs_add_procs','deleted');
		$this->dropColumn('et_ophtrconsent_procedure_proc_defaults','deleted');
		$this->dropColumn('et_ophtrconsent_procedure_procedures_procedures','deleted');
		$this->dropColumn('et_ophtrconsent_type','deleted');
		$this->dropColumn('et_ophtrconsent_type_type','deleted');
	}
}
