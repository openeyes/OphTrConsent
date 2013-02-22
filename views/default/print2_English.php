<style>
	h1,h2,h4 { display: inline; margin: 0 auto; width: 400px; text-align: center; }
	.noth3 { font-size: 12pt; font-weight: normal; }
	.spacer { height: 2em; }
	table.signature { margin-left: 0; }
	table.signature td { margin-left: 0; width: 300px; }
</style>
<h1>Moorfields Eye Hospital NHS Foundation Trust</h1>
<h2>Consent form 2</h2>
<h2>Parental agreement to investigation or treatment for a child or young person</h2>
<h2>Patient details (or pre-printed label)</h2>
<div class="spacer"></div>
<div class="spacer"></div>
<div class="spacer"></div>
<table>
	<tr>
		<th>Patient's surname/family name</th>
		<td><?php echo $this->patient->last_name?></td>
	</tr>
	<tr>
		<th>Patient's first names</th>
		<td><?php echo $this->patient->first_name?></td>
	</tr>
	<tr>
		<th>Date of birth</th>
		<td><?php echo $this->patient->dob?></td>
	</tr>
	<tr>
		<th>Hospital no</th>
		<td><?php echo $this->patient->hos_num?></td>
	</tr>
	<tr>
		<th>NHS number</th>
		<td><?php echo $this->patient->nhs_num?></td>
	</tr>
	<tr>
		<th>Gender</th>
		<td><?php echo $this->patient->genderString?></td>
	</tr>
	<tr>
		<th>Special requirements</th>
		<td>...............................................................</td>
	</tr>
	<tr>
		<td></td>
		<td>(e.g. other language/other communication method)</td>
	</tr>
	<tr>
		<th>Witness required</th>
		<td><?php echo $elements['Element_OphTrConsent_Other']->witness_required ? 'Yes' : 'No'?></td>
	</tr>
	<?php if ($elements['Element_OphTrConsent_Other']->witness_required) {?>
		<tr>
			<th>Witness name</th>
			<td><?php echo $elements['Element_OphTrConsent_Other']->witness_name?></td>
		</tr>
	<?php }?>
	<tr>
		<th>Interpreter required</th>
		<td><?php echo $elements['Element_OphTrConsent_Other']->interpreter_required ? 'Yes' : 'No'?></td>
	</tr>
	<?php if ($elements['Element_OphTrConsent_Other']->interpreter_required) {?>
		<tr>
			<th>Interpreter name</th>
			<td><?php echo $elements['Element_OphTrConsent_Other']->interpreter_name?></td>
		</tr>
	<?php }?>
</table>
<div class="spacer"></div>
<div class="spacer"></div>
<div class="spacer"></div>
<div class="spacer"></div>
<h2>To be retained in patient's notes</h2>
<br/>
<br pagebreak="true"/>
<h3>Statement of parent</h3>
<p>
	Please read this form carefully. If the procedure has been planned in advance, you should already have your own copy of page 3 which describes the benefits and risks of the proposed treatment. If not, you will be offered a copy now. If you have any further questions, do ask - we are here to help you and your child. You have the right to change your mind at any time, including after you have signed this form.
</p>
<p>
	<strong>I agree</strong> to the procedure or course of treatment described on this form and I confirm that I have 'parental responsibility' for this child.
</p>
<p>
	<strong>I understand</strong> that you cannot give me a guarantee that a particular person will perform the procedure. The person will, however, have appropriate experience.
</p>
<p>
	<strong>I understand</strong> that my child and I will have the opportunity to discuss the details of anaesthesia with an anaesthetist before the procedure, unless the urgency of the situation prevents this. (This only applies to children having general or regional anaesthesia.)
</p>
<p>
	<strong>I understand that any</strong> procedure in addition to those described on this form will only be carried out if it is necessary to save the life of my child or to prevent serious harm to his or her health.
</p>
<p>
	<strong>I have been told about</strong> additional procedures which may become necessary during my child's treatment. I have listed below any procedures which I do not wish to be carried out without further discussion: .............................................................
</p>
<table>
	<tr>
		<td>Signature:..............................................................</td>
		<td>Date:..........................................................</td>
	</tr>
	<tr>
		<td>Name (PRINT):................................................</td>
		<td>Relationship to child:.....................................................</td>
	</tr>
</table>
<div class="spacer"></div>
<h3>Child's agreement to treatment (if child wishes to sign)</h3>
<p>
	I agree to have the treatment I have been told about.
</p>
<table>
	<tr>
		<td>Name:..............................................................</td>
		<td>Signature:..........................................................</td>
	</tr>
	<tr>
		<td>Date:................................................</td>
	</tr>
</table>
<br pagebreak="true"/>
<h3>Confirmation of consent <span class="noth3">(to be completed by a health professional when the child is admitted for the procedure, if the parent/child have signed the form in advance)</span></h3>
<p>
	On behalf of the team treating the patient, I have confirmed with the child and his or her parent(s) that they have no further questions and wish the procedure to go ahead.
</p>
<table>
	<tr>
		<td>Signed:..............................................................</td>
		<td>Date:..........................................................</td>
	</tr>
	<tr>
		<td>Name (PRINT):................................................</td>
		<td>Job title:.....................................................</td>
	</tr>
