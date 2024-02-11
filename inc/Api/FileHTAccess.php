<?php
/**
 * File HTAccess
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

namespace CT4GG\Api;

use CT4GG\Core\BaseController;
use CT4GG\Core\Options;

/**
 * Class FileHTAccess
 */
class FileHTAccess extends BaseController {

	private $location  = '';
	private $items     = array();
	const INSERT_REGEX = '@\n?# Created by ct4gg(?:.*?)# End of ct4gg\n?@sm';

	/**
	 * Function adminIndexSectionManager
	 *
	 * @return message
	 */
	protected function __construct() {
		$this->load( array( 'location' => ABSPATH ) );
	}

	/**
	 * Function getLocation
	 *
	 * @return location
	 */
	public function getLocation() {
		return $this->_location;
	}

	/**
	 * Function load
	 *
	 * @return data
	 */
	public function load( $data ) {
		$mine = array( 'location' );

		foreach ( $mine as $key ) {
			if ( isset( $data[ $key ] ) ) {
				$this->$key = $data[ $key ];
			}
		}
	}

	/**
	 * Function add_login_screen_v2
	 *
	 * @return data
	 */
	private function add_login_screen_v2() {
		$all_defaults = Options::load_php_config( CT4GG_PATH . 'assets/options.php' );
		$head         = 0;
		foreach ( $all_defaults as $key => $value ) {
			$opt_test = explode( '_', $key );
			if ( 'login' === $opt_test[0] && 'slugs' === $opt_test[1] ) {
				if ( 0 === $head ) {
					$this->_items[] = '# RewriteRule for wp-login.php';
					$this->_items[] = '<IfModule mod_rewrite.c>';
					$this->_items[] = 'RewriteEngine On';
					$this->_items[] = 'RewriteBase /';
					$head++;
				}
				switch ( $key ) {
					case 'login_slugs_login':
						$this->_items[] = 'RewriteRule ^' . Options::get_option( $key ) . '/?$ /wp-login.php [QSA,L]';
						break;
					case 'login_slugs_logout':
						$this->_items[] = 'RewriteRule ^' . Options::get_option( $key ) . '/?$ /wp-login.php?action=logout [QSA,L]';
						break;
					case 'login_slugs_register':
						$this->_items[] = 'RewriteRule ^' . Options::get_option( $key ) . '/?$ /wp-login.php?action=register [QSA,L]';
						break;
					case 'login_slugs_lostpassword':
						$this->_items[] = 'RewriteRule ^' . Options::get_option( $key ) . '/?$ /wp-login.php?action=lostpassword [QSA,L]';
						break;
					case 'login_slugs_resetpass':
						$this->_items[] = 'RewriteRule ^' . Options::get_option( $key ) . '/?$ /wp-login.php?action=resetpass [QSA,L]';
						break;
					case 'login_slugs_postpass':
						$this->_items[] = 'RewriteRule ^' . Options::get_option( $key ) . '/?$ /wp-login.php?action=postpass [QSA,L]';
						break;
				}
			}
		}
		if ( $head > 0 ) {
			$this->_items[] = '</IfModule>';
			$this->_items[] = '';
		}
	}

	/**
	 * Function add_htaccess_disable_show_directory
	 *
	 * @return data
	 */
	private function add_htaccess_disable_show_directory() {
		$this->_items[] = '# Desactiver l affichage du contenu des repertoires';
		$this->_items[] = 'Options All -Indexes';
		$this->_items[] = '# Alternative pour empecher le listage des repertoires';
		$this->_items[] = '#IndexIgnore *';
		$this->_items[] = '';
	}

	/**
	 * Function add_htaccess_hide_server_information
	 *
	 * @return data
	 */
	private function add_htaccess_hide_server_information() {
		$this->_items[] = '# Masquer les informations du serveur';
		$this->_items[] = 'ServerSignature Off';
		$this->_items[] = '';
	}

	/**
	 * Function add_htaccess_protect_files_ht
	 *
	 * @return data
	 */
	private function add_htaccess_protect_files_ht() {
		$this->_items[] = '# Proteger les fichiers .htaccess et .htpasswds';
		$this->_items[] = '<Files ~ "^.*\.([Hh][Tt][AaPp])">';
		$this->_items[] = '	order allow,deny';
		$this->_items[] = '	deny from all';
		$this->_items[] = '	satisfy all';
		$this->_items[] = '</Files>';
		$this->_items[] = '';
	}

