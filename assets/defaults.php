<?php
/**
 * Default options
 *
 * PHP version 7
 *
 * @category  PHP
 * @package   CT4GGPlugin
 * @author    Franck VANHOUCKE <ct4gg@ginkgos.net>
 * @copyright 2021-2023 Copyright 2023, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later
 * @version   1.6.0 GIT:https://github.com/thanatos-vf-2000/ct4gg
 * @link      https://ginkgos.net
 */
if ( ! defined( 'ABSPATH' ) ) exit;

return array(
	'admin_del_logo_wp'                      => array(
		'title'   => ct4gg_t( 'Delete Wordpress Logo on top admin menu.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_admin_setting',
		'type'    => 'checkboxField',
	),
	'classic_widgets'                        => array(
		'title'   => ct4gg_t( '"Classic" WordPress widgets settings screens', 'ct4gg' ),
		'message' => ct4gg_t( 'For Wordpress 5.8.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_admin_setting',
		'type'    => 'checkboxField',
	),
	'admin_email_check_interval'             => array(
		'title'   => ct4gg_t( 'Semi-annual check of the administration e-mail', 'ct4gg' ),
		'message' => ct4gg_t( 'For Wordpress 5.3 and higher.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_admin_setting',
		'type'    => 'checkboxField',
	),
	'admin_email_check_interval_val'         => array(
		'title'   => ct4gg_t( 'Interval before displaying the administration email verification screen', 'ct4gg' ),
		'section' => CT4GG_NAME . '_admin_setting',
		'message' => ct4gg_t( 'For Wordpress 5.3 and higher.', 'ct4gg' ),
		'type'    => 'listField',
		'choices' => array(
			'1'  => 1,
			'2'  => 2,
			'3'  => 3,
			'4'  => 4,
			'5'  => 5,
			'6'  => 6,
			'7'  => 7,
			'8'  => 8,
			'9'  => 9,
			'10' => 10,
			'11' => 11,
			'12' => 12,
		),
	),
	'admin_email_check_interval_type'        => array(
		'title'   => ct4gg_t( 'Interval Type before displaying the administration email verification screen', 'ct4gg' ),
		'message' => ct4gg_t( 'For Wordpress 5.3 and higher.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_admin_setting',
		'type'    => 'listField',
		'choices' => array(
			'DAY_IN_SECONDS'   => ct4gg_t( 'Day', 'ct4gg' ),
			'WEEK_IN_SECONDS'  => ct4gg_t( 'Week', 'ct4gg' ),
			'MONTH_IN_SECONDS' => ct4gg_t( 'Month', 'ct4gg' ),
			'YEAR_IN_SECONDS'  => ct4gg_t( 'Year', 'ct4gg' ),
		),
	),
	'disable_jetpack_Automattic'             => array(
		'title'   => ct4gg_t( 'Disable Jetpack for Automattic', 'ct4gg' ),
		'message' => ct4gg_t( 'Disable Jetpack offered by Automattic to stop showing banners.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_admin_setting',
		'type'    => 'checkboxField',
	),
	'login_screen_v2'                        => array(
		'title'   => ct4gg_t( 'Use the new management version of the login screen.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_admin_login',
		'type'    => 'checkboxField',
	),
	'login_screen_logo_enable'               => array(
		'title'   => ct4gg_t( 'Enable change logo on login screen (logo size 84px*84px).', 'ct4gg' ),
		'section' => CT4GG_NAME . '_admin_login',
		'type'    => 'checkboxField',
	),
	'login_screen_logo'                      => array(
		'title'   => ct4gg_t( 'login screen logo', 'ct4gg' ),
		'message' => ct4gg_t( 'Change the login screen logo.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_admin_login',
		'height'  => '84px',
		'width'   => '84px',
		'type'    => 'imageField',
	),
	'login_screen_background_enable'         => array(
		'title'   => ct4gg_t( 'Enable change background login screen.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_admin_login',
		'type'    => 'checkboxField',
	),
	'login_screen_background_img'            => array(
		'title'   => ct4gg_t( 'login background', 'ct4gg' ),
		'message' => ct4gg_t( 'Change the login screen background.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_admin_login',
		'height'  => '84px',
		'width'   => '84px',
		'type'    => 'imageField',
	),
	'login_screen_background_color'          => array(
		'title'   => ct4gg_t( 'Login Screen background color:', 'ct4gg' ),
		'section' => CT4GG_NAME . '_admin_login',
		'type'    => 'colorField',
	),
	'login_screen_link_color'                => array(
		'title'   => ct4gg_t( 'Login Screen Link color:', 'ct4gg' ),
		'section' => CT4GG_NAME . '_admin_login',
		'type'    => 'colorField',
	),
	'login_screen_text_color'                => array(
		'title'   => ct4gg_t( 'Login Screen Text color:', 'ct4gg' ),
		'section' => CT4GG_NAME . '_admin_login',
		'type'    => 'colorField',
	),
	'login_screen_btn_color'                 => array(
		'title'   => ct4gg_t( 'Login Screen Bottum color:', 'ct4gg' ),
		'section' => CT4GG_NAME . '_admin_login',
		'type'    => 'colorField',
	),
	'login_screen_form_bg_color'             => array(
		'title'   => ct4gg_t( 'Login Screen Form  background color:', 'ct4gg' ),
		'section' => CT4GG_NAME . '_admin_login',
		'type'    => 'colorField',
	),
	'login_redirect_after_logout'            => array(
		'title'   => ct4gg_t( 'Redirect to home after logout.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_admin_login',
		'type'    => 'checkboxField',
	),
	'login_hide_login_errors'                => array(
		'title'   => ct4gg_t( 'Hide login errors.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_admin_login',
		'type'    => 'checkboxField',
	),
	'login_no_admin_to_home'                 => array(
		'title'   => ct4gg_t( 'Back to home if not Administrator.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_admin_login',
		'type'    => 'checkboxField',
	),
	'post_search_1_redirect_to_post'         => array(
		'title'   => ct4gg_t( 'If the result of a search returns only one item then it is displayed.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_post_setting',
		'type'    => 'checkboxField',
	),
	'post_minimal_comment_length'            => array(
		'title'   => ct4gg_t( 'Minimal comment length.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_post_setting',
		'type'    => 'textField',
	),
	'post_hide_meta_generator'               => array(
		'title'   => ct4gg_t( 'Hide meta generator (Wordpress version).', 'ct4gg' ),
		'section' => CT4GG_NAME . '_post_setting',
		'type'    => 'checkboxField',
	),
	'post_old_post_notice'                   => array(
		'title'   => ct4gg_t( 'Old post notice.', 'ct4gg' ),
		'message' => ct4gg_t( 'After xxx Days (default 60 days).', 'ct4gg' ),
		'section' => CT4GG_NAME . '_post_setting',
		'type'    => 'textField',
	),
	'htaccess_disable_show_directory'        => array(
		'title'   => ct4gg_t( 'Disable display of directory contents.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_htaccess',
		'type'    => 'checkboxField',
	),
	'htaccess_hide_server_information'       => array(
		'title'   => ct4gg_t( 'Hide server information.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_htaccess',
		'type'    => 'checkboxField',
	),
	'htaccess_protect_files_ht'              => array(
		'title'   => ct4gg_t( 'Protect .htaccess and .htpasswds files.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_htaccess',
		'type'    => 'checkboxField',
	),
	'htaccess_force_download_enable'         => array(
		'title'   => ct4gg_t( 'Enable Force download', 'ct4gg' ),
		'section' => CT4GG_NAME . '_htaccess',
		'type'    => 'checkboxField',
	),
	'htaccess_force_download'                => array(
		'title'   => ct4gg_t( 'Force download for these file types.', 'ct4gg' ),
		'message' => ct4gg_t( 'Exemple: .doc .docx .xls .xlsx .csv .mp3 .mp4', 'ct4gg' ),
		'section' => CT4GG_NAME . '_htaccess',
		'type'    => 'textField',
	),
	'htaccess_enable_cache'                  => array(
		'title'   => ct4gg_t( 'Enable cache expires.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_htaccess',
		'type'    => 'checkboxField',
	),
	'htaccess_enable_compress_statics_files' => array(
		'title'   => ct4gg_t( 'Compressing static files.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_htaccess',
		'type'    => 'checkboxField',
	),
	'robots_sitemap'                         => array(
		'title'   => ct4gg_t( 'Add site Maps Yoast SEO (/sitemap_index.xml).', 'ct4gg' ),
		'section' => CT4GG_NAME . '_robots',
		'type'    => 'checkboxField',
	),
	'robots_wordpress'                       => array(
		'title'   => ct4gg_t( 'Wordpress default options.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_robots',
		'type'    => 'checkboxField',
	),
	'robots_crawl_chatgpt'                   => array(
		'title'   => ct4gg_t( 'Disable crawl for ChatGPT.', 'ct4gg' ),
		'message' => 'https://platform.openai.com/docs/gptbot',
		'section' => CT4GG_NAME . '_robots',
		'type'    => 'checkboxField',
	),
	'robots_crawl_chatgpt_user'              => array(
		'title'   => ct4gg_t( 'Disable crawl for ChatGPT plugin.', 'ct4gg' ),
		'message' => 'https://platform.openai.com/docs/plugins/bot',
		'section' => CT4GG_NAME . '_robots',
		'type'    => 'checkboxField',
	),
	'llms_title'                             => array(
		'title'   => ct4gg_t( 'Title.', 'ct4gg' ),
		'message' => ct4gg_t( 'H1 title of the llms.txt file. Defaults to the site name if left empty.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_llms',
		'type'    => 'textField',
	),
	'llms_summary'                           => array(
		'title'   => ct4gg_t( 'Summary.', 'ct4gg' ),
		'message' => ct4gg_t( 'Short blockquote summary. Defaults to the site tagline if left empty.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_llms',
		'type'    => 'textField',
	),
	'llms_details'                           => array(
		'title'   => ct4gg_t( 'Details.', 'ct4gg' ),
		'message' => ct4gg_t( 'Optional free paragraph(s) describing the site, in Markdown.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_llms',
		'rows'    => 5,
		'cols'    => 100,
		'type'    => 'textAreaField',
	),
	'llms_sitemap'                           => array(
		'title'   => ct4gg_t( 'Add a link to the XML sitemap.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_llms',
		'type'    => 'checkboxField',
	),
	'llms_pages'                             => array(
		'title'   => ct4gg_t( 'List published Pages.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_llms',
		'type'    => 'checkboxField',
	),
	'llms_posts'                             => array(
		'title'   => ct4gg_t( 'List latest published Posts.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_llms',
		'type'    => 'checkboxField',
	),
	'llms_posts_number'                      => array(
		'title'   => ct4gg_t( 'Number of Posts to list.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_llms',
		'type'    => 'textField',
	),
	'llms_optional'                          => array(
		'title'   => ct4gg_t( 'Optional section.', 'ct4gg' ),
		'message' => ct4gg_t( 'Free Markdown content (e.g. secondary links) added under an "## Optional" heading.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_llms',
		'rows'    => 5,
		'cols'    => 100,
		'type'    => 'textAreaField',
	),
	'humans_team'                            => array(
		'title'   => ct4gg_t( 'Team.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_humans',
		'rows'    => 3,
		'cols'    => 100,
		'type'    => 'textAreaField',
	),
	'humans_thanks'                          => array(
		'title'   => ct4gg_t( 'Thanks.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_humans',
		'rows'    => 4,
		'cols'    => 100,
		'type'    => 'textAreaField',
	),
	'humans_site'                            => array(
		'title'   => ct4gg_t( 'Site.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_humans',
		'rows'    => 7,
		'cols'    => 100,
		'type'    => 'textAreaField',
	),
	'login_slugs_login'                      => array(
		'title'   => ct4gg_t( 'login', 'ct4gg' ),
		'section' => CT4GG_NAME . '_login',
		'type'    => 'textFieldUrl',
	),
	'login_slugs_logout'                     => array(
		'title'   => ct4gg_t( 'Logout', 'ct4gg' ),
		'section' => CT4GG_NAME . '_login',
		'type'    => 'textFieldUrl',
	),
	'login_slugs_register'                   => array(
		'title'   => ct4gg_t( 'Register', 'ct4gg' ),
		'section' => CT4GG_NAME . '_login',
		'type'    => 'textFieldUrl',
	),
	'login_slugs_lostpassword'               => array(
		'title'   => ct4gg_t( 'Lost password', 'ct4gg' ),
		'section' => CT4GG_NAME . '_login',
		'type'    => 'textFieldUrl',
	),
	'login_slugs_resetpass'                  => array(
		'title'   => ct4gg_t( 'Reset password', 'ct4gg' ),
		'section' => CT4GG_NAME . '_login',
		'type'    => 'textFieldUrl',
	),
	'login_slugs_postpass'                   => array(
		'title'   => ct4gg_t( 'Post Password', 'ct4gg' ),
		'section' => CT4GG_NAME . '_login',
		'type'    => 'textFieldUrl',
	),
	'socialbuttons_activated'                => array(
		'title'   => ct4gg_t( 'Activate Social Buttons.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_socialbuttons',
		'type'    => 'checkboxField',
	),
	'socialbuttons_txt'                      => array(
		'title'   => ct4gg_t( 'Show Texte.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_socialbuttons',
		'type'    => 'checkboxField',
	),
	'socialbuttons_twitter'                  => array(
		'title'   => ct4gg_t( 'Activate twitter.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_socialbuttons',
		'type'    => 'checkboxField',
	),
	'socialbuttons_facebook'                 => array(
		'title'   => ct4gg_t( 'Activate facebook.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_socialbuttons',
		'type'    => 'checkboxField',
	),
	'socialbuttons_whatsapp'                 => array(
		'title'   => ct4gg_t( 'Activate whatsapp.', 'ct4gg' ),
		'message' => ct4gg_t( 'Display only on max size 640px.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_socialbuttons',
		'type'    => 'checkboxField',
	),
	'socialbuttons_pinterest'                => array(
		'title'   => ct4gg_t( 'Activate pinterest.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_socialbuttons',
		'type'    => 'checkboxField',
	),
	'socialbuttons_linkedin'                 => array(
		'title'   => ct4gg_t( 'Activate linkedin.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_socialbuttons',
		'type'    => 'checkboxField',
	),
	'socialbuttons_buffer'                   => array(
		'title'   => ct4gg_t( 'Activate buffer.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_socialbuttons',
		'type'    => 'checkboxField',
	),
	'socialbuttons_email'                    => array(
		'title'   => ct4gg_t( 'Activate email.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_socialbuttons',
		'type'    => 'checkboxField',
	),
	'security_contact'                       => array(
		'title'   => ct4gg_t( 'Contact.', 'ct4gg' ),
		'message' => ct4gg_t( 'A link or e-mail address for people to contact you about security issues. Remember to include "https://" for URLs, and "mailto:" for e-mails.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_security',
		'type'    => 'textField',
	),
	'security_expires_date'                  => array(
		'title'   => ct4gg_t( 'Expire date.', 'ct4gg' ),
		'message' => ct4gg_t( 'The date and time when the content of the security.txt file should be considered stale (so security researchers should then not trust it). Make sure you update this value periodically and keep your file under review.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_security',
		'type'    => 'dateField',
	),
	'security_expires_time'                  => array(
		'title'   => ct4gg_t( 'Expire time.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_security',
		'type'    => 'timeField',
	),
	'security_encryption'                    => array(
		'title'   => ct4gg_t( 'Encryption.', 'ct4gg' ),
		'message' => ct4gg_t( 'A link to a key which security researchers should use to securely talk to you. Remember to include "https://".', 'ct4gg' ),
		'section' => CT4GG_NAME . '_security',
		'type'    => 'textField',
	),
	'security_acknowledgments'               => array(
		'title'   => ct4gg_t( 'Acknowledgments.', 'ct4gg' ),
		'message' => ct4gg_t( 'A link to a web page where you say thank you to security researchers who have helped you. Remember to include "https://.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_security',
		'type'    => 'textField',
	),
	'security_preferred_languages'           => array(
		'title'   => ct4gg_t( 'Preferred-Languages.', 'ct4gg' ),
		'message' => ct4gg_t( 'A comma-separated list of language codes that your security team speaks. You may include more than one language.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_security',
		'type'    => 'textField',
	),
	'security_canonical'                     => array(
		'title'   => ct4gg_t( 'Canonical.', 'ct4gg' ),
		'message' => ct4gg_t( 'The URLs for accessing your security.txt file. It is important to include this if you are digitally signing the security.txt file, so that the location of the security.txt file can be digitally signed too.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_security',
		'type'    => 'textField',
	),
	'security_policy'                        => array(
		'title'   => ct4gg_t( 'Policy.', 'ct4gg' ),
		'message' => ct4gg_t( 'A link to a policy detailing what security researchers should do when searching for or reporting security issues. Remember to include "https://".', 'ct4gg' ),
		'section' => CT4GG_NAME . '_security',
		'type'    => 'textField',
	),
	'security_hiring'                        => array(
		'title'   => ct4gg_t( 'Hiring.', 'ct4gg' ),
		'message' => ct4gg_t( 'A link to any security-related job openings in your organisation. Remember to include "https://".', 'ct4gg' ),
		'section' => CT4GG_NAME . '_security',
		'type'    => 'textField',
	),
	'header_sec'                             => array(
		'title'   => ct4gg_t( 'Security headers that should be enabled.', 'ct4gg' ),
		'message' => ct4gg_t( 'Check header site: X-XSS-Protection, X-Frame-Options, X-Content-Type-Options, ...', 'ct4gg' ),
		'section' => CT4GG_NAME . '_header_check',
		'type'    => 'checkboxField',
	),
	'header_info'                            => array(
		'title'   => ct4gg_t( 'header Information.', 'ct4gg' ),
		'message' => ct4gg_t( 'Check information header site: X-Powered-By, Server, X-AspNet-Version and X-AspNetMvc-Version', 'ct4gg' ),
		'section' => CT4GG_NAME . '_header_check',
		'type'    => 'checkboxField',
	),
	'header_cache'                           => array(
		'title'   => ct4gg_t( 'header Cache.', 'ct4gg' ),
		'message' => ct4gg_t( 'Check cache header site: Cache-Control, Pragma, Last-Modified, Expires, ETag.', 'ct4gg' ),
		'section' => CT4GG_NAME . '_header_check',
		'type'    => 'checkboxField',
	),
);
