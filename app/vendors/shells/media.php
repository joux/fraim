<?php 
class MediaShell extends Shell{
	var $uses=array('Film');
	var $tasks=array('ConvertNextFilm','RenderNextFilm','RenderFilm');
	
	function main(){
	$this->out('Hallo. Das hier ist die Media Shell');	
		
	}
	
}
?>