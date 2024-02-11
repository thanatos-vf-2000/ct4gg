<?php
/**
 * @package CT4GGPlugin
 * @version 1.5.1
 */

return array(
	array(
		'type'     => 'section',
		'section'  => CT4GG_NAME . '_form_section',
		'title'    => __( 'Form', 'ct4gg' ),
		'priority' => 15,
	),
	array(
		'type'              => 'opt-alpha',
		'section'           => CT4GG_NAME . '_form_section',
		'title'             => __( 'Background Color', 'ct4gg' ),
		'name'              => CT4GG_NAME . '_options[' . CT4GG_NAME . '_form_bg_color]',
		'sanitize_callback' => 'sanitize_text_field',
		'priority'          => 5,
		'default'           => '#FFFFFF',
	),
	array(
		'type'              => 'opt-alpha',
		'section'           => CT4GG_NAME . '_form_section',
		'title'             => __( 'Border Color', 'ct4gg' ),
		'name'              => CT4GG_NAME . '_options[' . CT4GG_NAME . '_form_border_color]',
		'sanitize_callback' => 'sanitize_text_field',
		'priority'          => 10,
		'default'           => '#000000',
	),
	array(
		'type'              => 'opt-alpha',
		'section'           => CT4GG_NAME . '_form_section',
		'title'             => __( 'Text Color', 'ct4gg' ),
		'name'              => CT4GG_NAME . '_options[' . CT4GG_NAME . '_text_color]',
		'sanitize_callback' => 'sanitize_text_field',
		'priority'          => 15,
		'default'           => '#000000',
	),
	array(
		'type'              => 'opt-alpha',
		'section'           => CT4GG_NAME . '_form_section',
		'title'             => __( 'Button Background', 'ct4gg' ),
		'name'              => CT4GG_NAME . '_options[' . CT4GG_NAME . '_button_bg]',
		'default'           => '#2EA2CC',
		'sanitize_callback' => 'sanitize_text_field',
		'priority'          => 20,
	),
	array(
		'type'              => 'opt-alpha',
		'section'           => CT4GG_NAME . '_form_section',
		'title'             => __( 'Button Background (Hover)', 'ct4gg' ),
		'name'              => CT4GG_NAME . '_options[' . CT4GG_NAME . '_button_hover_bg]',
		'default'           => '#1E8CBE',
		'sanitize_callback' => 'sanitize_text_field',
		'priority'          => 25,
	),
	array(
		'type'              => 'opt-alpha',
		'section'           => CT4GG_NAME . '_form_section',
		'title'             => __( 'Button Text Color', 'ct4gg' ),
		'name'              => CT4GG_NAME . '_options[' . CT4GG_NAME . '_button_color]',
		'default'           => '#FFF',
		'sanitize_callback' => 'sanitize_text_field',
		'priority'          => 30,
	),
);
