<?php if (@$vi) {?>
	<table>
		<tr>
			<td>Patient's signature:.....................</td>
			<td>Date:...............................</td>
		</tr>
		<tr>
			<td colspan="2">Name: <?php echo $name?></td>
		</tr>
	</table>
<?php }else{?>
	<table class="signature">
		<tr>
			<td>Patient's signature:............................................</td>
			<td>Date:......................................</td>
		</tr>
		<tr>
			<td colspan="2">Name: <?php echo $name?></td>
		</tr>
	</table>
<?php }?>
