<?php

class m130909_111400_anaesthetic_type_sort extends OEMigration
{
	public function up()
	{
		$migrations_path = dirname(__FILE__);
		$this->initialiseData($migrations_path, 'code');
	}

	public function down()
	{
	}
}