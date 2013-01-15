<?php 	$this->breadcrumbs=array($this->module->id);
	$this->header();
?>
<h3 class="withEventIcon" style="background:transparent url(<?php echo $this->assetPath?>/img/medium.png) center left no-repeat;"><?php echo $this->event_type->name ?></h3>

<div>
	<?php 		$form = $this->beginWidget('BaseEventTypeCActiveForm', array(
			'id'=>'clinical-create',
			'enableAjaxValidation'=>false,
			'htmlOptions' => array('class'=>'sliding'),
			// 'focus'=>'#procedure_id'
		));
	?>
	<?php  $this->displayErrors($errors)?>

	<p>
		Please indicate whether this consent form is for a booking or for unbooked procedures.
	</p>

	<table class="select_procedures">
		<tr>
			<th class="select"></th>
			<th class="date">Date</th>
			<th class="procedures">Procedures</th>
		</tr>
		<?php foreach ($operations as $operation) {?>
			<tr>
				<td>
					<input type="radio" name="SelectBooking" value="booking<?php echo $operation['evid']?>" />
				</td>
				<td>
					<?php echo date('j M Y',strtotime($operation['date']))?>
				</td>
				<td>
					<?php foreach ($operation['procedures'] as $proc) {?>
						<?php echo $proc?><br/>
					<?php }?>
				</td>
			</tr>
		<?php }?>
		<tr>
			<td>
				<input type="radio" name="SelectBooking" value="unbooked" />
			</td>
			<td colspan="2">Unbooked procedures</td>
		</tr>
	</table>

	<?php  $this->displayErrors($errors)?>
		<div class="cleartall"></div>
		<div class="form_button">
			<img class="loader" style="display: none;" src="/img/ajax-loader.gif" alt="loading..." />&nbsp;
			<button type="submit" class="classy green venti" id="et_save" name="save"><span class="button-span button-span-green">Create consent form</span></button>
			<button type="submit" class="classy red venti" id="et_cancel" name="cancel"><span class="button-span button-span-red">Cancel</span></button>
		</div>
	<?php  $this->endWidget(); ?></div>

<?php  $this->footer(); ?>
