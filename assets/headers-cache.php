<?php
/**
 * Header Cache options to check
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
 */

return array(
	'cache-control' => array(
		'name'        => 'Cache-Control',
		'description' => __( 'Cache Control', 'ct4gg' ),
		'link'        => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Caching',
		'type'        => 'present',
	),
	'pragma'        => array(
		'name'        => 'Pragma',
		'description' => __( 'Pragma', 'ct4gg' ),
		'link'        => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Caching',
		'type'        => 'present',
	),
	'last-modified' => array(
		'name'        => 'Last-Modified',
		'description' => __( 'Last Modified', 'ct4gg' ),
		'link'        => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Caching',
		'type'        => 'present',
	),
	'expires'       => array(
		'name'        => 'Expires',
		'description' => __( 'Expires', 'ct4gg' ),
		'link'        => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Caching',
		'type'        => 'present',
	),
	'etag'          => array(
		'name'        => 'ETag',
		'description' => __( 'ETag', 'ct4gg' ),
		'link'        => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Caching',
		'type'        => 'present',
	),
);
