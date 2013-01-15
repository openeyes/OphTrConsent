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
<h1>CONSENTEMENT À L'OPÉRATION OU AUTRES PROCÉDURES</h1>
<p>
	Patient: <strong><?php echo $this->patient->fullName?></strong> (le "Patient") Numéro de l'hôpital: <strong><?php echo $this->patient->hos_num?></strong>
</p>
<?php if ($elements['Element_OphTrConsent_Other']->parent_guardian) {?>
	<p>
		Parent/tuteur: <?php echo $elements['Element_OphTrConsent_Other']->parent_guardian?>
	</p>
<?php }?>
<p>
	J'autorise par la présente <?php if ($this->patient->gp) { echo $this->patient->gp->contact->fullName; } else { echo "____________________________"; }?> (le "médecin") et d'autres tels médecins, des consultants, des stagiaires ou assistants, que l'hôpital peut désigner à effectuer sur moi ou que le patient mentionné ci-dessus l'opération suivante (s) et / ou de la procédure (s):
</p>
<ul>
	<?php foreach ($elements['Element_OphTrConsent_Procedure']->procedures as $proc) {?>
		<li><?php echo $elements['Element_OphTrConsent_Procedure']->eye->adjective?> <?php echo $proc->term?></li>
	<?php }?>
</ul>
<p>
	En outre J'autorise le personnel visé à l'article précédent pour effectuer l'opération suivante (s) supplémentaire ou des procédures (s) qui peuvent s'avérer nécessaires au cours de la procédure principale (s):
</p>
<ul>
	<?php foreach ($elements['Element_OphTrConsent_Procedure']->additional_procedures as $proc) {?>
		<li><?php echo $elements['Element_OphTrConsent_Procedure']->eye->adjective?> <?php echo $proc->term?></li>
	<?php }?>
</ul>
<p>
	Je comprends que les avantages potentiels de subir la procédure (s) sont les suivants:
</p>
<ul>
	<?php foreach (explode(', ',trim($elements['Element_OphTrConsent_BenefitsAndRisks']->benefits)) as $benefit) {?>
		<li><?php echo ucfirst($benefit)?></li>
	<?php }?>
</ul>
<p>
	Je comprends aussi que les risques potentiels de l'subir la procédure (s) sont les suivants:
</p>
<ul>
	<?php foreach (explode(', ',trim($elements['Element_OphTrConsent_BenefitsAndRisks']->risks)) as $risk) {?>
		<li><?php echo ucfirst($risk)?></li>
	<?php }?>
</ul>
<p>
	Je comprends que je recevrai une <?php echo $elements['Element_OphTrConsent_Procedure']->anaesthetic_type->name?> anesthésique.
</p>
<p>
	J'ai été pleinement informés des risques potentiels et des avantages de la procédure (s) ci-dessus et de donner mon plein consentement de la procédure (s) à exécuter. Je reconnais que je consens à la procédure (s) entièrement à mes risques et périls et acceptez de ne pas tenir le personnel concerné pour responsable des conséquences éventuelles qui pourraient survenir.
</p>
<?php if ($elements['Element_OphTrConsent_Permissions']->tissues_id == 1) {?>
	<p>
		Je, soussigné, consens à mes tissus doivent être conservés pendant éducation, de la vérification et de la recherche.
	</p>
<?php }?>
<?php if ($elements['Element_OphTrConsent_Other']->information) {?>
	<p>
		J'ai reçu une brochure d'information qui décrit en détail la procédure (s) qui sera effectué.
	</p>
<?php }?>
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
					Signature du patient / tuteur
				</p>
			</td>
			<td>
				<p>
					________________________<br/>
					Date de la signature
				</p>
			</td>
		</tr>
		<?php if ($elements['Element_OphTrConsent_Other']->witness_required) {?>
			<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
			<tr>
				<td>
					<p>
						________________________<br/>
						<?php echo $elements['Element_OphTrConsent_Other']->witness_name?> (Témoin)
					</p>
				</td>
				<td>
					<p>
						________________________<br/>
						Date de la signature
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
						<?php echo $elements['Element_OphTrConsent_Other']->interpreter_name?> (Interprète)
					</p>
				</td>
				<td>
					<p>
						________________________<br/>
						Date de la signature
					</p>
				</td>
			</tr>
		<?php }?>
	</tbody>
</table>
