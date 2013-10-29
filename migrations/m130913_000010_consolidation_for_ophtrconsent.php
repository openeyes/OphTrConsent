<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */

class m130913_000010_consolidation_for_ophtrconsent extends OEMigration
{
	private  $element_types ;

	public function setData(){
		$this->element_types = array(
			'Element_OphTrConsent_Type' => array('name' => 'Type', 'display_order'=>10),
			'Element_OphTrConsent_Procedure' => array('name' => 'Procedure', 'display_order'=>30),
			'Element_OphTrConsent_BenefitsAndRisks' => array('name' => 'Benefits and risks', 'display_order'=>40),
			'Element_OphTrConsent_Permissions' => array('name' => 'Permissions for images', 'display_order'=>50),
			'Element_OphTrConsent_Other' => array('name' => 'Other', 'display_order'=>60),
			'Element_OphTrConsent_Leaflets' => array('name' => 'Leaflets', 'display_order'=>20),
		);
	}

	public function up()
	{
		$this->setData();
		//disable foreign keys check
		$this->execute("SET foreign_key_checks = 0");

		Yii::app()->cache->flush();

		$event_type_id = $this->insertOEEventType( 'Consent form', 'OphTrConsent', 'Tr');
		$this->insertOEElementType($this->element_types , $event_type_id);

		$this->execute("CREATE TABLE `et_ophtrconsent_benfitrisk` (
			  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			  `event_id` int(10) unsigned NOT NULL,
			  `benefits` text COLLATE utf8_bin,
			  `risks` text COLLATE utf8_bin,
			  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
			  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
			  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
			  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
			  PRIMARY KEY (`id`),
			  KEY `et_ophtrconsent_benfitrisk_lmui_fk` (`last_modified_user_id`),
			  KEY `et_ophtrconsent_benfitrisk_cui_fk` (`created_user_id`),
			  KEY `et_ophtrconsent_benfitrisk_ev_fk` (`event_id`),
			  CONSTRAINT `et_ophtrconsent_benfitrisk_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
			  CONSTRAINT `et_ophtrconsent_benfitrisk_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
			  CONSTRAINT `et_ophtrconsent_benfitrisk_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->execute("CREATE TABLE `et_ophtrconsent_leaflets` (
			  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			  `event_id` int(10) unsigned NOT NULL,
			  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
			  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
			  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
			  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
			  PRIMARY KEY (`id`),
			  KEY `et_ophtrconsent_leaflets_lmui_fk` (`last_modified_user_id`),
			  KEY `et_ophtrconsent_leaflets_cui_fk` (`created_user_id`),
			  KEY `et_ophtrconsent_leaflets_ev_fk` (`event_id`),
			  CONSTRAINT `et_ophtrconsent_leaflets_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
			  CONSTRAINT `et_ophtrconsent_leaflets_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
			  CONSTRAINT `et_ophtrconsent_leaflets_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->execute("CREATE TABLE `et_ophtrconsent_other` (
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
			  KEY `et_ophtrconsent_other_lmui_fk` (`last_modified_user_id`),
			  KEY `et_ophtrconsent_other_cui_fk` (`created_user_id`),
			  KEY `et_ophtrconsent_other_ev_fk` (`event_id`),
			  KEY `et_ophtrconsent_other_consultant_id_fk` (`consultant_id`),
			  CONSTRAINT `et_ophtrconsent_other_consultant_id_fk` FOREIGN KEY (`consultant_id`) REFERENCES `user` (`id`),
			  CONSTRAINT `et_ophtrconsent_other_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
			  CONSTRAINT `et_ophtrconsent_other_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
			  CONSTRAINT `et_ophtrconsent_other_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->execute("CREATE TABLE `et_ophtrconsent_permissions` (
			  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			  `event_id` int(10) unsigned NOT NULL,
			  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
			  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
			  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
			  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
			  `images_id` int(10) unsigned NOT NULL DEFAULT '3',
			  PRIMARY KEY (`id`),
			  KEY `et_ophtrconsent_permissions_lmui_fk` (`last_modified_user_id`),
			  KEY `et_ophtrconsent_permissions_cui_fk` (`created_user_id`),
			  KEY `et_ophtrconsent_permissions_ev_fk` (`event_id`),
			  KEY `et_ophtrconsent_permissions_images_fk` (`images_id`),
			  CONSTRAINT `et_ophtrconsent_permissions_images_fk` FOREIGN KEY (`images_id`) REFERENCES `et_ophtrconsent_permissions_images` (`id`),
			  CONSTRAINT `et_ophtrconsent_permissions_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
			  CONSTRAINT `et_ophtrconsent_permissions_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
			  CONSTRAINT `et_ophtrconsent_permissions_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->execute("CREATE TABLE `et_ophtrconsent_permissions_images` (
			  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			  `name` varchar(128) COLLATE utf8_bin NOT NULL,
			  `display_order` int(10) unsigned NOT NULL DEFAULT '1',
			  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
			  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
			  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
			  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
			  PRIMARY KEY (`id`),
			  KEY `et_ophtrconsent_permissions_images_lmui_fk` (`last_modified_user_id`),
			  KEY `et_ophtrconsent_permissions_images_cui_fk` (`created_user_id`),
			  CONSTRAINT `et_ophtrconsent_permissions_images_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
			  CONSTRAINT `et_ophtrconsent_permissions_images_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
			) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->execute("CREATE TABLE `et_ophtrconsent_procedure` (
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
			  KEY `et_ophtrconsent_procedure_lmui_fk` (`last_modified_user_id`),
			  KEY `et_ophtrconsent_procedure_cui_fk` (`created_user_id`),
			  KEY `et_ophtrconsent_procedure_ev_fk` (`event_id`),
			  KEY `et_ophtrconsent_procedure_eye_id_fk` (`eye_id`),
			  KEY `et_ophtrconsent_procedure_anaesthetic_type_id_fk` (`anaesthetic_type_id`),
			  KEY `et_ophtrconsent_procedure_booking_event_id_fk` (`booking_event_id`),
			  CONSTRAINT `et_ophtrconsent_procedure_booking_event_id_fk` FOREIGN KEY (`booking_event_id`) REFERENCES `event` (`id`),
			  CONSTRAINT `et_ophtrconsent_procedure_anaesthetic_type_id_fk` FOREIGN KEY (`anaesthetic_type_id`) REFERENCES `anaesthetic_type` (`id`),
			  CONSTRAINT `et_ophtrconsent_procedure_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
			  CONSTRAINT `et_ophtrconsent_procedure_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
			  CONSTRAINT `et_ophtrconsent_procedure_eye_id_fk` FOREIGN KEY (`eye_id`) REFERENCES `eye` (`id`),
			  CONSTRAINT `et_ophtrconsent_procedure_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->execute("CREATE TABLE `et_ophtrconsent_procedure_add_procs_add_procs` (
			  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			  `element_id` int(10) unsigned NOT NULL,
			  `proc_id` int(10) unsigned NOT NULL,
			  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
			  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
			  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
			  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
			  PRIMARY KEY (`id`),
			  KEY `et_ophtrconsent_procedure_add_procs_add_procs_lmui_fk` (`last_modified_user_id`),
			  KEY `et_ophtrconsent_procedure_add_procs_add_procs_cui_fk` (`created_user_id`),
			  KEY `et_ophtrconsent_procedure_add_procs_add_procs_ele_fk` (`element_id`),
			  KEY `et_ophtrconsent_procedure_add_procs_add_procs_lku_fk` (`proc_id`),
			  CONSTRAINT `et_ophtrconsent_procedure_add_procs_add_procs_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
			  CONSTRAINT `et_ophtrconsent_procedure_add_procs_add_procs_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
			  CONSTRAINT `et_ophtrconsent_procedure_add_procs_add_procs_ele_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophtrconsent_procedure` (`id`),
			  CONSTRAINT `et_ophtrconsent_procedure_add_procs_add_procs_lku_fk` FOREIGN KEY (`proc_id`) REFERENCES `proc` (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->execute("CREATE TABLE `et_ophtrconsent_procedure_proc_defaults` (
			  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			  `value_id` int(10) unsigned NOT NULL,
			  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
			  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
			  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
			  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
			  PRIMARY KEY (`id`),
			  KEY `et_ophtrconsent_procedure_proc_defaults_lmui_fk` (`last_modified_user_id`),
			  KEY `et_ophtrconsent_procedure_proc_defaults_cui_fk` (`created_user_id`),
			  CONSTRAINT `et_ophtrconsent_procedure_proc_defaults_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
			  CONSTRAINT `et_ophtrconsent_procedure_proc_defaults_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->execute("CREATE TABLE `et_ophtrconsent_procedure_procedures_procedures` (
			  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			  `element_id` int(10) unsigned NOT NULL,
			  `proc_id` int(10) unsigned NOT NULL,
			  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
			  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
			  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
			  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
			  PRIMARY KEY (`id`),
			  KEY `et_ophtrconsent_procedure_procedures_procedures_lmui_fk` (`last_modified_user_id`),
			  KEY `et_ophtrconsent_procedure_procedures_procedures_cui_fk` (`created_user_id`),
			  KEY `et_ophtrconsent_procedure_procedures_procedures_ele_fk` (`element_id`),
			  KEY `et_ophtrconsent_procedure_procedures_procedures_lku_fk` (`proc_id`),
			  CONSTRAINT `et_ophtrconsent_procedure_procedures_procedures_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
			  CONSTRAINT `et_ophtrconsent_procedure_procedures_procedures_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
			  CONSTRAINT `et_ophtrconsent_procedure_procedures_procedures_ele_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophtrconsent_procedure` (`id`),
			  CONSTRAINT `et_ophtrconsent_procedure_procedures_procedures_lku_fk` FOREIGN KEY (`proc_id`) REFERENCES `proc` (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->execute("CREATE TABLE `et_ophtrconsent_type` (
			  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			  `event_id` int(10) unsigned NOT NULL,
			  `type_id` int(10) unsigned NOT NULL,
			  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
			  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
			  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
			  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
			  PRIMARY KEY (`id`),
			  KEY `et_ophtrconsent_type_lmui_fk` (`last_modified_user_id`),
			  KEY `et_ophtrconsent_type_cui_fk` (`created_user_id`),
			  KEY `et_ophtrconsent_type_ev_fk` (`event_id`),
			  KEY `et_ophtrconsent_type_type_fk` (`type_id`),
			  CONSTRAINT `et_ophtrconsent_type_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
			  CONSTRAINT `et_ophtrconsent_type_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
			  CONSTRAINT `et_ophtrconsent_type_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
			  CONSTRAINT `et_ophtrconsent_type_type_fk` FOREIGN KEY (`type_id`) REFERENCES `et_ophtrconsent_type_type` (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->execute("CREATE TABLE `et_ophtrconsent_type_type` (
			  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			  `name` varchar(128) COLLATE utf8_bin NOT NULL,
			  `display_order` int(10) unsigned NOT NULL DEFAULT '1',
			  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
			  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
			  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
			  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
			  PRIMARY KEY (`id`),
			  KEY `et_ophtrconsent_type_type_lmui_fk` (`last_modified_user_id`),
			  KEY `et_ophtrconsent_type_type_cui_fk` (`created_user_id`),
			  CONSTRAINT `et_ophtrconsent_type_type_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
			  CONSTRAINT `et_ophtrconsent_type_type_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
			) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->execute("CREATE TABLE `ophtrconsent_leaflet` (
			  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			  `name` varchar(1024) COLLATE utf8_bin NOT NULL,
			  `display_order` int(10) unsigned NOT NULL DEFAULT '1',
			  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
			  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
			  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
			  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
			  PRIMARY KEY (`id`),
			  KEY `ophtrconsent_leaflet_lmui_fk` (`last_modified_user_id`),
			  KEY `ophtrconsent_leaflet_cui_fk` (`created_user_id`),
			  CONSTRAINT `ophtrconsent_leaflet_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
			  CONSTRAINT `ophtrconsent_leaflet_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->execute("CREATE TABLE `ophtrconsent_leaflet_firm` (
			  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			  `leaflet_id` int(10) unsigned NOT NULL,
			  `firm_id` int(10) unsigned DEFAULT NULL,
			  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
			  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
			  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
			  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
			  PRIMARY KEY (`id`),
			  KEY `ophtrconsent_leaflet_firm_leaflet_id_fk` (`leaflet_id`),
			  KEY `ophtrconsent_leaflet_firm_firm_id_fk` (`firm_id`),
			  KEY `ophtrconsent_leaflet_firm_lmui_fk` (`last_modified_user_id`),
			  KEY `ophtrconsent_leaflet_firm_cui_fk` (`created_user_id`),
			  CONSTRAINT `ophtrconsent_leaflet_firm_leaflet_id_fk` FOREIGN KEY (`leaflet_id`) REFERENCES `ophtrconsent_leaflet` (`id`),
			  CONSTRAINT `ophtrconsent_leaflet_firm_firm_id_fk` FOREIGN KEY (`firm_id`) REFERENCES `firm` (`id`),
			  CONSTRAINT `ophtrconsent_leaflet_firm_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
			  CONSTRAINT `ophtrconsent_leaflet_firm_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->execute("CREATE TABLE `ophtrconsent_leaflet_subspecialty` (
			  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			  `leaflet_id` int(10) unsigned NOT NULL,
			  `subspecialty_id` int(10) unsigned DEFAULT NULL,
			  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
			  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
			  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
			  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
			  PRIMARY KEY (`id`),
			  KEY `ophtrconsent_leaflet_subspecialty_leaflet_id_fk` (`leaflet_id`),
			  KEY `ophtrconsent_leaflet_subspecialty_subspecialty_id_fk` (`subspecialty_id`),
			  KEY `ophtrconsent_leaflet_subspecialty_lmui_fk` (`last_modified_user_id`),
			  KEY `ophtrconsent_leaflet_subspecialty_cui_fk` (`created_user_id`),
			  CONSTRAINT `ophtrconsent_leaflet_subspecialty_leaflet_id_fk` FOREIGN KEY (`leaflet_id`) REFERENCES `ophtrconsent_leaflet` (`id`),
			  CONSTRAINT `ophtrconsent_leaflet_subspecialty_subspecialty_id_fk` FOREIGN KEY (`subspecialty_id`) REFERENCES `subspecialty` (`id`),
			  CONSTRAINT `ophtrconsent_leaflet_subspecialty_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
			  CONSTRAINT `ophtrconsent_leaflet_subspecialty_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->execute("CREATE TABLE `ophtrconsent_leaflets` (
			  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			  `element_id` int(10) unsigned NOT NULL,
			  `leaflet_id` int(10) unsigned NOT NULL,
			  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
			  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
			  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
			  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
			  PRIMARY KEY (`id`),
			  KEY `ophtrconsent_leaflets_lmui_fk` (`last_modified_user_id`),
			  KEY `ophtrconsent_leaflets_cui_fk` (`created_user_id`),
			  KEY `ophtrconsent_leaflets_el_fk` (`element_id`),
			  KEY `ophtrconsent_leaflets_le_fk` (`leaflet_id`),
			  CONSTRAINT `ophtrconsent_leaflets_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
			  CONSTRAINT `ophtrconsent_leaflets_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
			  CONSTRAINT `ophtrconsent_leaflets_le_fk` FOREIGN KEY (`leaflet_id`) REFERENCES `ophtrconsent_leaflet` (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$migrations_path = dirname(__FILE__);
		$this->initialiseData($migrations_path);

		//enable foreign keys check
		$this->execute("SET foreign_key_checks = 1");

	}

	public function down()
	{
		echo "Down method not supported on consolidation";
	}
}
