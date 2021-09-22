<?php 
/**
 * @package  AlecadddPlugin
 */
namespace CT4GG\Core;

class BaseController
{
	public $plugin_path;

	public $plugin_url;

	public $plugin;

	public $managers = array();

	public function __construct() {
		$this->plugin_path = CT4GG_PATH;
		$this->plugin_url = CT4GG_URL;
		$this->plugin = CT4GG_NAME;
		$this->managers = array_merge(array(), Options::get_options());
	}

	public function activated( string $key )
	{
		$option = get_option( CT4GG_NAME.'_plugin' );

		return isset( $option[ $key ] ) ? $option[ $key ] : false;
	}
}