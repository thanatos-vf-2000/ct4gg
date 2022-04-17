<?php
/**
 * @package  CT4GGPlugin
 * @Version 1.4.3
 */

namespace CT4GG\Api;

use CT4GG\Core\BaseController;
use CT4GG\Core\Options;
/**
* 
*/
class FileHTAccess extends BaseController
{
    private $location  = '';
    private $items = array();
    const INSERT_REGEX = '@\n?# Created by ct4gg(?:.*?)# End of ct4gg\n?@sm';


    function __construct() {
        $this->load(array('location'=> ABSPATH));
    }

    public function get_location() {
		return $this->location;
	}

    public function load( $data ) {
		$mine = array( 'location' );

		foreach ( $mine as $key ) {
			if ( isset( $data[ $key ] ) ) {
				$this->$key = $data[ $key ];
			}
		}
	}

    private function add_login_screen_v2() {
        $all_defaults = Options::loadPHPConfig(CT4GG_PATH . 'assets/options.php');
        $head=0;
        foreach ($all_defaults as $key => $value) {
            $opt_test = explode("_",$key);
            if ($opt_test[0] == "login" && $opt_test[1] == "slugs" ) {
                if ($head == 0) {
                    $this->items[] = '# RewriteRule for wp-login.php';
                    $this->items[] = '<IfModule mod_rewrite.c>';
                    $this->items[] = 'RewriteEngine On';
                    $this->items[] = 'RewriteBase /';
                    $head++;
                }
                switch ( $key ) {
                    case 'login_slugs_login':
                        $this->items[] = 'RewriteRule ^'. Options::get_option($key) .'/?$ /wp-login.php [QSA,L]';
                        break;
                    case 'login_slugs_logout':
                        $this->items[] = 'RewriteRule ^'. Options::get_option($key)  .'/?$ /wp-login.php?action=logout [QSA,L]';
                        break;
                    case 'login_slugs_register':
                        $this->items[] = 'RewriteRule ^'. Options::get_option($key)  .'/?$ /wp-login.php?action=register [QSA,L]';
                        break;
                    case 'login_slugs_lostpassword':
                        $this->items[] = 'RewriteRule ^'. Options::get_option($key)  .'/?$ /wp-login.php?action=lostpassword [QSA,L]';
                        break;
                    case 'login_slugs_resetpass':
                        $this->items[] = 'RewriteRule ^'. Options::get_option($key)  .'/?$ /wp-login.php?action=resetpass [QSA,L]';
                        break;
                    case 'login_slugs_postpass':
                        $this->items[] = 'RewriteRule ^'. Options::get_option($key)  .'/?$ /wp-login.php?action=postpass [QSA,L]';
                        break;
                }
            }
        }
        if ($head > 0) {
            $this->items[] = '</IfModule>';
            $this->items[] = '';
        }
    }

    private function add_htaccess_disable_show_directory() {
        $this->items[] = '# Desactiver l affichage du contenu des repertoires';
        $this->items[] = 'Options All -Indexes';
        $this->items[] = '# Alternative pour empecher le listage des repertoires';
        $this->items[] = '#IndexIgnore *';
        $this->items[] = '';
    }

    private function add_htaccess_hide_server_information() {
        $this->items[] = '# Masquer les informations du serveur';
        $this->items[] = 'ServerSignature Off';
        $this->items[] = '';
    }

    private function add_htaccess_protect_files_ht() {
        $this->items[] = '# Proteger les fichiers .htaccess et .htpasswds';
        $this->items[] = '<Files ~ "^.*\.([Hh][Tt][AaPp])">';
        $this->items[] = '	order allow,deny';
        $this->items[] = '	deny from all';
        $this->items[] = '	satisfy all';
        $this->items[] = '</Files>';
        $this->items[] = '';
    }
    
    private function add_htaccess_force_download_enable() {
        if (Options::get_option('htaccess_force_download_enable') != '') {
            $this->items[] = '# Forcer le telechargement pour ces types de fichiers';
            $this->items[] = sprintf( 'AddType application/octet-stream %s',esc_html(Options::get_option('htaccess_force_download')));
            $this->items[] = '';
        }
    }
    
