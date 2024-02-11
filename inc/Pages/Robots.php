<?php
/**
 * Page Robots
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

namespace CT4GG\Pages;

use CT4GG\Core\BaseController;
use CT4GG\Api\SettingsApi;
use CT4GG\Api\Callbacks\AdminCallbacks;

/**
 *
 */
class Robots extends BaseController {

	public $callbacks;

	public $subpages = array();

	public function register() {
		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();

		$this->setSubpages();

		$this->settings->add_sub_pages( $this->subpages )->register();
	}

	public function setSubpages() {
		$this->subpages = array(
			array(
				'parent_slug' => CT4GG_NAME . '_plugin',
				'page_title'  => 'Robots',
				'menu_title'  => 'Robots',
				'capability'  => 'manage_options',
				'menu_slug'   => CT4GG_NAME . '_robots',
				'callback'    => array( $this->callbacks, 'adminRobots' ),
			),
		);
	}
}
