<div class="film view">
<h2><?php  __('Film');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $film['Film']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($film['User']['name'], array('controller'=> 'users', 'action'=>'view', $film['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $film['Film']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $film['Film']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $film['Film']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Single Frames Ready'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $film['Film']['single_frames_ready']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Film', true), array('action'=>'edit', $film['Film']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Film', true), array('action'=>'delete', $film['Film']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $film['Film']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Film', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Film', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Users', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller'=> 'users', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Originals', true), array('controller'=> 'originals', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Original', true), array('controller'=> 'originals', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Originals');?></h3>
	<?php if (!empty($film['Original'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Film Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($film['Original'] as $original):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $original['id'];?></td>
			<td><?php echo $original['film_id'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'originals', 'action'=>'view', $original['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'originals', 'action'=>'edit', $original['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'originals', 'action'=>'delete', $original['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $original['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Original', true), array('controller'=> 'originals', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
