<?php
/**
 * @package CT4GGPlugin
 * @version 1.5.1
 */

return array(
	array(
		'type'     => 'section',
		'section'  => CT4GG_NAME . '_background_section',
		'title'    => __( 'Background', 'ct4gg' ),
		'priority' => 10,
	),
	array(
		'type'              => 'opt-color',
		'section'           => CT4GG_NAME . '_background_section',
		'title'             => __( 'Background Color', 'ct4gg' ),
		'name'              => CT4GG_NAME . '_options[' . CT4GG_NAME . '_bg_color]',
		'default'           => '#F1F1F1',
		'sanitize_callback' => 'sanitize_hex_color',
		'priority'          => 5,
	),
	array(
		'type'              => 'opt-image',
		'section'           => CT4GG_NAME . '_background_section',
		'title'             => __( 'Background Image', 'ct4gg' ),
		'name'              => CT4GG_NAME . '_options[' . CT4GG_NAME . '_bg_image]',
		'sanitize_callback' => 'esc_url_raw',
		'priority'          => 10,
	),
	array(
		'type'     => 'opt-radio',
		'section'  => CT4GG_NAME . '_background_section',
		'title'    => __( 'Background Size', 'ct4gg' ),
		'name'     => CT4GG_NAME . '_options[' . CT4GG_NAME . '_bg_image_size]',
		'default'  => 'auto',
		'priority' => 15,
		'choices'  => array(
			'auto'    => __( 'Original', 'ct4gg' ),
			'contain' => __( 'Fit to Screen', 'ct4gg' ),
			'cover'   => __( 'Fill Screen', 'ct4gg' ),
			'custom'  => __( 'Custom', 'ct4gg' ),
		),
	),
	array(
		'type'              => 'option',
		'section'           => CT4GG_NAME . '_background_section',
		'title'             => __( 'Custom Size', 'ct4gg' ),
		'name'              => CT4GG_NAME . '_options[' . CT4GG_NAME . '_bg_size]',
		'sanitize_callback' => 'esc_html',
		'priority'          => 20,
	),
	array(
		'type'     => 'opt-radio',
		'section'  => CT4GG_NAME . '_background_section',
		'title'    => __( 'Background Repeat', 'ct4gg' ),
		'name'     => CT4GG_NAME . 'options[' . CT4GG_NAME . '_bg_image_repeat]',
		'default'  => 'no-repeat',
		'priority' => 25,
		'choices'  => array(
			'no-repeat' => __( 'No Repeat', 'ct4gg' ),
			'repeat'    => __( 'Repeat', 'ct4gg' ),
			'repeat-x'  => __( 'Repeat Horizontally', 'ct4gg' ),
			'repeat-y'  => __( 'Repeat Vertically', 'ct4gg' ),
		),
	),
);
