<div class="users form">
<?php echo $form->create('User');?>
	<fieldset>
 		<legend><?php __('Add User');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('password');
		echo $form->input('password2',array('type'=>'password','label'=>__('Password (again)',true) ));
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
