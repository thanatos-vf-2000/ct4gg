<?php
/**
 * @package CT4GGPlugin
 * @version 1.4.8
 */

namespace CT4GG\Pages;

use CT4GG\Core\BaseController;
use CT4GG\Api\SettingsApi;
use CT4GG\Api\Callbacks\AdminCallbacks;

/**
*
*/
class Robots extends BaseController
{
    public $callbacks;

    public $subpages = array();

    public function register()
    {
        $this->settings = new SettingsApi();

        $this->callbacks = new AdminCallbacks();

        $this->setSubpages();

        $this->settings->addSubPages($this->subpages)->register();
    }

    public function setSubpages()
    {
        $this->subpages = array(
            array(
                'parent_slug' => CT4GG_NAME.'_plugin',
                'page_title' => 'Robots',
                'menu_title' => 'Robots',
                'capability' => 'manage_options',
                'menu_slug' => CT4GG_NAME.'_robots',
                'callback' => array( $this->callbacks, 'adminRobots' )
            )
        );
    }
}
