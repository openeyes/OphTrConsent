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
 ?>
<?php
if (@$vi) {
	echo $this->renderPartial('_print_css_visually_impaired');
} else {
	echo $this->renderPartial('_print_css_normal');
}
?>
<h2>Consent form 3</h2>
<h2><?php echo $this->patient->fullName?>, Hospital no: <?php echo $this->patient->hos_num?></h2>
<h3>Patient/parental agreement to investigation or treatment (procedures where consciousness not impaired)</h3>
<p>
	<strong>Procedure(s):</strong>
	<?php foreach ($elements['Element_OphTrConsent_Procedure']->procedures as $i => $procedure) {
		if ($i >0) echo ', ';
		echo $procedure->term;
	}?>
</p>
<p>
	<strong>Statement of health professional</strong> (to be filled in by health professional with appropriate knowledge of proposed procedure, as specified in consent policy)
</p>
<p>
	<strong>I have explained the procedure to the patient/parent. In particular, I have explained:</strong>
	<br/>
	<strong>The intended benefits:</strong>
	<?php echo $elements['Element_OphTrConsent_BenefitsAndRisks']->benefits?>
	<br/>
	<strong>Serious, frequently occurring or unavoidable risks:</strong>
	<?php echo $elements['Element_OphTrConsent_BenefitsAndRisks']->risks?>
</p>
<?php if (!empty($elements['Element_OphTrConsent_Procedure']->additional_procedures)) {?>
	<p>Any extra procedures which may become necessary during the procedure(s):</p>
	<ul<?php if (@$vi) {?> class="ul_vi"<?php }?>>
		<?php foreach ($elements['Element_OphTrConsent_Procedure']->additional_procedures as $proc) {?>
			<li><?php echo $proc->term?></li>
		<?php }?>
	</ul>
	<?php if (@$vi) {?>
		<div class="spacer"></div>
	<?php }?>
<?php }?>
<p>
	I have also discussed what the procedure is likely to involve, the benefits and risks of any available alternative treatments (including no treatment) and any particular concerns of those involved.
</p>
<p>
	[<?php if ($elements['Element_OphTrConsent_Other']->information) {?>x<?php }else{?>&nbsp;&nbsp;<?php }?>] The following informational leaflets have been provided: .............................................<br/>
</p>
<?php echo $this->renderPartial('signature_table1',array('vi'=>@$vi,'consultant'=>$elements['Element_OphTrConsent_Other']->consultant))?>
<br pagebreak="true"/>
<?php if ($elements['Element_OphTrConsent_Other']->interpreter_required) {?>
	<h3>Statement of interpreter</h3>
	<p>
		I have interpreted the information above to the patient/parent to the best of my ability and in a way in which I believe s/he/they can understand.
	</p>
	<?php echo $this->renderPartial('signature_table3',array('vi'=>@$vi,'name'=>$elements['Element_OphTrConsent_Other']->interpreter_name))?>
	<div class="spacer"></div>
<?php }?>
<h3>Statement of patient/person with parental responsibility for patient I agree to the procedure described above.</h3>
<p>
	I understand that you cannot give me a guarantee that a particular person will perform the procedure. The person will, however, have appropriate experience. I understand that the procedure will/will not involve local anaesthesia.
</p>
<?php echo $this->renderPartial('signature_table2',array('vi'=>@$vi))?>
<div class="spacer"></div>
<p>
	Confirmation of consent (to be completed by a health professional when the patient is admitted for the procedure, if the patient/parent has signed the form in advance) I have confirmed that the patient/parent has no further questions and wishes the procedure to go ahead.
</p>
<?php echo $this->renderPartial('signature_table1',array('vi'=>@$vi,'consultant'=>$elements['Element_OphTrConsent_Other']->consultant))?>
<div class="spacer"></div>
<h3>Top copy accepted by patient: yes/no <span class="noth3">(please ring)</span></h3>
