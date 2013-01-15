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
<h1>CONSENT TO OPERATION OR OTHER PROCEDURES</h1>
<p>
	Patient: <strong><?php echo $this->patient->fullName?></strong> (the "Patient") Hospital no: <strong><?php echo $this->patient->hos_num?></strong>
</p>
<?php if ($elements['Element_OphTrConsent_Other']->parent_guardian) {?>
	<p>
		Parent/guardian: <?php echo $elements['Element_OphTrConsent_Other']->parent_guardian?>
	</p>
<?php }?>
<p>
	I hereby authorise <?php if ($this->patient->gp) { echo $this->patient->gp->contact->fullName; } else { echo "____________________________"; }?> (the "Doctor") and other such doctors, consultants, fellows or assistants, as the hospital may designate to perform upon me or the above-named Patient the following operation(s) and/or procedure(s):
</p>
<ul>
	<?php foreach ($elements['Element_OphTrConsent_Procedure']->procedures as $proc) {?>
		<li><?php echo $elements['Element_OphTrConsent_Procedure']->eye->adjective?> <?php echo $proc->term?></li>
	<?php }?>
</ul>
<p>
	In addition I hereby authorise the personnel named in the previous clause to perform the following additional operation(s) or procedures(s) which may become necessary during the course of the main procedure(s):
</p>
<ul>
	<?php foreach ($elements['Element_OphTrConsent_Procedure']->additional_procedures as $proc) {?>
		<li><?php echo $elements['Element_OphTrConsent_Procedure']->eye->adjective?> <?php echo $proc->term?></li>
	<?php }?>
</ul>
<p>
	I understand that the potential benefits of undergoing the procedure(s) are:
</p>
<ul>
	<?php foreach (explode(', ',trim($elements['Element_OphTrConsent_BenefitsAndRisks']->benefits)) as $benefit) {?>
		<li><?php echo ucfirst($benefit)?></li>
	<?php }?>
</ul>
<p>
	I also understand that the potential risks of the undergoing the procedure(s) are:
</p>
<ul>
	<?php foreach (explode(', ',trim($elements['Element_OphTrConsent_BenefitsAndRisks']->risks)) as $risk) {?>
		<li><?php echo ucfirst($risk)?></li>
	<?php }?>
</ul>
<p>
	I understand that I will be given a <?php echo $elements['Element_OphTrConsent_Procedure']->anaesthetic_type->name?> anaesthetic.
</p>
<p>
	I have been fully advised of the potential risks and benefits of the procedure(s) listed above and give my full consent for the procedure(s) to be performed.  I acknowledge that I consent to the procedure(s) entirely at my own risk and agree not to hold any of the personnel involved responsible for any possible consequences that may arise.
</p>
<?php if ($elements['Element_OphTrConsent_Permissions']->tissues_id == 1) {?>
	<p>
		I hereby give consent for my tissues to be kept for education, auditing and research.
	</p>
<?php }?>
<?php if ($elements['Element_OphTrConsent_Other']->information) {?>
	<p>
		I have been given an information leaflet that describes in-depth the procedure(s) which will be carried out.
	</p>
<?php }?>
<p></p><p></p>
<table>
	<thead>
		<tr><th></th><th></th></tr>
		<?php if ($elements['Element_OphTrConsent_Other']->witness_required) {?>
			<tr><th></th><th></th></tr>
			<tr><th></th><th></th></tr>
		<?php }?>
		<?php if ($elements['Element_OphTrConsent_Other']->interpreter_required) {?>
			<tr><th></th><th></th></tr>
			<tr><th></th><th></th></tr>
		<?php }?>
	</thead>
	<tbody>
		<tr>
			<td>
				<p>
					________________________<br/>
					Signature of Patient/Guardian
				</p>
			</td>
			<td>
				<p>
					________________________<br/>
					Date of signature
				</p>
			</td>
		</tr>
		<?php if ($elements['Element_OphTrConsent_Other']->witness_required) {?>
			<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
			<tr>
				<td>
					<p>
						________________________<br/>
						<?php echo $elements['Element_OphTrConsent_Other']->witness_name?> (Witness)
					</p>
				</td>
				<td>
					<p>
						________________________<br/>
						Date of signature
					</p>
				</td>
			</tr>
		<?php }?>
		<?php if ($elements['Element_OphTrConsent_Other']->interpreter_required) {?>
			<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
			<tr>
				<td>
					<p>
						________________________<br/>
						<?php echo $elements['Element_OphTrConsent_Other']->interpreter_name?> (Intepreter)
					</p>
				</td>
				<td>
					<p>
						________________________<br/>
						Date of signature
					</p>
				</td>
			</tr>
		<?php }?>
	</tbody>
</table>
