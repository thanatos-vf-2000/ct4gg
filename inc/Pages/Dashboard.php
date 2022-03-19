<?php
/**
 * @package  CT4GGPlugin
 * @Version 1.4.0
 */

namespace CT4GG\Pages;

use CT4GG\Api\SettingsApi;
use CT4GG\Core\BaseController;
use CT4GG\Api\Callbacks\AdminCallbacks;
use CT4GG\Api\Callbacks\ManagerCallbacks;

/**
* 
*/
class Dashboard extends BaseController
{
	public $settings;

	public $callbacks;

	public $callbacks_mngr;

	public $pages = array();

	public function register() {
		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();

		$this->callbacks_mngr = new ManagerCallbacks();

		$this->setPages();

		$this->setSettings();
		$this->setSections();
		$this->setFields();

		$this->settings->addPages( $this->pages )->withSubPage( __('Settings', 'ct4gg') )->register();
	}

	public function setPages() 
	{
		$icon_svg = "data:image/svg+xml,%3C%3Fxml version='1.0' encoding='UTF-8'%3F%3E%3Csvg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' width='20pt' height='19pt' viewBox='0 0 20 19' version='1.1'%3E%3Cg id='surface1'%3E%3Cpath style=' stroke:none;fill-rule:nonzero;fill:rgb(65.490196%25,66.27451%25,67.45098%25);fill-opacity:1;' d='M 10.496094 10.714844 C 13.871094 7.0625 12.121094 5.558594 13.175781 4.136719 C 14.195312 3.316406 14.226562 3.738281 14.613281 3.929688 C 15.484375 3.953125 15.550781 4 15.808594 4.46875 C 16.230469 4.503906 16.578125 4.59375 16.703125 4.839844 C 17.285156 4.671875 17.304688 5.1875 17.550781 5.605469 C 18.289062 5.453125 18.742188 5.929688 18.882812 6.394531 C 19.75 6.179688 19.90625 7.515625 19.773438 7.613281 C 19.425781 9.019531 16.160156 8.695312 15.636719 9.496094 C 16.972656 9.863281 18.3125 8.546875 19.535156 9.289062 C 20.027344 9.972656 19.917969 10.207031 19.707031 10.859375 C 19.6875 11.433594 20.109375 11.636719 19.644531 12.246094 C 19.617188 13.144531 18.484375 14.460938 18.488281 14.296875 C 18.789062 14.710938 18.117188 14.855469 17.726562 15 C 17.917969 15.605469 17.042969 15.722656 16.09375 16.15625 C 16.09375 16.15625 16.136719 16.46875 16.136719 16.46875 C 14.992188 17.742188 14.953125 12.773438 10.519531 10.882812 C 5.125 12.0625 5.039062 15.117188 5.117188 15.890625 C 5.117188 15.890625 4.789062 15.867188 4.789062 15.867188 C 4.992188 12.054688 8.726562 11.460938 10.496094 10.714844 Z M 4.167969 5.710938 C 4.023438 5.628906 3.152344 3.339844 3.46875 3.242188 C 3.699219 3.097656 4.507812 3.355469 4.746094 3.074219 C 5.101562 2.902344 6.207031 3.324219 6.550781 3.234375 C 7.417969 2.886719 7.414062 3.046875 7.753906 3.511719 C 8.472656 3.421875 8.402344 3.679688 8.753906 3.65625 C 9.480469 4.183594 9.058594 4.175781 9.683594 4.386719 C 11.046875 5.417969 5.996094 7.246094 6.691406 9.242188 C 8.550781 13.179688 9.097656 12 11.628906 15.378906 C 11.628906 15.378906 11.367188 15.542969 11.367188 15.542969 C 10.34375 13.472656 8.15625 12.691406 6.5625 9.308594 C 4.347656 8.003906 0.636719 11.542969 0.015625 9.101562 C 0.0234375 8.191406 0.285156 8.3125 -0.015625 7.363281 C -0.0078125 7.199219 0.328125 7.402344 0.289062 6.621094 C 0.238281 6.378906 0.738281 6.652344 0.640625 5.804688 C 0.570312 5.703125 1.179688 5.648438 0.972656 5.253906 C 1.332031 5.214844 1.238281 4.402344 1.148438 4.414062 C 1.167969 4.523438 2 4.167969 1.988281 4.042969 C 3.113281 3.800781 4.144531 5.796875 4.167969 5.710938 Z M 0.222656 9.214844 C 0.207031 9.050781 0.109375 8.71875 0.109375 8.71875 M 4.269531 5.65625 '/%3E%3C/g%3E%3C/svg%3E%0A";
		if( !function_exists('get_plugin_data') ){
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}
		$plugin_data = get_plugin_data(CT4GG_FILE );
		$this->pages = array(
			array(
				'page_title' => $plugin_data['Name'], 
				'menu_title' => ucwords(CT4GG_NAME), 
				'capability' => 'manage_options', 
				'menu_slug' => CT4GG_NAME.'_plugin', 
				'callback' => array( $this->callbacks, 'adminDashboard' ), 
				'icon_url' => $icon_svg, 
				'position' => 110
			)
		);
	}
	public function setSettings()
	{
		$args = array(
			array(
				'option_group' => CT4GG_NAME.'_plugin_settings',
				'option_name' => CT4GG_NAME.'_plugin',
				'callback' => array( $this->callbacks_mngr, 'checkboxSanitize' )
			)
		);

		$this->settings->setSettings( $args );
	}

