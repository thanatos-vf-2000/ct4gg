<?php
/**
 * Enqueue file
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

namespace CT4GG\Core;

class Enqueue {

	public function register() {
		add_action( 'init', array( $this, 'init' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue' ) );
		add_action( 'login_enqueue_scripts', array( $this, 'admin_enqueue' ) );
	}

	public function init() {
		load_plugin_textdomain( 'ct4gg', false, CT4GG_PATH . '/languages' );
	}

	public function enqueue() {
		if ( WP_DEBUG ) {
			wp_enqueue_style( CT4GG_NAME, CT4GG_URL . 'assets/css/style.css', array(), CT4GG_VERSION );
		} else {
			wp_enqueue_style( CT4GG_NAME, CT4GG_URL . 'assets/css/style.min.css', array(), CT4GG_VERSION );
		}
	}

	public function admin_enqueue() {
		wp_enqueue_media();
		wp_enqueue_script( 'jquery' );
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );

		if ( WP_DEBUG ) {
			wp_enqueue_style( CT4GG_NAME, CT4GG_URL . 'assets/css/admin.css', array(), CT4GG_VERSION );
			wp_enqueue_script( CT4GG_NAME, CT4GG_URL . 'assets/js/admin.js', array( 'jquery', 'wp-color-picker' ), CT4GG_VERSION, true );
			wp_enqueue_script( CT4GG_NAME . '-header', CT4GG_URL . 'assets/js/admin-header.js', array(), CT4GG_VERSION, true );
		} else {
			wp_enqueue_style( CT4GG_NAME, CT4GG_URL . 'assets/css/admin.min.css', array(), CT4GG_VERSION );
			wp_enqueue_script( CT4GG_NAME, CT4GG_URL . 'assets/js/admin.min.js', array( 'jquery', 'wp-color-picker' ), CT4GG_VERSION, true );
			wp_enqueue_script( CT4GG_NAME . '-header', CT4GG_URL . 'assets/js/admin-header.min.js', array(), CT4GG_VERSION, true );
		}

		if ( isset( $_SERVER['SCRIPT_NAME'] ) && stripos( sanitize_text_field( wp_unslash( $_SERVER['SCRIPT_NAME'] ) ), strrchr( wp_login_url(), '/' ) ) !== false ) {
			$custom_css = '';
			$opt        = get_option( CT4GG_NAME . '_plugin' );
			if ( $opt['login_screen_logo_enable'] ) {
				$custom_css .= ".login h1 a { 
					background-image: url('" . $opt['login_screen_logo'] . "'); 
				}";
			}
			if ( $opt['login_screen_background_enable'] ) {
				$color_img   = str_replace( '#', '', $opt['login_screen_btn_color'] );
				$custom_css .= 'body {background: ' . $opt['login_screen_background_color'] . " url('" . $opt['login_screen_background_img'] . "');}
				body.login { 
					background-attachment: fixed; 
					background-position: center;
				}
				body.login a {color: " . $opt['login_screen_link_color'] . ' !important;}
				body.login a:active, a:hover {color: darken(' . $opt['login_screen_link_color'] . ',20%) !important;}
				.login label {color: ' . $opt['login_screen_text_color'] . '}
				.login .button.wp-hide-pw .dashicons {color: ' . $opt['login_screen_btn_color'] . ';}
				.login .button.wp-hide-pw:focus {border-color:' . $opt['login_screen_btn_color'] . ';box-shadow:0 0 0 1px ' . $opt['login_screen_btn_color'] . ';}
				.login form .input:focus {border-color:' . $opt['login_screen_btn_color'] . ';box-shadow:0 0 0 1px ' . $opt['login_screen_btn_color'] . ';}
				input[type=checkbox]:focus {border-color:' . $opt['login_screen_btn_color'] . ';box-shadow:0 0 0 1px ' . $opt['login_screen_btn_color'] . ';}
				input[type=checkbox]:checked::before {
					content: url(data:image/svg+xml;utf8,%3Csvg%20xmlns%3D%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27%20viewBox%3D%270%200%2020%2020%27%3E%3Cpath%20d%3D%27M14.83%204.89l1.34.94-5.81%208.38H9.02L5.78%209.67l1.34-1.25%202.57%202.4z%27%20fill%3D%27%23' . $color_img . '%27%2F%3E%3C%2Fsvg%3E);}
				.wp-core-ui .button-group.button-large .button, .wp-core-ui .button.button-large {background: ' . $opt['login_screen_btn_color'] . '; border-color: ' . $opt['login_screen_btn_color'] . '; color: ' . $opt['login_screen_form_bg_color'] . ';	}
				.login form .input, .login form {background: ' . $opt['login_screen_form_bg_color'] . ';}
				.login #login_error, .login .message, .login .success {
					color: ' . $opt['login_screen_text_color'] . ';	border-left: 4px solid ' . $opt['login_screen_text_color'] . ';	background-color: ' . $opt['login_screen_form_bg_color'] . ';}
				';
			}

			if ( '' !== $custom_css ) {
				if ( ! WP_DEBUG ) {
					$custom_css = $this->compress_css( $custom_css );
				}
				wp_add_inline_style( CT4GG_NAME, $custom_css );
			}
		}
	}

	private static function compress_css( $css ) {
		return preg_replace( '/\s+/', ' ', $css );
	}
}
