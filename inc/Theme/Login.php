<?php
/**
 * Theme Login
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

namespace CT4GG\Theme;

use CT4GG\Core\BaseController;
use CT4GG\Core\Options;
use CT4GG\Api\SettingsApi;
use CT4GG\Api\Callbacks\AdminCallbacks;
use CT4GG\Theme\Login\Controls\Range_Slider;
use CT4GG\Theme\Login\Controls\Alpha;
use CT4GG\Theme\Login\Controls\Padding;
use CT4GG\Theme\Login\Controls\Radio_Images;
use CT4GG\Theme\Login\Controls\Toggle;

require_once ABSPATH . 'wp-includes/class-wp-customize-control.php';
require_once ABSPATH . 'wp-includes/customize/class-wp-customize-background-position-control.php';

/**
 *
 */
class Login extends BaseController {

	public $callbacks;

	public $subpages = array();

	public function register() {
		if ( 1 === Options::get_option( 'login_screen_v2' ) ) {
			$this->settings = new SettingsApi();

			$this->callbacks = new AdminCallbacks();

			$this->setSubpages();

			$this->settings->add_sub_pages( $this->subpages )->register();

			/**
			 * Register Customizer Page
			 */
			add_action( 'customize_register', array( $this, 'login_customize_register' ) );

			/**
			 * Enqueue script CSS and JS for login screen
			 */
			add_action( 'customize_controls_print_scripts', array( $this, 'js_script' ) );
			add_action( 'customize_controls_print_scripts', array( $this, 'js_script' ) );
			add_action( 'customize_preview_init', array( $this, 'js_preview_script' ) );
			add_action( 'customize_controls_enqueue_scripts', array( $this, 'js_preview_script' ) );
			add_action( 'login_enqueue_scripts', array( $this, 'render_styles' ) );

			if ( ! is_customize_preview() ) {
				/*
				 * Hook to login_headerurl
				 */
				$options = get_option( CT4GG_NAME . '_options' );
				if ( ! empty( $options['ct4gg_logo_link'] ) ) {
					add_filter( 'login_headerurl', array( $this, 'login_logo_url' ), 99 );
				}
				if ( ! empty( $options['ct4gg_field_register_link'] ) && 1 === $options['ct4gg_field_register_link'] ) {
					add_filter( 'register', array( $this, 'no_register_link' ) );
					add_filter( 'login_link_separator', array( $this, 'no_register_link' ) );
				}
				if ( ! empty( $options['ct4gg_field_lost_password'] ) && 1 === $options['ct4gg_field_lost_password'] ) {
					add_filter( 'login_link_separator', array( $this, 'no_register_link' ) );
				}
			}
		}
	}

	public function setSubpages() {
		global $submenu;

		if ( 1 === Options::get_option( 'login_screen_v2' ) ) {
			$url = Options::get_option( 'login_slugs_login' );
		} else {
			$url = 'wp-login.php';
		}
		$login_url = add_query_arg(
			array(
				'autofocus[panel]' => CT4GG_NAME . '_login_panel',
				'url'              => rawurlencode( site_url() . '/' . $url ),
			),
			admin_url( 'customize.php' )
		);

		/**
		 *  Add submenu item to menu CT4GG
		 */
		$this->subpages = array(
			array(
				'parent_slug' => CT4GG_NAME . '_plugin',
				'page_title'  => 'Login Custom',
				'menu_title'  => 'Login Custom',
				'capability'  => 'manage_options',
				'menu_slug'   => "$login_url",
				'callback'    => '',
			),
		);

		/**
		 * Add submenu item to Theme configuration
		 */
		// phpcs:ignore WordPress.WP.GlobalVariablesOverride
		$submenu['themes.php'][] = array( 'Login Custom', 'manage_options', $login_url, CT4GG_NAME . '_login_panel' );
	}

	/**
	 * Sanitizer for Background Radio Control
	 */
	public function ct4gg_radio_option( $input, $setting ) {
		global $wp_customize;

		/**
		 * Get control ID
		 */
		$control = $wp_customize->get_control( $setting->id );

		/**
		 * Check if option exists in choice array
		 */
		if ( array_key_exists( $input, $control->choices ) ) {
			/**
			 * If it does, return the value
			 */
			return $input;
		} else {
			/**
			 * Else, return default value
			 */
			return $setting->default;
		}
	}

