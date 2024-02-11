<?php
/**
 * Admin Callbacks
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
 * @since     1.0.0
 */

namespace CT4GG\Api\Callbacks;

use CT4GG\Core\BaseController;

/**
 * Class AdminCallbacks
 */
class AdminCallbacks extends BaseController {

	/**
	 * Function adminDashboard
	 *
	 * @return Page
	 */
	public function adminDashboard() {
		return include_once "$this->plugin_path/templates/admin.php";
	}

	/**
	 * Function adminHtaccess
	 *
	 * @return Page
	 */
	public function adminHtaccess() {
		return include_once "$this->plugin_path/templates/htaccess.php";
	}

	/**
	 * Function adminRobots
	 *
	 * @return Page
	 */
	public function adminRobots() {
		return include_once "$this->plugin_path/templates/robots.php";
	}

	/**
	 * Function adminHumans
	 *
	 * @return Page
	 */
	public function adminHumans() {
		return include_once "$this->plugin_path/templates/humans.php";
	}

	/**
	 * Function adminSecurity
	 *
	 * @return Page
	 */
	public function adminSecurity() {
		return include_once "$this->plugin_path/templates/security.php";
	}

	/**
	 * Function adminHeader
	 *
	 * @return Page
	 */
	public function adminHeader() {
		return include_once "$this->plugin_path/templates/header.php";
	}
}
