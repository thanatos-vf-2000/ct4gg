<?php
/**
 * Template Security
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

use CT4GG\Api\FileHumans;

$security_file = new FileHumans();


if ( isset( $_POST[ CT4GG_NAME . '-verif' ] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ CT4GG_NAME . '-verif' ] ) ), CT4GG_NAME . '-opt' ) ) {
	if ( isset( $_POST['submit-security-restore'] ) ) {
		if ( $security_file->backup() ) {
			if ( isset( $_POST['ct4gg-security'] ) ) {
				if ( copy( ABSPATH . sanitize_text_field( wp_unslash( $_POST['ct4gg-security'] ) ), ABSPATH . 'security.txt' ) ) {
					self::view( 'security', array( 'type' => 'copy-ok' ) );
				} else {
					self::view( 'security', array( 'type' => 'copy-ko' ) );
				}
			} else {
				self::view( 'security', array( 'type' => 'ct4gg-security-ko' ) );
			}
		} else {
			self::view( 'security', array( 'type' => 'backup-ko' ) );
		}
	} elseif ( isset( $_POST['submit-security-delete'] ) ) {
		if ( isset( $_POST['ct4gg-security'] ) ) {
			if ( unlink( ABSPATH . sanitize_text_field( wp_unslash( $_POST['ct4gg-security'] ) ) ) ) {
				self::view( 'security', array( 'type' => 'delete-ok' ) );
			} else {
				self::view( 'security', array( 'type' => 'delete-ko' ) );
			}
		} else {
			self::view( 'security', array( 'type' => 'ct4gg-security-ko' ) );
		}
	} elseif ( isset( $_POST['submit-build-security'] ) && isset( $_POST['security-content'] ) ) {
		if ( file_exists( ABSPATH . '.htaccess' ) ) {
			$security_file->backup();
			$security_file->save_mod( sanitize_text_field( wp_unslash( $_POST['security-content'] ) ) );
		}
	} else {
		$security_params = array(
			'security_team',
			'security_thanks',
			'security_site',
		);
		foreach ( $security_params as $security_param ) {
			if ( $this->activated( $security_param ) ) {
				$security_file->add( $security_param );
			}
		}
		if ( file_exists( ABSPATH . 'security.txt' ) ) {
			if ( $security_file->backup() ) {
				if ( ! $security_file->save() ) {
					self::view( 'security', array( 'type' => 'update-ko' ) );
				} else {
					self::view( 'security', array( 'type' => 'update-ok' ) );
				}
			} else {
				self::view( 'security', array( 'type' => 'backup-ko' ) );
			}
		} else {
			if ( ! $security_file->save() ) {
				self::view( 'security', array( 'type' => 'update-ko' ) );
			} else {
				self::view( 'security', array( 'type' => 'update-ok' ) );
			}
		}
	}
}



self::get_template( array( 'header', 'security/nav-tabs', 'security/tab-content', 'footer' ) );
