<?php
/**
 * @package CT4GGPlugin
 * @version 1.4.8
 */
namespace CT4GG\Core;

class Activate
{
    public static function activate()
    {
        flush_rewrite_rules();

        $default = array('v'=> CT4GG_VERSION,
            't'=> time());
        Options::set_option('version', CT4GG_VERSION);
    }
}
