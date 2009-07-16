<div class="films form">
<?php echo $form->create('Film',array('type'=>'file') );?>
	<fieldset>
 		<legend><?php __('Add Film');?></legend>
	<?php
		echo $form->input('user_id');
		echo $form->input('title');
		echo $form->input('description');
		echo $form->input('content',array('type'=>'file','label'=>sprintf(__('.flv file, %d KB max',true),Configure::read('max_video_upload_size')/1024)));
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Films', true), array('action'=>'index'));?></li>
	</ul>
</div>
