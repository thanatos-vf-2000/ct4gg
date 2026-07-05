<?php
/**
 * Template Contents
 *
 * PHP version 7
 *
 * @category  PHP
 * @package   CT4GGPlugin
 * @author    Franck VANHOUCKE <ct4gg@ginkgos.net>
 * @copyright 2021-2026 Copyright 2026, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later
 * @version   1.6.0 GIT:https://github.com/thanatos-vf-2000/ct4gg
 * @link      https://ginkgos.net
 */

if ( ! defined( 'ABSPATH' ) ) exit;

use CT4GG\Api\FileLlms;
?>
	<div class="ct4gg-tab-content">
		<div id="tab-1" class="ct4gg-tab-pane <?php echo esc_html( ( ( isset( $_POST['tab'] ) && sanitize_text_field( wp_unslash( $_POST['tab'] ) ) === 'tab-1' ) || ! isset( $_POST['tab'] ) ) ? 'active' : '' ); ?>">
			<div class="ct4gg-infos">
				<p><?php esc_html_e( 'The llms.txt file lets you describe your site (title, summary, pages, posts) in a format meant to be read by Large Language Models. See ', 'ct4gg' ); ?><a href="https://llmstxt.org/" target="_blank" rel="noopener noreferrer">llmstxt.org</a>.</p>
				<form method="post" >
					<input type="hidden" name="page" value="ct4gg_llms"/>
					<input type="hidden" name="tab" value="tab-1"/>
					<?php wp_nonce_field( CT4GG_NAME . '-opt', CT4GG_NAME . '-verif' ); ?>
					<p><?php submit_button( __( 'Update llms.txt', 'ct4gg' ), 'primary', 'submit-build-llms', false ); ?></p>
					<?php
					$llms_file = ABSPATH . 'llms.txt';
					global $wp_filesystem;
					if ( ! is_a( $wp_filesystem, 'WP_Filesystem_Base' ) ) {
						if ( ! function_exists( 'request_filesystem_credentials' ) ) {
							include_once ABSPATH . 'wp-admin/includes/file.php';
						}
					}
					// Demander les informations d'identification du système de fichiers, si nécessaire.
					if ( false === ( $creds = request_filesystem_credentials( site_url() ) ) ) {
						// Si les informations d'identification ne peuvent pas être obtenues, arrêter ici.
						esc_html_e( 'Error during checking identification.', 'ct4gg' );
						return;
					}
					// Initialiser le système de fichiers global.
					if ( ! WP_Filesystem( $creds ) ) {
						// Si la connexion échoue, arrêter ici.
						esc_html_e( 'Error during Initialize global file system.', 'ct4gg' );
						return;
					}
					// Vérifier si le fichier existe.
					if ( ! $wp_filesystem->exists( $llms_file ) ) {
						esc_html_e( 'File llms.txt not found. Click "Update llms.txt" to create it.', 'ct4gg' );
					} else {
						$contents = $wp_filesystem->get_contents( $llms_file );
						if ( ! $contents ) {
							esc_html_e( 'Error accessing file.', 'ct4gg' );
						} elseif ( file_exists( $llms_file ) ) {
								echo '<p>' . esc_html( $llms_file . __( ' updated on ', 'ct4gg' ) . gmdate( 'F d Y H:i:s.', filemtime( $llms_file ) ) ) . '</p>';
							?>
								<textarea cols="150" style="margin-top: 0px; margin-bottom: 0px; height: 500px;" name="llms-content"><?php echo esc_html( $contents ); ?></textarea>
								<?php

						}
					}
					?>
				</form>
			</div>
			<div class="ct4gg-advertise">
				<?php self::get_template( array( 'support' ) ); ?>
			</div>
		</div>

		<div id="tab-2" class="ct4gg-tab-pane <?php echo esc_html( ( isset( $_POST['tab'] ) && sanitize_text_field( wp_unslash( $_POST['tab'] ) ) === 'tab-2' ) ? 'active' : '' ); ?>" >
			<div class="ct4gg-infos">
				<h3><?php esc_html_e( 'llms.txt file(s)', 'ct4gg' ); ?></h3>
				<?php if ( file_exists( $llms_file ) ) { ?>
				<form method="POST">
					<input type="hidden" name="page" value="ct4gg_llms"/>
					<input type="hidden" name="tab" value="tab-2"/>
					<?php wp_nonce_field( CT4GG_NAME . '-opt', CT4GG_NAME . '-verif' ); ?>
					<dl>
					<?php
					foreach ( scandir( ABSPATH ) as $llms_filename ) {
						if ( preg_match( '~llms*~', $llms_filename ) ) {
							if ( basename( $llms_filename ) === 'llms.txt' ) {
									$check = '';
							} else {
								$check = '<input type="checkbox" class="radio" value="' . esc_attr( basename( $llms_filename ) ) . '" id="ct4gg-llms" name="ct4gg-llms" />';
							}
							$display = '<dt>' . esc_txt( $check ) . '<b>' . esc_html( basename( $llms_filename ) ) . '</b> - ' . esc_html( gmdate( 'Ymd H:i:s.', filemtime( ABSPATH . $llms_filename ) ) ) . '</dt>';
							$allowed_html = array(  'dt' => array(),
													'b' => array(),
													'input' => array( 'type' => true, 'class' => true, 'value' => true, 'id' => true, 'name' => true),
													'a' => array( 'href' => true, 'target' => true ),
												);
							echo wp_kses($display ,$allowed_html );
						}
					}
					submit_button( __( 'Restore', 'ct4gg' ), 'primary', 'submit-llms-restore', false );
					submit_button( __( 'Delete', 'ct4gg' ), 'secondary', 'submit-llms-delete', false );
					?>
					</dl>
				</form>
					<?php
				} else {
					echo esc_html( __( 'No llms.txt fils found.', 'ct4gg' ) );
				}
				?>
			</div>
			<div class="ct4gg-advertise">
				<?php self::get_template( array( 'support' ) ); ?>
			</div>
		</div>
	</div>