	/**
	 * Sanitizer for Background Position Control
	 */
	public function ct4gg_sanitize_position( $input, $setting ) {
		/**
		 * Check if value is one of the positions
		 */
		if ( in_array( $input, array( 'top', 'bottom', 'left', 'right', 'center' ), true ) ) {
			/**
			 * If it does, return the value
			 */
			return $input;
		} else {
			/**
			 * Else, return default value
			 */
			return $setting->default;
		}
	}

	public function login_customize_register( $wp_customize ) {

		/**
		 * Login Customizer Panel
		 */
		$wp_customize->add_panel(
			CT4GG_NAME . '_login_panel',
			array(
				'priority'    => 30,
				'capability'  => 'edit_theme_options',
				'title'       => __( 'Login Custom', 'c2b4wp' ),
				'description' => __( 'This section allows you to customize the login page of your website. Made with ❤ by <a target="_blank" rel="nofollow" href="https://loginpress.pro/?utm_source=login-customizer-lite&utm_medium=customizer">Hardeep Asrani</a> team.', 'c4b4wp' ),
			)
		);

		/**
		 * Section Menu
		 */
		$defaults = $this->get_login_customizer_configuration_defaults();
		$files    = scandir( CT4GG_PATH . 'inc/Theme/Login/Sections', SCANDIR_SORT_ASCENDING );
		foreach ( $files as $file_key => $file_value ) {
			if ( ! is_dir( CT4GG_PATH . 'inc/Theme/Login/Sections' . DIRECTORY_SEPARATOR . $file_value ) ) {
				unset( $all_options );
				$all_options = Options::load_php_config( CT4GG_PATH . 'inc/Theme/Login/Sections' . DIRECTORY_SEPARATOR . $file_value );
				foreach ( $all_options as $x => $opt_value ) {
					$config = wp_parse_args( $opt_value, $defaults );
					switch ( $config['type'] ) {
						case 'section':
							$wp_customize->add_section(
								$config['section'],
								array(
									'priority' => $config['priority'],
									'title'    => $config['title'],
									'panel'    => CT4GG_NAME . '_login_panel',
								)
							);
							break;
						case 'opt-color':
							$wp_customize->add_setting(
								$config['name'],
								array(
									'default'           => $config['default'],
									'type'              => 'option',
									'capability'        => 'edit_theme_options',
									'sanitize_callback' => $config['sanitize_callback'],
									'transport'         => 'postMessage',
								)
							);

							$wp_customize->add_control(
								new \WP_Customize_Color_Control(
									$wp_customize,
									$config['name'],
									array(
										'label'    => $config['title'],
										'section'  => $config['section'],
										'priority' => $config['priority'],
										'settings' => $config['name'],
									)
								)
							);
							break;
						case 'opt-image':
							$wp_customize->add_setting(
								$config['name'],
								array(
									'type'              => 'option',
									'capability'        => 'edit_theme_options',
									'sanitize_callback' => $config['sanitize_callback'],
									'transport'         => 'postMessage',
								)
							);

							$wp_customize->add_control(
								new \WP_Customize_Image_Control(
									$wp_customize,
									$config['name'],
									array(
										'label'    => $config['title'],
										'section'  => $config['section'],
										'priority' => $config['priority'],
										'settings' => $config['name'],
									)
								)
							);
							break;
						case 'opt-radio':
							$wp_customize->add_setting(
								$config['name'],
								array(
									'default'           => $config['default'],
									'type'              => 'option',
									'capability'        => 'edit_theme_options',
									'sanitize_callback' => array( $this, 'ct4gg_radio_option' ),
									'transport'         => 'postMessage',
								)
							);
							$wp_customize->add_control(
								$config['name'],
								array(
									'label'    => $config['title'],
									'section'  => $config['section'],
									'type'     => 'select',
									'choices'  => $config['choices'],
									'priority' => $config['priority'],
									'settings' => $config['name'],
								)
							);
							break;
						case 'option':
							$wp_customize->add_setting(
								$config['name'],
								array(
									'type'              => 'option',
									'capability'        => 'edit_theme_options',
									'sanitize_callback' => $config['sanitize_callback'],
									'transport'         => 'postMessage',
								)
							);

							$wp_customize->add_control(
								$config['name'],
								array(
									'label'    => $config['title'],
									'section'  => $config['section'],
									'priority' => $config['priority'],
									'settings' => $config['name'],
								)
							);
							break;
						case 'opt-position':
							$wp_customize->add_setting(
								$config['name-x'],
								array(
									'default'           => $config['default-x'],
									'type'              => 'option',
									'capability'        => 'edit_theme_options',
									'sanitize_callback' => array( $this, 'ct4gg_sanitize_position' ),
									'transport'         => 'postMessage',
								)
							);

							$wp_customize->add_setting(
								$config['name-y'],
								array(
									'default'           => $config['default-y'],
									'type'              => 'option',
									'capability'        => 'edit_theme_options',
									'sanitize_callback' => array( $this, 'ct4gg_sanitize_position' ),
									'transport'         => 'postMessage',
								)
							);

							$wp_customize->add_control(
								new \WP_Customize_Background_Position_Control(
									$wp_customize,
									$config['name'],
									array(
										'label'    => $config['title'],
										'section'  => $config['section'],
										'priority' => $config['priority'],
										'settings' => array(
											'x' => $config['name-x'],
											'y' => $config['name-y'],
										),
									)
								)
							);
							break;
						case 'opt-range-slider':
							$wp_customize->add_setting(
								$config['name'],
								array(
									'default'           => $config['default'],
									'type'              => 'option',
									'capability'        => 'edit_theme_options',
									'sanitize_callback' => $config['sanitize_callback'],
									'transport'         => 'postMessage',
								)
							);

							$wp_customize->add_control(
								new Range_Slider(
									$wp_customize,
									$config['name'],
									array(
										'label'       => $config['title'],
										'section'     => $config['section'],
										'priority'    => $config['priority'],
										'settings'    => $config['name'],
										'choices'     => $config['choices'],
										'input_attrs' => $config['input_attrs'],
									)
								)
							);
							break;
						case 'option-default':
							$wp_customize->add_setting(
								$config['name'],
								array(
									'default'           => $config['default'],
									'type'              => 'option',
									'capability'        => 'edit_theme_options',
									'sanitize_callback' => $config['sanitize_callback'],
									'transport'         => 'postMessage',
								)
							);

							$wp_customize->add_control(
								$config['name'],
								array(
									'label'       => $config['title'],
									'description' => $config['description'],
									'section'     => $config['section'],
									'priority'    => $config['priority'],
									'settings'    => $config['name'],
								)
							);
							break;
						case 'opt-alpha':
							$wp_customize->add_setting(
								$config['name'],
								array(
									'default'           => $config['default'],
									'type'              => 'option',
									'capability'        => 'edit_theme_options',
									'sanitize_callback' => 'sanitize_text_field',
									'transport'         => 'postMessage',
								)
							);

							$wp_customize->add_control(
								new Alpha(
									$wp_customize,
									$config['name'],
									array(
										'label'    => $config['title'],
										'section'  => $config['section'],
										'priority' => $config['priority'],
										'settings' => $config['name'],
									)
								)
							);
							break;
						case 'opt-padding':
							$wp_customize->add_setting(
								$config['name'],
								array(
									'default'           => $config['default'],
									'type'              => 'option',
									'capability'        => 'edit_theme_options',
									'sanitize_callback' => $config['sanitize_callback'],
									'transport'         => 'postMessage',
								)
							);

							$wp_customize->add_control(
								new Padding(
									$wp_customize,
									$config['name'],
									array(
										'label'    => $config['title'],
										'section'  => $config['section'],
										'priority' => $config['priority'],
										'settings' => $config['name'],
									)
								)
							);
							break;
						case 'opt-toggle':
							$wp_customize->add_setting(
								$config['name'],
								array(
									'default'           => $config['default'],
									'type'              => 'option',
									'capability'        => 'edit_theme_options',
									'sanitize_callback' => $config['sanitize_callback'],
									'transport'         => 'postMessage',
								)
							);

							$wp_customize->add_control(
								new Toggle(
									$wp_customize,
									$config['name'],
									array(
										'label'    => $config['title'],
										'section'  => $config['section'],
										'priority' => $config['priority'],
										'settings' => $config['name'],
									)
								)
							);
							break;
						case 'opt-select':
							$wp_customize->add_setting(
								$config['name'],
								array(
									'default'           => $config['default'],
									'type'              => 'option',
									'capability'        => 'edit_theme_options',
									'sanitize_callback' => $config['sanitize_callback'],
									'transport'         => 'postMessage',
								)
							);
							$wp_customize->add_control(
								$config['name'],
								array(
									'label'    => $config['title'],
									'section'  => $config['section'],
									'type'     => 'select',
									'choices'  => $config['choices'],
									'priority' => $config['priority'],
									'settings' => $config['name'],
								)
							);
							break;
						case 'opt-radio-images':
							$wp_customize->add_setting(
								$config['name'],
								array(
									'default'           => $config['default'],
									'type'              => 'option',
									'capability'        => 'edit_theme_options',
									'sanitize_callback' => function ( $input, $setting ) {
										/**
										 * global wp_customize
										 */
										global $wp_customize;

										/**
										 * Get control ID
										 */
										$control = $wp_customize->get_control( $setting->id );

										/**
										 * Check if option exists in choice array
										 */
										if ( array_key_exists( $input, $control->choices ) ) {
											/**
											 * If it does, return the value
											 */
											return $input;
										} else {
											/**
											 * Else, return default value
											 */
											return $setting->default;
										}
									},
								)
							);

							$wp_customize->add_control(
								new Radio_Images(
									$wp_customize,
									$config['name'],
									array(
										'label'    => $config['title'],
										'section'  => $config['section'],
										'priority' => $config['priority'],
										'settings' => $config['name'],
										'choices'  => $config['choices'],
									)
								)
							);
							break;
					}
				}
			}
		}
	}

