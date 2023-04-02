<?php
/**
 * @package CT4GGPlugin
 * @version 1.4.8
 */
namespace CT4GG\Core;

class Deactivate
{
    public static function deactivate()
    {
        flush_rewrite_rules();
        if (get_option(CT4GG_NAME.'_plugin')) {
            delete_option(CT4GG_NAME.'_plugin');
        }
    }
}
