<?php $javascript->link('flowplayer-3.1.1.min.js',false); 
?>
<div class="films view">
	<h2><?php echo $film['Film']['title'];?></h2>
	<p>
		<?php echo $film['Film']['description'];?>
	</p>
	<?php // *** The copy film *** 
	?>
	<div id="reconstructedVideo">
		<h3>The reconstruction</h3>
		<a  
		href="<?php echo sprintf('%svideo/copy/%05d.flv',$html->url('/'.Configure::read('mediaPath',true),true),$film['Film']['id']); ?>"
			 class="bigVideoPlayer"  
			 id="player2"> 
		</a> 
		<?php echo $javascript->codeBlock('flowplayer("player2", "/'.Configure::read('swfPath').'flowplayer-3.1.1.swf",{
			clip: {
			autoPlay: false,
			autoBuffering: false
			}
			});'); ?>
	</div>
	<div id="originalVideo">
		<?php // *** The original film *** 
		?>
		<h3>The original</h3>
		<a  
		href="<?php echo sprintf('%svideo/original/%05d.flv',$html->url('/'.Configure::read('mediaPath',true),true),$film['Film']['id']); ?>"
			 class="smallVideoPlayer"  
			 id="player1"> 
		</a> 
		<?php echo $javascript->codeBlock('flowplayer("player1", "/'.Configure::read('swfPath').'flowplayer-3.1.1.swf",{
			clip: {
			autoPlay: false,
			autoBuffering: false
			}
			});'); ?>
	</div>
	<div id="suggestedFrames">
		<?php // *** Suggest frames to copy: *** 
		?>
		<h3>Reconstruct a frame yourself</h3>
		<div class="thumbnailBox">
		<?php foreach($suggestFrames as $suggestFrame):?>
		<div>
		<?php echo $html->link(
			$html->image(sprintf('/%sframes/original/%05d/%s',Configure::read('mediaPath'),$suggestFrame['Original']['film_id'],$suggestFrame['Original']['file']),array('class'=>'thumbnail') )
			,array('controller'=>'Copies','action'=>'add',$suggestFrame['Original']['id']),null,null,false); ?>
		
		</div>
		<?php endforeach; ?>
		Or <?php echo $html->link(__('reconstruct a random frame',true),array('controller'=>'Films','action'=>'adoptFrame',$film['Film']['id'])); ?>
		</div>
	</div>
</div>
