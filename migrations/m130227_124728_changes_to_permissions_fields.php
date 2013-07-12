<?php

class m130227_124728_changes_to_permissions_fields extends CDbMigration
{
	public function up()
	{
		$this->dropForeignKey('et_ophtrconsent_permissions_tissues_fk','et_ophtrconsent_permissions');
		$this->dropIndex('et_ophtrconsent_permissions_tissues_fk','et_ophtrconsent_permissions');
		$this->dropColumn('et_ophtrconsent_permissions','tissues_id');

		$this->dropTable('et_ophtrconsent_permissions_tissues');

		$this->dropColumn('et_ophtrconsent_permissions','images');

		$this->createTable('et_ophtrconsent_permissions_images', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophtrconsent_permissions_images_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophtrconsent_permissions_images_cui_fk` (`created_user_id`)',
				'CONSTRAINT `et_ophtrconsent_permissions_images_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophtrconsent_permissions_images_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('et_ophtrconsent_permissions_images',array('id'=>1,'name'=>'Yes'));
		$this->insert('et_ophtrconsent_permissions_images',array('id'=>2,'name'=>'No'));
		$this->insert('et_ophtrconsent_permissions_images',array('id'=>3,'name'=>'Not applicable'));

		$this->addColumn('et_ophtrconsent_permissions','images_id','int(10) unsigned NOT NULL DEFAULT 3');
		$this->createIndex('et_ophtrconsent_permissions_images_fk','et_ophtrconsent_permissions','images_id');
		$this->addForeignKey('et_ophtrconsent_permissions_images_fk','et_ophtrconsent_permissions','images_id','et_ophtrconsent_permissions_images','id');
	}

	public function down()
	{
		$this->dropForeignKey('et_ophtrconsent_permissions_images_fk','et_ophtrconsent_permissions');
		$this->dropIndex('et_ophtrconsent_permissions_images_fk','et_ophtrconsent_permissions');
		$this->dropColumn('et_ophtrconsent_permissions','images_id');

		$this->dropTable('et_ophtrconsent_permissions_images');

		$this->addColumn('et_ophtrconsent_permissions','images','tinyint(1) unsigned NOT NULL');

		$this->createTable('et_ophtrconsent_permissions_tissues', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophtrconsent_permissions_tissues_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophtrconsent_permissions_tissues_cui_fk` (`created_user_id`)',
				'CONSTRAINT `et_ophtrconsent_permissions_tissues_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophtrconsent_permissions_tissues_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('et_ophtrconsent_permissions_tissues',array('name'=>'Keep for education, audit, and research','display_order'=>1));
		$this->insert('et_ophtrconsent_permissions_tissues',array('name'=>'Disposal','display_order'=>2));

		$this->addColumn('et_ophtrconsent_permissions','tissues_id','int(10) unsigned NOT NULL');
		$this->createIndex('et_ophtrconsent_permissions_tissues_fk','et_ophtrconsent_permissions','tissues_id');
		$this->addForeignKey('et_ophtrconsent_permissions_tissues_fk','et_ophtrconsent_permissions','tissues_id','et_ophtrconsent_permissions_tissues','id');
	}
}
