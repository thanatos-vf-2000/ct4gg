<?php
/*
Plugin Name: ct4gg
Plugin URI: https://ginkgos.net/plugin/ct4gg/
Description: Customiser Tools For GinkGos - Plugin / Customiser Tools for WordPress.
Version: 1.5.1
Requires at least: 5.2
Tested up to: 6.4.3
Requires PHP: 7.4
Author: Franck VANHOUCKE
Author URI: https://ginkgos.net/
Network: true
License: GPLv2 or later
Domain Path: /languages
Text Domain: ct4gg

Copyright 2020-2021 Franck VANHOUCKE

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

defined( 'ABSPATH' ) || die( 'Hey, what are you doing here? You silly human!' );


if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	include_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

/**
 * Plugin variable information
 */
define( 'CT4GG_VERSION', '1.5.1' );
define( 'CT4GG_NAME', 'ct4gg' );
define( 'CT4GG_FILE', __FILE__ );
define( 'CT4GG_PATH', plugin_dir_path( CT4GG_FILE ) );
define( 'CT4GG_URL', plugin_dir_url( CT4GG_FILE ) );

/**
 * The code that runs during plugin activation
 *
 * @return Bool value
 */
function ct4gg_activate_plugin() {
	CT4GG\Core\Activate::activate();
}
register_activation_hook( __FILE__, 'ct4gg_activate_plugin' );

/**
 * The code that runs during plugin deactivation
 *
 * @return None
 */
function ct4gg_deactivate_plugin() {
	CT4GG\Core\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'ct4gg_deactivate_plugin' );

/**
 * The code that run for Core executing
 */
if ( class_exists( 'CT4GG\\Init' ) ) {
	CT4GG\Init::register_services();
}
