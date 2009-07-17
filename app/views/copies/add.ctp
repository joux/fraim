<img src="<?php echo sprintf('/fraim/%sframes/original/%05d/%s',Configure::read('mediaPath'),$original['Original']['film_id'],$original['Original']['file']); ?>" />
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Give me a different frame to adopt', true), array('controller'=>'Films','action'=>'adoptFrame',$original['Original']['film_id']));?></li>
	</ul>
</div>
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

