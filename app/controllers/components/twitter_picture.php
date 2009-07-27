<?php
class TwitterPictureComponent extends Object{
	
	
	// Get the largest (in bytes) img from a website:
	function findLargestImageURL($url){
		$header=array_change_key_case(get_headers($url, 1));
		// *** If we were redirected, use the new address:
		if(!empty($header['location'])){
			$url=$header['location'];
		}
		// *** If the URL already points directly at an image, simply return it: ***
		$accepted_image_mime_types=array(
			'image/jpeg',
			'image/jpg',
			'image/png',
			'image/gif'
			);
		if(in_array($header['content-type'],$accepted_image_mime_types) || in_array($header['content-type'][1],$accepted_image_mime_types)){
			return $url;
		}
		// *** Parse HTML for largest image: ***
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
			// Only continue if "200 OK" directly or after first redirect:
			if($header[0]=='HTTP/1.1 200 OK' || $header[1]=='HTTP/1.1 200 OK'){
				if(!empty($header['content-length'])){
					// If we were redirected, the second entry is the one.
					// See http://us3.php.net/manual/en/function.filesize.php#84130
					if(!empty($header['content-length'][1])){
						$header['content-length']=$header['content-length'][1];
					}
					if($header['content-length']>$largest_file_size){
					$largest_file_size=$header['content-length'];
					$largest_file_url=$img_url;
					}
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
		}
		return $largest_file_url;
	}
	
	// Helper function to get absolute URLs
	function InternetCombineUrl($absolute, $relative) {
		$p = parse_url($relative);
		//if($p["scheme"])return $relative;
		if(!empty($p["scheme"]))return $relative;
		
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
		//if($user) {
		if(!empty($user)) {
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
	function findURLs( $text ){
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
			return($m[0]);
		}
		return( array() );
	}
	// Return all words prefixed with #:
	function findHashTags($text){
		$find = "/(^|\s)#(\w*)/i";
		$c=preg_match_all($find,$text,$m);
		if( $c )
		{
			return( ($m[2]) );
		}
		return( array() );
	}

}
?>