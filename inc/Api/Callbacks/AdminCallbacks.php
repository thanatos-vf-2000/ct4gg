<?php 
/**
 * @package  CT4GGPlugin
 * @Version 1.2.0
 */
namespace CT4GG\Api\Callbacks;

use CT4GG\Core\BaseController;

class AdminCallbacks extends BaseController
{
	public function adminDashboard()
	{
		return require_once( "$this->plugin_path/templates/admin.php" );
	}

	public function adminHtaccess()
	{
		return require_once( "$this->plugin_path/templates/htaccess.php" );
	}
	
	public function adminRobots()
	{
		return require_once( "$this->plugin_path/templates/robots.php" );
	}

	public function adminHumans()
	{
		return require_once( "$this->plugin_path/templates/humans.php" );
	}

}