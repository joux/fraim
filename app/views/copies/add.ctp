<div class="copies form">
<?php echo $form->create('Copy');?>
	<fieldset>
 		<legend><?php __('Add Copy');?></legend>
	<?php
		echo $form->input('original_id');
		echo $form->input('user_id');
		echo $form->input('description');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Copies', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Originals', true), array('controller'=> 'originals', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Original', true), array('controller'=> 'originals', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Users', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller'=> 'users', 'action'=>'add')); ?> </li>
	</ul>
</div>
