<?php
//Set Plugin Version
define ( 'PTSS_PLUGIN_VERSION', '1.0.0', TRUE );
//Set User Capability
define ( 'PTSS_USER_CAPABILITY', 'publish_posts', TRUE );
//Set Base Prefix
global $wpdb;
define ( 'PTSS_TABLE_PREFIX', $wpdb->base_prefix, TRUE );
//Set Table Name
define ( 'PTSS_TABLE_NAME', TABLE_PREFIX.'pluginsTalkSocialStatistics', TRUE );
//Set My Number
define ( 'PT_MY_NUMBER', '99.000000000179', TRUE );
?>