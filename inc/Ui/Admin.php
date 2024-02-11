<?php
/**
 * Admin
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

namespace CT4GG\ui;

use CT4GG\Core\BaseController;

/**
 *
 */
class Admin extends BaseController {

	public function register() {
		if ( $this->activated( 'classic_widgets' ) ) {

			add_action( 'after_setup_theme', array( $this, 'classic_widgets_theme_support' ) );
		}

		if ( ! $this->activated( 'admin_email_check_interval' ) ) {
			add_filter( 'admin_email_check_interval', '__return_false' );
		} else {
			add_filter( 'admin_email_check_interval', array( $this, 'admin_email_check_interval' ) );
		}

		if ( $this->activated( 'disable_jetpack_Automattic' ) ) {
			/**
			 * Hide Jetpack Banner
			 */
			add_filter( 'jetpack_just_in_time_msgs', '__return_false' );
		}

		if ( $this->activated( 'admin_del_logo_wp' ) ) {
			add_action( 'admin_bar_menu', array( $this, 'del_logo_wp' ), 999 );
		}

		add_filter( 'admin_footer_text', array( $this, 'admin_footer_text' ) );
	}

	public function admin_email_check_interval() {
		$opt   = get_option( $option_name );
		$delay = (int) $opt['admin_email_check_interval_val'];
		$type  = (int) $opt['admin_email_check_interval_type'];
		return $delay * $type;
	}

	public function classic_widgets_theme_support() {
		remove_theme_support( 'widgets-block-editor' );
	}

	public static function del_logo_wp( $wp_admin_bar ) {
		if ( ! is_admin() ) {
			$wp_admin_bar->remove_node( 'about' );
			$wp_admin_bar->remove_node( 'wp-logo-external' );
		}
		$wp_admin_bar->remove_node( 'wp-logo' );
	}

	/**
	 * Admin footer text.
	 *
	 * Modifies the "Thank you" text displayed in the admin footer.
	 *
	 * Fired by `admin_footer_text` filter.
	 *
	 * @since  1.4.0
	 * @access public
	 *
	 * @param string $footer_text The content that will be printed.
	 *
	 * @return string The content that will be printed.
	 */
	public function admin_footer_text( $footer_text ) {
		$current_screen  = get_current_screen();
		$is_ct4gg_screen = ( $current_screen && false !== strpos( $current_screen->id, 'ct4gg' ) );

		if ( $is_ct4gg_screen ) {
			$footer_text = sprintf(
				/* translators: 1: Elementor, 2: Link to plugin review */
				__( 'Enjoyed %1$s? Please leave us a %2$s rating. We really appreciate your support!', 'ct4gg' ),
				'<strong>' . esc_html__( 'CT4GG', 'ct4gg' ) . '</strong>',
				'<a href="https://wordpress.org/support/plugin/ct4gg/reviews/#new-post" target="_blank" class ="ct4gg-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</a>'
			);
		}

		return $footer_text;
	}
}
