<?php
/**
 * Post
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

namespace CT4GG\ui;

use CT4GG\Core\BaseController;

/**
 *
 */
class Post extends BaseController {

	public function register() {
		$opt = get_option( CT4GG_NAME . '_plugin' );
		if ( $this->activated( 'post_search_1_redirect_to_post' ) ) {
			add_action( 'template_redirect', array( $this, 'search_1_redirect_to_post' ) );
		}
		if ( is_array( $opt ) && $opt['post_minimal_comment_length'] > 0 ) {
			add_filter( 'preprocess_comment', array( $this, 'minimal_comment_length' ) );
		}
		if ( $this->activated( 'post_hide_meta_generator' ) ) {
			add_filter( 'the_generator', array( $this, 'delete_version' ) );
		}
		if ( is_array( $opt ) && $opt['post_old_post_notice'] > 0 ) {
			add_filter( 'the_content', array( $this, 'old_post_notice' ) );
		}
	}

	public function search_1_redirect_to_post() {
		global $wp_query;

		/*
		 * If you are on an archive page and there is only one result
		 */
		if ( is_archive() && 1 === $wp_query->post_count ) {
			/*
			 * Recover the item and its values
			 */
			the_post();

			/*
			 * We get the URL of the article
			 */
			$post_url = get_permalink();

			/*
			 * And we redirect to the article
			 */
			wp_safe_redirect( $post_url );
			exit;
		}

		/*
		 * If you are on a search page
		 */
		if ( is_search() ) {
			/*
			 * And if there is only one result
			 */
			if ( 1 === $wp_query->post_count && 1 === $wp_query->max_num_pages ) {
				/*
				 * We redirect to the only result
				 */
				wp_safe_redirect( get_permalink( $wp_query->posts['0']->ID ) );
				exit;
			}
		}
	}

	public static function minimal_comment_length( $commentdata ) {
		/*
		* Here we set the minimum number of characters per comment.
		*/
		$opt                    = get_option( CT4GG_NAME . '_plugin' );
		$minimal_comment_length = $opt['post_minimal_comment_length'];

		/*
		 * We see if the comment contains more than xx characters
		 */
		if ( strlen( trim( $commentdata['comment_content'] ) ) < $minimal_comment_length ) {
			/*
			 * If it is less than xx characters, an error is returned:
			 */
			wp_die( esc_html( __( 'Comments must contain at least ', 'ct4gg' ) . $minimal_comment_length . __( 'characters.', 'ct4gg' ) ) );
		}
		return $commentdata;
	}

	/**
	 * We return an empty string instead of the WordPress version
	 */
	public static function delete_version() {
		return '';
	}

	/**
	 * Display a message at the top of articles older than X days
	 */
	public static function old_post_notice( $content ) {
		if ( ! is_front_page() && ! is_home() && ! is_admin() ) {
			$opt = get_option( CT4GG_NAME . '_plugin' );

			/*
			 * Calculation of the "seniority" of the article since January 1, 1970, called Unix time
			 */
			$anciennete_unix = get_the_time( 'U' );

			/*
			 * We calculate the age in seconds of the article between the present time and its age in Unix time.
			 * time() returns the current time, measured in seconds since the beginning of the UNIX era, (January 1st 1970 00:00:00 GMT).
			 */
			$anciennete_secondes = ( ( time() - $anciennete_unix ) );

			/*
			 * We calculate its age in days (1 day = 86400 seconds)
			 */
			$anciennete_jours = ( ( $anciennete_secondes / 86400 ) );

			/*
			 * If the article is more than xxx days old, we display our alert
			 */
			if ( $anciennete_jours > $opt['post_old_post_notice'] && ( ! is_front_page() && ! is_home() ) && get_post_type() !== 'page' ) {
				$message = sprintf( __( 'WARNING: This article is more than %s days old and may no longer be current.', 'ct4gg' ), $opt['post_old_post_notice'] );
				$content = "<div style='background-color: #f4f4f4; padding: 15px; margin-bottom: 30px;'>" . $message . '</div>' . $content;
			}
		}

		return $content;
	}
}
