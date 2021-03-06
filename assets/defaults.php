<?php
/**
 * @package  CT4GGPlugin
 * @Version 1.4.0
 */
return array(
    'admin_del_logo_wp' => array(
        'title'     => __('Delete Wordpress Logo on top admin menu.','ct4gg'),
        'section' => CT4GG_NAME.'_admin_setting',
        'type'      => 'checkboxField') ,
    'classic_widgets' => array(
        'title'     => __('"Classic" WordPress widgets settings screens','ct4gg'),
        'message'   => __('For Wordpress 5.8.', 'ct4gg'),
        'section'   => CT4GG_NAME.'_admin_setting',
        'type'      => 'checkboxField') ,
    'admin_email_check_interval' => array(
        'title'     => __('Semi-annual check of the administration e-mail','ct4gg'),
        'message'   => __('For Wordpress 5.3 and higher.', 'ct4gg'),
        'section' => CT4GG_NAME.'_admin_setting',
        'type'      => 'checkboxField') ,
    'admin_email_check_interval_val' => array(
        'title'     => __('Interval before displaying the administration email verification screen','ct4gg'),
        'section'   => CT4GG_NAME.'_admin_setting',
        'message'   => __('For Wordpress 5.3 and higher.', 'ct4gg'),
        'type'      => 'listField' ,
        'choices'   => array( 
            '1'     => 1,
            '2'     => 2,
            '3'     => 3,
            '4'     => 4,
            '5'     => 5,
            '6'     => 6,
            '7'     => 7,
            '8'     => 8,
            '9'     => 9,
            '10'    => 10,
            '11'    => 11,
            '12'    => 12
            )
        ),
        'admin_email_check_interval_type' => array(
            'title'     => __('Interval Type before displaying the administration email verification screen','ct4gg'),
            'message'   => __('For Wordpress 5.3 and higher.', 'ct4gg'),
            'section'   => CT4GG_NAME.'_admin_setting',
            'type'      => 'listField' ,
            'choices'   => array( 
                'DAY_IN_SECONDS'     => __('Day','ct4gg'),
                'WEEK_IN_SECONDS'     => __('Week','ct4gg'),
                'MONTH_IN_SECONDS'     => __('Month','ct4gg'),
                'YEAR_IN_SECONDS'     => __('Year','ct4gg')
                )
            ),
        'disable_jetpack_Automattic' => array(
            'title'     => __('Disable Jetpack for Automattic','ct4gg'),
            'message'   => __('Disable Jetpack offered by Automattic to stop showing banners.', 'ct4gg'),
            'section'   => CT4GG_NAME.'_admin_setting',
            'type'      => 'checkboxField') ,
        'login_screen_v2' => array(
            'title'     => __('Use the new management version of the login screen.','ct4gg'),
            'section'   => CT4GG_NAME.'_admin_login',
            'type'      => 'checkboxField') ,
        'login_screen_logo_enable' => array(
            'title'     => __('Enable change logo on login screen (logo size 84px*84px).','ct4gg'),
            'section'   => CT4GG_NAME.'_admin_login',
            'type'      => 'checkboxField') ,
        'login_screen_logo' => array(
            'title'     => __('login screen logo','ct4gg'),
            'message'   => __('Change the login screen logo.', 'ct4gg'),
            'section'   => CT4GG_NAME.'_admin_login',
            'height'    => '84px',
            'width'     => '84px',
            'type'      => 'ImageField') ,
        'login_screen_background_enable' => array(
            'title'     => __('Enable change background login screen.','ct4gg'),
            'section'   => CT4GG_NAME.'_admin_login',
            'type'      => 'checkboxField') ,
        'login_screen_background_img' => array(
            'title'     => __('login background','ct4gg'),
            'message'   => __('Change the login screen background.', 'ct4gg'),
            'section'   => CT4GG_NAME.'_admin_login',
            'height'    => '84px',
            'width'     => '84px',
            'type'      => 'ImageField') ,
        'login_screen_background_color' => array(
            'title'     => __('Login Screen background color:','ct4gg'),
            'section'   => CT4GG_NAME.'_admin_login',
            'type'      => 'ColorField') ,
        'login_screen_link_color' => array(
            'title'     => __('Login Screen Link color:','ct4gg'),
            'section'   => CT4GG_NAME.'_admin_login',
            'type'      => 'ColorField') ,
        'login_screen_text_color' => array(
            'title'     => __('Login Screen Text color:','ct4gg'),
            'section'   => CT4GG_NAME.'_admin_login',
            'type'      => 'ColorField') ,
        'login_screen_btn_color' => array(
            'title'     => __('Login Screen Bottum color:','ct4gg'),
            'section'   => CT4GG_NAME.'_admin_login',
            'type'      => 'ColorField') ,
        'login_screen_form_bg_color' => array(
            'title'     => __('Login Screen Form  background color:','ct4gg'),
            'section'   => CT4GG_NAME.'_admin_login',
            'type'      => 'ColorField') ,
        'login_redirect_after_logout' => array(
            'title'     => __('Redirect to home after logout.','ct4gg'),
            'section'   => CT4GG_NAME.'_admin_login',
            'type'      => 'checkboxField') ,
        'login_hide_login_errors' => array(
            'title'     => __('Hide login errors.','ct4gg'),
            'section'   => CT4GG_NAME.'_admin_login',
            'type'      => 'checkboxField') ,
        'login_no_admin_to_home' => array(
            'title'     => __('Back to home if not Administrator.','ct4gg'),
            'section'   => CT4GG_NAME.'_admin_login',
            'type'      => 'checkboxField') ,
        'post_search_1_redirect_to_post' => array(
            'title'     => __('If the result of a search returns only one item then it is displayed.','ct4gg'),
            'section'   => CT4GG_NAME.'_post_setting',
            'type'      => 'checkboxField') ,
        'post_minimal_comment_length' => array(
            'title'     => __('Minimal comment length.','ct4gg'),
            'section'   => CT4GG_NAME.'_post_setting',
            'type'      => 'TextField') ,
        'post_hide_meta_generator' => array(
            'title'     => __('Hide meta generator (Wordpress version).','ct4gg'),
            'section'   => CT4GG_NAME.'_post_setting',
            'type'      => 'checkboxField') ,
        'post_old_post_notice' => array(
            'title'     => __('Old post notice.','ct4gg'),
            'message'   => __('After xxx Days (default 60 days).', 'ct4gg'),
            'section'   => CT4GG_NAME.'_post_setting',
            'type'      => 'TextField') ,
        'htaccess_disable_show_directory' => array(
            'title'     => __('Disable display of directory contents.','ct4gg'),
            'section'   => CT4GG_NAME.'_htaccess',
            'type'      => 'checkboxField') ,
        'htaccess_hide_server_information' => array(
            'title'     => __('Hide server information.','ct4gg'),
            'section'   => CT4GG_NAME.'_htaccess',
            'type'      => 'checkboxField') ,
        'htaccess_protect_files_ht' => array(
            'title'     => __('Protect .htaccess and .htpasswds files.','ct4gg'),
            'section'   => CT4GG_NAME.'_htaccess',
            'type'      => 'checkboxField') ,
        'htaccess_force_download_enable' => array(
            'title'     => __('Enable Force download','ct4gg'),
            'section'   => CT4GG_NAME.'_htaccess',
            'type'      => 'checkboxField'),
        'htaccess_force_download' => array(
            'title'     => __('Force download for these file types.','ct4gg'),
            'message'   => __('Exemple: .doc .docx .xls .xlsx .csv .mp3 .mp4', 'ct4gg'),
            'section'   => CT4GG_NAME.'_htaccess',
            'type'      => 'TextField') ,
        'htaccess_enable_cache' => array(
            'title'     => __('Enable cache expires.','ct4gg'),
            'section'   => CT4GG_NAME.'_htaccess',
            'type'      => 'checkboxField') ,
        'htaccess_enable_compress_statics_files' => array(
            'title'     => __('Compressing static files.','ct4gg'),
            'section'   => CT4GG_NAME.'_htaccess',
            'type'      => 'checkboxField') ,
        'robots_sitemap' => array(
            'title'     => __('Add site Maps Yoast SEO (/sitemap_index.xml).','ct4gg'),
            'section'   => CT4GG_NAME.'_robots',
            'type'      => 'checkboxField') ,
        'robots_wordpress' => array(
            'title'     => __('Wordpress default options.','ct4gg'),
            'section'   => CT4GG_NAME.'_robots',
            'type'      => 'checkboxField') ,
        'humans_team' => array(
            'title'     => __('Team.','ct4gg'),
            'section'   => CT4GG_NAME.'_humans',
            'rows'      => 3,
            'cols'      => 100,
            'type'      => 'TextAreaField') ,
        'humans_thanks' => array(
            'title'     => __('Thanks.','ct4gg'),
            'section'   => CT4GG_NAME.'_humans',
            'rows'      => 4,
            'cols'      => 100,
            'type'      => 'TextAreaField') ,
        'humans_site' => array(
            'title'     => __('Site.','ct4gg'),
            'section'   => CT4GG_NAME.'_humans',
            'rows'      => 7,
            'cols'      => 100,
            'type'      => 'TextAreaField') ,
        'login_slugs_login' => array(
            'title'     => __('login','ct4gg'),
            'section'   => CT4GG_NAME.'_login',
            'type'      => 'TextFieldUrl') ,
        'login_slugs_logout' => array(
            'title'     => __('Logout','ct4gg'),
            'section'   => CT4GG_NAME.'_login',
            'type'      => 'TextFieldUrl') ,
        'login_slugs_register' => array(
            'title'     => __('Register','ct4gg'),
            'section'   => CT4GG_NAME.'_login',
            'type'      => 'TextFieldUrl') ,
        'login_slugs_lostpassword' => array(
            'title'     => __('Lost password','ct4gg'),
            'section'   => CT4GG_NAME.'_login',
            'type'      => 'TextFieldUrl') ,
        'login_slugs_resetpass' => array(
            'title'     => __('Reset password','ct4gg'),
            'section'   => CT4GG_NAME.'_login',
            'type'      => 'TextFieldUrl') ,
        'login_slugs_postpass' => array(
            'title'     => __('Post Password','ct4gg'),
            'section'   => CT4GG_NAME.'_login',
            'type'      => 'TextFieldUrl') ,
        'socialbuttons_activated' => array(
            'title'     => __('Activate Social Buttons.','ct4gg'),
            'section'   => CT4GG_NAME.'_socialbuttons',
            'type'      => 'checkboxField') ,
        'socialbuttons_txt' => array(
            'title'     => __('Show Texte.','ct4gg'),
            'section'   => CT4GG_NAME.'_socialbuttons',
            'type'      => 'checkboxField') ,
        'socialbuttons_twitter' => array(
            'title'     => __('Activate twitter.','ct4gg'),
            'section'   => CT4GG_NAME.'_socialbuttons',
            'type'      => 'checkboxField') ,
        'socialbuttons_facebook' => array(
            'title'     => __('Activate facebook.','ct4gg'),
            'section'   => CT4GG_NAME.'_socialbuttons',
            'type'      => 'checkboxField') ,
        'socialbuttons_whatsapp' => array(
            'title'     => __('Activate whatsapp.','ct4gg'),
            'message'   => __('Display only on max size 640px.', 'ct4gg'),
            'section'   => CT4GG_NAME.'_socialbuttons',
            'type'      => 'checkboxField') ,
        'socialbuttons_pinterest' => array(
            'title'     => __('Activate pinterest.','ct4gg'),
            'section'   => CT4GG_NAME.'_socialbuttons',
            'type'      => 'checkboxField') ,
        'socialbuttons_linkedin' => array(
            'title'     => __('Activate linkedin.','ct4gg'),
            'section'   => CT4GG_NAME.'_socialbuttons',
            'type'      => 'checkboxField') ,
        'socialbuttons_buffer' => array(
            'title'     => __('Activate buffer.','ct4gg'),
            'section'   => CT4GG_NAME.'_socialbuttons',
            'type'      => 'checkboxField') ,
        'socialbuttons_email' => array(
            'title'     => __('Activate email.','ct4gg'),
            'section'   => CT4GG_NAME.'_socialbuttons',
            'type'      => 'checkboxField') ,
);