</table>
<div class="spacer"></div>
<h3>Important notes: (tick if applicable)</h3>
<p>
	See also advance directive/living will (eg Jehovah's Witness form)
</p>
<p>
	Parent has withdrawn consent (ask parent to sign /date here) .................................
</p>
<br pagebreak="true"/>
<h2>Moorfields Eye Hospital NHS Trust</h2>
<h3>Name of proposed procedure or course of treatment</h3>
<ul>
	<?php foreach ($elements['Element_OphTrConsent_Procedure']->procedures as $proc) {?>
		<li><?php echo $elements['Element_OphTrConsent_Procedure']->eye->adjective?> <?php echo $proc->term?></li>
	<?php }?>
</ul>
<h3>Statement of health professional</h3> (to be filled in by a health professional with appropriate knowledge of the proposed procedure(s), as specified in the consent policy)
<br/>
<p><strong>I have explained the procedure to the patient. In particular, I have explained:</strong></p>
<p><strong>The intended benefits:</strong></p>
<p>
	<?php echo $elements['Element_OphTrConsent_BenefitsAndRisks']->benefits?>
</p>
<p><strong>Serious, frequently occurring or unavoidable risks:</strong></p>
<p>
	<?php echo $elements['Element_OphTrConsent_BenefitsAndRisks']->risks?>
</p>
<?php if (!empty($elements['Element_OphTrConsent_Procedure']->additional_procedures)) {?>
	<p>Any extra procedures which may become necessary during the procedure(s)</p>
	<ul>
		<?php foreach ($elements['Element_OphTrConsent_Procedure']->additional_procedures as $proc) {?>
			<li><?php echo $proc->term?></li>
		<?php }?>
	</ul>
<?php }?>
<p>
	I have also discussed what the procedure is likely to involve, the benefits and risks of any available alternative treatments (including no treatment) and any particular concerns of this patient and <?php echo $this->patient->pos?> parents.
</p>
<?php if ($elements['Element_OphTrConsent_Other']->information) {?>
	<p>
		An informational leaflet has been provided.
	</p>
<?php }?>
<p>
	[&nbsp;&nbsp;] "Anaesthesia at Moorfields Eye Hospital" leaflet has been provided
</p>
<p>
	This procedure will involve:
</p>
<p>
	[<?php if ($elements['Element_OphTrConsent_Procedure']->anaesthetic_type->name == 'GA') {?>x<?php }else{?>&nbsp;&nbsp;<?php }?>] general and/or regional anaesthesia&nbsp;&nbsp;[<?php if (in_array($elements['Element_OphTrConsent_Procedure']->anaesthetic_type->name,array('Topical','LAC','LA','LAS'))) {?>x<?php }else{?>&nbsp;&nbsp;<?php }?>] local anaesthesia&nbsp;&nbsp;[<?php if ($elements['Element_OphTrConsent_Procedure']->anaesthetic_type->name == 'LAS') {?>x<?php }else{?>&nbsp;&nbsp;<?php }?>] sedation
</p>
<table>
	<tr>
		<td>Signed:..............................................................</td>
		<td>Date:..........................................................</td>
	</tr>
	<tr>
		<td>Name (PRINT):................................................</td>
		<td>Job title:.....................................................</td>
	</tr>
</table>
<div class="spacer"></div>
<p>
	Contact details (if child/parent wishes to discuss options later) .....................
</p>
<br pagebreak="true"/>
<?php if ($elements['Element_OphTrConsent_Other']->interpreter_required) {?>
	<h3>Statement of interpreter</h3>
	<p>
		I have interpreted the information above to the child and <?php echo $this->patient->pos?> parents to the best of my ability and in a way in which I believe they can understand.
	</p>
	<table>
		<tr>
			<td>Signed:..............................................................</td>
			<td>Date:..........................................................</td>
		</tr>
		<tr>
			<td colspan="2">Name: <?php echo $elements['Element_OphTrConsent_Other']->interpreter_name?></td>
		</tr>
	</table>
	<h3>Top copy accepted by patient: yes/no <span class="noth3">(please ring)</span></h3>
<?php }?>
<h2>Form 2: Supplementary consent</h2>
<h3>Images</h3>
<p>
	Photographs, x-rays or other images may be taken as part of your child's treatment and will form part of the medical record. It is very unlikely that your child would be recognised from these images. If however your child could be recognised we would seek your specific consent before any particular publication.
</p>
<p>
	Do you agree to them being used for:
</p>
<p>
	[<?php if ($elements['Element_OphTrConsent_Permissions']->images) {?>x<?php }else{?>&nbsp;&nbsp;<?php }?>] Education
</p>
<p>
	[<?php if ($elements['Element_OphTrConsent_Permissions']->images) {?>x<?php }else{?>&nbsp;&nbsp;<?php }?>] Research
</p>
<p>
	If you do not wish to take part in either of the above, your care will not be compromised in any way.
</p>
<p>
	Signature of Parent/Guardian ..............................
</p>
<p>
	Date ...............................
</p>
