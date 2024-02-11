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

?>
	<div class="ct4gg-tab-content">
		<div id="tab-1" class="ct4gg-tab-pane active">
			<div class="ct4gg-infos">
				<form method="post" action="options.php">
					<?php
						settings_fields( CT4GG_NAME . '_plugin_settings' );
						do_settings_sections( CT4GG_NAME . '_plugin' );
						submit_button();
					?>
				</form>
			</div>
			<div class="ct4gg-advertise">
				<?php self::get_template( array( 'support' ) ); ?>
			</div>
		</div>

		<div id="tab-2" class="ct4gg-tab-pane">
			<div class="ct4gg-infos">
				<h3><?php esc_html_e( 'Updates', 'ct4gg' ); ?></h3>
				<dl>
				<?php
				$nb = 0;
				global $wp_filesystem;
				if ( ! is_a( $wp_filesystem, 'WP_Filesystem_Base' ) ) {
					include_once ABSPATH . 'wp-admin/includes/file.php';
					$creds = request_filesystem_credentials( site_url() );
					wp_filesystem( $creds );
				}
				$file->get_contents( CT4GG_PATH . 'changelog.txt' );
				while ( ! feof( $file ) ) {
					$line = fgets( $file );
					if ( preg_match( '/= (.*) =/', $line, $matches ) ) {
						$nb++;
						$ver = $matches[1];
					} elseif ( preg_match( '/\*Release Date -(.*)\*/', $line, $matches ) ) {
						$nb++;
						echo '<dt><b>' . esc_html( $ver ) . '</b>: ' . esc_html( $matches[1] ) . '</dt>';
					} elseif ( $nb > 2 ) {
						echo '<dd>' . esc_html( $line ) . '</dd>';
					}
				}
				?>
				</dl>
			</div>
			<div class="ct4gg-advertise">
				<?php self::get_template( array( 'support' ) ); ?>
			</div>
		</div>

		<div id="tab-3" class="ct4gg-tab-pane">
			<div class="ct4gg-infos">
				<h3><?php esc_html_e( 'About', 'ct4gg' ); ?></h3>
				<p>Version : <?php echo esc_html( CT4GG_VERSION ); ?></p>
				<p><?php esc_html_e( 'Credit', 'ct4gg' ); ?>: Franck VANHOUCKE</p>
			</div>
			<div class="ct4gg-advertise">
				<?php self::get_template( array( 'support' ) ); ?>
			</div>
		</div>
	</div>
