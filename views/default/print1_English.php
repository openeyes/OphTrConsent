<style>
	h1,h2,h4 { display: inline; margin: 0 auto; width: 400px; text-align: center; }
	.noth3 { font-size: 12pt; font-weight: normal; }
	.spacer { height: 2em; }
	table { border-spacing: 0; border-collapse: collapse; }
	table.signature { margin-left: 0; }
	table.signature td,th { margin-left: 0; padding-left: 0; width: 300px; }
	p,li,td,th,span { font-size: 14pt; }
	/* ul,li { margin: 0; padding: 0; } */
	.mainContent { line-height: 3px; }
	.topCopy { font-size: 10pt; line-height: 1px !important; }
</style>
<h2>Consent form 1</h2>
<h2>For adults with mental capacity to give valid consent</h2>
<h2>Patient agreement to investigation or treatment</h2>
<div class="spacer"></div>
<div class="spacer"></div>
<div class="spacer"></div>
<p><strong>Patient details (or pre-printed label)</strong></p>
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
<?php for ($i=0; $i<2; $i++) {?>
	<div class="mainContent">
		<h3>Name of proposed procedure or course of treatment</h3>
		<ul>
			<?php foreach ($elements['Element_OphTrConsent_Procedure']->procedures as $proc) {?>
				<li><?php echo $elements['Element_OphTrConsent_Procedure']->eye->adjective?> <?php echo $proc->term?></li>
			<?php }?>
		</ul>
		<h3>Statement of health professional <span class="noth3">(to be filled in by a health professional with appropriate knowledge of the proposed procedure(s), as specified in the consent policy)</span></h3>
		<p>
			<strong>I have explained the procedure to the patient. In particular, I have explained:</strong>
		</p>
		<p>
			<strong>The intended benefits:</strong>
			<?php echo $elements['Element_OphTrConsent_BenefitsAndRisks']->benefits?>
		</p>
		<p>
			<strong>Serious, frequently occurring or unavoidable risks:</strong>
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
			I have also discussed what the procedure is likely to involve, the benefits and risks of any available alternative treatments (including no treatment) and any particular concerns of this patient. I assess that this patient has the capacity to give valid consent.
		</p>
		<p>
			[<?php if ($elements['Element_OphTrConsent_Other']->information) {?>x<?php }else{?>&nbsp;&nbsp;<?php }?>] An informational leaflet has been provided.<br/>
			[&nbsp;&nbsp;] "Anaesthesia at Moorfields Eye Hospital" leaflet has been provided
		</p>
		<p>
			This procedure will involve:
			[<?php if ($elements['Element_OphTrConsent_Procedure']->anaesthetic_type->name == 'GA') {?>x<?php }else{?>&nbsp;&nbsp;<?php }?>] general and/or regional anaesthesia&nbsp;&nbsp;[<?php if (in_array($elements['Element_OphTrConsent_Procedure']->anaesthetic_type->name,array('Topical','LAC','LA','LAS'))) {?>x<?php }else{?>&nbsp;&nbsp;<?php }?>]<br/>local anaesthesia&nbsp;&nbsp;[<?php if ($elements['Element_OphTrConsent_Procedure']->anaesthetic_type->name == 'LAS') {?>x<?php }else{?>&nbsp;&nbsp;<?php }?>] sedation
		</p>
		<table>
			<tr>
				<td>Signed:.............................................</td>
				<td>Date:...........................................</td>
			</tr>
			<tr>
				<td>Name (PRINT):................................</td>
				<td>Job title:.......................................</td>
			</tr>
		</table>
		<div class="spacer"></div>
		<p>
			Contact details (if patient wishes to discuss options later): 0207 253 3411
		</p>
		<?php if ($elements['Element_OphTrConsent_Other']->interpreter_required) {?>
			<h3>Statement of interpreter</h3>
			<p>
				I have interpreted the information above to the patient to the best of my ability and in a way in which I believe s/he can understand.
			</p>
			<table>
				<tr>
					<td>Signed:..................................................</td>
					<td>Date:.............................................</td>
				</tr>
				<tr>
					<td colspan="2">Name: <?php echo $elements['Element_OphTrConsent_Other']->interpreter_name?></td>
				</tr>
			</table>
			<div class="spacer"></div>
		<?php }?>
		<br/>
		<br pagebreak="true"/>
	<?php }?>
	<div class="topCopy">Top copy accepted by patient: yes/no (please ring)</div>
	<h3>Statement of patient</h3>
	<p>
		Please read this form carefully.	If your treatment has been planned in advance, you should already have your own copy of the page which describes the benefits and risks of the proposed treatment. If not, you will be offered a copy now. If you have any questions, do ask - we are here to help you. You have the right to change your mind at any time, including after you have signed this form.
	</p>
	<p>
		<strong>I agree</strong> to the procedure or course of treatment described on this form.<br/>
		<strong>I understand</strong> that you cannot give me a guarantee that a particular person will perform the procedure. The person will, however, have appropriate experience.<br/>
		<?php if ($elements['Element_OphTrConsent_Procedure']->anaesthetic_type->name == 'GA') {?>
			<strong>I understand</strong> that I will have the opportunity to discuss the details of anaesthesia before the procedure, unless the urgency of my situation prevents this.<br/>
		<?php }?>
		<strong>I understand</strong> that any procedure in addition to those described on this form will only be carried out if it is necessary to save my life or to prevent serious harm to my health.
	</p>
	<span>I have been told <strong>about additional procedures which may become necessary during my treatment. I have listed below any procedures</strong> which I do not wish to be carried out <strong>without further discussion.</strong></span><br/>
	<span>................................................................................................................................</span><br/><br/>
	<table class="signature">
		<tr>
			<td>Patient's signature:............................................</td>
			<td>Date:......................................</td>
		</tr>
		<tr>
			<td colspan="2">Name: <?php echo $this->patient->fullName?></td>
		</tr>
	</table>
	<?php if ($elements['Element_OphTrConsent_Other']->witness_required) {?>
		<br/>
		<span>A <strong>witness</strong> should sign below <strong>if the patient is unable to sign but has indicated <?php echo $this->patient->obj?> consent.</strong></span><br/><br/>
		<table>
			<tr>
				<td>Signature:..............................................</td>
				<td>Date:......................................</td>
			</tr>
			<tr>
				<td colspan="2">Name: <?php echo $elements['Element_OphTrConsent_Other']->witness_name?></td>
			</tr>
		</table>
	<?php }?>
	<h3>Confirmation of consent</h3>
	(to be completed by a health professional when the patient is admitted, if the patient has signed the form in advance)
	<p>
		On behalf of the team treating the patient, I have confirmed with the patient that <?php echo $this->patient->pro?> has no further questions and wishes the procedure to go ahead.
	</p>
	<table>
		<tr>
			<td>Signed:..................................................</td>
			<td>Date:..............................................</td>
		</tr>
		<tr>
			<td>Name (PRINT):......................................</td>
			<td>Job title:...........................................</td>
		</tr>
	</table>
	<div class="spacer"></div>
	<p>
		<strong>Important notes:</strong> (tick if applicable)
	</p>
	<p>
		[&nbsp;&nbsp;] See also advance decision refusing treatment (including a Jehovah’s Witness form)<br/>
		[&nbsp;&nbsp;] Patient has withdrawn consent (ask patient to sign /date here): ..................................................................
	</p>
	<br pagebreak="true"/>
	<h2>Form 1: Supplementary consent</h2>
	<h3>Images</h3>
	<p>
		Photographs, x-rays or other images may be taken as part of your treatment and will form part of your medical record. It is very unlikely that you would be recognised from these images. If however you could be recognised we would seek your specific consent before any particular publication.
	</p>
	<p>
		<strong>Do you agree to them being used for:</strong>
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
		Patient signature ..............................
	</p>
	<p>
		Date ...............................
	</p>
</div>
