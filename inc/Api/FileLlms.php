<?php
/**
 * File Llms
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

namespace CT4GG\Api;

use CT4GG\Core\BaseController;
use CT4GG\Core\Options;

/**
 * Manage the llms.txt file (https://llmstxt.org/) content.
 */
class FileLlms extends BaseController {


	private $location  = '';
	private $items     = array();
	const INSERT_REGEX = '@\n?<!-- Created by ct4gg -->(?:.*?)<!-- End of ct4gg -->\n?@sm';


	public function __construct() {
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

	/**
	 * Header block: H1 title + summary blockquote + free details paragraph.
	 */
	private function add_llms_header() {
		$title = trim( (string) Options::get_option( 'llms_title' ) );
		if ( '' === $title ) {
			$title = get_bloginfo( 'name' );
		}
		$this->items[] = '# ' . $title;
		$this->items[] = '';

		$summary = trim( (string) Options::get_option( 'llms_summary' ) );
		if ( '' === $summary ) {
			$summary = get_bloginfo( 'description' );
		}
		if ( '' !== $summary ) {
			$this->items[] = '> ' . $summary;
			$this->items[] = '';
		}

		$details = trim( (string) Options::get_option( 'llms_details' ) );
		if ( '' !== $details ) {
			$this->items[] = $details;
			$this->items[] = '';
		}
	}

	/**
	 * Link to the XML sitemap.
	 */
	private function add_llms_sitemap() {
		$this->items[] = '## Sitemap';
		$this->items[] = '';
		$this->items[] = '- [XML Sitemap](' . get_site_url() . '/sitemap_index.xml)';
		$this->items[] = '';
	}

	/**
	 * List of published Pages.
	 */
	private function add_llms_pages() {
		$pages = get_pages(
			array(
				'sort_column' => 'menu_order',
				'post_status' => 'publish',
			)
		);

		if ( ! empty( $pages ) ) {
			$this->items[] = '## Pages';
			$this->items[] = '';
			foreach ( $pages as $page ) {
				$this->items[] = '- [' . $page->post_title . '](' . get_permalink( $page->ID ) . ')';
			}
			$this->items[] = '';
		}
	}

	/**
	 * List of latest published Posts.
	 */
	private function add_llms_posts() {
		$nb = (int) Options::get_option( 'llms_posts_number' );
		if ( $nb <= 0 ) {
			$nb = 10;
		}

		$posts = get_posts(
			array(
				'numberposts' => $nb,
				'post_status' => 'publish',
			)
		);

		if ( ! empty( $posts ) ) {
			$this->items[] = '## Posts';
			$this->items[] = '';
			foreach ( $posts as $post ) {
				$this->items[] = '- [' . $post->post_title . '](' . get_permalink( $post->ID ) . ')';
			}
			$this->items[] = '';
		}
	}

	/**
	 * Free "Optional" markdown block (manually maintained links).
	 */
	private function add_llms_optional() {
		$optional = trim( (string) Options::get_option( 'llms_optional' ) );
		if ( '' !== $optional ) {
			$this->items[] = '## Optional';
			$this->items[] = '';
			$this->items[] = $optional;
			$this->items[] = '';
		}
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
			'<!-- Created by ct4gg -->',
			'<!-- ' . date( 'r' ) . ' -->',
			'<!-- ct4gg ' . trim( CT4GG_VERSION ) . ' - https://ginkgos.net -->',
			'',
		);

		/**
		 * Add Options ct4gg llms
		 */
		$text = array_merge( $text, array_filter( array_map( array( $this, 'sanitize_ct4gg' ), $this->items ) ) );

		/**
		 * End of ct4gg section
		 */
		$text[] = '<!-- End of ct4gg -->';

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
		$filename = $this->location . 'llms.txt';

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

		$filename = $this->location . 'llms.txt';

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
		while ( file_exists( $this->location . 'llms.txt_' . $day . '-' . $nb ) ) :
			++$nb;
		endwhile;
		if ( ! copy( $this->location . 'llms.txt', $this->location . 'llms.txt_' . $day . '-' . $nb ) ) {
			return false;
		}
		return true;
	}
}
