<?php
/**
 * Base Controller
 *
 * PHP version 7
 *
 * @category  PHP
 * @package   CT4GGPlugin
 * @author    Franck VANHOUCKE <ct4gg@ginkgos.net>
 * @copyright 2021-2023 Copyright 2023, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later
 * @version   1.5.1 GIT:https://github.com/thanatos-vf-2000/WordPress
 * @link      https://ginkgos.net
 */

namespace CT4GG\Core;
/**
 * Class BaseController
 */
class BaseController {

	public $plugin_path;

	public $plugin_url;

	public $plugin;

	public $managers = array();

	public function __construct() {
		$this->plugin_path = CT4GG_PATH;
		$this->plugin_url  = CT4GG_URL;
		$this->plugin      = CT4GG_NAME;
		$this->managers    = array_merge( array(), Options::get_options() );
	}

	public function activated( string $key ) {
		$option = get_option( CT4GG_NAME . '_plugin' );

		return isset( $option[ $key ] ) ? $option[ $key ] : false;
	}

	/**
	 * Get Template File
	 *
	 * @param $template
	 */
	public static function get_template( $template ) {

		// Check Load single file or array list
		if ( is_string( $template ) ) {
			$template = explode( ' ', $template );
		}

		// Load File
		foreach ( $template as $file ) {
			$template_file = CT4GG_PATH . 'templates-part/' . $file . '.php';
			if ( ! file_exists( $template_file ) ) {
				continue;
			}

			// include File
			include $template_file;
		}
	}

	/**
	 * Get Template File
	 *
	 * @param name
	 * @param args
	 */
	public static function view( $name, $args = array() ) {
		$args = apply_filters( 'ct4gg_view_arguments', $args, $name );

		foreach ( $args as $key => $val ) {
			$$key = $val;
		}

		load_plugin_textdomain( 'ct4gg' );

		$file = CT4GG_PATH . 'assets/messages/' . $name . '.php';

		include $file;
	}
}
