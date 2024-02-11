<?php
/**
 * @package CT4GGPlugin
 * @version 1.5.1
 */

return array(
	array(
		'type'     => 'section',
		'section'  => CT4GG_NAME . '_other_section',
		'title'    => __( 'Other', 'ct4gg' ),
		'priority' => 20,
	),
	array(
		'type'              => 'opt-toggle',
		'section'           => CT4GG_NAME . '_other_section',
		'title'             => __( 'Disable Register Link?', 'ct4gg' ),
		'name'              => CT4GG_NAME . '_options[' . CT4GG_NAME . '_field_register_link]',
		'sanitize_callback' => 'absint',
		'priority'          => 5,
		'default'           => false,
	),
	array(
		'type'              => 'opt-toggle',
		'section'           => CT4GG_NAME . '_other_section',
		'title'             => __( 'Disable Lost Password?', 'ct4gg' ),
		'name'              => CT4GG_NAME . '_options[' . CT4GG_NAME . '_field_lost_password]',
		'sanitize_callback' => 'absint',
		'priority'          => 10,
		'default'           => false,
	),
	array(
		'type'              => 'opt-toggle',
		'section'           => CT4GG_NAME . '_other_section',
		'title'             => __( 'Disable "Back to Website"?', 'ct4gg' ),
		'name'              => CT4GG_NAME . '_options[' . CT4GG_NAME . '_field_back_blog]',
		'sanitize_callback' => 'absint',
		'priority'          => 15,
		'default'           => false,
	),
	array(
		'type'              => 'opt-color',
		'section'           => CT4GG_NAME . '_other_section',
		'title'             => __( 'Text Color', 'ct4gg' ),
		'name'              => CT4GG_NAME . '_options[' . CT4GG_NAME . '_other_color]',
		'default'           => '#999',
		'sanitize_callback' => 'sanitize_hex_color',
		'priority'          => 20,
	),
	array(
		'type'              => 'opt-color',
		'section'           => CT4GG_NAME . '_other_section',
		'title'             => __( 'ext Color (Hover)', 'ct4gg' ),
		'name'              => CT4GG_NAME . '_options[' . CT4GG_NAME . '_other_color_hover]',
		'default'           => '#2EA2CC',
		'sanitize_callback' => 'sanitize_hex_color',
		'priority'          => 25,
	),
);