	/**
	 * Function add_htaccess_force_download_enable
	 *
	 * @return data
	 */
	private function add_htaccess_force_download_enable() {
		if ( '' !== Options::get_option( 'htaccess_force_download_enable' ) ) {
			$this->_items[] = '# Forcer le telechargement pour ces types de fichiers';
			$this->_items[] = sprintf( 'AddType application/octet-stream %s', esc_html( Options::get_option( 'htaccess_force_download' ) ) );
			$this->_items[] = '';
		}
	}

	/**
	 * Function add_htaccess_enable_cache
	 *
	 * @return data
	 */
	private function add_htaccess_enable_cache() {
		$this->_items[] = '# Mise en cache des fichiers dans le navigateur';
		$this->_items[] = '<IfModule mod_expires.c>';
		$this->_items[] = '	ExpiresActive On';
		$this->_items[] = '	ExpiresDefault "access plus 1 month"';
		$this->_items[] = '';
		$this->_items[] = '	ExpiresByType text/html "access plus 0 seconds"';
		$this->_items[] = '	ExpiresByType text/xml "access plus 0 seconds"';
		$this->_items[] = '	ExpiresByType application/xml "access plus 0 seconds"';
		$this->_items[] = '	ExpiresByType application/json "access plus 0 seconds"';
		$this->_items[] = '	ExpiresByType application/pdf "access plus 0 seconds"';
		$this->_items[] = '';
		$this->_items[] = '	ExpiresByType application/rss+xml "access plus 1 hour"';
		$this->_items[] = '	ExpiresByType application/atom+xml "access plus 1 hour"';
		$this->_items[] = '';
		$this->_items[] = '	ExpiresByType application/x-font-ttf "access plus 1 month"';
		$this->_items[] = '	ExpiresByType font/opentype "access plus 1 month"';
		$this->_items[] = '	ExpiresByType application/x-font-woff "access plus 1 month"';
		$this->_items[] = '	ExpiresByType application/x-font-woff2 "access plus 1 month"';
		$this->_items[] = '	ExpiresByType image/svg+xml "access plus 1 month"';
		$this->_items[] = '	ExpiresByType application/vnd.ms-fontobject "access plus 1 month"';
		$this->_items[] = '';
		$this->_items[] = '	ExpiresByType image/jpg "access plus 1 month"';
		$this->_items[] = '	ExpiresByType image/jpeg "access plus 1 month"';
		$this->_items[] = '	ExpiresByType image/gif "access plus 1 month"';
		$this->_items[] = '	ExpiresByType image/png "access plus 1 month"';
		$this->_items[] = '';
		$this->_items[] = '	ExpiresByType video/ogg "access plus 1 month"';
		$this->_items[] = '	ExpiresByType audio/ogg "access plus 1 month"';
		$this->_items[] = '	ExpiresByType video/mp4 "access plus 1 month"';
		$this->_items[] = '	ExpiresByType video/webm "access plus 1 month"';
		$this->_items[] = '';
		$this->_items[] = '	ExpiresByType text/css "access plus 1 week"';
		$this->_items[] = '	ExpiresByType application/javascript "access plus 1 week"';
		$this->_items[] = '';
		$this->_items[] = '	ExpiresByType application/x-shockwave-flash "access plus 1 week"';
		$this->_items[] = '	ExpiresByType image/x-icon "access plus 1 week"';
		$this->_items[] = '';
		$this->_items[] = '</IfModule>';
		$this->_items[] = '';
		$this->_items[] = '# En-tetes';
		$this->_items[] = 'Header unset ETag';
		$this->_items[] = 'FileETag None';
		$this->_items[] = '';
		$this->_items[] = '<ifModule mod_headers.c>';
		$this->_items[] = '	<filesMatch "\.(ico|jpe?g|png|gif|swf)$">';
		$this->_items[] = '		Header set Cache-Control "public" ';
		$this->_items[] = '	</filesMatch>';
		$this->_items[] = '	<filesMatch "\.(css)$">';
		$this->_items[] = '		Header set Cache-Control "public" ';
		$this->_items[] = '	</filesMatch>';
		$this->_items[] = '	<filesMatch "\.(js)$">';
		$this->_items[] = '		Header set Cache-Control "private" ';
		$this->_items[] = '	</filesMatch>';
		$this->_items[] = '	<filesMatch "\.(x?html?|php)$">';
		$this->_items[] = '		Header set Cache-Control "private, must-revalidate"';
		$this->_items[] = '	</filesMatch>';
		$this->_items[] = '</ifModule>';
		$this->_items[] = '';
	}

