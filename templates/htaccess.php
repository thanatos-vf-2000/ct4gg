<?php
/**
 * Template htaccess
 *
 * PHP version 7
 *
 * @category  PHP
 * @package   CT4GGPlugin
 * @author    Franck VANHOUCKE <ct4gg@ginkgos.net>
 * @copyright 2021-2023 Copyright 2023, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later
 * @version   1.5.2 GIT:https://github.com/thanatos-vf-2000/WordPress
 * @link      https://ginkgos.net
 */

if ( ! defined( 'ABSPATH' ) ) exit;

use CT4GG\Api\FileHTAccess;

$htaccess_file = new FileHTAccess();


if ( isset( $_POST[ CT4GG_NAME . '-verif' ] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ CT4GG_NAME . '-verif' ] ) ), CT4GG_NAME . '-opt' ) ) {
	$htaccess_nonce = wp_create_nonce( CT4GG_NAME . '-verif' );
	if ( isset( $_POST['ct4gg-htaccess'] ) ) {
		$htaccess_tmp = sanitize_text_field( wp_unslash( $_POST['ct4gg-htaccess'] ) );
		if ( ! preg_match( '~htaccess*~', $htaccess_tmp ) ) {
			unset($_POST, $htaccess_tmp) ; $_POST = array();
		}
	}
	
	if ( isset( $_POST['submit-htaccess-restore'] ) ) {
		if ( $htaccess_file->backup() ) {
			if ( isset( $htaccess_tmp ) ) {
				if ( copy( ABSPATH . $htaccess_tmp, ABSPATH . '.htaccess' ) ) {
					self::view( 'htaccess', array( 'type' => 'copy-ok', 'nonce' => $htaccess_nonce ) );
				} else {
					self::view( 'htaccess', array( 'type' => 'copy-ko', 'nonce' => $htaccess_nonce ) );
				}
			} else {
				self::view( 'htaccess', array( 'type' => 'ct4gg-htaccess-ko', 'nonce' => $htaccess_nonce ) );
			}
		} else {
			self::view( 'htaccess', array( 'type' => 'backup-ko', 'nonce' => $htaccess_nonce ) );
		}
	} elseif ( isset( $_POST['submit-htaccess-delete'] ) ) {
		if ( isset( $htaccess_tmp ) ) {
			if ( unlink( ABSPATH . $htaccess_tmp ) ) {
				self::view( 'htaccess', array( 'type' => 'delete-ok', 'nonce' => $htaccess_nonce ) );
			} else {
				self::view( 'htaccess', array( 'type' => 'delete-ko', 'nonce' => $htaccess_nonce ) );
			}
		} else {
			self::view( 'htaccess', array( 'type' => 'ct4gg-htaccess-ko', 'nonce' => $htaccess_nonce ) );
		}
	} elseif ( isset( $_POST['submit-build-htaccess'] ) && isset( $_POST['htaccess-content'] ) ) {
		if ( file_exists( ABSPATH . '.htaccess' ) ) {
			$htaccess_file->backup();
			$htaccess_file->save_mod( esc_txt( $_POST['htaccess-content'] ) );
		}
	} else {
		$htaccess_params = array(
			'login_screen_v2',
			'htaccess_disable_show_directory',
			'htaccess_hide_server_information',
			'htaccess_protect_files_ht',
			'htaccess_force_download_enable',
			'htaccess_enable_cache',
			'htaccess_enable_compress_statics_files',
		);
		foreach ( $htaccess_params as $htaccess_param ) {
			if ( $this->activated( $htaccess_param ) ) {
				$htaccess_file->add( $htaccess_param );
			}
		}
		if ( file_exists( ABSPATH . '.htaccess' ) ) {
			if ( $htaccess_file->backup() ) {
				if ( ! $htaccess_file->save() ) {
					self::view( 'htaccess', array( 'type' => 'update-ko', 'nonce' => $htaccess_nonce ) );
				} else {
					self::view( 'htaccess', array( 'type' => 'update-ok', 'nonce' => $htaccess_nonce ) );
				}
			} else {
				self::view( 'htaccess', array( 'type' => 'backup-ko', 'nonce' => $htaccess_nonce ) );
			}
		} else {
			if ( ! $htaccess_file->save() ) {
				self::view( 'htaccess', array( 'type' => 'update-ko', 'nonce' => $htaccess_nonce ) );
			} else {
				self::view( 'htaccess', array( 'type' => 'update-ok', 'nonce' => $htaccess_nonce ) );
			}
		}
	}
}



self::get_template( array( 'header', 'htaccess/nav-tabs', 'htaccess/tab-content', 'footer' ) );
