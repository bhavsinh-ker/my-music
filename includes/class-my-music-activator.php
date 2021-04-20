<?php

/**
 * Fired during plugin activation
 *
 * @link       https://github.com/bhavsinh-ker
 * @since      1.0.0
 *
 * @package    My_Music
 * @subpackage My_Music/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    My_Music
 * @subpackage My_Music/includes
 * @author     Bhavik Ker <bhavik.ker@gmail.com>
 */
class My_Music_Activator {

	/**
	 * Action on plugin activation
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		/* Create Music Meta Database Table */
		global $wpdb;
		$musicmeta = $wpdb->prefix . 'musicmeta';
		// Check if db table is exist or not
		if($wpdb->get_var("show tables like '$musicmeta'") == $musicmeta) {
			// create database table
			$sql = "CREATE TABLE `$musicmeta` ( 
				`music_meta_id` INT NOT NULL AUTO_INCREMENT , 
				`music_id` INT NOT NULL , 
				`music_meta_key` VARCHAR(50) NOT NULL , 
				`music_meta_value` TEXT NULL , 
				PRIMARY KEY (`music_meta_id`)
				) ENGINE = InnoDB;";
			$wpdb->query($sql);
		}
		/* EOF Create Music Meta Database Table */
	}

}
