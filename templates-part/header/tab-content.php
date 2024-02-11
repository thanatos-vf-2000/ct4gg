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

use CT4GG\Core\Options;

?>
	<div class="ct4gg-tab-content">
		<div id="tab-1" class="ct4gg-tab-pane <?php echo esc_html( ( ( isset( $_POST['tab'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['tab'] ) ), 'tab-my-nonce' ) && 'tab-1' === sanitize_text_field( wp_unslash( $_POST['tab'] ) ) ) || ! isset( $_POST['tab'] ) ) ? 'active' : '' ); ?>">
			<div class="ct4gg-infos">
				<h2><?php esc_html_e( 'Security headers', 'ct4gg' ); ?></h2>
				<?php
				if ( Options::get_option( 'header_sec' ) === false ) {
					echo '<p><a href="' . esc_url( admin_url( 'admin.php?page=ct4gg_plugin' ) ) . '" style="text-decoration: none;"><b style="color:red">' . esc_html__( 'go to parameters to enable options.', 'ct4gg' ) . '</b></a></p>';
				} else {
					?>
					<div id="ct4gg-graph-sec">
						<div class="ct4gg-graph-container">
							<div class="ct4gg-graph-bg"></div>
							<div class="ct4gg-graph-text"></div>
							<div class="ct4gg-graph-progress" style="transform: rotate(180deg);"></div>
							<div class="ct4gg-graph-data"><b>100%</b><br>Wait</div>
						</div>                       
					</div>
					<div id="ct4gg-check-headers">
						<button id="ct4gg-check-headers-sec" type="button" class="button button-primary" onClick="CT4GG.check_headers('sec', '<?php echo esc_attr( wp_create_nonce( 'ct4gg/check_headers' ) ); ?>')"><?php esc_html_e( 'Check Current Headers Security', 'ct4gg' ); ?></button>
						<span class="spinner" style="visibility: hidden; float: left;"></span>
					</div>
					<script type="text/javascript">
						jQuery('#ct4gg-check-headers-sec').click();    
					</script>
					<?php
				}
				?>
			</div>
			<div class="ct4gg-advertise">
				<?php self::get_template( array( 'support' ) ); ?>
			</div>
			<div id="ct4gg-headers-container-sec"></div>
		</div>

		<div id="tab-2" class="ct4gg-tab-pane <?php echo esc_html( ( isset( $_POST['tab'] ) && 'tab-2' === sanitize_text_field( wp_unslash( $_POST['tab'] ) ) ) ? 'active' : '' ); ?>" >
			<div class="ct4gg-infos">
				<h2><?php esc_html_e( 'Information headers', 'ct4gg' ); ?></h2>
				<?php
				if ( Options::get_option( 'header_info' ) === false ) {
					echo '<p><b style="color:red">' . esc_html__( 'go to parameters to enable options.', 'ct4gg' ) . '</b></p>';
				} else {
					?>
					<div id="ct4gg-graph-info">
						<div class="ct4gg-graph-container">
							<div class="ct4gg-graph-bg"></div>
							<div class="ct4gg-graph-text"></div>
							<div class="ct4gg-graph-progress" style="transform: rotate(180deg);"></div>
							<div class="ct4gg-graph-data"><b>100%</b><br>Wait</div>
						</div>                       
					</div>
					<div id="ct4gg-check-headers">
						<button id="ct4gg-check-headers-info" type="button" class="button button-primary" onClick="CT4GG.check_headers('info', '<?php echo esc_attr( wp_create_nonce( 'ct4gg/check_headers' ) ); ?>')"><?php esc_html_e( 'Check Current Headers Information', 'ct4gg' ); ?></button>
						<span class="spinner" style="visibility: hidden; float: left;"></span>
					</div>
					<script type="text/javascript">
						jQuery('#ct4gg-check-headers-info').click();    
					</script>
					<?php
				}
				?>
			</div>
			<div class="ct4gg-advertise">
				<?php self::get_template( array( 'support' ) ); ?>
			</div>
			<div id="ct4gg-headers-container-info"></div>
		</div>

		<div id="tab-3" class="ct4gg-tab-pane <?php echo esc_html( ( isset( $_POST['tab'] ) && 'tab-3' === sanitize_text_field( wp_unslash( $_POST['tab'] ) ) ) ? 'active' : '' ); ?>" >
			<div class="ct4gg-infos">
				<h2><?php esc_html_e( 'Cache headers', 'ct4gg' ); ?></h2>
				<?php
				if ( Options::get_option( 'header_cache' ) === false ) {
					echo '<p><b style="color:red">' . esc_html__( 'go to parameters to enable options.', 'ct4gg' ) . '</b></p>';
				} else {
					?>
					<div id="ct4gg-graph-cache">
						<div class="ct4gg-graph-container">
							<div class="ct4gg-graph-bg"></div>
							<div class="ct4gg-graph-text"></div>
							<div class="ct4gg-graph-progress" style="transform: rotate(180deg);"></div>
							<div class="ct4gg-graph-data"><b>100%</b><br>Wait</div>
						</div>                       
					</div>
					<div id="ct4gg-check-headers">
						<button id="ct4gg-check-headers-cache" type="button" class="button button-primary" onClick="CT4GG.check_headers('cache', '<?php echo esc_attr( wp_create_nonce( 'ct4gg/check_headers' ) ); ?>')"><?php esc_html_e( 'Check Current Headers Cache', 'ct4gg' ); ?></button>
						<span class="spinner" style="visibility: hidden; float: left;"></span>
					</div>
					<script type="text/javascript">
						jQuery('#ct4gg-check-headers-cache').click();    
					</script>
					<?php
				}
				?>
			</div>
			<div class="ct4gg-advertise">
				<?php self::get_template( array( 'support' ) ); ?>
			</div>
			<div id="ct4gg-headers-container-cache"></div>
		</div>
	</div>
