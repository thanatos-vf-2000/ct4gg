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

use CT4GG\Api\FileHumans;
?>
	<div class="ct4gg-tab-content">
		<div id="tab-1" class="ct4gg-tab-pane <?php echo esc_html( ( ( isset( $_POST['tab'] ) && sanitize_text_field( wp_unslash( $_POST['tab'] ) ) === 'tab-1' ) || ! isset( $_POST['tab'] ) ) ? 'active' : '' ); ?>">
			<div class="ct4gg-infos">
				<form method="post" >
					<input type="hidden" name="page" value="ct4gg_humans"/>
					<input type="hidden" name="tab" value="tab-1"/>
					<?php wp_nonce_field( CT4GG_NAME . '-opt', CT4GG_NAME . '-verif' ); ?>
					<p><?php submit_button( __( 'Update Humans.txt', 'ct4gg' ), 'primary', 'submit-build-humans', false ); ?></p>
					<?php
					$humans_file = ABSPATH . 'humans.txt';
					if ( file_exists( $humans_file ) ) {
						echo '<p>' . esc_html( $humans_file . __( ' updated on ', 'ct4gg' ) . gmdate( 'F d Y H:i:s.', filemtime( $humans_file ) ) ) . '</p>';
						?>
						<textarea cols="150" style="margin-top: 0px; margin-bottom: 0px; height: 500px;" name="humans-content"><?php echo esc_html( wp_remote_get( $humans_file ) ); ?></textarea>
					<?php } ?>
				</form>
			</div>
			<div class="ct4gg-advertise">
				<?php self::get_template( array( 'support' ) ); ?>
			</div>
		</div>

		<div id="tab-2" class="ct4gg-tab-pane <?php echo esc_html( ( isset( $_POST['tab'] ) && 'tab-2' === $_POST['tab'] ) ? 'active' : '' ); ?>" >
			<div class="ct4gg-infos">
				<h3><?php esc_html_e( 'Humans.txt file(s)', 'ct4gg' ); ?></h3>
				<?php if ( file_exists( $humans_file ) ) { ?>
				<form method="POST">
					<input type="hidden" name="page" value="ct4gg_humans"/>
					<input type="hidden" name="tab" value="tab-2"/>
					<?php wp_nonce_field( CT4GG_NAME . '-opt', CT4GG_NAME . '-verif' ); ?>
					<dl>
					<?php
					foreach ( scandir( ABSPATH ) as $humans_filename ) {
						if ( preg_match( '~humans*~', $humans_filename ) ) {
							if ( basename( $humans_filename ) === 'humans.txt' ) {
								$check = '';
							} else {
								$check = '<input type="checkbox" class="radio" value="' . esc_attr( basename( $humans_filename ) ) . '" id="ct4gg-humans" name="ct4gg-humans" />';
							}
							echo '<dt>' . esc_html( $check ) . '<b>' . esc_html( basename( $humans_filename ) ) . '</b> - ' . esc_html( gmdate( 'Ymd H:i:s.', filemtime( ABSPATH . $humans_filename ) ) ) . '</dt>';
						}
					}
						submit_button( __( 'Restore', 'ct4gg' ), 'primary', 'submit-humans-restore', false );
						submit_button( __( 'Delete', 'ct4gg' ), 'secondary', 'submit-humans-delete', false );
					?>
					</dl>
				</form>
					<?php
				} else {
					echo esc_html( __( 'No humans.txt fils found.', 'ct4gg' ) );
				}
				?>
			</div>
			<div class="ct4gg-advertise">
				<?php self::get_template( array( 'support' ) ); ?>
			</div>
		</div>
	</div>
