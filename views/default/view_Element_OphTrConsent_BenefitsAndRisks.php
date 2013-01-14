
<h4 class="elementTypeName"><?php  echo $element->elementType->name ?></h4>

<table class="subtleWhite normalText">
	<tbody>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('benefits'))?></td>
			<td><span class="big"><?php echo CHtml::encode($element->benefits)?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('risks'))?></td>
			<td><span class="big"><?php echo CHtml::encode($element->risks)?></span></td>
		</tr>
	</tbody>
</table>
