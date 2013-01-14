<?php

class m130111_145225_witness_name extends CDbMigration
{
	public function up()
	{
		$this->addColumn('et_ophtrconsent_other','witness_name','varchar(255) COLLATE utf8_bin');
		$this->addColumn('et_ophtrconsent_other','interpreter_name','varchar(255) COLLATE utf8_bin');
	}

	public function down()
	{
		$this->dropColumn('et_ophtrconsent_other','witness_name');
		$this->dropColumn('et_ophtrconsent_other','interpreter_name');
	}
}
