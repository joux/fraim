<div class="copies view">
<h2><?php  __('Copy');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $copy['Copy']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Original'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($copy['Original']['id'], array('controller'=> 'originals', 'action'=>'view', $copy['Original']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($copy['User']['name'], array('controller'=> 'users', 'action'=>'view', $copy['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $copy['Copy']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $copy['Copy']['created']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Copy', true), array('action'=>'edit', $copy['Copy']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Copy', true), array('action'=>'delete', $copy['Copy']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $copy['Copy']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Copies', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Copy', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Originals', true), array('controller'=> 'originals', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Original', true), array('controller'=> 'originals', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Users', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller'=> 'users', 'action'=>'add')); ?> </li>
	</ul>
</div>
