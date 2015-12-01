<?php
/**
 * Plugin Name: Base Plugin
 * Description: The beginnings of yet another awesome plugin.
 * Version: 0.1.0
 * License: GPL-2.0+
 */

use BasePlugin\Plugin;

/** @var wpdb $wpdb */
global $wpdb;

require "vendor/autoload.php";

$plugin = new Plugin();

$plugin['path']    = realpath( plugin_dir_path( __FILE__ ) ) . DIRECTORY_SEPARATOR;
$plugin['url']     = plugin_dir_url( __FILE__ );
$plugin['version'] = '0.1.0'; // don't forget to update the comment block as well
$plugin['nonce']   = 'NonceKey';

// DB details
$plugin['db_version']     = 1;
$plugin['db_option_name'] = 'BasePlugin_db_version';
$plugin['db_table_name']  = $wpdb->prefix . 'baseplugin_table_name';

//Activator
$plugin['activator'] = function ( $c ) {
	return new BasePlugin\Activator( __FILE__, $c['db_version'], $c['db_option_name'], $c['db_table_name'] );
};

// Example, please delete, along with associated file
// the previously defined services and variables are available through
// the function parameter
$plugin['example'] = function ( $c ) {
	return new \BasePlugin\Example( $c['path'], $c['log'] );
};

$plugin->run();