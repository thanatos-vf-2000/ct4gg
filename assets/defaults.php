<?php
/**
 * @package  CT4GGPlugin
 * @Version 0.0.1
 */
return array(
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
);