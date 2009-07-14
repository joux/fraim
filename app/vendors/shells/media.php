<?php 
class MediaShell extends SHell{
	var $uses=array('Film');
	var $tasks=array('ConvertNextFilm');
	
	function main(){
	$this->out('Hallo. Das hier ist die Media Shell');	
		
	}
	
}
?>