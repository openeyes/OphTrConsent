<?php

class m131204_164708_table_versioning extends CDbMigration
{
	public function up()
	{
		$this->execute("
CREATE TABLE `et_ophtrconsent_benfitrisk_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(10) unsigned NOT NULL,
  `benefits` text COLLATE utf8_bin,
  `risks` text COLLATE utf8_bin,
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `acv_et_ophtrconsent_benfitrisk_lmui_fk` (`last_modified_user_id`),
  KEY `acv_et_ophtrconsent_benfitrisk_cui_fk` (`created_user_id`),
  KEY `acv_et_ophtrconsent_benfitrisk_ev_fk` (`event_id`),
  CONSTRAINT `acv_et_ophtrconsent_benfitrisk_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_et_ophtrconsent_benfitrisk_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_et_ophtrconsent_benfitrisk_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('et_ophtrconsent_benfitrisk_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','et_ophtrconsent_benfitrisk_version');

		$this->createIndex('et_ophtrconsent_benfitrisk_aid_fk','et_ophtrconsent_benfitrisk_version','id');
		$this->addForeignKey('et_ophtrconsent_benfitrisk_aid_fk','et_ophtrconsent_benfitrisk_version','id','et_ophtrconsent_benfitrisk','id');

		$this->addColumn('et_ophtrconsent_benfitrisk_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('et_ophtrconsent_benfitrisk_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','et_ophtrconsent_benfitrisk_version','version_id');
		$this->alterColumn('et_ophtrconsent_benfitrisk_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `et_ophtrconsent_leaflets_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(10) unsigned NOT NULL,
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `acv_et_ophtrconsent_leaflets_lmui_fk` (`last_modified_user_id`),
  KEY `acv_et_ophtrconsent_leaflets_cui_fk` (`created_user_id`),
  KEY `acv_et_ophtrconsent_leaflets_ev_fk` (`event_id`),
  CONSTRAINT `acv_et_ophtrconsent_leaflets_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_et_ophtrconsent_leaflets_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_et_ophtrconsent_leaflets_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('et_ophtrconsent_leaflets_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','et_ophtrconsent_leaflets_version');

		$this->createIndex('et_ophtrconsent_leaflets_aid_fk','et_ophtrconsent_leaflets_version','id');
		$this->addForeignKey('et_ophtrconsent_leaflets_aid_fk','et_ophtrconsent_leaflets_version','id','et_ophtrconsent_leaflets','id');

		$this->addColumn('et_ophtrconsent_leaflets_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('et_ophtrconsent_leaflets_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','et_ophtrconsent_leaflets_version','version_id');
		$this->alterColumn('et_ophtrconsent_leaflets_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `et_ophtrconsent_other_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(10) unsigned NOT NULL,
  `information` tinyint(1) unsigned NOT NULL,
  `witness_required` tinyint(1) unsigned NOT NULL,
  `interpreter_required` tinyint(1) unsigned NOT NULL,
  `parent_guardian` varchar(255) COLLATE utf8_bin DEFAULT '',
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `witness_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `interpreter_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `anaesthetic_leaflet` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `consultant_id` int(10) unsigned NOT NULL,
  `include_supplementary_consent` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `acv_et_ophtrconsent_other_lmui_fk` (`last_modified_user_id`),
  KEY `acv_et_ophtrconsent_other_cui_fk` (`created_user_id`),
  KEY `acv_et_ophtrconsent_other_ev_fk` (`event_id`),
  KEY `acv_et_ophtrconsent_other_consultant_id_fk` (`consultant_id`),
  CONSTRAINT `acv_et_ophtrconsent_other_consultant_id_fk` FOREIGN KEY (`consultant_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_et_ophtrconsent_other_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_et_ophtrconsent_other_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
  CONSTRAINT `acv_et_ophtrconsent_other_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('et_ophtrconsent_other_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','et_ophtrconsent_other_version');

		$this->createIndex('et_ophtrconsent_other_aid_fk','et_ophtrconsent_other_version','id');
		$this->addForeignKey('et_ophtrconsent_other_aid_fk','et_ophtrconsent_other_version','id','et_ophtrconsent_other','id');

		$this->addColumn('et_ophtrconsent_other_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('et_ophtrconsent_other_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','et_ophtrconsent_other_version','version_id');
		$this->alterColumn('et_ophtrconsent_other_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `et_ophtrconsent_permissions_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(10) unsigned NOT NULL,
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `images_id` int(10) unsigned NOT NULL DEFAULT '3',
  PRIMARY KEY (`id`),
  KEY `acv_et_ophtrconsent_permissions_lmui_fk` (`last_modified_user_id`),
  KEY `acv_et_ophtrconsent_permissions_cui_fk` (`created_user_id`),
  KEY `acv_et_ophtrconsent_permissions_ev_fk` (`event_id`),
  KEY `acv_et_ophtrconsent_permissions_images_fk` (`images_id`),
  CONSTRAINT `acv_et_ophtrconsent_permissions_images_fk` FOREIGN KEY (`images_id`) REFERENCES `et_ophtrconsent_permissions_images` (`id`),
  CONSTRAINT `acv_et_ophtrconsent_permissions_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_et_ophtrconsent_permissions_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
  CONSTRAINT `acv_et_ophtrconsent_permissions_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('et_ophtrconsent_permissions_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','et_ophtrconsent_permissions_version');

		$this->createIndex('et_ophtrconsent_permissions_aid_fk','et_ophtrconsent_permissions_version','id');
		$this->addForeignKey('et_ophtrconsent_permissions_aid_fk','et_ophtrconsent_permissions_version','id','et_ophtrconsent_permissions','id');

		$this->addColumn('et_ophtrconsent_permissions_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('et_ophtrconsent_permissions_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','et_ophtrconsent_permissions_version','version_id');
		$this->alterColumn('et_ophtrconsent_permissions_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `et_ophtrconsent_permissions_images_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_bin NOT NULL,
  `display_order` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `acv_et_ophtrconsent_permissions_images_lmui_fk` (`last_modified_user_id`),
  KEY `acv_et_ophtrconsent_permissions_images_cui_fk` (`created_user_id`),
  CONSTRAINT `acv_et_ophtrconsent_permissions_images_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_et_ophtrconsent_permissions_images_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('et_ophtrconsent_permissions_images_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','et_ophtrconsent_permissions_images_version');

		$this->createIndex('et_ophtrconsent_permissions_images_aid_fk','et_ophtrconsent_permissions_images_version','id');
		$this->addForeignKey('et_ophtrconsent_permissions_images_aid_fk','et_ophtrconsent_permissions_images_version','id','et_ophtrconsent_permissions_images','id');

		$this->addColumn('et_ophtrconsent_permissions_images_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('et_ophtrconsent_permissions_images_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','et_ophtrconsent_permissions_images_version','version_id');
		$this->alterColumn('et_ophtrconsent_permissions_images_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `et_ophtrconsent_procedure_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(10) unsigned NOT NULL,
  `eye_id` int(10) unsigned NOT NULL DEFAULT '2',
  `anaesthetic_type_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `booking_event_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `acv_et_ophtrconsent_procedure_lmui_fk` (`last_modified_user_id`),
  KEY `acv_et_ophtrconsent_procedure_cui_fk` (`created_user_id`),
  KEY `acv_et_ophtrconsent_procedure_ev_fk` (`event_id`),
  KEY `acv_et_ophtrconsent_procedure_eye_id_fk` (`eye_id`),
  KEY `acv_et_ophtrconsent_procedure_anaesthetic_type_id_fk` (`anaesthetic_type_id`),
  KEY `acv_et_ophtrconsent_procedure_booking_event_id_fk` (`booking_event_id`),
  CONSTRAINT `acv_et_ophtrconsent_procedure_booking_event_id_fk` FOREIGN KEY (`booking_event_id`) REFERENCES `event` (`id`),
  CONSTRAINT `acv_et_ophtrconsent_procedure_anaesthetic_type_id_fk` FOREIGN KEY (`anaesthetic_type_id`) REFERENCES `anaesthetic_type` (`id`),
  CONSTRAINT `acv_et_ophtrconsent_procedure_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_et_ophtrconsent_procedure_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
  CONSTRAINT `acv_et_ophtrconsent_procedure_eye_id_fk` FOREIGN KEY (`eye_id`) REFERENCES `eye` (`id`),
  CONSTRAINT `acv_et_ophtrconsent_procedure_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('et_ophtrconsent_procedure_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','et_ophtrconsent_procedure_version');

		$this->createIndex('et_ophtrconsent_procedure_aid_fk','et_ophtrconsent_procedure_version','id');
		$this->addForeignKey('et_ophtrconsent_procedure_aid_fk','et_ophtrconsent_procedure_version','id','et_ophtrconsent_procedure','id');

		$this->addColumn('et_ophtrconsent_procedure_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('et_ophtrconsent_procedure_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','et_ophtrconsent_procedure_version','version_id');
		$this->alterColumn('et_ophtrconsent_procedure_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `et_ophtrconsent_procedure_add_procs_add_procs_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `element_id` int(10) unsigned NOT NULL,
  `proc_id` int(10) unsigned NOT NULL,
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `acv_et_ophtrconsent_procedure_add_procs_add_procs_lmui_fk` (`last_modified_user_id`),
  KEY `acv_et_ophtrconsent_procedure_add_procs_add_procs_cui_fk` (`created_user_id`),
  KEY `acv_et_ophtrconsent_procedure_add_procs_add_procs_ele_fk` (`element_id`),
  KEY `acv_et_ophtrconsent_procedure_add_procs_add_procs_lku_fk` (`proc_id`),
  CONSTRAINT `acv_et_ophtrconsent_procedure_add_procs_add_procs_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_et_ophtrconsent_procedure_add_procs_add_procs_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_et_ophtrconsent_procedure_add_procs_add_procs_ele_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophtrconsent_procedure` (`id`),
  CONSTRAINT `acv_et_ophtrconsent_procedure_add_procs_add_procs_lku_fk` FOREIGN KEY (`proc_id`) REFERENCES `proc` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('et_ophtrconsent_procedure_add_procs_add_procs_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','et_ophtrconsent_procedure_add_procs_add_procs_version');

		$this->createIndex('et_ophtrconsent_procedure_add_procs_add_procs_aid_fk','et_ophtrconsent_procedure_add_procs_add_procs_version','id');
		$this->addForeignKey('et_ophtrconsent_procedure_add_procs_add_procs_aid_fk','et_ophtrconsent_procedure_add_procs_add_procs_version','id','et_ophtrconsent_procedure_add_procs_add_procs','id');

		$this->addColumn('et_ophtrconsent_procedure_add_procs_add_procs_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('et_ophtrconsent_procedure_add_procs_add_procs_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','et_ophtrconsent_procedure_add_procs_add_procs_version','version_id');
		$this->alterColumn('et_ophtrconsent_procedure_add_procs_add_procs_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `et_ophtrconsent_procedure_proc_defaults_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `value_id` int(10) unsigned NOT NULL,
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `acv_et_ophtrconsent_procedure_proc_defaults_lmui_fk` (`last_modified_user_id`),
  KEY `acv_et_ophtrconsent_procedure_proc_defaults_cui_fk` (`created_user_id`),
  CONSTRAINT `acv_et_ophtrconsent_procedure_proc_defaults_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_et_ophtrconsent_procedure_proc_defaults_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('et_ophtrconsent_procedure_proc_defaults_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','et_ophtrconsent_procedure_proc_defaults_version');

		$this->createIndex('et_ophtrconsent_procedure_proc_defaults_aid_fk','et_ophtrconsent_procedure_proc_defaults_version','id');
		$this->addForeignKey('et_ophtrconsent_procedure_proc_defaults_aid_fk','et_ophtrconsent_procedure_proc_defaults_version','id','et_ophtrconsent_procedure_proc_defaults','id');

		$this->addColumn('et_ophtrconsent_procedure_proc_defaults_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('et_ophtrconsent_procedure_proc_defaults_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','et_ophtrconsent_procedure_proc_defaults_version','version_id');
		$this->alterColumn('et_ophtrconsent_procedure_proc_defaults_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `et_ophtrconsent_procedure_procedures_procedures_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `element_id` int(10) unsigned NOT NULL,
  `proc_id` int(10) unsigned NOT NULL,
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `acv_et_ophtrconsent_procedure_procedures_procedures_lmui_fk` (`last_modified_user_id`),
  KEY `acv_et_ophtrconsent_procedure_procedures_procedures_cui_fk` (`created_user_id`),
  KEY `acv_et_ophtrconsent_procedure_procedures_procedures_ele_fk` (`element_id`),
  KEY `acv_et_ophtrconsent_procedure_procedures_procedures_lku_fk` (`proc_id`),
  CONSTRAINT `acv_et_ophtrconsent_procedure_procedures_procedures_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_et_ophtrconsent_procedure_procedures_procedures_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_et_ophtrconsent_procedure_procedures_procedures_ele_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophtrconsent_procedure` (`id`),
  CONSTRAINT `acv_et_ophtrconsent_procedure_procedures_procedures_lku_fk` FOREIGN KEY (`proc_id`) REFERENCES `proc` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('et_ophtrconsent_procedure_procedures_procedures_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','et_ophtrconsent_procedure_procedures_procedures_version');

		$this->createIndex('et_ophtrconsent_procedure_procedures_procedures_aid_fk','et_ophtrconsent_procedure_procedures_procedures_version','id');
		$this->addForeignKey('et_ophtrconsent_procedure_procedures_procedures_aid_fk','et_ophtrconsent_procedure_procedures_procedures_version','id','et_ophtrconsent_procedure_procedures_procedures','id');

		$this->addColumn('et_ophtrconsent_procedure_procedures_procedures_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('et_ophtrconsent_procedure_procedures_procedures_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','et_ophtrconsent_procedure_procedures_procedures_version','version_id');
		$this->alterColumn('et_ophtrconsent_procedure_procedures_procedures_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `et_ophtrconsent_type_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(10) unsigned NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `acv_et_ophtrconsent_type_lmui_fk` (`last_modified_user_id`),
  KEY `acv_et_ophtrconsent_type_cui_fk` (`created_user_id`),
  KEY `acv_et_ophtrconsent_type_ev_fk` (`event_id`),
  KEY `acv_et_ophtrconsent_type_type_fk` (`type_id`),
  CONSTRAINT `acv_et_ophtrconsent_type_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_et_ophtrconsent_type_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_et_ophtrconsent_type_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
  CONSTRAINT `acv_et_ophtrconsent_type_type_fk` FOREIGN KEY (`type_id`) REFERENCES `et_ophtrconsent_type_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('et_ophtrconsent_type_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','et_ophtrconsent_type_version');

		$this->createIndex('et_ophtrconsent_type_aid_fk','et_ophtrconsent_type_version','id');
		$this->addForeignKey('et_ophtrconsent_type_aid_fk','et_ophtrconsent_type_version','id','et_ophtrconsent_type','id');

		$this->addColumn('et_ophtrconsent_type_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('et_ophtrconsent_type_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','et_ophtrconsent_type_version','version_id');
		$this->alterColumn('et_ophtrconsent_type_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `et_ophtrconsent_type_type_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_bin NOT NULL,
  `display_order` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `acv_et_ophtrconsent_type_type_lmui_fk` (`last_modified_user_id`),
  KEY `acv_et_ophtrconsent_type_type_cui_fk` (`created_user_id`),
  CONSTRAINT `acv_et_ophtrconsent_type_type_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_et_ophtrconsent_type_type_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('et_ophtrconsent_type_type_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','et_ophtrconsent_type_type_version');

		$this->createIndex('et_ophtrconsent_type_type_aid_fk','et_ophtrconsent_type_type_version','id');
		$this->addForeignKey('et_ophtrconsent_type_type_aid_fk','et_ophtrconsent_type_type_version','id','et_ophtrconsent_type_type','id');

		$this->addColumn('et_ophtrconsent_type_type_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('et_ophtrconsent_type_type_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','et_ophtrconsent_type_type_version','version_id');
		$this->alterColumn('et_ophtrconsent_type_type_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophtrconsent_leaflet_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(1024) COLLATE utf8_bin NOT NULL,
  `display_order` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `acv_ophtrconsent_leaflet_lmui_fk` (`last_modified_user_id`),
  KEY `acv_ophtrconsent_leaflet_cui_fk` (`created_user_id`),
  CONSTRAINT `acv_ophtrconsent_leaflet_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_ophtrconsent_leaflet_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('ophtrconsent_leaflet_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophtrconsent_leaflet_version');

		$this->createIndex('ophtrconsent_leaflet_aid_fk','ophtrconsent_leaflet_version','id');
		$this->addForeignKey('ophtrconsent_leaflet_aid_fk','ophtrconsent_leaflet_version','id','ophtrconsent_leaflet','id');

		$this->addColumn('ophtrconsent_leaflet_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophtrconsent_leaflet_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophtrconsent_leaflet_version','version_id');
		$this->alterColumn('ophtrconsent_leaflet_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophtrconsent_leaflet_firm_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `leaflet_id` int(10) unsigned NOT NULL,
  `firm_id` int(10) unsigned DEFAULT NULL,
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `acv_ophtrconsent_leaflet_firm_leaflet_id_fk` (`leaflet_id`),
  KEY `acv_ophtrconsent_leaflet_firm_firm_id_fk` (`firm_id`),
  KEY `acv_ophtrconsent_leaflet_firm_lmui_fk` (`last_modified_user_id`),
  KEY `acv_ophtrconsent_leaflet_firm_cui_fk` (`created_user_id`),
  CONSTRAINT `acv_ophtrconsent_leaflet_firm_leaflet_id_fk` FOREIGN KEY (`leaflet_id`) REFERENCES `ophtrconsent_leaflet` (`id`),
  CONSTRAINT `acv_ophtrconsent_leaflet_firm_firm_id_fk` FOREIGN KEY (`firm_id`) REFERENCES `firm` (`id`),
  CONSTRAINT `acv_ophtrconsent_leaflet_firm_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_ophtrconsent_leaflet_firm_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('ophtrconsent_leaflet_firm_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophtrconsent_leaflet_firm_version');

		$this->createIndex('ophtrconsent_leaflet_firm_aid_fk','ophtrconsent_leaflet_firm_version','id');
		$this->addForeignKey('ophtrconsent_leaflet_firm_aid_fk','ophtrconsent_leaflet_firm_version','id','ophtrconsent_leaflet_firm','id');

		$this->addColumn('ophtrconsent_leaflet_firm_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophtrconsent_leaflet_firm_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophtrconsent_leaflet_firm_version','version_id');
		$this->alterColumn('ophtrconsent_leaflet_firm_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophtrconsent_leaflet_subspecialty_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `leaflet_id` int(10) unsigned NOT NULL,
  `subspecialty_id` int(10) unsigned DEFAULT NULL,
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `acv_ophtrconsent_leaflet_subspecialty_leaflet_id_fk` (`leaflet_id`),
  KEY `acv_ophtrconsent_leaflet_subspecialty_subspecialty_id_fk` (`subspecialty_id`),
  KEY `acv_ophtrconsent_leaflet_subspecialty_lmui_fk` (`last_modified_user_id`),
  KEY `acv_ophtrconsent_leaflet_subspecialty_cui_fk` (`created_user_id`),
  CONSTRAINT `acv_ophtrconsent_leaflet_subspecialty_leaflet_id_fk` FOREIGN KEY (`leaflet_id`) REFERENCES `ophtrconsent_leaflet` (`id`),
  CONSTRAINT `acv_ophtrconsent_leaflet_subspecialty_subspecialty_id_fk` FOREIGN KEY (`subspecialty_id`) REFERENCES `subspecialty` (`id`),
  CONSTRAINT `acv_ophtrconsent_leaflet_subspecialty_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_ophtrconsent_leaflet_subspecialty_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('ophtrconsent_leaflet_subspecialty_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophtrconsent_leaflet_subspecialty_version');

		$this->createIndex('ophtrconsent_leaflet_subspecialty_aid_fk','ophtrconsent_leaflet_subspecialty_version','id');
		$this->addForeignKey('ophtrconsent_leaflet_subspecialty_aid_fk','ophtrconsent_leaflet_subspecialty_version','id','ophtrconsent_leaflet_subspecialty','id');

		$this->addColumn('ophtrconsent_leaflet_subspecialty_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophtrconsent_leaflet_subspecialty_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophtrconsent_leaflet_subspecialty_version','version_id');
		$this->alterColumn('ophtrconsent_leaflet_subspecialty_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophtrconsent_leaflets_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `element_id` int(10) unsigned NOT NULL,
  `leaflet_id` int(10) unsigned NOT NULL,
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `acv_ophtrconsent_leaflets_lmui_fk` (`last_modified_user_id`),
  KEY `acv_ophtrconsent_leaflets_cui_fk` (`created_user_id`),
  KEY `acv_ophtrconsent_leaflets_el_fk` (`element_id`),
  KEY `acv_ophtrconsent_leaflets_le_fk` (`leaflet_id`),
  CONSTRAINT `acv_ophtrconsent_leaflets_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_ophtrconsent_leaflets_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_ophtrconsent_leaflets_le_fk` FOREIGN KEY (`leaflet_id`) REFERENCES `ophtrconsent_leaflet` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('ophtrconsent_leaflets_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophtrconsent_leaflets_version');

		$this->createIndex('ophtrconsent_leaflets_aid_fk','ophtrconsent_leaflets_version','id');
		$this->addForeignKey('ophtrconsent_leaflets_aid_fk','ophtrconsent_leaflets_version','id','ophtrconsent_leaflets','id');

		$this->addColumn('ophtrconsent_leaflets_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophtrconsent_leaflets_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophtrconsent_leaflets_version','version_id');
		$this->alterColumn('ophtrconsent_leaflets_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');
	}

	public function down()
	{
		$this->dropTable('et_ophtrconsent_benfitrisk_version');
		$this->dropTable('et_ophtrconsent_leaflets_version');
		$this->dropTable('et_ophtrconsent_other_version');
		$this->dropTable('et_ophtrconsent_permissions_version');
		$this->dropTable('et_ophtrconsent_permissions_images_version');
		$this->dropTable('et_ophtrconsent_procedure_version');
		$this->dropTable('et_ophtrconsent_procedure_add_procs_add_procs_version');
		$this->dropTable('et_ophtrconsent_procedure_proc_defaults_version');
		$this->dropTable('et_ophtrconsent_procedure_procedures_procedures_version');
		$this->dropTable('et_ophtrconsent_type_version');
		$this->dropTable('et_ophtrconsent_type_type_version');
		$this->dropTable('ophtrconsent_leaflet_version');
		$this->dropTable('ophtrconsent_leaflet_firm_version');
		$this->dropTable('ophtrconsent_leaflet_subspecialty_version');
		$this->dropTable('ophtrconsent_leaflets_version');
	}
}
