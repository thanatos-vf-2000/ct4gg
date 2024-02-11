<?php
/**
 * Init file
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

namespace CT4GG;

use CT4GG\Core\Options;

final class Init {

	/**
	 * Store all the classes inside an array
	 *
	 * @return array Full list of classes
	 */
	public static function get_services() {
		return array(
			Core\SettingsLinks::class,
			Core\Enqueue::class,
			Pages\Dashboard::class,
			Pages\Header::class,
			Pages\HTAccess::class,
			Pages\Robots::class,
			Pages\Humans::class,
			Pages\Security::class,
			Theme\Login::class,
			Ui\Admin::class,
			Ui\AdminAjax::class,
			Ui\Login::class,
			Ui\Post::class,
			Ui\Humans_Header::class,
			Ui\SocialButtons::class,
			Ui\Messages::class,
			Ui\Security_Header::class,
		);
	}

	/**
	 * Loop through the classes, initialize them,
	 * and call the register() method if it exists
	 */
	public static function register_services() {

		$opt = get_option( CT4GG_NAME . '_plugin' );
		if ( is_array( $opt ) ) {
			if ( ! array_key_exists( 'version', $opt ) || CT4GG_VERSION !== $opt['version'] ) {
				Options::set_option( 'version', CT4GG_VERSION );
			}
		}

		foreach ( self::get_services() as $class ) {
			$service = self::instantiate( $class );
			if ( method_exists( $service, 'register' ) ) {
				$service->register();
			}
		}
	}

	/**
	 * Initialize the class
	 *
	 * @param  class $class    class from the services array
	 *
	 * @return class instance  new instance of the class
	 */
	private static function instantiate( $class ) {
		$service = new $class();

		return $service;
	}
}
