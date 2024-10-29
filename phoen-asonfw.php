<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://phoeniixx.com/
 * @since             1.0.0
 * @package           Phoen_Asonfw
 *
 * @wordpress-plugin
 * Plugin Name:       Advanced Sequential Order Number for WooCommerce
 * Plugin URI:        https://phoeniixx.com/product/advanced-sequential-order-number-for-wooCommerce
 * Description:       Advanced Sequential order number plugin will help you to set your new orders in a sequence. 
 * Version:           1.0.4
 * Author:            phoeniixx
 * Author URI:        https://phoeniixx.com/
 * WC requires at least: 2.6.0
 * WC tested up to:   4.0.0
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       phoen-asonfw
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
define( 'PHOEN_ASONFW_VERSION', '1.0.0' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-phoen-asonfw.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_phoen_asonfw() {

	$plugin = new Phoen_Asonfw();
	$plugin->run();

}
run_phoen_asonfw();
