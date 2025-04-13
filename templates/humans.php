<?php
/**
 * Template Humans
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

use CT4GG\Api\FileHumans;

$humans_file = new FileHumans();


if ( isset( $_POST[ CT4GG_NAME . '-verif' ] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ CT4GG_NAME . '-verif' ] ) ), CT4GG_NAME . '-opt' ) ) {
	$humans_nonce = wp_create_nonce( CT4GG_NAME . '-verif' );
	if ( isset( $_POST['ct4gg-humans'] ) ) {
		$humans_tmp = sanitize_text_field( wp_unslash( $_POST['ct4gg-humans'] ) );
		if ( ! preg_match( '~humans*~', $humans_tmp ) ) {
			unset( $_POST, $humans_tmp );
			$_POST = array();
		}
	}
	if ( isset( $_POST['submit-humans-restore'] ) ) {
		if ( $humans_file->backup() ) {
			if ( isset( $humans_tmp ) ) {
				if ( copy( ABSPATH . $humans_tmp, ABSPATH . 'humans.txt' ) ) {
					self::view(
						'humans',
						array(
							'type'  => 'copy-ok',
							'nonce' => $humans_nonce,
						)
					);
				} else {
					self::view(
						'humans',
						array(
							'type'  => 'copy-ko',
							'nonce' => $humans_nonce,
						)
					);
				}
			} else {
				self::view(
					'humans',
					array(
						'type'  => 'ct4gg-humans-ko',
						'nonce' => $humans_nonce,
					)
				);
			}
		} else {
			self::view(
				'humans',
				array(
					'type'  => 'backup-ko',
					'nonce' => $humans_nonce,
				)
			);
		}
	} elseif ( isset( $_POST['submit-humans-delete'] ) ) {
		if ( isset( $humans_tmp ) ) {
			if ( wp_delete_file( ABSPATH . $humans_tmp ) ) {
				self::view(
					'humans',
					array(
						'type'  => 'delete-ok',
						'nonce' => $humans_nonce,
					)
				);
			} else {
				self::view(
					'humans',
					array(
						'type'  => 'delete-ko',
						'nonce' => $humans_nonce,
					)
				);
			}
		} else {
			self::view(
				'humans',
				array(
					'type'  => 'ct4gg-humans-ko',
					'nonce' => $humans_nonce,
				)
			);
		}
	} elseif ( isset( $_POST['submit-build-humans'] ) && isset( $_POST['humans-content'] ) ) {
		if ( file_exists( ABSPATH . 'humans.txt' ) ) {
			$humans_file->backup();
			$humans_file->save_mod( esc_txt( sanitize_text_field( wp_unslash( $_POST['humans-content'] ) ) ) );
		}
	} else {
		$humans_params = array(
			'humans_team',
			'humans_thanks',
			'humans_site',
		);
		foreach ( $humans_params as $humans_param ) {
			if ( $this->activated( $humans_param ) ) {
				$humans_file->add( $humans_param );
			}
		}
		if ( file_exists( ABSPATH . 'humans.txt' ) ) {
			if ( $humans_file->backup() ) {
				if ( ! $humans_file->save() ) {
					self::view(
						'humans',
						array(
							'type'  => 'update-ko',
							'nonce' => $humans_nonce,
						)
					);
				} else {
					self::view(
						'humans',
						array(
							'type'  => 'update-ok',
							'nonce' => $humans_nonce,
						)
					);
				}
			} else {
				self::view(
					'humans',
					array(
						'type'  => 'backup-ko',
						'nonce' => $humans_nonce,
					)
				);
			}
		} elseif ( ! $humans_file->save() ) {
				self::view(
					'humans',
					array(
						'type'  => 'update-ko',
						'nonce' => $humans_nonce,
					)
				);
		} else {
			self::view(
				'humans',
				array(
					'type'  => 'update-ok',
					'nonce' => $humans_nonce,
				)
			);
		}
	}
}



self::get_template( array( 'header', 'humans/nav-tabs', 'humans/tab-content', 'footer' ) );
