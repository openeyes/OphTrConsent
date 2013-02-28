
<h4 class="elementTypeName"><?php  echo $element->elementType->name ?></h4>

<table class="subtleWhite normalText">
	<tbody>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('images_id'))?></td>
			<td><span class="big"><?php echo $element->images ? $element->images->name : 'None'?></span></td>
		</tr>
	</tbody>
</table>
