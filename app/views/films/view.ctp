<?php $javascript->link('flowplayer-3.1.1.min.js',false); 
?>
<div class="films view">
<h2><?php echo $film['Film']['title'];?></h2>
<p>
	<?php echo $film['Film']['description'];?>
</p>
	<?php // *** The original film *** 
	?>
	<h3>The original</h3>
	<a  
	href="<?php echo sprintf('%svideo/original/%05d.flv',$html->url('/'.Configure::read('mediaPath',true),true),$film['Film']['id']); ?>"
		 style="display:block;width:320px;height:240px"  
		 id="player1"> 
	</a> 
	<?php echo $javascript->codeBlock('flowplayer("player1", "/'.Configure::read('swfPath').'flowplayer-3.1.1.swf",{
		clip: {
		autoPlay: false,
		autoBuffering: false
		}
		});'); ?>
	<?php // *** The copy film *** 
	?>
	<h3>The reconstruction</h3>
	<a  
	href="<?php echo sprintf('%svideo/copy/%05d.flv',$html->url('/'.Configure::read('mediaPath',true),true),$film['Film']['id']); ?>"
		 style="display:block;width:320px;height:240px"  
		 id="player2"> 
	</a> 
	<?php echo $javascript->codeBlock('flowplayer("player2", "/'.Configure::read('swfPath').'flowplayer-3.1.1.swf",{
		clip: {
		autoPlay: false,
		autoBuffering: false
		}
		});'); ?>
	<?php foreach($suggestFrames as $suggestFrame):?>
	<div>
	<?php echo $html->link(
		$html->image(sprintf('/%sframes/original/%05d/%s',Configure::read('mediaPath'),$suggestFrame['Original']['film_id'],$suggestFrame['Original']['file']),array('class'=>'thumbnail') )
		,array('controller'=>'Copies','action'=>'add',$suggestFrame['Original']['id']),null,null,false); ?>
	
	</div>
	<?php endforeach; ?>
</div>
<div class="actions">
<?php echo $html->link(__('Adopt a frame!',true),array('controller'=>'Films','action'=>'adoptFrame',$film['Film']['id'])); ?>
</div>

