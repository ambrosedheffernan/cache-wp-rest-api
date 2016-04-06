<?php
function get_api_cache(){
	
	//dont run if we are calling to cache the file (see later in the code)
	if( isset($_GET['cachecall']) && $_GET['cachecall'] === true)
		return;
	
	$url = "$_SERVER[REQUEST_URI]";
	
	//do a little error checking
	
	$uri= explode('/',$url);
	
	//we have a array (1st key is blank)
	if( $uri[1] !== 'wp-json' || $uri[2] !== 'wp' || $uri[3] !== 'v2'){
		return;
	} 
	
	//lock down the possible endpoints we dont want idiots playing with this...
	$allowed_endpoints= array(
		'posts'
	);
	
	$endpoint= array_pop($uri); // not sure if this is valid or not, is there more structure to some api calls?
	
	if( !in_array( $endpoint, $allowed_endpoints) ){
		return;
	} 
	
	//ok reasonably confident its a api call...
	
	$cache_folder= get_stylesheet_directory().'/api_cache/';
	
	// prob best if not within php server but to get you going
	if(! file_exists ( $cache_folder ) ){
		mkdir($cache_folder); //warning 777!!
	}
	

	/*
	* Need to choose a method of control for your cached json files
	* you could clear out the folder on update post/ taxonomies etc
	* or cron clear out hourly/weekly whatever freq you want
	*/
	
	
	if( file_exists($cache_folder.$endpoint.'.json') ){
		$json= file_get_contents($cache_folder.$endpoint.'.json');
		header('Content-Type: application/json');
		echo $json;
		exit;// we need nothing else from php exit 
	} else {
		//make sure there will be no errors etc..
		$ch = curl_init();
		$url= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]?cachecall=true";
		$timeout= 5;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$json = curl_exec($ch);
		curl_close($ch);
		file_put_contents($cache_folder.$endpoint.'.json', $json);
		
		
	}
	
	
	
	
}


get_api_cache();