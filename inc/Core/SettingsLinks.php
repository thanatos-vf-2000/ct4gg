<?php
/**
 * Class SettingsLinks
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

namespace CT4GG\Core;

class SettingsLinks {

	public function register() {
		add_filter( 'plugin_action_links', array( $this, 'settings_link' ), 10, 5 );
	}

	/**
	 * Adds the manage link in the plugins list
	 *
	 * @access global
	 * @return string The manage link in the plugins list
	 */
	public function settings_link( $actions, $ct4gg_file ) {

		static $plugin;

		if ( ! isset( $plugin ) ) {
			$plugin = plugin_basename( CT4GG_FILE );
		}
		if ( $plugin === $ct4gg_file ) {
			$plugin_data = get_plugin_data( CT4GG_FILE );
			$actions[]   = '<a href="admin.php?page=' . CT4GG_NAME . '_plugin">' . __( 'Settings' ) . '</a>';
			$actions[]   = '<a href="' . $plugin_data['PluginURI'] . '" target="_blank">' . __( 'Support' ) . '</a>';
			$actions[]   = '<a href="' . $plugin_data['AuthorURI'] . '" target="_blank">' . __( 'all GinkGos plugins ' ) . '</a>';
		}

		return $actions;
	}
}
