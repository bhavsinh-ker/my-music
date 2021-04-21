<?php

/**
 *
 * @link              https://github.com/bhavsinh-ker
 * @since             1.0.0
 * @package           My_Music
 *
 * @wordpress-plugin
 * Plugin Name:       My Music
 * Plugin URI:        https://github.com/bhavsinh-ker/my-music
 * Description:       This plugin providing functionality for manage music albums
 * Version:           1.0.0
 * Author:            Bhavik Ker
 * Author URI:        https://github.com/bhavsinh-ker
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       my-music
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'MY_MUSIC_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-my-music-activator.php
 */
function activate_my_music() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-my-music-activator.php';
	My_Music_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-my-music-deactivator.php
 */
function deactivate_my_music() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-my-music-deactivator.php';
	My_Music_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_my_music' );
register_deactivation_hook( __FILE__, 'deactivate_my_music' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-my-music.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_my_music() {

	$plugin = new My_Music();
	$plugin->run();

}
run_my_music();