	public function setSections()
	{
		$args = array(
			array(
				'id' => CT4GG_NAME.'_admin_index',
				'title' => __('Settings Manager', 'ct4gg'),
				'callback' => array( $this->callbacks_mngr, 'adminIndexSectionManager' ),
				'page' => CT4GG_NAME.'_plugin'
			),
			array(
				'id' => CT4GG_NAME.'_admin_login',
				'title' => __('Login Manager screen', 'ct4gg'),
				'callback' => array( $this->callbacks_mngr, 'adminLoginSectionManager' ),
				'page' => CT4GG_NAME.'_plugin'
			),
			array(
				'id' => CT4GG_NAME.'_login',
				'title' => __('Login Custom', 'ct4gg'),
				'callback' => array( $this->callbacks_mngr, 'loginSettingSectionManager' ),
				'page' => CT4GG_NAME.'_plugin'
			),
			array(
				'id' => CT4GG_NAME.'_admin_setting',
				'title' => __('Administration - Settings Manager', 'ct4gg'),
				'callback' => array( $this->callbacks_mngr, 'adminSettingSectionManager' ),
				'page' => CT4GG_NAME.'_plugin'
			),
			array(
				'id' => CT4GG_NAME.'_post_setting',
				'title' => __('Post - Settings Manager', 'ct4gg'),
				'callback' => array( $this->callbacks_mngr, 'postSettingSectionManager' ),
				'page' => CT4GG_NAME.'_plugin'
			),
			array(
				'id' => CT4GG_NAME.'_socialbuttons',
				'title' => __('Social Buttons', 'ct4gg'),
				'callback' => array( $this->callbacks_mngr, 'socialbuttonsSettingSectionManager' ),
				'page' => CT4GG_NAME.'_plugin'
			),
			array(
				'id' => CT4GG_NAME.'_htaccess',
				'title' => __('Htaccess', 'ct4gg'),
				'callback' => array( $this->callbacks_mngr, 'htaccessSettingSectionManager' ),
				'page' => CT4GG_NAME.'_plugin'
			),
			array(
				'id' => CT4GG_NAME.'_robots',
				'title' => __('Robots', 'ct4gg'),
				'callback' => array( $this->callbacks_mngr, 'robotsSettingSectionManager' ),
				'page' => CT4GG_NAME.'_plugin'
			),
			array(
				'id' => CT4GG_NAME.'_humans',
				'title' => __('Humans', 'ct4gg'),
				'callback' => array( $this->callbacks_mngr, 'humansSettingSectionManager' ),
				'page' => CT4GG_NAME.'_plugin'
			)
		);

		$this->settings->setSections( $args );
	}

