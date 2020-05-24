<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://remkus.devries.frl
 * @since             0.1.0
 * @package           Genindie
 *
 * @wordpress-plugin
 * Plugin Name:       GenIndie
 * Plugin URI:        https://github.com/remkus/genindie
 * Description:       Bringing the IndieWeb to the Genesis Framework by adding Microformats 2.0
 * Version:           0.1.0
 * Author:            Remkus de Vries
 * Author URI:        https://remkus.devries.frl
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       genindie
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'GENINDIE_VERSION', '0.1.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-genindie-activator.php
 */
function activate_genindie() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-genindie-activator.php';
	Genindie_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-genindie-deactivator.php
 */
function deactivate_genindie() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-genindie-deactivator.php';
	Genindie_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_genindie' );
register_deactivation_hook( __FILE__, 'deactivate_genindie' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-genindie.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    0.1.0
 */
function run_genindie() {

	$plugin = new Genindie();
	$plugin->run();

}
run_genindie();
