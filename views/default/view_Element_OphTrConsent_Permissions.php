
<h4 class="elementTypeName"><?php  echo $element->elementType->name ?></h4>

<table class="subtleWhite normalText">
	<tbody>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('tissues_id'))?></td>
			<td><span class="big"><?php echo $element->tissues ? $element->tissues->name : 'None'?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('images'))?></td>
			<td><span class="big"><?php echo $element->images ? 'Yes' : 'No'?></span></td>
		</tr>
	</tbody>
</table>
