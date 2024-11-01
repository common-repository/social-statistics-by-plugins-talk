<?php
class PTSS_Variables {
	private static $_slug = array( "_main" => "plugins-talk", "_subInfo" => "plugins-talk", "_subPlugin" => "social-statistics-by-plugins-talk" );
	private static $_menu = array( "_main" => "Plugins Talk", "_subInfo" => "About Plugins Talk", "_subPlugin" => "Social Statistics" );
	private static $_title = array( "_subInfo" => "Something About Plugins Talk", "_subPlugin" => "Social Statistics By Plugins Talk" );
	private static $_function = array( "_subInfo" => "ptssAboutPluginsTalk", "_subPlugin" => "socialStatisticsByPluginsTalk" );	
	
	public static function getVariable ( $name, $type ) {		
		if ( $type == "__SLUG__" ){
			return PTSS_Variables::$_slug[$name];
		} else if ( $type == "__MENU__" ) {
			return PTSS_Variables::$_menu[$name];
		} else if ( $type == "__TITLE__" ) {
			return PTSS_Variables::$_title[$name];
		} else if ( $type == "__FUNCTION__" ) {
			return PTSS_Variables::$_function[$name];
		} else {
			return null;
		}
	}
}
?>