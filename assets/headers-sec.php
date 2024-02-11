<?php
/**
 * Header Security options to check
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
	'cross-origin-embedder-policy'        => array(
		'name'        => 'Cross-Origin-Embedder-Policy',
		'description' => __( 'Allows a server to declare an embedder policy for a given document.', 'ct4gg' ),
		'link'        => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers#security',
		'type'        => 'warning',
	),
	'cross-origin-opener-policy'          => array(
		'name'        => 'Cross-Origin-Opener-Policy',
		'description' => __( 'Prevents other domains from opening/controlling a window.', 'ct4gg' ),
		'link'        => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers#security',
		'type'        => 'warning',
	),
	'cross-origin-resource-policy'        => array(
		'name'        => 'Cross-Origin-Resource-Policy',
		'description' => __( 'Prevents other domains from reading the response of the resources to which this header is applied.', 'ct4gg' ),
		'link'        => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers#security',
		'type'        => 'warning',
	),
	'content-security-policy'             => array(
		'name'        => 'Content-Security-Policy',
		'description' => __( 'Controls resources the user agent is allowed to load for a given page.', 'ct4gg' ),
		'link'        => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers#security',
		'type'        => 'warning',
	),
	'content-security-policy-report-only' => array(
		'name'        => 'Content-Security-Policy-Report-Only',
		'description' => __( 'Allows web developers to experiment with policies by monitoring, but not enforcing, their effects. These violation reports consist of JSON documents sent via an HTTP POST request to the specified URI.', 'ct4gg' ),
		'link'        => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers#security',
		'type'        => 'warning',
	),
	'expect-ct'                           => array(
		'name'        => 'Expect-CT',
		'description' => __( 'Allows sites to opt in to reporting and/or enforcement of Certificate Transparency requirements, which prevents the use of misissued certificates for that site from going unnoticed. When a site enables the Expect-CT header, they are requesting that Chrome check that any certificate for that site appears in public CT logs.', 'ct4gg' ),
		'link'        => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers#security',
		'type'        => 'deprecated',
	),
	'permissions-policy'                  => array(
		'name'        => 'Permissions-Policy',
		'description' => __( 'Provides a mechanism to allow and deny the use of browser features in its own frame, and in iframes that it embeds.', 'ct4gg' ),
		'link'        => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers#security',
		'type'        => 'warning',
	),
	'referrer-policy'                     => array(
		'name'        => 'Referrer-Policy',
		'description' => __( 'A policy that controls how much information is shared through the HTTP referrer header. Helps to protect user privacy.', 'ct4gg' ),
		'link'        => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Referrer-Policy',
		'type'        => 'warning',
	),
	'strict-transport-security'           => array(
		'name'        => 'Strict-Transport-Security',
		'description' => __( 'Force communication using HTTPS instead of HTTP.', 'ct4gg' ),
		'link'        => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers#security',
		'type'        => 'error',
	),
	'x-content-type-options'              => array(
		'name'        => 'X-Content-Type-Options',
		'description' => __( 'Disables MIME sniffing and forces browser to use the type given in Content-Type.', 'ct4gg' ),
		'link'        => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers#security',
		'type'        => 'warning',
	),
	'x-download-options'                  => array(
		'name'        => 'X-Download-Options',
		'description' => __( 'The X-Download-Options HTTP header indicates that the browser (Internet Explorer) should not display the option to "Open" a file that has been downloaded from an application, to prevent phishing attacks as the file otherwise would gain access to execute in the context of the application.', 'ct4gg' ),
		'link'        => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers#security',
		'type'        => 'warning',
	),
	'x-frame-options'                     => array(
		'name'        => 'X-Frame-Options',
		'description' => __( 'Indicates whether a browser should be allowed to render a page in a &#60;frame&#62;, &#60;iframe&#62;, &#60;embed&#62; or &#60;object&#62;', 'ct4gg' ),
		'link'        => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers#security',
		'type'        => 'warning',
	),
	'x-permitted-cross-domain-policies'   => array(
		'name'        => 'X-Permitted-Cross-Domain-Policies',
		'description' => __( 'Specifies if a cross-domain policy file (crossdomain.xml) is allowed. The file may define a policy to grant clients, such as Adobe\'s Flash Player (now obsolete), Adobe Acrobat, Microsoft Silverlight (now obsolete), or Apache Flex, permission to handle data across domains that would otherwise be restricted due to the Same-Origin Policy. See the Cross-domain Policy File Specification for more information.', 'ct4gg' ),
		'link'        => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers#security',
		'type'        => 'deprecated',
	),
	'x-xss-protection'                    => array(
		'name'        => 'X-XSS-Protection',
		'description' => __( 'Created for browsers equipped with XSS filters, this non-standard header was intended as a way to control the filtering functionality.', 'ct4gg' ),
		'link'        => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers#security',
		'type'        => 'deprecated',
	),
);
