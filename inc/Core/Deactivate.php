<?php
/**
 * @package  CT4GGPlugin
 * @Version 0.0.1
 */
namespace CT4GG\Core;

class Deactivate
{
	public static function deactivate() {
		flush_rewrite_rules();
		if ( get_option( CT4GG_NAME.'_plugin' ) ) {
			delete_option( CT4GG_NAME.'_plugin');
		}
	}
}