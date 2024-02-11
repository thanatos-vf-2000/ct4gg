<?php
/**
 * Template Admin
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

use CT4GG\Core\BaseController;
use CT4GG\Api\FileHTAccess;
use CT4GG\Api\FileHumans;
use CT4GG\Api\FileRobots;
use CT4GG\Api\FileSecurity;

if ( isset( $_SERVER['REQUEST_URI'] ) && strpos( sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ), 'settings-updated=true' ) !== false ) {
	/*
	 * File htaccess
	 */
	$htaccess_file   = new FileHTAccess();
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
				self::view( 'htaccess', array( 'type' => 'update-ko' ) );
			} else {
				self::view( 'htaccess', array( 'type' => 'update-ok' ) );
			}
		} else {
			self::view( 'htaccess', array( 'type' => 'backup-ko' ) );
		}
	} else {
		if ( ! $htaccess_file->save() ) {
			self::view( 'htaccess', array( 'type' => 'update-ko' ) );
		} else {
			self::view( 'htaccess', array( 'type' => 'update-ok' ) );
		}
	}

	/*
	 * File humans
	 */
	$humans_file   = new FileHumans();
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
				self::view( 'humans', array( 'type' => 'update-ko' ) );
			} else {
				self::view( 'humans', array( 'type' => 'update-ok' ) );
			}
		} else {
			self::view( 'humans', array( 'type' => 'backup-ko' ) );
		}
	} else {
		if ( ! $humans_file->save() ) {
			self::view( 'humans', array( 'type' => 'update-ko' ) );
		} else {
			self::view( 'humans', array( 'type' => 'update-ok' ) );
		}
	}

	/*
	 * File robots
	 */
	$robots_file   = new FileRobots();
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

	/*
	 * File security
	 */
	$security_file   = new Filesecurity();
	$security_params = array(
		'security_contact',
		'security_expires_date',
		'security_encryption',
		'security_acknowledgments',
		'security_preferred_languages',
		'security_canonical',
		'security_policy',
		'security_hiring',
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
self::get_template( array( 'header', 'admin/nav-tabs', 'admin/tab-content', 'footer' ) );