    private function add_htaccess_enable_cache() {
        $this->items[] = '# Mise en cache des fichiers dans le navigateur';
        $this->items[] = '<IfModule mod_expires.c>';
        $this->items[] = '	ExpiresActive On';
        $this->items[] = '	ExpiresDefault "access plus 1 month"';
        $this->items[] = '';
        $this->items[] = '	ExpiresByType text/html "access plus 0 seconds"';
        $this->items[] = '	ExpiresByType text/xml "access plus 0 seconds"';
        $this->items[] = '	ExpiresByType application/xml "access plus 0 seconds"';
        $this->items[] = '	ExpiresByType application/json "access plus 0 seconds"';
        $this->items[] = '	ExpiresByType application/pdf "access plus 0 seconds"';
        $this->items[] = '';
        $this->items[] = '	ExpiresByType application/rss+xml "access plus 1 hour"';
        $this->items[] = '	ExpiresByType application/atom+xml "access plus 1 hour"';
        $this->items[] = '';
        $this->items[] = '	ExpiresByType application/x-font-ttf "access plus 1 month"';
        $this->items[] = '	ExpiresByType font/opentype "access plus 1 month"';
        $this->items[] = '	ExpiresByType application/x-font-woff "access plus 1 month"';
        $this->items[] = '	ExpiresByType application/x-font-woff2 "access plus 1 month"';
        $this->items[] = '	ExpiresByType image/svg+xml "access plus 1 month"';
        $this->items[] = '	ExpiresByType application/vnd.ms-fontobject "access plus 1 month"';
        $this->items[] = '';
        $this->items[] = '	ExpiresByType image/jpg "access plus 1 month"';
        $this->items[] = '	ExpiresByType image/jpeg "access plus 1 month"';
        $this->items[] = '	ExpiresByType image/gif "access plus 1 month"';
        $this->items[] = '	ExpiresByType image/png "access plus 1 month"';
        $this->items[] = '';
        $this->items[] = '	ExpiresByType video/ogg "access plus 1 month"';
        $this->items[] = '	ExpiresByType audio/ogg "access plus 1 month"';
        $this->items[] = '	ExpiresByType video/mp4 "access plus 1 month"';
        $this->items[] = '	ExpiresByType video/webm "access plus 1 month"';
        $this->items[] = '';
        $this->items[] = '	ExpiresByType text/css "access plus 1 week"';
        $this->items[] = '	ExpiresByType application/javascript "access plus 1 week"';
        $this->items[] = '';
        $this->items[] = '	ExpiresByType application/x-shockwave-flash "access plus 1 week"';
        $this->items[] = '	ExpiresByType image/x-icon "access plus 1 week"';
        $this->items[] = '';
        $this->items[] = '</IfModule>';
        $this->items[] = '';
        $this->items[] = '# En-tetes';
        $this->items[] = 'Header unset ETag';
        $this->items[] = 'FileETag None';
        $this->items[] = '';
        $this->items[] = '<ifModule mod_headers.c>';
        $this->items[] = '	<filesMatch "\.(ico|jpe?g|png|gif|swf)$">';
        $this->items[] = '		Header set Cache-Control "public" ';
        $this->items[] = '	</filesMatch>';
        $this->items[] = '	<filesMatch "\.(css)$">';
        $this->items[] = '		Header set Cache-Control "public" ';
        $this->items[] = '	</filesMatch>';
        $this->items[] = '	<filesMatch "\.(js)$">';
        $this->items[] = '		Header set Cache-Control "private" ';
        $this->items[] = '	</filesMatch>';
        $this->items[] = '	<filesMatch "\.(x?html?|php)$">';
        $this->items[] = '		Header set Cache-Control "private, must-revalidate"';
        $this->items[] = '	</filesMatch>';
        $this->items[] = '</ifModule>';
        $this->items[] = '';
    }

    private function add_htaccess_enable_compress_statics_files() {
        $this->items[] = '# Compressions des fichiers statiques';
        $this->items[] = '<IfModule mod_deflate.c>';
        $this->items[] = '	AddOutputFilterByType DEFLATE text/xhtml text/html text/plain text/xml text/javascript application/x-javascript text/css ';
        $this->items[] = '	BrowserMatch ^Mozilla/4 gzip-only-text/html ';
        $this->items[] = '	BrowserMatch ^Mozilla/4\.0[678] no-gzip ';
        $this->items[] = '	BrowserMatch \bMSIE !no-gzip !gzip-only-text/html ';
        $this->items[] = '	SetEnvIfNoCase Request_URI \.(?:gif|jpe?g|png)$ no-gzip dont-vary ';
        $this->items[] = '	Header append Vary User-Agent env=!dont-vary ';
        $this->items[] = '</IfModule> ';
        $this->items[] = '';
        $this->items[] = 'AddOutputFilterByType DEFLATE text/html';
        $this->items[] = 'AddOutputFilterByType DEFLATE text/plain';
        $this->items[] = 'AddOutputFilterByType DEFLATE text/plain';
        $this->items[] = 'AddOutputFilterByType DEFLATE text/xml';
        $this->items[] = 'AddOutputFilterByType DEFLATE text/css';
        $this->items[] = 'AddOutputFilterByType DEFLATE text/javascript';
        $this->items[] = 'AddOutputFilterByType DEFLATE font/opentype';
        $this->items[] = 'AddOutputFilterByType DEFLATE application/rss+xml';
        $this->items[] = 'AddOutputFilterByType DEFLATE application/javascript';
        $this->items[] = 'AddOutputFilterByType DEFLATE application/json';
        $this->items[] = '';
    }

    public function add( $item ) {
		$target = 'add_' . $item;

		if ( method_exists( $this, $target ) ) {
			$this->$target();
		}
	}

    public function sanitize_ct4gg( $text ) {
		return $text;
	}

    private function generate() {
		if ( count( $this->items ) === 0 ) {
			return '';
		}

		$text = [
			'# Created by ct4gg',
			'# ' . date( 'r' ),
			'# ct4gg ' . trim( CT4GG_VERSION ) . ' - https://ginkgos.net',
			'',

		];

		// Add Options ct4gg htaccess
		$text = array_merge( $text, array_filter( array_map( [ $this, 'sanitize_ct4gg' ], $this->items ) ) );

		// End of redirection section
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
		$filename = $this->location .'.htaccess';

		if ( file_exists( $filename ) ) {
			$existing = file_get_contents( $filename );
		}

		$file = @fopen( $filename, 'w' );
		if ( $file ) {
			$result = fwrite( $file, $this->get( $existing ) );
			fclose( $file );

			return $result !== false;
		}

		return false;
	}

    public function save_mod($txt) {

        $filename = $this->location .'.htaccess';
        
        $file = @fopen( $filename, 'w' );
		if ( $file ) {
			$result = fwrite( $file, str_replace('\"','"',$txt) );
			fclose( $file );

			return $result !== false;
		}

		return true;
    }

    public function backup() {
        $day = date('Ymd');
        $nb=0;
        while (file_exists($this->location .'.htaccess_'.$day.'-'.$nb)):
            $nb++;
        endwhile;
        if (!copy($this->location .'.htaccess', $this->location .'.htaccess_'.$day.'-'.$nb)) {
            return false;
        }
        return true;
    }
}