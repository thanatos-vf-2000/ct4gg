<?php
/**
 * Admin Ajax
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

namespace CT4GG\ui;

use CT4GG\Core\BaseController;
use CT4GG\Core\Options;

/**
 * Class AdminAjax
 */
class AdminAjax extends BaseController {

	public function register() {
		if ( is_admin() ) {
			add_action( 'wp_ajax_ct4gg_check_headers', array( $this, 'ct4ggCheckHeaders' ) );
		}
	}

	public function ct4ggCheckHeaders() {
		if ( isset( $_POST['nonce'] ) ) {
			if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'ct4gg/check_headers' ) ) {
				die();
			}
		}

		$checktypes = array( 'sec', 'info', 'cache' );
		$checktype  = filter_input( INPUT_POST, 'type', FILTER_SANITIZE_STRING );

		if ( ! in_array( $checktype, $checktypes, true ) ) {
			die();
		}

		$json_response = array();

		$site_url = apply_filters( 'ct4gg/check_headers/url', home_url() );
		$response = wp_remote_head(
			$site_url,
			array(
				'sslverify' => false,
				'timeout'   => 40,
			)
		);

		$json_response['graph']['color'] = '#ce9e27';
		if ( ! is_array( $response ) ) {
				$json_response['html'] = __( '<br />Unable to parse the site Headers. The wp_remote_head() returned an invalid Response, check with your host support for more details.  Unable to identify your site Headers.', 'ct4gg' );
			if ( is_wp_error( $response ) ) {
				$json_response['html'] .= '<br /><b>' . $response->get_error_message() . '</b>';
			}
				$json_response['graph']['message'] = __( 'Error', 'ct4gg' );
				$json_response['graph']['value']   = '0';
				echo wp_json_encode( $json_response );
				die();
		}

		$http_response = $response['http_response'];
		if ( ! is_object( $http_response ) ) {
				$json_response['html']             = __( '<br />Invalid WP_HTTP_Requests_Response object. The wp_remote_head() returned an invalid Response, check with your host support for more details.', 'ct4gg' );
				$json_response['graph']['message'] = __( 'Error', 'ct4gg' );
				$json_response['graph']['value']   = '0';
				echo wp_json_encode( $json_response );
				die();
		}

		if ( empty( $http_response->get_status() ) ) {
				$json_response['html']             = __( '<br />Unable to parse the site Headers. The wp_remote_head() returns invalid Response Code, check with your host support for more details.', 'ct4gg' );
				$json_response['graph']['message'] = __( 'Error', 'ct4gg' );
				$json_response['graph']['value']   = '0';
				echo wp_json_encode( $json_response );
				die();
		}
		if ( $http_response->get_status() !== 200 ) {
			if ( $http_response->get_status() === 401 ) {
					$json_response['html']             = __( '<br />Unable to parse the site Headers. The wp_remote_head() returns a 401 error code, the request could not be authenticated. Does the site use an httpd password?', 'ct4gg' );
					$json_response['graph']['message'] = __( 'Error', 'ct4gg' );
					$json_response['graph']['value']   = '0';
					echo wp_json_encode( $json_response );
					die();
			}

				$json_response['html']             = __( '<br />Unable to parse the site Headers. The wp_remote_head() returns wrong Response Code', 'ct4gg' ) . $http_response->get_status() . __( ', check with your host support for more details.', 'ct4gg' );
				$json_response['graph']['message'] = __( 'Error', 'ct4gg' );
				$json_response['graph']['value']   = '0';
				echo wp_json_encode( $json_response );
				die();
		}

		$headers = $http_response->get_headers();

		switch ( $checktype ) {
			case 'sec':
				$headers_check = Options::load_php_config( CT4GG_PATH . 'assets/headers-sec.php' );
				break;
			case 'info':
				$headers_check = Options::load_php_config( CT4GG_PATH . 'assets/headers-information.php' );
				break;
			case 'cache':
				$headers_check = Options::load_php_config( CT4GG_PATH . 'assets/headers-cache.php' );
				break;
		}

		ob_start();
		?>
		<div id="ct4gg-headers">
			<table class="ct4gg-headers-table">
				<thead>
					<tr>
						<th style="width: 30%"><?php esc_html_e( 'Header', 'ct4gg' ); ?></th>
						<th><?php esc_html_e( 'Value', 'ct4gg' ); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php
					$found_header = array();
					foreach ( $headers->getAll() as $header_key => $header_value ) {
						$header_key = strtolower( $header_key );
						$header_key = trim( $header_key );

						$is_header_check = false;
						if ( isset( $headers_check[ $header_key ] ) ) {
							$is_header_check = true;
							$found_header[]  = $header_key;
						}
						?>
						<tr 
						<?php
						if ( $is_header_check ) {
							echo ' class="ct4gg-check-header" ';
						}
						?>
						>
							<td style="width: 30%"><?php echo esc_html( $header_key ); ?>
							<?php
							if ( $is_header_check ) {
								echo ' <span class="dashicons dashicons-saved"></span>';
							}
							?>
							</td>
							<td>
								<?php
								if ( is_array( $header_value ) ) {
									echo esc_html( implode( '<br />', array_map( 'htmlspecialchars', $header_value ) ) );
								} else {
									echo esc_html( htmlspecialchars( $header_value ) );
								}
								?>
								</td>
						</tr>
						<?php
					}
					?>
				</tbody>
			</table>
			<table class="ct4gg-headers-table">
				<thead>
					<tr>
						<th style="width: 30%"><?php esc_html_e( 'Name', 'ct4gg' ); ?></th>
						<th style="width: 5%"><?php esc_html_e( 'Type', 'ct4gg' ); ?></th>
						<th><?php esc_html_e( 'Description', 'ct4gg' ); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ( $headers_check as $key => $value ) {
						if ( in_array( $key, $found_header, true ) ) {
							$name     = $value['name'] . '<span class="dashicons dashicons-saved"></span>';
							$css_name = "class='ct4gg-check-header-" . $value['type'] . "'";
						} else {
							$name     = $value['name'];
							$css_name = '';
						}

						switch ( $value['type'] ) {
							case 'warning':
								$type = '<span class="dashicons dashicons-warning ct4gg-dashicons-warning"></span>';
								break;
							case 'deprecated':
								$type = '<span class="dashicons dashicons-undo ct4gg-dashicons-deprecated"></span>';
								break;
							case 'error':
								$type = '<span class="dashicons dashicons-dismiss ct4gg-dashicons-error"></span>';
								break;
							case 'present':
								$type = '<span class="dashicons dashicons-ok ct4gg-dashicons-present"></span>';
								break;
						}

						if ( '' === $value['link'] ) {
							$description = $value['description'];
						} else {
							$description = $value['description'] . '<br><a href="' . $value['link'] . '" target="_blank"><code>' . $key . '</code></a>';
						}

						echo '<tr>
                            <td ' . esc_html( $css_name ) . '>' . esc_html( $name ) . ' </td>
                            <td> ' . esc_html( $type ) . '</td>
                            <td> ' . esc_html( $description ) . '</td>
                        </tr>';
					}
					?>
				</tbody>
			</table>
		</div>

		<?php

		$json_response['html'] = ob_get_clean();

		switch ( $checktype ) {
			case 'sec':
				$progress = round( count( $found_header ) * 100 / count( $headers_check ) );
				break;
			case 'info':
				$progress = round( 100 - ( count( $found_header ) * 100 / ( count( $headers_check ) / 2 ) ) );
				break;
			case 'cache':
				$progress = round( count( $found_header ) * 100 / count( $headers_check ) );
				break;
		}
		if ( $progress < 1 ) {
			$progress = 1;
		}
		$json_response['graph']['value'] = round( $progress * 180 / 100 );

		$json_response['graph']['message']  = '<b>' . $progress . '%</b>';
		$json_response['graph']['message'] .= '<br />';
		if ( $progress < 20 ) {
			$json_response['graph']['message'] .= __( 'Poor', 'ct4gg' );
			$json_response['graph']['color']    = '#8B0000';
		} elseif ( $progress >= 20 && $progress < 40 ) {
			$json_response['graph']['message'] .= __( 'Fair', 'ct4gg' );
			$json_response['graph']['color']    = '#FF4500';
		} elseif ( $progress >= 40 && $progress < 60 ) {
			$json_response['graph']['message'] .= __( 'Good', 'ct4gg' );
			$json_response['graph']['color']    = '#FFD700';
		} elseif ( $progress >= 60 && $progress < 80 ) {
			$json_response['graph']['message'] .= __( 'Great', 'ct4gg' );
			$json_response['graph']['color']    = '#00008B';
		} elseif ( $progress >= 80 ) {
			$json_response['graph']['message'] .= __( 'Excelent', 'ct4gg' );
			$json_response['graph']['color']    = '#32CD32';
		}

		echo wp_json_encode( $json_response );

		die();
	}
}
