<?php if (@$vi) {?>
	<table>
		<tr>
			<td>Signed:............................</td>
			<td>Date:...............................</td>
		</tr>
		<?php if (@$address) {?>
			<tr>
				<td colspan="2">Address (if not the same as patient):.................................................................................................</td>
			</tr>
		<?php }?>
		<tr>
			<td>Name (PRINT):.............................................</td>
			<td>Relationship to patient:..........................</td>
		</tr>
	</table>
<?php }else{?>
	<table>
		<tr>
			<td>Signed:.............................................</td>
			<td>Date:......................................................</td>
		</tr>
		<?php if (@$address) {?>
			<tr>
				<td colspan="2">Address (if not the same as patient):......................................................................</td>
			</tr>
		<?php }?>
		<tr>
			<td>Name (PRINT):.................................</td>
			<td>Relationship to patient:..........................</td>
		</tr>
	</table>
<?php }?>
