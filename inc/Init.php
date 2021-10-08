<?php
/**
 * @package  CT4GGPlugin
 * @Version 1.1.0
 */

namespace CT4GG;

use CT4GG\Core\Options;

final class Init
{
	/**
	 * Store all the classes inside an array
	 * @return array Full list of classes
	 */
	public static function get_services() 
	{
		return [
			Core\SettingsLinks::class,
			Core\Enqueue::class,
			Pages\Dashboard::class,
			Pages\HTAcccess::class,
			Ui\Admin::class,
			Ui\Login::class,
			Ui\Post::class
		];
	}

	/**
	 * Loop through the classes, initialize them, 
	 * and call the register() method if it exists
	 * @return
	 */
	public static function register_services() 
	{

		$opt = get_option( CT4GG_NAME . '_plugin' );
		if (is_array($opt)) {
			if ( !array_key_exists('version',$opt) || $opt['version'] != CT4GG_VERSION) {
				Options::set_option('version',CT4GG_VERSION);
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
	 * @param  class $class    class from the services array
	 * @return class instance  new instance of the class
	 */
	private static function instantiate( $class )
	{
		$service = new $class();

		return $service;
	}
}