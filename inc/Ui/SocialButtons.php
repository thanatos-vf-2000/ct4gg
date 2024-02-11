<?php
/**
 * Social Buttons
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
 * Social Buttons
 */
class SocialButtons extends BaseController {

	public function register() {
		if ( $this->activated( 'socialbuttons_activated' ) ) {
			// Enable the_content if you want to automatically show social buttons below your post.

			add_filter( 'the_content', array( $this, 'social_buttons' ) );

			// This will create a WordPress shortcode [ct4gg_social].
			add_shortcode( 'ct4gg_social', array( $this, 'social_buttons' ) );

			add_action( 'wp_enqueue_scripts', array( $this, 'add_fontawesome_scripts' ) );
		}
	}

	/**
	 * Function to handle the thumbnail request
	 */
	public function get_the_post_thumbnail_src( $img ) {
		return ( preg_match( '~\bsrc="([^"]++)"~', $img, $matches ) ) ? $matches[1] : '';
	}

	public function social_buttons( $content ) {
		global $post;
		if ( is_singular() || is_home() ) {
			/*
			 * Get current page URL
			 */
			$sb_url = rawurlencode( get_permalink() );

			/*
			 * Get current page title
			 */
			$sb_title = str_replace( ' ', '%20', get_the_title() );

			/*
			 * Get Post Thumbnail for pinterest
			 */
			$sb_thumb = $this->get_the_post_thumbnail_src( get_the_post_thumbnail() );

			/*
			 * Construct sharing URL without using any script
			 */
			$twitter_url  = 'https://twitter.com/intent/tweet?text=' . $sb_title . '&amp;url=' . $sb_url . '&amp;via=wpvkp';
			$facebook_url = 'https://www.facebook.com/sharer/sharer.php?u=' . $sb_url;
			$buffer_url   = 'https://bufferapp.com/add?url=' . $sb_url . '&amp;text=' . $sb_title;
			$whatsapp_url = 'https://wa.me/?text=' . $sb_title . ' ' . $sb_url;
			$linkedin_url = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $sb_url . '&amp;title=' . $sb_title;

			if ( ! empty( $sb_thumb ) ) {
				$pinterest_url = 'https://pinterest.com/pin/create/button/?url=' . $sb_url . '&amp;media=' . $sb_thumb[0] . '&amp;description=' . $sb_title;
			} else {
				$pinterest_url = 'https://pinterest.com/pin/create/button/?url=' . $sb_url . '&amp;description=' . $sb_title;
			}

			/*
			 * Based on popular demand added Pinterest too
			 */
			$pinterest_url = 'https://pinterest.com/pin/create/button/?url=' . $sb_url . '&amp;media=' . $sb_thumb[0] . '&amp;description=' . $sb_title;

			$mail_subject = str_replace( ' ', '%20', __( 'Your friend has shared an article you with you.', 'ct4gg' ) );
			$mail_url     = 'mailto:?subject=' . $mail_subject . '&body=' . $sb_title . '%20' . $sb_url;

			/*
			 * Display type
			 */
			$btn = ( $this->activated( 'socialbuttons_txt' ) ) ? 'ct4gg-social-1' : 'ct4gg-social-2';

			/*
			 * Add sharing button at the end of page/page content
			 */
			$content .= '<div class="ct4gg-social-box"><div class="ct4gg-social-btn">';
			if ( $this->activated( 'socialbuttons_twitter' ) ) {
				$content .= '<a class="' . $btn . ' sbtn ct4gg-twitter" href="' . $twitter_url . '" target="_blank" rel="nofollow"><span>Twitter</span></a>';
			}
			if ( $this->activated( 'socialbuttons_facebook' ) ) {
				$content .= '<a class="' . $btn . ' sbtn ct4gg-facebook" href="' . $facebook_url . '" target="_blank" rel="nofollow"><span>Facebook</span></a>';
			}
			if ( $this->activated( 'socialbuttons_whatsapp' ) ) {
				$content .= '<a class="' . $btn . ' sbtn ct4gg-whatsapp" href="' . $whatsapp_url . '" target="_blank" rel="nofollow"><span>WhatsApp</span></a>';
			}
			if ( $this->activated( 'socialbuttons_pinterest' ) ) {
				$content .= '<a class="' . $btn . ' sbtn ct4gg-pinterest" href="' . $pinterest_url . '" data-pin-custom="true" target="_blank" rel="nofollow"><span>Pin It</span></a>';
			}
			if ( $this->activated( 'socialbuttons_linkedin' ) ) {
				$content .= '<a class="' . $btn . ' sbtn ct4gg-linkedin" href="' . $linkedin_url . '" target="_blank" rel="nofollow"><span>LinkedIn</span></a>';
			}
			if ( $this->activated( 'socialbuttons_buffer' ) ) {
				$content .= '<a class="' . $btn . ' sbtn ct4gg-buffer" href="' . $buffer_url . '" target="_blank" rel="nofollow"><span>Buffer</span></a>';
			}
			if ( $this->activated( 'socialbuttons_email' ) ) {
				$content .= '<a class="' . $btn . ' sbtn ct4gg-email" href="' . $mail_url . '" target="_blank" rel="nofollow"><span>Email</span></a>';
			}
			$content .= '</div></div>';

			return $content;
		} else {
			/*
			 * if not a post/page then don't include sharing button
			 */
			return $content;
		}
	}

	public function add_fontawesome_scripts() {
		if ( ! \wp_style_is( 'font-awesome', 'enqueued' ) && ! \wp_style_is( 'fontawesome', 'enqueued' ) ) {
			\wp_enqueue_style( 'font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/fontawesome.min.css', array(), '6.0.0' );
		}
	}
}
