<?php $javascript->link('flowplayer-3.1.1.min.js',false); 
?>
<div class="films view">
<h2><?php echo $film['Film']['title'];?></h2>
	<a  
	href="<?php echo sprintf('%svideo/%05d.flv',$html->url('/'.Configure::read('mediaPath',true),true),$film['Film']['id']); ?>"
		 style="display:block;width:520px;height:330px"  
		 id="player"> 
	</a> 
	<?php echo $javascript->codeBlock('flowplayer("player", "/'.Configure::read('swfPath').'flowplayer-3.1.1.swf",{
		clip: {
		autoPlay: false,
		autoBuffering: true
		}
		});'); ?>
</div>

