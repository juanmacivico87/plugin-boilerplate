<?php
/*
Plugin Name: Plugin Boilerplate
Plugin URI: https://github.com/juanmacivico87/plugin-boilerplate
Description: Boilerplate to develop a plugin to WordPress
Version: 0.3.0
Author: Juan Manuel Civico Cabrera
Author URI: https://www.juanmacivico87.com
License: GPLv2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  plugin-boilerplate
Domain Path:  /languages
*/

if ( false === defined( 'ABSPATH' ) ) {
    exit;
}

require_once 'vendor/autoload.php';

use PluginBoilerplate\App\App;

$plugin_boilerplate = new App();

define( 'PLUGIN_BOILERPLATE_LANG_DIR', plugin_dir_path( __FILE__ ) . '/languages' );
define( 'PLUGIN_BOILERPLATE_FILE', __FILE__ );
define( 'PLUGIN_BOILERPLATE_DIR', plugin_dir_path( __FILE__ ) );
define( 'PLUGIN_BOILERPLATE_URL', plugin_dir_url( __FILE__ ) );
define( 'PLUGIN_BOILERPLATE_PUBLIC_ASSETS', PLUGIN_BOILERPLATE_URL . '/public' );
define( 'PLUGIN_BOILERPLATE_ADMIN_ASSETS', PLUGIN_BOILERPLATE_URL . '/admin' );

define( 'PLUGIN_BOILERPLATE_NAME', 'Plugin Boilerplate' );
define( 'PLUGIN_BOILERPLATE_VERSION', '0.3.0' );
define( 'PLUGIN_BOILERPLATE_TEXTDOMAIN', 'plugin-boilerplate' );
