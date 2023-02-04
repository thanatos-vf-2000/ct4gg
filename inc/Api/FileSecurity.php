<?php
/**
 * @package  CT4GGPlugin
 * @Version 1.4.5
 */

namespace CT4GG\Api;

use CT4GG\Core\BaseController;
use CT4GG\Core\Options;
/**
* 
*/
class FileSecurity extends BaseController
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


    private function add_security_contact() {
        $this->items[] = "Contact: " . Options::get_option('security_contact');
    }

	private function add_security_expires_date() {
        $this->items[] = "Expires: ". Options::get_option('security_expires_date') . "T" . Options::get_option('security_expires_time') . ":00.000Z";
    }

	private function add_security_encryption() {
        $this->items[] = "Encryption: " . Options::get_option('security_encryption');
    }

	private function add_security_acknowledgments() {
        $this->items[] = "Acknowledgments: " . Options::get_option('security_acknowledgments');
    }

	private function add_security_preferred_languages() {
        $this->items[] = "Preferred-Languages: " . Options::get_option('security_preferred_languages');
    }

	private function add_security_canonical() {
        $this->items[] = "Canonical: " . Options::get_option('security_canonical');
    }

	private function add_security_policy() {
        $this->items[] = "Policy: " . Options::get_option('security_policy');
    }

	private function add_security_hiring() {
        $this->items[] = "Hiring: " . Options::get_option('security_hiring');
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
		$filename = $this->location .'security.txt';

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

        $filename = $this->location .'security.txt';
        
        $file = @fopen( $filename, 'w' );
		if ( $file ) {
			$result = fwrite( $file, str_replace('\\','',$txt) );
			fclose( $file );

			return $result !== false;
		}

		return true;
    }

    public function backup() {
        $day = date('Ymd');
        $nb=0;
        while (file_exists($this->location .'security.txt_'.$day.'-'.$nb)):
            $nb++;
        endwhile;
        if (!copy($this->location .'security.txt', $this->location .'security.txt_'.$day.'-'.$nb)) {
            return false;
        }
        return true;
    }
}