<?php
/**
 * @package CT4GGPlugin
 * @version 1.5.1
 */

return array(
	array(
		'type'     => 'section',
		'section'  => CT4GG_NAME . '_logo_section',
		'title'    => __( 'Logo', 'ct4gg' ),
		'priority' => 5,
	),
	array(
		'type'              => 'opt-toggle',
		'section'           => CT4GG_NAME . '_logo_section',
		'title'             => __( 'Disable Logo?', 'ct4gg' ),
		'name'              => CT4GG_NAME . '_options[' . CT4GG_NAME . '_logo_show]',
		'sanitize_callback' => 'absint',
		'priority'          => 5,
	),
	array(
		'type'              => 'opt-image',
		'section'           => CT4GG_NAME . '_logo_section',
		'title'             => __( 'Logo', 'ct4gg' ),
		'name'              => CT4GG_NAME . '_options[' . CT4GG_NAME . '_logo]',
		'sanitize_callback' => 'esc_url_raw',
		'priority'          => 10,
	),
	array(
		'type'              => 'option-default',
		'section'           => CT4GG_NAME . '_logo_section',
		'title'             => __( 'Logo URL', 'ct4gg' ),
		'name'              => CT4GG_NAME . '_options[' . CT4GG_NAME . '_logo_link]',
		'default'           => 'https://wordpress.org/',
		'sanitize_callback' => 'esc_url_raw',
		'priority'          => 15,
		'description'       => __( 'The page where your logo will take you.', 'ct4gg' ),
	),

);
