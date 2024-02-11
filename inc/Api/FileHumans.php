<?php
/**
 * File Humans
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
 *
 */
class FileHumans extends BaseController {

	private $location  = '';
	private $items     = array();
	const INSERT_REGEX = '@\n?# Created by ct4gg(?:.*?)# End of ct4gg\n?@sm';


	protected function __construct() {
		$this->load( array( 'location' => ABSPATH ) );
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


	private function add_humans_team() {
		$this->items[] = '/* TEAM */';
		$this->items[] = Options::get_option( 'humans_team' );
		$this->items[] = '';
	}

	private function add_humans_thanks() {
		$this->items[] = '/* THANKS */';
		$this->items[] = Options::get_option( 'humans_thanks' );
		$this->items[] = '';
	}

	private function add_humans_site() {
		$this->items[] = '/* SITE */';
		$this->items[] = Options::get_option( 'humans_site' );
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

		$text = array(
			'# Created by ct4gg',
			'# ' . date( 'r' ),
			'# ct4gg ' . trim( CT4GG_VERSION ) . ' - https://ginkgos.net',
			'',

		);

		/**
		 * Add Options ct4gg htaccess
		 */
		$text = array_merge( $text, array_filter( array_map( array( $this, 'sanitize_ct4gg' ), $this->items ) ) );

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
		$filename = $this->location . 'humans.txt';

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

		$filename = $this->location . 'humans.txt';

		$file = @fopen( $filename, 'w' );
		if ( $file ) {
			$result = fwrite( $file, str_replace( '\\', '', $txt ) );
			fclose( $file );

			return false !== $result;
		}

		return true;
	}

	public function backup() {
		$day = date( 'Ymd' );
		$nb  = 0;
		while ( file_exists( $this->location . 'humans.txt_' . $day . '-' . $nb ) ) :
			$nb++;
		endwhile;
		if ( ! copy( $this->location . 'humans.txt', $this->location . 'humans.txt_' . $day . '-' . $nb ) ) {
			return false;
		}
		return true;
	}
}
