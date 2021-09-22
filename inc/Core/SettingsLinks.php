<?php
/**
 * @package  CT4GGPlugin
 * @Version 0.0.1
 */
namespace CT4GG\Core;

class SettingsLinks 
{
	public function register() 
	{
		add_filter( "plugin_action_links", array( $this, 'settings_link' ), 10, 5 );
	}

    /**
     * Adds the manage link in the plugins list
     *
     * @access global
     * @return string The manage link in the plugins list
     */
	public function settings_link( $actions, $CT4GG_FILE ) 
	{

        static $plugin;
 
        if (!isset($plugin))
            $plugin = plugin_basename(CT4GG_FILE);
        if ($plugin == $CT4GG_FILE) {
            $plugin_data = get_plugin_data(CT4GG_FILE );
            $actions[] = '<a href="admin.php?page=' . CT4GG_NAME . '_plugin">' . __('Settings') . '</a>';
            $actions[] =  '<a href="' . $plugin_data['PluginURI'] . '" target="_blank">' . __('Support') . '</a>';
            $actions[] =  '<a href="' . $plugin_data['AuthorURI'] . '" target="_blank">' . __('all GinkGos plugins ') . '</a>';
        }
            
        return $actions;

	}
}