<?php
/**
 * Options
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
 * @since     1.0.0
 */

return array(
	'admin_del_logo_wp'                      => false,
	'classic_widgets'                        => false,
	'admin_email_check_interval'             => true,
	'admin_email_check_interval_val'         => '6',
	'admin_email_check_interval_type'        => 'MONTH_IN_SECONDS',
	'disable_jetpack_Automattic'             => true,
	'login_screen_v2'                        => false,
	'login_screen_logo_enable'               => false,
	'login_screen_logo'                      => '/wp-admin/images/wordpress-logo.svg?ver=20131107',
	'login_screen_background_enable'         => false,
	'login_screen_background_img'            => CT4GG_URL . '/assets/img/page-bg-1.jpg',
	'login_screen_background_color'          => '#ce9e27',
	'login_screen_link_color'                => '#ce9e27',
	'login_screen_text_color'                => '#ce9e27',
	'login_screen_btn_color'                 => '#ce9e27',
	'login_screen_form_bg_color'             => '#5c5c5c',
	'login_redirect_after_logout'            => false,
	'login_hide_login_errors'                => false,
	'login_no_admin_to_home'                 => false,
	'post_search_1_redirect_to_post'         => false,
	'post_minimal_comment_length'            => 20,
	'post_hide_meta_generator'               => false,
	'post_old_post_notice'                   => 60,
	'htaccess_disable_show_directory'        => false,
	'htaccess_hide_server_information'       => false,
	'htaccess_protect_files_ht'              => false,
	'htaccess_force_download_enable'         => false,
	'htaccess_force_download'                => '',
	'htaccess_enable_cache'                  => false,
	'htaccess_enable_compress_statics_files' => false,
	'robots_sitemap'                         => false,
	'robots_wordpress'                       => false,
	'robots_crawl_chatgpt'                   => false,
	'robots_crawl_chatgpt_user'              => false,
	'humans_team'                            => 'Founder: Dupont DUPOND
Contact: dupont.dupond [at] exemple.com
From: Paris, France
',
	'humans_thanks'                          => 'Host: 
Twitter: 
Contact: 
From: ',
	'humans_site'                            => 'Last update: 2021/11/14
Language: French
Doctype: HTML5
IDE: Coda 2
Standards: HTML5, CSS3
Components: jQuery, PHP
Software: WordPress',
	'login_slugs_login'                      => 'login',
	'login_slugs_logout'                     => 'logout',
	'login_slugs_register'                   => 'register',
	'login_slugs_lostpassword'               => 'lostpassword',
	'login_slugs_resetpass'                  => 'resetpass',
	'login_slugs_postpass'                   => 'postpass',
	'socialbuttons_activated'                => false,
	'socialbuttons_txt'                      => false,
	'socialbuttons_twitter'                  => true,
	'socialbuttons_facebook'                 => true,
	'socialbuttons_whatsapp'                 => true,
	'socialbuttons_pinterest'                => true,
	'socialbuttons_linkedin'                 => true,
	'socialbuttons_buffer'                   => true,
	'socialbuttons_email'                    => true,
	'security_contact'                       => 'dupont.dupond [at] exemple.com',
	'security_expires_date'                  => '2024-02-01',
	'security_expires_time'                  => '12:00',
	'security_encryption'                    => 'None',
	'security_acknowledgments'               => 'https://example.com/hall-of-fame.html',
	'security_preferred_languages'           => 'fr, en',
	'security_canonical'                     => 'https://example.com/security.txt',
	'security_policy'                        => 'None',
	'security_hiring'                        => 'None',
	'header_sec'                             => true,
	'header_info'                            => true,
	'header_cache'                           => true,
);
