<?php
/**
 * Template Contents
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

use CT4GG\Api\FileHTAcccess;
?>
	<div class="ct4gg-tab-content">
		<div id="tab-1" class="ct4gg-tab-pane <?php echo esc_html( ( ( isset( $_POST['tab'] ) && sanitize_text_field( wp_unslash( $_POST['tab'] ) ) === 'tab-1' ) || ! isset( $_POST['tab'] ) ) ? 'active' : '' ); ?>">
			<div class="ct4gg-infos">
				<form method="post" >
					<input type="hidden" name="page" value="ct4gg_htaccess"/>
					<input type="hidden" name="tab" value="tab-1"/>
					<?php wp_nonce_field( CT4GG_NAME . '-opt', CT4GG_NAME . '-verif' ); ?>
					<p><?php submit_button( __( 'Update Htaccess', 'ct4gg' ), 'primary', 'submit-build-htaccess', false ); ?></p>
					<?php
					$htaccess_file = ABSPATH . '.htaccess';
					if ( file_exists( $htaccess_file ) ) {
						echo '<p>' . esc_html( $htaccess_file . __( ' updated on ', 'ct4gg' ) . gmdate( 'F d Y H:i:s.', filemtime( $htaccess_file ) ) ) . '</p>';
						?>
						<textarea cols="150" style="margin-top: 0px; margin-bottom: 0px; height: 500px;" name="htaccess-content" ><?php echo esc_html( wp_remote_get( $htaccess_file ) ); ?></textarea>
					<?php } ?>
				</form>
			</div>
			<div class="ct4gg-advertise">
				<?php self::get_template( array( 'support' ) ); ?>
			</div>
		</div>

		<div id="tab-2" class="ct4gg-tab-pane <?php echo esc_html( ( isset( $_POST['tab'] ) && sanitize_text_field( wp_unslash( $_POST['tab'] ) ) === 'tab-2' ) ? 'active' : '' ); ?>" >
			<div class="ct4gg-infos">
				<h3><?php esc_html_e( 'Htaccess file(s)', 'ct4gg' ); ?></h3>
				<?php if ( file_exists( $htaccess_file ) ) { ?>
				<form method="POST">
					<input type="hidden" name="page" value="ct4gg_htaccess"/>
					<input type="hidden" name="tab" value="tab-2"/>
					<?php wp_nonce_field( CT4GG_NAME . '-opt', CT4GG_NAME . '-verif' ); ?>
					<dl>
					<?php
					foreach ( scandir( ABSPATH ) as $htaccess_filename ) {
						if ( preg_match( '~htaccess*~', $htaccess_filename ) ) {
							if ( basename( $htaccess_filename ) === '.htaccess' ) {
								$check = '';
							} else {
								$check = '<input type="checkbox" class="radio" value="' . esc_attr( basename( $htaccess_filename ) ) . '" id="ct4gg-htaccess" name="ct4gg-htaccess" />';
							}
							echo '<dt>' . esc_html( $check ) . '<b>' . esc_html( basename( $htaccess_filename ) ) . '</b> - ' . esc_html( gmdate( 'Ymd H:i:s.', filemtime( ABSPATH . $htaccess_filename ) ) ) . '</dt>';
						}
					}
						submit_button( __( 'Restore', 'ct4gg' ), 'primary', 'submit-htaccess-restore', false );
						submit_button( __( 'Delete', 'ct4gg' ), 'secondary', 'submit-htaccess-delete', false );
					?>
					</dl>
				</form>
					<?php
				} else {
					echo esc_html( __( 'No .htaccess fils found.', 'ct4gg' ) );
				}
				?>
			</div>
			<div class="ct4gg-advertise">
				<?php self::get_template( array( 'support' ) ); ?>
			</div>
		</div>
	</div>
