<?php
/**
 * Header Information options to check
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
	'x-powered-by'        => array(
		'name'        => 'X-Powered-By',
		'description' => __( 'X Powered By', 'ct4gg' ),
		'link'        => '',
		'type'        => 'warning',
	),
	'server'              => array(
		'name'        => 'Server',
		'description' => __( 'Server', 'ct4gg' ),
		'link'        => '',
		'type'        => 'error',
	),
	'x-aspnet-version'    => array(
		'name'        => 'X-AspNet-Version',
		'description' => __( 'X AspNet Version', 'ct4gg' ),
		'link'        => '',
		'type'        => 'warning',
	),
	'x-aspnetmvc-version' => array(
		'name'        => 'X-AspNetMvc-Version',
		'description' => __( 'X AspNetMvc Version', 'ct4gg' ),
		'link'        => '',
		'type'        => 'warning',
	),
);
