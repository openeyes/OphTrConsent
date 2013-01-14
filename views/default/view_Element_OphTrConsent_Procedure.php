
<h4 class="elementTypeName"><?php  echo $element->elementType->name ?></h4>

<table class="subtleWhite normalText">
	<tbody>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('eye_id'))?></td>
			<td><span class="big"><?php echo $element->eye ? $element->eye->name : 'None'?></span></td>
		</tr>
		<tr>
			<td colspan="2">
				<div class="colThird">
					<b><?php echo CHtml::encode($element->getAttributeLabel('procedures'))?>:</b>
					<div class="eventHighlight medium">
						<?php if (!$element->procedures) {?>
							<h4>None</h4>
						<?php }else{?>
							<h4>
								<?php foreach ($element->procedures as $item) {
									echo $item->term?><br/>
								<?php }?>
							</h4>
						<?php }?>
					</div>
				</div>
			</td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('anaesthetic_type_id'))?></td>
			<td><span class="big"><?php echo $element->anaesthetic_type ? $element->anaesthetic_type->name : 'None'?></span></td>
		</tr>
		<tr>
			<td colspan="2">
				<div class="colThird">
					<b><?php echo CHtml::encode($element->getAttributeLabel('add_procs'))?>:</b>
					<div class="eventHighlight medium">
						<?php if (!$element->additional_procedures) {?>
							<h4>None</h4>
						<?php }else{?>
							<h4>
								<?php foreach ($element->additional_procedures as $item) {
									echo $item->term?><br/>
								<?php }?>
							</h4>
						<?php }?>
					</div>
				</div>
			</td>
		</tr>
	</tbody>
</table>
