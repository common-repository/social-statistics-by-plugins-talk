<?php
/*
Plugin Name: Social Statistics By Plugins Talk
Plugin URI: http://dev.pluginstalk.com/social-statistics
Description: Find our your <strong>most popular posts</strong> by getting the social statistics for each and every post. Display count of <strong>Facebook</strong> (Likes,comments & shares), <strong>Twitter</strong> tweets, <strong>LinkedIn</strong> shares, <strong>Pinterest</strong> pins and more. For more info visit <a href="http://dev.pluginstalk.com/social-statistics" target="_blank">click here</a> or open <a href="http://pluginstalk.com" target="_blank">PluginsTalk.com</a>
Version: 1.0.0
Author: Sunil
Author URI: http://www.pluginstalk.com
*/

//Set plugin dirname
define('PTSS_BASE_DIRECTORY', dirname(plugin_basename(__FILE__)), TRUE);

if ( !function_exists( 'ptssCurPageURL' ) ) {
	function ptssCurPageURL() {
		$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
}
	
if ( is_admin() ) {	
	$url = ptssCurPageURL();
	$parse = parse_url ($url);
	$url = $parse['path'];
	$parse = explode ( "/" , $url );
	$url = sizeof( $parse ) - 2;
	$result="";
	
	for($i=1; $i <= $url ; $i++ ) {
		$result = "";
		for($j=1; $j <= $i; $j++){
			$result = $result."../";
		}
	}
	$result = substr( $result , 0, -1 );

	define('PTSS_BASE_URL', $result.current(array_slice(parse_url(plugins_url(PTSS_BASE_DIRECTORY)), 2,1)) , TRUE);
} else {
	define('PTSS_BASE_URL', '.'.current(array_slice(parse_url(plugins_url(PTSS_BASE_DIRECTORY)), 2,1)) , TRUE);
}

include ( PTSS_BASE_URL.'/php/includes.php' );
ptssAddActions();
?>