<?php
class TwitterPictureComponent extends Object{
	
	
	// Get the largest (in bytes) img from a website:
	function getLargestImageURL($url){
		// Import the library:
		App::import('Vendor', 'SimpleHTML', array('file' => 'simple_html_dom.php'));
		$html = file_get_html($url);
		// Find all images
		$largest_file_size=0;
		$largest_file_url='';
		foreach($html->find('img') as $element){
			$img_url=$this->InternetCombineUrl($url,$element->src);
			// Try to get size info from header:
			$header=array_change_key_case(get_headers($img_url, 1));
			if($header['content-length']){
				if($header['content-length']>$largest_file_size){
				$largest_file_size=$header['content-length'];
				$largest_file_url=$img_url;
				}
				// TODO: make redirections work, too
				// See http://us3.php.net/manual/en/function.filesize.php#84130
			}else{ 
				// If no content-length-header is sent, we need to download the image:
				$tmp_filename=sha1($img_url);
				$content = file_get_contents($img_url);
				$handle = fopen(TMP.$tmp_filename, "w");
				fwrite($handle, $content);
				fclose($handle);
				$filesize=filesize(TMP.$tmp_filename);
				if($filesize>$largest_file_size){
				$largest_file_size=$filesize;
				$largest_file_url=$img_url;
				unlink(TMP.$tmp_filename);
				}
			}
			 
		}
		return $largest_file_url;
	}
	
	// Helper function to get absolute URLs
	function InternetCombineUrl($absolute, $relative) {
		$p = parse_url($relative);
		if($p["scheme"])return $relative;
		
		extract(parse_url($absolute));
		
		$path = dirname($path); 
	    
		if($relative{0} == '/') {
		    $cparts = array_filter(explode("/", $relative));
		}
		else {
		    $aparts = array_filter(explode("/", $path));
		    $rparts = array_filter(explode("/", $relative));
		    $cparts = array_merge($aparts, $rparts);
		    foreach($cparts as $i => $part) {
			if($part == '.') {
			    $cparts[$i] = null;
			}
			if($part == '..') {
			    $cparts[$i - 1] = null;
			    $cparts[$i] = null;
			}
		    }
		    $cparts = array_filter($cparts);
		}
		$path = implode("/", $cparts);
		$url = "";
		if($scheme) {
		    $url = "$scheme://";
		}
		if($user) {
		    $url .= "$user";
		    if($pass) {
			$url .= ":$pass";
		    }
		    $url .= "@";
		}
		if($host) {
		    $url .= "$host/";
		}
		$url .= $path;
		return $url;
	}
	
	// return all links found in a text:
	function find_URLS( $text ){
		// build the patterns
		$scheme         =       '(http:\/\/|https:\/\/)';
		$www            =       'www\.';
		$ip             =       '\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}';
		$subdomain      =       '[-a-z0-9_]+\.';
		$name           =       '[a-z][-a-z0-9]+\.';
		$tld            =       '[a-z]+(\.[a-z]{2,2})?';
		$the_rest       =       '\/?[a-z0-9._\/~#&=;%+?-]+[a-z0-9\/#=?]{1,1}';            
		$pattern        =       "$scheme?(?(1)($ip|($subdomain)?$name$tld)|($www$name$tld))$the_rest";
		
		$pattern        =       '/'.$pattern.'/is';
		$c              =       preg_match_all( $pattern, $text, $m );
		unset( $text, $scheme, $www, $ip, $subdomain, $name, $tld, $the_rest, $pattern );
		if( $c )
		{
		return( array_flip($m[0]) );
		}
		return( array() );
	}

}
?>