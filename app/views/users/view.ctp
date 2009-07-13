<div class="users view">
<h2><?php  __('User');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Email'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['email']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Password'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['password']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reset Token'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['reset_token']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reset Token Expires'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['reset_token_expires']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Group'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['group']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['created']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit User', true), array('action'=>'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete User', true), array('action'=>'delete', $user['User']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['User']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Users', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Copies', true), array('controller'=> 'copies', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Copy', true), array('controller'=> 'copies', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Films', true), array('controller'=> 'films', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Film', true), array('controller'=> 'films', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Copies');?></h3>
	<?php if (!empty($user['Copy'])):?>
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
		foreach ($user['Copy'] as $copy):
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
<div class="related">
	<h3><?php __('Related Films');?></h3>
	<?php if (!empty($user['Film'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Single Frames Ready'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Film'] as $film):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $film['id'];?></td>
			<td><?php echo $film['user_id'];?></td>
			<td><?php echo $film['created'];?></td>
			<td><?php echo $film['description'];?></td>
			<td><?php echo $film['title'];?></td>
			<td><?php echo $film['single_frames_ready'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'films', 'action'=>'view', $film['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'films', 'action'=>'edit', $film['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'films', 'action'=>'delete', $film['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $film['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Film', true), array('controller'=> 'films', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
