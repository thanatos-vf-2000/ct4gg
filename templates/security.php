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
 * @version   1.5.4 GIT:https://github.com/thanatos-vf-2000/WordPress
 * @link      https://ginkgos.net
 */

if ( ! defined( 'ABSPATH' ) ) exit;

use CT4GG\Api\FileSecurity;

$security_file = new FileSecurity();


if ( isset( $_POST[ CT4GG_NAME . '-verif' ] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ CT4GG_NAME . '-verif' ] ) ), CT4GG_NAME . '-opt' ) ) {
	$security_nonce = wp_create_nonce( CT4GG_NAME . '-verif' );
	if ( isset( $_POST['ct4gg-security'] ) ) {
		$security_tmp = sanitize_text_field( wp_unslash( $_POST['ct4gg-security'] ) );
		if ( ! preg_match( '~security*~', $security_tmp ) ) {
			unset( $_POST, $security_tmp );
			$_POST = array();
		}
	}
	if ( isset( $_POST['submit-security-restore'] ) ) {
		if ( $security_file->backup() ) {
			if ( isset( $security_tmp ) ) {
				if ( copy( ABSPATH . $security_tmp, ABSPATH . 'security.txt' ) ) {
					self::view(
						'security',
						array(
							'type'  => 'copy-ok',
							'nonce' => $security_nonce,
						)
					);
				} else {
					self::view(
						'security',
						array(
							'type'  => 'copy-ko',
							'nonce' => $security_nonce,
						)
					);
				}
			} else {
				self::view(
					'security',
					array(
						'type'  => 'ct4gg-security-ko',
						'nonce' => $security_nonce,
					)
				);
			}
		} else {
			self::view( 'security', array( 'type' => 'backup-ko' ) );
		}
	} elseif ( isset( $_POST['submit-security-delete'] ) ) {
		if ( isset( $security_tmp ) ) {
			if ( wp_delete_file( ABSPATH . $security_tmp ) ) {
				self::view(
					'security',
					array(
						'type'  => 'delete-ok',
						'nonce' => $security_nonce,
					)
				);
			} else {
				self::view(
					'security',
					array(
						'type'  => 'delete-ko',
						'nonce' => $security_nonce,
					)
				);
			}
		} else {
			self::view(
				'security',
				array(
					'type'  => 'ct4gg-security-ko',
					'nonce' => $security_nonce,
				)
			);
		}
	} elseif ( isset( $_POST['submit-build-security'] ) && isset( $_POST['security-content'] ) ) {
		if ( file_exists( ABSPATH . 'security.txt' ) ) {
			$security_file->backup();
			$security_file->save_mod( esc_txt( sanitize_text_field( wp_unslash( $_POST['security-content'] ) ) ) );
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
					self::view(
						'security',
						array(
							'type'  => 'update-ko',
							'nonce' => $security_nonce,
						)
					);
				} else {
					self::view(
						'security',
						array(
							'type'  => 'update-ok',
							'nonce' => $security_nonce,
						)
					);
				}
			} else {
				self::view(
					'security',
					array(
						'type'  => 'backup-ko',
						'nonce' => $security_nonce,
					)
				);
			}
		} elseif ( ! $security_file->save() ) {
				self::view(
					'security',
					array(
						'type'  => 'update-ko',
						'nonce' => $security_nonce,
					)
				);
		} else {
			self::view(
				'security',
				array(
					'type'  => 'update-ok',
					'nonce' => $security_nonce,
				)
			);
		}
	}
}



self::get_template( array( 'header', 'security/nav-tabs', 'security/tab-content', 'footer' ) );
