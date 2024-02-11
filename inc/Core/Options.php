<?php
/**
 * Class Options
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

class Options {

	/**
	 * Class instance.
	 *
	 * @since  0.0.1
	 * @access private
	 * @var    $instance Class instance.
	 */
	private static $instance;

	/**
	 * A static option variable.
	 *
	 * @since  0.0.1
	 * @access private
	 * @var    mixed $db_options
	 */
	private static $db_options;

	/**
	 * A static option variable.
	 *
	 * @since 0.0.1
	 * @access private
	 * @var mixed $db_options
	 */
	private static $db_options_no_defaults;

	/**
	 * Initiator
	 *
	 * @since 0.0.1
	 */
	public function register() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
			if ( empty( self::$db_options ) ) {
				self::refresh();
			}
		}
	}

	/**
	 * LoadPHPConfig - load default config for plugin
	 *
	 * @since  1.3.0
	 * @return array()
	 */
	public static function load_php_config( $path ) {

		if ( ! file_exists( $path ) ) {
			return array();
		}

		$content = require $path;

		return $content;
	}

	/**
	 * Set default option values
	 *
	 * @since  0.0.1
	 * @return default values of the .
	 */
	public static function defaults() {
		// Defaults list of options.
		$defaults_sys = array(
			'version' => '0.0.0',
			't'       => time(),
		);
		$defaults_app = self::load_php_config( CT4GG_PATH . 'assets/options.php' );

		return array_merge( $defaults_sys, $defaults_app );
	}

	/**
	 * Get options from static array()
	 *
	 * @since  0.0.1
	 * @return array    Return array of options.
	 */
	public static function get_options() {
		if ( empty( self::$db_options ) ) {
			self::refresh();
		}
		return self::$db_options;
	}

	/**
	 * Get specific option
	 *
	 * @since  0.0.1
	 * @return array    Return array of options.
	 */
	public static function get_option( $opt ) {
		if ( empty( self::$db_options ) ) {
			self::refresh();
		}
		return self::$db_options[ $opt ];
	}

	/**
	 * Update  static option array.
	 *
	 * @since 0.0.1
	 */
	public static function refresh() {
		self::$db_options = wp_parse_args(
			self::get_db_options(),
			self::defaults()
		);
	}

	/**
	 * Get options from static array() from database
	 *
	 * @since  0.0.1
	 * @return array    Return array of options from database.
	 */
	public static function get_db_options() {
		self::$db_options_no_defaults = get_option( CT4GG_NAME . '_plugin' );
		return self::$db_options_no_defaults;
	}

	/**
	 * Set option to database
	 *
	 * @since  0.0.1
	 * @return true/false
	 */
	public static function set_option( $name, $value ) {
		if ( empty( self::$db_options ) ) {
			self::refresh();
		}
		self::$db_options[ $name ] = $value;
		self::$db_options['t']     = time();
		update_option( CT4GG_NAME . '_plugin', self::$db_options );
		return true;
	}

	/**
	 * Delete option to database
	 *
	 * @since  0.0.1
	 * @return true/false
	 */
	public static function del_option( $name ) {
		if ( empty( self::$db_options ) ) {
			self::refresh();
		}
		unset( self::$db_options[ $name ] );
		self::$db_options['t'] = time();
		update_option( CT4GG_NAME . '_plugin', self::$db_options );
		return true;
	}
}
