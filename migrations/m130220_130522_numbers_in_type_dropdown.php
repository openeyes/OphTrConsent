<?php

class m130220_130522_numbers_in_type_dropdown extends CDbMigration
{
	public function up()
	{
		$this->update('et_ophtrconsent_type_type',array('name'=>'1. Patient agreement to investigation or treatment'),'id=1');
		$this->update('et_ophtrconsent_type_type',array('name'=>'2. Parental agreement to investigation or treatment for a child or young person'),'id=2');
		$this->update('et_ophtrconsent_type_type',array('name'=>'3. Patient/parental agreement to investigation or treatment (procedures where consciousness not impaired)'),'id=3');
		$this->update('et_ophtrconsent_type_type',array('name'=>'4. Form for adults who are unable to consent to investigation or treatment'),'id=4');
	}

	public function down()
	{
		$this->update('et_ophtrconsent_type_type',array('name'=>'Patient agreement to investigation or treatment'),'id=1');
		$this->update('et_ophtrconsent_type_type',array('name'=>'Parental agreement to investigation or treatment for a child or young person'),'id=2');
		$this->update('et_ophtrconsent_type_type',array('name'=>'Patient/parental agreement to investigation or treatment (procedures where consciousness not impaired)'),'id=3');
		$this->update('et_ophtrconsent_type_type',array('name'=>'Form for adults who are unable to consent to investigation or treatment'),'id=4');
	}
}
