<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.clopes.a2hosted.com/
 * @since             1.0.0
 * @package           Wc_Stu
 *
 * @wordpress-plugin
 * Plugin Name:       WooCommerce SKU to URL
 * Plugin URI:        https://github.com/networking2017/WC-SKU-to-URL.git
 * Description:       This is a custom plugin made to pass the SKUs of a cart to url.
 * Version:           1.0.0
 * Author:            Caleb Lopes
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wc-stu
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
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wc-stu-activator.php
 */
function activate_wc_stu() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wc-stu-activator.php';
	Wc_Stu_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wc-stu-deactivator.php
 */
function deactivate_wc_stu() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wc-stu-deactivator.php';
	Wc_Stu_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wc_stu' );
register_deactivation_hook( __FILE__, 'deactivate_wc_stu' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wc-stu.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wc_stu() {

	$plugin = new Wc_Stu();
	$plugin->run();

}



run_wc_stu();

