<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://phoeniixx.com/
 * @since      1.0.0
 *
 * @package    Phoen_Asonfw
 * @subpackage Phoen_Asonfw/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Phoen_Asonfw
 * @subpackage Phoen_Asonfw/includes
 * @author     phoeniixx <support@phoeniixx.com>
 */
class Phoen_Asonfw_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'phoen-asonfw',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