	public function setFields()
	{
		$args = array();
		$defaults = $this->get_customizer_configuration_defaults();
		$all_defaults = $this->loadPHPConfig(CT4GG_PATH . 'assets/defaults.php');
		$all_options = $this->loadPHPConfig(CT4GG_PATH . 'assets/options.php');
		foreach ( $this->managers as $key => $value ) {
			$value = ($value == '') ? $all_options[$key] : $value;
			if (!in_array($key,array('version','t'))) {
				$config = wp_parse_args( $all_defaults[$key], $defaults );
				switch ( $config['type'] ) {
					case 'checkboxField':
						$args[] = array(
							'id' => $key,
							'title' => $config['title'],
							'callback' => array( $this->callbacks_mngr, 'checkboxField' ),
							'page' => CT4GG_NAME.'_plugin',
							'section' => $config['section'],
							'args' => array(
								'option_name' => CT4GG_NAME.'_plugin',
								'label_for' => $key,
								'value'	=> $value,
								'message'	=> $config['message'],
								'class' => 'ct4gg-ui-toggle'
							)
						);
						break;
					case 'listField':
						$args[] = array(
							'id' => $key,
							'title' => $config['title'],
							'callback' => array( $this->callbacks_mngr, 'listField' ),
							'page' => CT4GG_NAME.'_plugin',
							'section' => $config['section'],
							'args' => array(
								'option_name' => CT4GG_NAME.'_plugin',
								'label_for' => $key,
								'value'	=> $value,
								'message'	=> $config['message'],
								'class' => 'ct4gg-ui-toggle',
								'choices' => $config['choices']
							)
						);
						break;
					case 'ImageField':
						$args[] = array(
							'id' => $key,
							'title' => $config['title'],
							'callback' => array( $this->callbacks_mngr, 'ImageField' ),
							'page' => CT4GG_NAME.'_plugin',
							'section' => $config['section'],
							'args' => array(
								'option_name' => CT4GG_NAME.'_plugin',
								'label_for' => $key,
								'value'	=> $value,
								'message'	=> $config['message'],
								'class' => 'ct4gg-ui-toggle',
								'height'	=> $config['height'],
								'width'		=> $config['width']
							)
						);
						break;
					case 'ColorField':
						$args[] = array(
							'id' => $key,
							'title' => $config['title'],
							'callback' => array( $this->callbacks_mngr, 'ColorField' ),
							'page' => CT4GG_NAME.'_plugin',
							'section' => $config['section'],
							'args' => array(
								'option_name' => CT4GG_NAME.'_plugin',
								'label_for' => $key,
								'value'	=> $value,
								'message'	=> $config['message'],
								'class' => 'ct4gg-ui-toggle'
							)
						);
						break;
					case 'TextField':
						$args[] = array(
							'id' => $key,
							'title' => $config['title'],
							'callback' => array( $this->callbacks_mngr, 'TextField' ),
							'page' => CT4GG_NAME.'_plugin',
							'section' => $config['section'],
							'args' => array(
								'option_name' => CT4GG_NAME.'_plugin',
								'label_for' => $key,
								'value'	=> $value,
								'message'	=> $config['message'],
								'class' => 'ct4gg-ui-toggle'
							)
						);
						break;
					case 'TextFieldUrl':
						$args[] = array(
							'id' => $key,
							'title' => $config['title'],
							'callback' => array( $this->callbacks_mngr,'TextFieldUrl' ),
							'page' => CT4GG_NAME.'_plugin',
							'section' => $config['section'],
							'args' => array(
								'option_name' => CT4GG_NAME.'_plugin',
								'label_for' => $key,
								'value'	=> $value,
								'message'	=> $config['message'],
								'class' => 'ct4gg-ui-toggle'
							)
						);
						break;
					case 'TextAreaField':
						$args[] = array(
							'id' => $key,
							'title' => $config['title'],
							'callback' => array( $this->callbacks_mngr, 'TextAreaField' ),
							'page' => CT4GG_NAME.'_plugin',
							'section' => $config['section'],
							'args' => array(
								'option_name' => CT4GG_NAME.'_plugin',
								'label_for' => $key,
								'value'	=> $value,
								'message'	=> $config['message'],
								'cols'	=> $config['cols'],
								'rows'	=> $config['rows'],
								'class' => 'ct4gg-ui-toggle'
							)
						);
						break;
				}
			}
		}

		$this->settings->setFields( $args );
	}

	private function get_customizer_configuration_defaults() {
		return apply_filters(
			'ct4gg_customizer_configuration_defaults',
			array(
				'type'		=> null,
				'title'		=> null,
				'message'	=> '',
				'section' 	=> CT4GG_NAME.'_admin_index',
				'height'	=> null,
				'width'		=> null,
				'cols'		=> 50,
				'rows'		=> 5
			)
		);
	}

	private function loadPHPConfig($path)
        {
            if ( ! file_exists($path)) {
                return array();
            }
            $content = require $path;
            return $content;
        }
}