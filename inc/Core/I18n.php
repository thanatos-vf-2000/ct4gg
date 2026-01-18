<?php
/**
 *
 * @package CT4GGPluginPlugin
 * @version 1.4.23
 */
namespace CT4GG\Core;

class I18n {
    public function register() {
		add_action( 'init', array( $this, 'init' ) );
	}

    public function init() {
        if ( is_textdomain_loaded( 'ct4gg' ) ) {
            return;
        }
		load_plugin_textdomain('ct4gg', false, CT4GG_PATH . '/languages');

	}
}