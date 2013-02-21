<style>
	h1,h2,h4 { display: inline; margin: 0 auto; width: 400px; text-align: center; }
	.noth3 { font-size: 12pt; font-weight: normal; }
	.spacer { height: 2em; }
	table.signature { margin-left: 0; }
	table.signature td { margin-left: 0; width: 300px; }
</style>
<h1>Moorfields Eye Hospital NHS Foundation Trust</h1>
<h2>Consent form 3</h2>
<h2><?php echo $this->patient->fullName?>, Hospital no: <?php echo $this->patient->hos_num?></h2>
<h3>Patient/parental agreement to investigation or treatment (procedures where consciousness not impaired)</h3>
<p>
	<strong>Name of procedure</strong> (include brief explanation if medical term not clear)
</p>
<p>
	.....................................................................................................................................................................
</p>
<p>
	<strong>Statement of health professional</strong> (to be filled in by health professional with appropriate knowledge of proposed procedure, as specified in consent policy)
</p>
<p>
	I have explained the procedure to the patient/parent. In particular, I have explained:
</p>
<p>The intended benefits</p>
<p>
	<?php echo $elements['Element_OphTrConsent_BenefitsAndRisks']->benefits?>
</p>
<p>Serious, frequently occurring or unavoidable risks</p>
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
	I have also discussed what the procedure is likely to involve, the benefits and risks of any available alternative treatments (including no treatment) and any particular concerns of those involved.
</p>
<?php if ($elements['Element_OphTrConsent_Other']->information) {?>
	<p>
		An informational leaflet has been provided.
	</p>
<?php }?>
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
<br pagebreak="true"/>
<?php if ($elements['Element_OphTrConsent_Other']->interpreter_required) {?>
	<h3>Statement of interpreter</h3>
	<p>
		I have interpreted the information above to the patient/parent to the best of my ability and in a way in which I believe s/he/they can understand.
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
	<div class="spacer"></div>
<?php }?>
<h3>Statement of patient/person with parental responsibility for patient I agree to the procedure described above.</h3>
<p>
	I understand that you cannot give me a guarantee that a particular person will perform the procedure. The person will, however, have appropriate experience. I understand that the procedure will/will not involve local anaesthesia.
</p>
<table>
	<tr>
		<td>Signed:..............................................................</td>
		<td>Date:..........................................................</td>
	</tr>
	<tr>
		<td>Name (PRINT):................................................</td>
		<td>Relationship to patient:...............................................</td>
	</tr>
</table>
<div class="spacer"></div>
<p>
	Confirmation of consent (to be completed by a health professional when the patient is admitted for the procedure, if the patient/parent has signed the form in advance) I have confirmed that the patient/parent has no further questions and wishes the procedure to go ahead.
</p>
<table>
	<tr>
		<td>Signed:..............................................................</td>
		<td>Date:..........................................................</td>
	</tr>
	<tr>
		<td>Name (PRINT):................................................</td>
		<td>Job title:......................................................</td>
	</tr>
</table>
<div class="spacer"></div>
<h3>Top copy accepted by patient: yes/no <span class="noth3">(please ring)</span></h3>