	private function get_login_customizer_configuration_defaults() {
		return apply_filters(
			'ct4gg_login_customizer_configuration_defaults',
			array(
				'type'              => null,
				'section'           => null,
				'title'             => null,
				'name'              => null,
				'default'           => null,
				'sanitize_callback' => null,
				'priority'          => 1,
				'choices'           => null,
				'input_attrs'       => null,
				'description'       => null,
			)
		);
	}

	public function js_script() {

		$min = ( WP_DEBUG ) ? '' : '.min';
		/**
		 * Enqueue script to Customizer
		 */
		wp_enqueue_script( CT4GG_NAME . '_login_js', CT4GG_URL . '/assets/js/Login/customizer' . $min . '.js', array( 'jquery' ), CT4GG_VERSION, true );

		if ( 1 === Options::get_option( 'login_screen_v2' ) ) {
			$url = Options::get_option( 'login_slugs_login' );
		} else {
			$url = 'wp-login.php';
		}
		$url = site_url() . '/' . $url;

		$localize = array(
			'page' => $url,
			'url'  => CT4GG_URL,
		);

		/**
		 * Localize Script
		 */
		wp_localize_script( CT4GG_NAME . '_login_js', CT4GG_NAME . '_script', $localize );
	}

	public function js_preview_script() {

		$min = ( WP_DEBUG ) ? '' : '.min';
		/**
		 * Enqueue script to Customizer Preview
		 */
		wp_enqueue_script( CT4GG_NAME . '_preview', CT4GG_URL . '/assets/js/Login/customizer-preview' . $min . '.js', array( 'jquery', 'customize-preview' ), CT4GG_VERSION, true );

		if ( 1 === Options::get_option( 'login_screen_v2' ) ) {
			$url = Options::get_option( 'login_slugs_login' );
		} else {
			$url = 'wp-login.php';
		}
		$url = site_url() . '/' . $url;

		$localize = array(
			'page' => $url,
		);

		/**
		 * Action hook triggered after customize_controls_init was called
		 */
		wp_localize_script( CT4GG_NAME . '_preview', CT4GG_NAME . '_script', $localize );
	}

