<?php
/**
 * @package  CT4GGPlugin
 * @Version 1.4.5
 */

namespace CT4GG\Pages;

use CT4GG\Core\BaseController;
use CT4GG\Api\SettingsApi;
use CT4GG\Api\Callbacks\AdminCallbacks;


/**
* 
*/
class Security extends BaseController
{
    public $callbacks;

	public $subpages = array();

	public function register()
	{
		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();

		$this->setSubpages();

		$this->settings->addSubPages( $this->subpages )->register();
	}

	public function setSubpages()
	{
		$this->subpages = array(
			array(
				'parent_slug' => CT4GG_NAME.'_plugin', 
				'page_title' => 'Security', 
				'menu_title' => 'Security', 
				'capability' => 'manage_options', 
				'menu_slug' => CT4GG_NAME.'_security', 
				'callback' => array( $this->callbacks, 'adminSecurity' )
			)
		);
	}
}