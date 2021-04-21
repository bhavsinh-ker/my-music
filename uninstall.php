<?php

/**
 *
 * @link       https://github.com/bhavsinh-ker
 * @since      1.0.0
 *
 * @package    My_Music
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

/* Remove Music Meta database table */
global $wpdb;
$musicmeta = $wpdb->prefix . 'musicmeta';
$sql = "DROP TABLE IF EXISTS $musicmeta;";
$wpdb->query($sql);
/* EOF Remove Music Meta database table */