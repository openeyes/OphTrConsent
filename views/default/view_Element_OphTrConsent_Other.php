
<h4 class="elementTypeName"><?php  echo $element->elementType->name ?></h4>

<table class="subtleWhite normalText">
	<tbody>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('information'))?></td>
			<td><span class="big"><?php echo $element->information ? 'Yes' : 'No'?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('witness_required'))?></td>
			<td><span class="big"><?php echo $element->witness_required ? 'Yes' : 'No'?></span></td>
		</tr>
		<?php if ($element->witness_required) {?>
			<tr>
				<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('witness_name'))?></td>
				<td><span class="big"><?php echo $element->witness_name?></span></td>
			</tr>
		<?php }?>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('interpreter_required'))?></td>
			<td><span class="big"><?php echo $element->interpreter_required ? 'Yes' : 'No'?></span></td>
		</tr>
		<?php if ($element->interpreter_required) {?>
			<tr>
				<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('interpreter_name'))?></td>
				<td><span class="big"><?php echo $element->interpreter_name?></span></td>
			</tr>
		<?php }?>
		<?php if ($element->parent_guardian) {?>
			<tr>
				<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('parent_guardian'))?></td>
				<td><span class="big"><?php echo CHtml::encode($element->parent_guardian)?></span></td>
			</tr>
		<?php }?>
	</tbody>
</table>
