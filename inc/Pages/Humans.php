<?php
/**
 * @package  CT4GGPlugin
 * @Version 1.2.0
 */

namespace CT4GG\Pages;

use CT4GG\Core\BaseController;
use CT4GG\Api\SettingsApi;
use CT4GG\Api\Callbacks\AdminCallbacks;


/**
* 
*/
class Humans extends BaseController
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
				'page_title' => 'Humans', 
				'menu_title' => 'Humans', 
				'capability' => 'manage_options', 
				'menu_slug' => CT4GG_NAME.'_Humans', 
				'callback' => array( $this->callbacks, 'adminHumans' )
			)
		);
	}
}