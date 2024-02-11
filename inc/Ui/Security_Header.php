<?php
/**
 * Security Header
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
class Security_Header extends BaseController {

	public function register() {
		$robots_file = ABSPATH . 'security.txt';
		if ( file_exists( $robots_file ) ) {
			add_action( 'wp_head', array( $this, 'head_author' ) );
		}
	}

	public function head_author() {
		echo '<link type="text/plain" rel="author" href="' . esc_url( get_site_url() ) . '/security.txt" />';
	}
}
