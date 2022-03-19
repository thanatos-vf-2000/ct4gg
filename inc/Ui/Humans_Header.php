<?php
/**
 * @package  CT4GGPlugin
 * @Version 1.4.0
 */

namespace CT4GG\ui;

use CT4GG\Core\BaseController;

/**
* 
*/
class Humans_Header extends BaseController
{
    public function register()
    {
        $robots_file = ABSPATH."humans.txt";
        if (file_exists($robots_file)) {
            add_action('wp_head', array( $this, 'head_author'));
        }
    }

    public function head_author(){
        echo '<link type="text/plain" rel="author" href="' . get_site_url() . '/humans.txt" />';
    }
}