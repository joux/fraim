<div class="original index">
<h2><?php __('Original');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('film_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($original as $original):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $original['Original']['id']; ?>
		</td>
		<td>
			<?php echo $html->link($original['Film']['title'], array('controller'=> 'films', 'action'=>'view', $original['Film']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $original['Original']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $original['Original']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $original['Original']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $original['Original']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Original', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Films', true), array('controller'=> 'films', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Film', true), array('controller'=> 'films', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Copies', true), array('controller'=> 'copies', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Copy', true), array('controller'=> 'copies', 'action'=>'add')); ?> </li>
	</ul>
</div>
