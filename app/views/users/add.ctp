<div class="users form">
<?php echo $form->create('User');?>
	<fieldset>
 		<legend><?php __('Add User');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('email');
		echo $form->input('password');
		echo $form->input('reset_token');
		echo $form->input('reset_token_expires');
		echo $form->input('group');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Users', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Copies', true), array('controller'=> 'copies', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Copy', true), array('controller'=> 'copies', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Films', true), array('controller'=> 'films', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Film', true), array('controller'=> 'films', 'action'=>'add')); ?> </li>
	</ul>
</div>
