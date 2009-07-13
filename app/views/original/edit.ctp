<div class="original form">
<?php echo $form->create('Original');?>
	<fieldset>
 		<legend><?php __('Edit Original');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('film_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Original.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Original.id'))); ?></li>
		<li><?php echo $html->link(__('List Original', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Films', true), array('controller'=> 'films', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Film', true), array('controller'=> 'films', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Copies', true), array('controller'=> 'copies', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Copy', true), array('controller'=> 'copies', 'action'=>'add')); ?> </li>
	</ul>
</div>
