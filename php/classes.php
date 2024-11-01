<?php
class PTSS_MenuHandler {
	private function _checkMenu($handle, $sub = false) {
		if(!is_admin() || (defined('DOING_AJAX') && DOING_AJAX)) {
			return false;
		}
		global $menu, $submenu;
		$check_menu = $sub ? $submenu : $menu;
		if(empty($check_menu)) {
			return false;
		}
		foreach ($check_menu as $k => $item) {
			if ($sub) {
				foreach($item as $sm) {
				  if($handle == $sm[2]) {
				    return true;
				  }
				}
			} else {
				if($handle == $item[2]) {
				  return true;
				}
			}
		}
		return false;
	}
	
	function __construct() {
		if ( !$this->_checkMenu( ptssGetter ( "__SLUG__" , "_main" ) ) ) {
			add_menu_page("Top Heading Menu", ptssGetter ( "__MENU__" , "_main" ), PTSS_USER_CAPABILITY, ptssGetter ( "__SLUG__" , "_main" ), ptssGetter ( "__FUNCTION__" , "_subInfo" ), PTSS_BASE_URL.'/images/logo_16.png' , PT_MY_NUMBER);
		}
	
		if ( !$this->_checkMenu( ptssGetter ( "__SLUG__" , "_subInfo" ) , true ) ) {
			add_submenu_page( ptssGetter ( "__SLUG__" , "_main" ), ptssGetter ( "__TITLE__" , "_subInfo" ), ptssGetter ( "__MENU__" , "_subInfo" ), PTSS_USER_CAPABILITY, ptssGetter ( "__SLUG__" , "_subInfo" ), ptssGetter ( "__FUNCTION__" , "_subInfo" ) );
		}
		if ( !$this->_checkMenu( ptssGetter ( "__SLUG__" , "_subPlugin" ) , true ) ) {
			add_submenu_page( ptssGetter ( "__SLUG__" , "_main" ), ptssGetter ( "__TITLE__" , "_subPlugin" ), ptssGetter ( "__MENU__" , "_subPlugin" ), PTSS_USER_CAPABILITY, ptssGetter ( "__SLUG__" , "_subPlugin" ), ptssGetter ( "__FUNCTION__" , "_subPlugin" ) );
		}
		
	}
}
?>