	/**
	 * Function add_htaccess_enable_compress_statics_files
	 *
	 * @return data
	 */
	private function add_htaccess_enable_compress_statics_files() {
		$this->_items[] = '# Compressions des fichiers statiques';
		$this->_items[] = '<IfModule mod_deflate.c>';
		$this->_items[] = '	AddOutputFilterByType DEFLATE text/xhtml text/html text/plain text/xml text/javascript application/x-javascript text/css ';
		$this->_items[] = '	BrowserMatch ^Mozilla/4 gzip-only-text/html ';
		$this->_items[] = '	BrowserMatch ^Mozilla/4\.0[678] no-gzip ';
		$this->_items[] = '	BrowserMatch \bMSIE !no-gzip !gzip-only-text/html ';
		$this->_items[] = '	SetEnvIfNoCase Request_URI \.(?:gif|jpe?g|png)$ no-gzip dont-vary ';
		$this->_items[] = '	Header append Vary User-Agent env=!dont-vary ';
		$this->_items[] = '</IfModule> ';
		$this->_items[] = '';
		$this->_items[] = 'AddOutputFilterByType DEFLATE text/html';
		$this->_items[] = 'AddOutputFilterByType DEFLATE text/plain';
		$this->_items[] = 'AddOutputFilterByType DEFLATE text/plain';
		$this->_items[] = 'AddOutputFilterByType DEFLATE text/xml';
		$this->_items[] = 'AddOutputFilterByType DEFLATE text/css';
		$this->_items[] = 'AddOutputFilterByType DEFLATE text/javascript';
		$this->_items[] = 'AddOutputFilterByType DEFLATE font/opentype';
		$this->_items[] = 'AddOutputFilterByType DEFLATE application/rss+xml';
		$this->_items[] = 'AddOutputFilterByType DEFLATE application/javascript';
		$this->_items[] = 'AddOutputFilterByType DEFLATE application/json';
		$this->_items[] = '';
	}

	/**
	 * Function add
	 *
	 * @param string $item data
	 *
	 * @return data
	 */
	public function add( $item ) {
		$target = 'add_' . $item;

		if ( method_exists( $this, $target ) ) {
			$this->$target();
		}
	}

	/**
	 * Function sanitize_ct4gg
	 *
	 * @param string $text text
	 *
	 * @return text
	 */
	public function sanitize_ct4gg( $text ) {
		return $text;
	}

	/**
	 * Function generate
	 *
	 * @return text
	 */
	private function generate() {
		if ( count( $this->_items ) === 0 ) {
			return '';
		}

		$text = array(
			'# Created by ct4gg',
			'# ' . date( 'r' ),
			'# ct4gg ' . trim( CT4GG_VERSION ) . ' - https://ginkgos.net',
			'',

		);

		/**
		 * Add Options ct4gg htaccess
		 */
		$text = array_merge( $text, array_filter( array_map( array( $this, 'sanitize_ct4gg' ), $this->_items ) ) );

		/**
		 * End of redirection section
		 */
		$text[] = '# End of ct4gg';

		$text = implode( "\n", $text );
		return "\n" . $text . "\n";
	}

	public function get( $existing = false ) {
		$text = $this->generate();

		if ( $existing ) {
			if ( preg_match( self::INSERT_REGEX, $existing ) > 0 ) {
				$text = preg_replace( self::INSERT_REGEX, str_replace( '$', '\\$', $text ), $existing );
			} else {
				$text = $text . "\n" . trim( $existing );
			}
		}

		return trim( $text );
	}


	public function save() {
		$existing = false;
		$filename = $this->_location . '.htaccess';

		if ( file_exists( $filename ) ) {
			$existing = file_get_contents( $filename );
		}

		$file = @fopen( $filename, 'w' );
		if ( $file ) {
			$result = fwrite( $file, $this->get( $existing ) );
			fclose( $file );

			return false !== $result;
		}

		return false;
	}

	public function save_mod( $txt ) {

		$filename = $this->_location . '.htaccess';

		$file = @fopen( $filename, 'w' );
		if ( $file ) {
			$result = fwrite( $file, str_replace( '\"', '"', $txt ) );
			fclose( $file );

			return false !== $result;
		}

		return true;
	}

	public function backup() {
		$day = date( 'Ymd' );
		$nb  = 0;
		while ( file_exists( $this->_location . '.htaccess_' . $day . '-' . $nb ) ) :
			$nb++;
		endwhile;
		if ( ! copy( $this->_location . '.htaccess', $this->_location . '.htaccess_' . $day . '-' . $nb ) ) {
			return false;
		}
		return true;
	}
}
