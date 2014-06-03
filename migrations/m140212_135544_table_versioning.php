<?php

class m140212_135544_table_versioning extends OEMigration
{
	public function up()
	{
		$this->addColumn('ophtrconsent_type_type', 'active', 'boolean not null default true');
		$this->addColumn('ophtrconsent_leaflet', 'active', 'boolean not null default true');
	}

	public function down()
	{
		$this->dropColumn('ophtrconsent_leaflet', 'active');
		$this->dropColumn('ophtrconsent_type_type', 'active');
	}
}