	public function render_styles() {
		/**
		 * Get plugin options array
		 */
		$options = get_option( CT4GG_NAME . '_options' );
		/**
		 * Initialize empty string
		 */
		$custom_css = '';

		/*
		* Logo CSS
		*/
		$custom_css .= 'body.login div#login h1 a {';
		if ( ! empty( $options['ct4gg_logo_show'] ) && 1 === $options['ct4gg_logo_show'] ) {
			$custom_css .= 'display: none;';
		} else {
			if ( ! empty( $options['ct4gg_logo'] ) ) {
				$custom_css .= 'background-image: url(" ' . $options['ct4gg_logo'] . ' ");';
			}
		}
		$custom_css .= '}';

		/*
		* Background
		*/
		$custom_css .= 'body.login {';
		if ( ! empty( $options['ct4gg_bg_image'] ) ) {
			$custom_css .= 'background-image: url(" ' . $options['ct4gg_bg_image'] . ' ");';
		}
		if ( ! empty( $options['ct4gg_bg_color'] ) ) {
			$custom_css .= 'background-color: ' . $options['ct4gg_bg_color'] . ';';
		}
		if ( ! empty( $options['ct4gg_bg_image_size'] ) ) {
			if ( 'custom' === $options['ct4gg_bg_image_size'] ) {
				$custom_css .= 'background-size: ' . $options['ct4gg_bg_size'] . ';';
			} else {
				$custom_css .= 'background-size: ' . $options['ct4gg_bg_image_size'] . ';';
			}
		}
		if ( ! empty( $options['ct4gg_bg_image_repeat'] ) ) {
			$custom_css .= 'background-repeat: ' . $options['ct4gg_bg_image_repeat'] . ';';
		}
		$custom_css .= '}';

		/*
		* Form
		*/
		$custom_css .= '#login form#loginform, #login form#registerform, #login form#lostpasswordform {';
		if ( ! empty( $options['ct4gg_form_bg_color'] ) ) {
			$custom_css .= 'background-color: ' . $options['ct4gg_form_bg_color'] . ';';
		}
		$custom_css .= '}';

		/*
		* Login Form Labels
		*/
		$custom_css .= '#login form#loginform label, #login form#registerform label, #login form#lostpasswordform label {';
		if ( ! empty( $options['ct4gg_text_color'] ) ) {
			$custom_css .= 'color: ' . $options['ct4gg_text_color'] . ';';
		}
		$custom_css .= '}';

		/*
		* Button
		*/
		$custom_css     .= '#login form .submit .button {';
			$custom_css .= 'height: auto;';
		if ( ! empty( $options['ct4gg_button_bg'] ) ) {
			$custom_css .= 'background-color: ' . $options['ct4gg_button_bg'] . ';';
		}
		if ( ! empty( $options['ct4gg_form_border_color'] ) ) {
			$custom_css .= 'border-color: ' . $options['ct4gg_form_border_color'] . ';';
		}
		if ( ! empty( $options['ct4gg_button_color'] ) ) {
			$custom_css .= 'color: ' . $options['ct4gg_button_color'] . ';';
		}
		$custom_css .= '}';

		/*
		* Button Hover
		* Login Button on Hover CSS
		*/
		$custom_css .= '#login form .submit .button:hover, #login form .submit .button:focus {';
		if ( ! empty( $options['ct4gg_button_hover_bg'] ) ) {
			$custom_css .= 'background-color: ' . $options['ct4gg_button_hover_bg'] . ';';
			$custom_css .= 'border-color: ' . $options['ct4gg_button_hover_bg'] . ';';
		}
		$custom_css .= '}';

		/*
		* Other Styling
		*/
		if ( ! empty( $options['ct4gg_field_back_blog'] ) && 1 === $options['ct4gg_field_back_blog'] ) {
			$custom_css     .= '#login #backtoblog {';
				$custom_css .= 'display: none;';
			$custom_css     .= '}';
		}
		if ( ! empty( $options['ct4gg_other_color'] ) ) {
			$custom_css     .= '.login #nav, .login #nav a, .login #backtoblog a, .login .privacy-policy-page-link a {';
				$custom_css .= 'color: ' . $options['ct4gg_other_color'] . ';';
			$custom_css     .= '}';
		}
		if ( ! empty( $options['ct4gg_other_color_hover'] ) ) {
			$custom_css     .= '.login #backtoblog a:hover, .login #nav a:hover, .login .privacy-policy-page-link a:hover {';
				$custom_css .= 'color: ' . $options['ct4gg_other_color_hover'] . ';';
			$custom_css     .= '}';
		}
		/**
		 * Lost Password Link CSS
		 */
		if ( ! empty( $options['ct4gg_field_lost_password'] ) && 1 === $options['ct4gg_field_lost_password'] ) {
			$custom_css     .= '#login #nav a:last-child {';
				$custom_css .= 'display: none;';
			$custom_css     .= '}';
		}

		/**
		 * Register Link
		 */
		if ( ! empty( $options['ct4gg_field_register_link'] ) && 1 === $options['ct4gg_field_register_link'] ) {
			$custom_css     .= '#login #nav a:first-child {';
				$custom_css .= 'display: none;';
			$custom_css     .= '}';
		}

		/**
		 * Hook inline styles to stylesheet
		 */
		wp_add_inline_style( CT4GG_NAME, $custom_css );
	}

	/**
	 * Change login logo URL
	 *
	 * @since 1.3.0
	 */
	public function login_logo_url() {
		/**
		 * Return logo link option
		 */
		$options = get_option( CT4GG_NAME . '_options' );

		return $options['ct4gg_logo_link'];
	}

	/**
	 * Remove register link
	 */
	public function no_register_link( $url ) {
		return '';
	}
}
