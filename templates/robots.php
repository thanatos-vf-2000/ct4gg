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
 * @version   1.5.3 GIT:https://github.com/thanatos-vf-2000/WordPress
 * @link      https://ginkgos.net
 */

use CT4GG\Api\FileRobots;

$robots_file = new FileRobots();


if ( isset( $_POST[ CT4GG_NAME . '-verif' ] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ CT4GG_NAME . '-verif' ] ) ), CT4GG_NAME . '-opt' ) ) {
	$robots_nonce = wp_create_nonce( CT4GG_NAME . '-verif' );
	if ( isset( $_POST['ct4gg-robots'] ) ) {
		$robots_tmp = sanitize_text_field( wp_unslash( $_POST['ct4gg-robots'] ) );
		if ( ! preg_match( '~robots*~', $robots_tmp ) ) {
			unset( $_POST, $robots_tmp );
			$_POST = array();
		}
	}
	if ( isset( $_POST['submit-robots-restore'] ) ) {
		if ( $robots_file->backup() ) {
			if ( isset( $robots_tmp ) ) {
				if ( copy( ABSPATH . $robots_tmp, ABSPATH . 'robots.txt' ) ) {
					self::view(
						'robots',
						array(
							'type'  => 'copy-ok',
							'nonce' => $robots_nonce,
						)
					);
				} else {
					self::view(
						'robots',
						array(
							'type'  => 'copy-ko',
							'nonce' => $robots_nonce,
						)
					);
				}
			} else {
				self::view(
					'robots',
					array(
						'type'  => 'ct4gg-robots-ko',
						'nonce' => $robots_nonce,
					)
				);
			}
		} else {
			self::view(
				'robots',
				array(
					'type'  => 'backup-ko',
					'nonce' => $robots_nonce,
				)
			);
		}
	} elseif ( isset( $_POST['submit-robots-delete'] ) ) {
		if ( isset( $robots_tmp ) ) {
			if ( unlink( ABSPATH . $robots_tmp ) ) {
				self::view(
					'robots',
					array(
						'type'  => 'delete-ok',
						'nonce' => $robots_nonce,
					)
				);
			} else {
				self::view(
					'robots',
					array(
						'type'  => 'delete-ko',
						'nonce' => $robots_nonce,
					)
				);
			}
		} else {
			self::view(
				'robots',
				array(
					'type'  => 'ct4gg-robots-ko',
					'nonce' => $robots_nonce,
				)
			);
		}
	} elseif ( isset( $_POST['submit-build-robots'] ) && isset( $_POST['robots-content'] ) ) {
		if ( file_exists( ABSPATH . 'robots.txt' ) ) {
			$robots_file->backup();
			$robots_file->save_mod( esc_txt( sanitize_text_field( wp_unslash( $_POST['robots-content'] ) ) ) );
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
					self::view(
						'robots',
						array(
							'type'  => 'update-ko',
							'nonce' => $robots_nonce,
						)
					);
				} else {
					self::view(
						'robots',
						array(
							'type'  => 'update-ok',
							'nonce' => $robots_nonce,
						)
					);
				}
			} else {
				self::view(
					'robots',
					array(
						'type'  => 'backup-ko',
						'nonce' => $robots_nonce,
					)
				);
			}
		} else {
			if ( ! $robots_file->save() ) {
				self::view(
					'robots',
					array(
						'type'  => 'update-ko',
						'nonce' => $robots_nonce,
					)
				);
			} else {
				self::view(
					'robots',
					array(
						'type'  => 'update-ok',
						'nonce' => $robots_nonce,
					)
				);
			}
		}
	}
}



self::get_template( array( 'header', 'robots/nav-tabs', 'robots/tab-content', 'footer' ) );
