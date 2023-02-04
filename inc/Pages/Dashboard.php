<?php
/**
 * @package  CT4GGPlugin
 * @Version 1.4.5
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
		$icon_svg = CT4GG_URL . 'assets/img/logo-end.png';
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
			),
			array(
				'id' => CT4GG_NAME.'_security',
				'title' => __('Security', 'ct4gg'),
				'callback' => array( $this->callbacks_mngr, 'securitySettingSectionManager' ),
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
					case 'DateField':
						$args[] = array(
							'id' => $key,
							'title' => $config['title'],
							'callback' => array( $this->callbacks_mngr, 'DateField' ),
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
					case 'TimeField':
						$args[] = array(
							'id' => $key,
							'title' => $config['title'],
							'callback' => array( $this->callbacks_mngr, 'TimeField' ),
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