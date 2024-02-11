<?php
/**
 * Login
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
class Login extends BaseController {

	public function register() {
		if ( $this->activated( 'login_redirect_after_logout' ) ) {
			add_action( 'wp_logout', array( $this, 'home_redirect_after_logout' ) );
		}
		if ( $this->activated( 'login_hide_login_errors' ) ) {
			add_action( 'wp_logout', array( $this, 'hide_login_errors' ) );
		}
		if ( $this->activated( 'login_no_admin_to_home' ) ) {
			add_action( 'init', array( $this, 'wp_admin_redirection' ) );
		}
	}

	public function home_redirect_after_logout() {
		/**
		 * We redirect to the home page
		 */
		wp_safe_redirect( home_url( '/' ) );
		exit();
	}

	public function hide_login_errors() {
		/**
		 * We return our own error sentence
		 */
		return __( 'incorrect!', 'ct4gg' );
	}

	/**
	 * Redirect non-administrators to the home page From the administration
	 */
	public function wp_admin_redirection() {
		/**
		 * If you try to access the administration without having the administrator role
		 */
		if ( is_admin() && ! current_user_can( 'administrator' ) ) {
			/**
			 * We redirect to the home page
			 */
			wp_safe_redirect( home_url() );
			exit;
		}
	}
}
