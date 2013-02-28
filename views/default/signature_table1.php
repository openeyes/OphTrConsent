<?php if (@$vi) {?>
	<table>
		<tr>
			<td>Signed:............................</td>
			<td>Date:...............................</td>
		</tr>
		<tr>
			<td>Name (PRINT): <?php echo $consultant->fullNameAndTitle?></td>
			<td>Job title: Consultant Ophthalmologist</td>
		</tr>
	</table>
<?php }else{?>
	<table>
		<tr>
			<td>Signed:.............................................</td>
			<td>Date:...........................................</td>
		</tr>
		<tr>
			<td>Name (PRINT): <?php echo $consultant->fullNameAndTitle?></td>
			<td>Job title: Consultant Ophthalmologist</td>
		</tr>
	</table>
<?php }?>
