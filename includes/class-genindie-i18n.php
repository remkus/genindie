<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://remkus.devries.frl
 * @since      0.1.0
 *
 * @package    Genindie
 * @subpackage Genindie/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      0.1.0
 * @package    Genindie
 * @subpackage Genindie/includes
 * @author     Remkus de Vries <remkus@burokreas.nl>
 */
class Genindie_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    0.1.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'genindie',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
