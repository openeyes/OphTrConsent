<?php

class m130114_133823_link_consent_form_to_operation_event extends CDbMigration
{
	public function up()
	{
		$this->addColumn('et_ophtrconsent_procedure','booking_event_id','int(10) unsigned NULL');
		$this->createIndex('et_ophtrconsent_procedure_booking_event_id_fk','et_ophtrconsent_procedure','booking_event_id');
		$this->addForeignKey('et_ophtrconsent_procedure_booking_event_id_fk','et_ophtrconsent_procedure','booking_event_id','event','id');
	}

	public function down()
	{
		$this->dropForeignKey('et_ophtrconsent_procedure','booking_event_id');
		$this->dropIndex('et_ophtrconsent_procedure','booking_event_id');
		$this->dropColumn('et_ophtrconsent_procedure','booking_event_id');
	}
}
