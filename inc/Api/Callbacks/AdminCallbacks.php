<?php 
/**
 * @package  AlecadddPlugin
 */
namespace CT4GG\Api\Callbacks;

use CT4GG\Core\BaseController;

class AdminCallbacks extends BaseController
{
	public function adminDashboard()
	{
		return require_once( "$this->plugin_path/templates/admin.php" );
	}

}