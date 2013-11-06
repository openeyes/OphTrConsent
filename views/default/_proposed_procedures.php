<?php /* DEPRECATED */ ?>
<ul<?php if (@$vi) {?> class="ul_vi"<?php }?>>
	<?php foreach ($procedures as $proc) {?>
		<li><?php echo $eye?> <?php echo $proc->term?></li>
	<?php }?>
</ul>
<?php if (@$vi) {?>
	<div class="spacer"></div>
<?php }?>
