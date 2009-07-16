<div class="copies form">
<?php echo $form->create('Copy',array('type'=>'file','url'=>array('controller'=>'Copies','action'=>'add',$this->passedArgs[0])) );?>
	<fieldset>
 		<legend><?php __('Add Copy');?></legend>
	<?php
		echo $form->input('user_id');
		echo $form->input('original_id',array('type'=>'hidden','value'=>$original_id) );
		echo $form->input('description');
		echo $form->input('content',array('type'=>'file','label'=>sprintf(__('JPEG Image File, %d KB max',true),Configure::read('max_picture_upload_size')/1024)));
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Copies', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Originals', true), array('controller'=> 'originals', 'action'=>'index')); ?> </li>
	</ul>
</div>
