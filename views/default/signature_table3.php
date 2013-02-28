<?php if (@$vi) {?>
	<table>
		<tr>
			<td>Signed:............................</td>
			<td>Date:...............................</td>
		</tr>
		<tr>
			<td colspan="2">Name: <?php echo $name?></td>
		</tr>
	</table>
<?php }else{?>
	<table>
		<tr>
			<td>Signed:..................................................</td>
			<td>Date:.............................................</td>
		</tr>
		<tr>
			<td colspan="2">Name: <?php echo $name?></td>
		</tr>
	</table>
<?php }?>
