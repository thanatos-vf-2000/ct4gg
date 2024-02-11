<?php
/**
 * Template robots
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

use CT4GG\Api\FileRobots;

$robots_file = new FileRobots();


if ( isset( $_POST[ CT4GG_NAME . '-verif' ] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ CT4GG_NAME . '-verif' ] ) ), CT4GG_NAME . '-opt' ) ) {
	if ( isset( $_POST['submit-robots-restore'] ) ) {
		if ( $robots_file->backup() ) {
			if ( isset( $_POST['ct4gg-robots'] ) ) {
				if ( copy( ABSPATH . sanitize_text_field( wp_unslash( $_POST['ct4gg-robots'] ) ), ABSPATH . 'robots.txt' ) ) {
					self::view( 'robots', array( 'type' => 'copy-ok' ) );
				} else {
					self::view( 'robots', array( 'type' => 'copy-ko' ) );
				}
			} else {
				self::view( 'robots', array( 'type' => 'ct4gg-robots-ko' ) );
			}
		} else {
			self::view( 'robots', array( 'type' => 'backup-ko' ) );
		}
	} elseif ( isset( $_POST['submit-robots-delete'] ) ) {
		if ( isset( $_POST['ct4gg-robots'] ) ) {
			if ( unlink( ABSPATH . sanitize_text_field( wp_unslash( $_POST['ct4gg-robots'] ) ) ) ) {
				self::view( 'robots', array( 'type' => 'delete-ok' ) );
			} else {
				self::view( 'robots', array( 'type' => 'delete-ko' ) );
			}
		} else {
			self::view( 'robots', array( 'type' => 'ct4gg-robots-ko' ) );
		}
	} elseif ( isset( $_POST['submit-build-robots'] ) && isset( $_POST['robots-content'] ) ) {
		if ( file_exists( ABSPATH . '.htaccess' ) ) {
			$robots_file->backup();
			$robots_file->save_mod( sanitize_text_field( wp_unslash( $_POST['robots-content'] ) ) );
		}
	} else {
		$robots_params = array(
			'robots_sitemap',
			'robots_wordpress',
		);
		foreach ( $robots_params as $robots_param ) {
			if ( $this->activated( $robots_param ) ) {
				$robots_file->add( $robots_param );
			}
		}
		if ( file_exists( ABSPATH . 'robots.txt' ) ) {
			if ( $robots_file->backup() ) {
				if ( ! $robots_file->save() ) {
					self::view( 'robots', array( 'type' => 'update-ko' ) );
				} else {
					self::view( 'robots', array( 'type' => 'update-ok' ) );
				}
			} else {
				self::view( 'robots', array( 'type' => 'backup-ko' ) );
			}
		} else {
			if ( ! $robots_file->save() ) {
				self::view( 'robots', array( 'type' => 'update-ko' ) );
			} else {
				self::view( 'robots', array( 'type' => 'update-ok' ) );
			}
		}
	}
}



self::get_template( array( 'header', 'robots/nav-tabs', 'robots/tab-content', 'footer' ) );
