<div class="films form">
<?php echo $form->create('Film');?>
	<fieldset>
 		<legend><?php __('Add Film');?></legend>
	<?php
		echo $form->input('user_id');
		echo $form->input('description');
		echo $form->input('title');
		echo $form->input('single_frames_ready');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Films', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Users', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller'=> 'users', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Originals', true), array('controller'=> 'originals', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Original', true), array('controller'=> 'originals', 'action'=>'add')); ?> </li>
	</ul>
</div>
