<?php
/**
 * @package  CT4GGPlugin
 * @Version 0.0.1
 */

namespace CT4GG\ui;

use CT4GG\Core\BaseController;

/**
* 
*/
class Admin extends BaseController
{
    public function register()
    {
        if ( $this->activated( 'classic_widgets' ) ) {
            // Disables the block editor from managing widgets in the Gutenberg plugin.
            //add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
            // Disables the block editor from managing widgets.
            //add_filter( 'use_widgets_block_editor', '__return_false' );
            add_action( 'after_setup_theme', array( $this,'classic_widgets_theme_support') );
        }

        // Disables check email interval
        if ( ! $this->activated( 'admin_email_check_interval' ) ) {
            add_filter('admin_email_check_interval', '__return_false');
        } else {
            add_filter('admin_email_check_interval', array( $this, 'admin_email_check_interval'));
        }

        if ( $this->activated( 'disable_jetpack_Automattic' ) ) {
            /* Hide Jetpack Banner */
            add_filter('jetpack_just_in_time_msgs', '__return_false');
        }


    }

    public function admin_email_check_interval() 
    {
        $opt = get_option( $option_name );
        $delay  = (int) $opt['admin_email_check_interval_val'];
        $type = (int) $opt['admin_email_check_interval_type'];
        return $delay * $type;
    }

    public function classic_widgets_theme_support() {
        remove_theme_support( 'widgets-block-editor' );
    }

}