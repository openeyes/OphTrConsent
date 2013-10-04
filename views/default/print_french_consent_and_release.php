<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2012
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2012, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */
?>
<style type="text/css">
	.orbis_patient_name { text-decoration: underline; }
</style>

<h1>Consent and release</h1>
<p>The "Undersigned" shall mean the patient, provided that the patient is age 18 or older, or the patient's legal guardian.  Execution of this Consent and Release ("Release") is optional and will not prevent the patient from receiving medical treatment from Project ORBIS International, Inc., its affiliates, subsidiaries and branch offices (collectively "ORBIS").  The Undersigned has the right to at any time request the cessation of the production of recordings, films and the like and ORBIS agrees to take the steps necessary to accommodate such cessation.</p>
<p>For valuable consideration, the receipt of which is hereby acknowledged, the Undersigned consents to being interviewed, photographed, videotaped, recorded in connection with an ORBIS program, including during any medical operation(s) and procedure(s), and to the reproduction of the foregoing by any means available including, but not limited to print, film, radio and television broadcasts, multimedia, video, audio and over the internet (collectively "Patient Material").</p>
<p>The Undersigned relinquishes and grants to ORBIS, on a royalty free basis, all right, title and interest in the Patient Material.  The Undersigned consents to the use of Patient Material in any way that may be useful for the advancement or dissemination of medical knowledge, education or teaching purposes, raise awareness and to promote ORBIS, including without limitation the right to give, sell, transfer, display, and exhibit the Patient Material and copies thereof and to circulate the same in any manner.  The Undersigned waives the right to inspect, approve or edit any Patient Material and any descriptive or advertising material used in connection therewith.</p>
<p>The Undersigned releases, discharges, and agrees to hold harmless ORBIS, its officers, directors, employees, representatives, agents, assigns, and any person(s) or corporation(s) acting under permission or authority of ORBIS, including any firm publishing and/or distributing the Patient Material from or against any liability as a result of any use of the Patient Material and any distortion, blurring or alteration, or use in composite form, either intentionally or otherwise, that may occur or be produced in the taking, processing, reproduction, distribution, broadcast or use of the Patient Material, even should the same create any type of negative perception of the patient.</p>
<p>This Release is made on behalf of myself, my dependents, heirs, executors, administrators and assigns, and is to be governed by the laws of the State of New York.  The Undersigned hereby represents and certifies that he/she has read the foregoing and fully understands the meaning and effect thereof, and intends to be legally bound, executes this Release this <?php echo date('jS')?> day of <?php echo date('F')?>, <?php echo date('Y')?>.</p>
<table>
	<thead>
		<tr><th></th><th></th></tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<p>
					__________________________<br/>
					Signature of Patient/Guardian
				</p>
			</td>
			<td>
				<p>
					<span class="orbis_patient_name"><?php echo $patient->fullName?></span><br/>
					Patient Name
				</p>
			</td>
		</tr>
		<tr>
			<td>
				<p>
					__________________________<br/>
					Thumbprint if necessary
				</p>
			</td>
		</tr>
	</tbody>
</table>
