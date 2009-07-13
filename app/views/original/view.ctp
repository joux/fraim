<div class="original view">
<h2><?php  __('Original');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $original['Original']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Film'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($original['Film']['title'], array('controller'=> 'films', 'action'=>'view', $original['Film']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Original', true), array('action'=>'edit', $original['Original']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Original', true), array('action'=>'delete', $original['Original']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $original['Original']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Original', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Original', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Films', true), array('controller'=> 'films', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Film', true), array('controller'=> 'films', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Copies', true), array('controller'=> 'copies', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Copy', true), array('controller'=> 'copies', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Copies');?></h3>
	<?php if (!empty($original['Copy'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Original Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Created'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($original['Copy'] as $copy):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $copy['id'];?></td>
			<td><?php echo $copy['original_id'];?></td>
			<td><?php echo $copy['user_id'];?></td>
			<td><?php echo $copy['description'];?></td>
			<td><?php echo $copy['created'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'copies', 'action'=>'view', $copy['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'copies', 'action'=>'edit', $copy['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'copies', 'action'=>'delete', $copy['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $copy['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Copy', true), array('controller'=> 'copies', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
