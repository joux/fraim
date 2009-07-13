<div class="film index">
<h2><?php __('Film');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('user_id');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('description');?></th>
	<th><?php echo $paginator->sort('title');?></th>
	<th><?php echo $paginator->sort('single_frames_ready');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($film as $film):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $film['Film']['id']; ?>
		</td>
		<td>
			<?php echo $html->link($film['User']['name'], array('controller'=> 'users', 'action'=>'view', $film['User']['id'])); ?>
		</td>
		<td>
			<?php echo $film['Film']['created']; ?>
		</td>
		<td>
			<?php echo $film['Film']['description']; ?>
		</td>
		<td>
			<?php echo $film['Film']['title']; ?>
		</td>
		<td>
			<?php echo $film['Film']['single_frames_ready']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $film['Film']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $film['Film']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $film['Film']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $film['Film']['id'])); ?>
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
		<li><?php echo $html->link(__('New Film', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Users', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller'=> 'users', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Originals', true), array('controller'=> 'originals', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Original', true), array('controller'=> 'originals', 'action'=>'add')); ?> </li>
	</ul>
</div>
