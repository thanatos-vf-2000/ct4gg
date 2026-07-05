<?php
/**
 * Template llms
 *
 * PHP version 7
 *
 * @category  PHP
 * @package   CT4GGPlugin
 * @author    Franck VANHOUCKE <ct4gg@ginkgos.net>
 * @copyright 2021-2026 Copyright 2026, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later
 * @version   1.6.0 GIT:https://github.com/thanatos-vf-2000/ct4gg
 * @link      https://ginkgos.net
 */

if ( ! defined( 'ABSPATH' ) ) exit;

use CT4GG\Api\FileLlms;

$llms_file = new FileLlms();


if ( isset( $_POST[ CT4GG_NAME . '-verif' ] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ CT4GG_NAME . '-verif' ] ) ), CT4GG_NAME . '-opt' ) ) {
	$llms_nonce = wp_create_nonce( CT4GG_NAME . '-verif' );
	if ( isset( $_POST['ct4gg-llms'] ) ) {
		$llms_tmp = sanitize_text_field( wp_unslash( $_POST['ct4gg-llms'] ) );
		if ( ! preg_match( '~llms*~', $llms_tmp ) ) {
			unset( $_POST, $llms_tmp );
			$_POST = array();
		}
	}
	if ( isset( $_POST['submit-llms-restore'] ) ) {
		if ( $llms_file->backup() ) {
			if ( isset( $llms_tmp ) ) {
				if ( copy( ABSPATH . $llms_tmp, ABSPATH . 'llms.txt' ) ) {
					self::view(
						'llms',
						array(
							'type'  => 'copy-ok',
							'nonce' => $llms_nonce,
						)
					);
				} else {
					self::view(
						'llms',
						array(
							'type'  => 'copy-ko',
							'nonce' => $llms_nonce,
						)
					);
				}
			} else {
				self::view(
					'llms',
					array(
						'type'  => 'ct4gg-llms-ko',
						'nonce' => $llms_nonce,
					)
				);
			}
		} else {
			self::view(
				'llms',
				array(
					'type'  => 'backup-ko',
					'nonce' => $llms_nonce,
				)
			);
		}
	} elseif ( isset( $_POST['submit-llms-delete'] ) ) {
		if ( isset( $llms_tmp ) ) {
			if ( wp_delete_file( ABSPATH . $llms_tmp ) ) {
				self::view(
					'llms',
					array(
						'type'  => 'delete-ok',
						'nonce' => $llms_nonce,
					)
				);
			} else {
				self::view(
					'llms',
					array(
						'type'  => 'delete-ko',
						'nonce' => $llms_nonce,
					)
				);
			}
		} else {
			self::view(
				'llms',
				array(
					'type'  => 'ct4gg-llms-ko',
					'nonce' => $llms_nonce,
				)
			);
		}
	} elseif ( isset( $_POST['submit-build-llms'] ) && isset( $_POST['llms-content'] ) ) {
		if ( file_exists( ABSPATH . 'llms.txt' ) ) {
			$llms_file->backup();
			$llms_file->save_mod( esc_txt( sanitize_textarea_field( wp_unslash( $_POST['llms-content'] ) ) ) );
		}
	} else {
		$llms_file->add( 'llms_header' );

		$llms_params = array(
			'llms_sitemap',
			'llms_pages',
			'llms_posts',
		);
		foreach ( $llms_params as $llms_param ) {
			if ( $this->activated( $llms_param ) ) {
				$llms_file->add( $llms_param );
			}
		}
		$llms_file->add( 'llms_optional' );

		if ( file_exists( ABSPATH . 'llms.txt' ) ) {
			if ( $llms_file->backup() ) {
				if ( ! $llms_file->save() ) {
					self::view(
						'llms',
						array(
							'type'  => 'update-ko',
							'nonce' => $llms_nonce,
						)
					);
				} else {
					self::view(
						'llms',
						array(
							'type'  => 'update-ok',
							'nonce' => $llms_nonce,
						)
					);
				}
			} else {
				self::view(
					'llms',
					array(
						'type'  => 'backup-ko',
						'nonce' => $llms_nonce,
					)
				);
			}
		} elseif ( ! $llms_file->save() ) {
				self::view(
					'llms',
					array(
						'type'  => 'update-ko',
						'nonce' => $llms_nonce,
					)
				);
		} else {
			self::view(
				'llms',
				array(
					'type'  => 'update-ok',
					'nonce' => $llms_nonce,
				)
			);
		}
	}
}



self::get_template( array( 'header', 'llms/nav-tabs', 'llms/tab-content', 'footer' ) );
