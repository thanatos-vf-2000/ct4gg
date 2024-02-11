<?php
/**
 * Activate function
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

namespace CT4GG\Core;

class Activate {

	public static function activate() {
		flush_rewrite_rules();

		$default = array(
			'v' => CT4GG_VERSION,
			't' => time(),
		);
		Options::set_option( 'version', CT4GG_VERSION );
	}
}
