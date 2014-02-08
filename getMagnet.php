<?php


	if($_COOKIE['safesearch'] == 'On'){
		echo 'safesearch is on, but not working, getMagnet.php L#(s) 4-6';
		die;
	}


	$search_term = str_replace(' ', '%20', $_GET['q']);
	$page_content = file_get_contents('http://thepiratebay.se/search/'.$search_term.'/0/7/0');
	$magnets = array();
	$dom = new DOMDocument();
	$dom->loadHTML($page_content);

	$anchors = $dom->getElementsByTagName('a');

	if ( count($anchors->length) > 0 ) {
	    foreach ( $anchors as $anchor ) {
	        if ( $anchor->hasAttribute('href') ) {
	            $url = $anchor->getAttribute('href');
	            if (substr($url, 0, 14) === 'magnet:?xt=urn'){
	            	//add to magnets array
					array_push($magnets, $url);
	            }
	        }
	    }
	}

	//This segment over hurr will check to see if the magnets array is empty, if it is it will hide our buttons
	$magcheck = array_filter($magnets);
	if (empty($magcheck)) {
		echo '<style type="text/css">#magnetLink,#clearSearch{display:none;}</style>';
		echo '<img src="http://0-media-cdn.foolz.us/ffuuka/board/gd/image/1389/31/1389311265704.gif" width="30px">';
	}
		echo '<a id="magnetLink" href="'.reset($magnets).'" class="btn btn-default" data-loading-text="Loading...">Feeling Lucky</a>';
		echo '&nbsp;&nbsp;<button id="clearSearch" type="reset" class="btn btn-danger" onclick="getMagnet(this.value);clearSearch();FocusOnInput();">x</button>'
	
?>