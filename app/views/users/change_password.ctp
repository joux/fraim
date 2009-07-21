<div class="artists form">
<?php echo $form->create('User',array('action'=>'changePassword'));?>
	<fieldset>
 		<legend><?php __('Change Password');?></legend>
		<p>
		Please enter your new password in both fields below
		</p>
	<?php
		echo $form->input('password',array('type'=>'password','label'=>__('New password',true) ) );
		echo $form->input('password2',array('type'=>'password','label'=>__('Repeat new password',true) ) );
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>