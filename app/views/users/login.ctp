<div class="users form">
<?php echo $form->create('User',array('action'=>'login'));?>
	<fieldset>
 		<legend><?php __('Login');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('password');
	?>
	</fieldset>
<?php echo $form->end('Login');?>
</div>
