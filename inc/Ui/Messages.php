<?php
/**
 * Messages
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

namespace CT4GG\Ui;

use CT4GG\Core\BaseController;

use CT4GG\Core\Options;

/**
 * Messages
 */
class Messages extends BaseController {

	public function register() {
		add_action( 'init', array( $this, 'init' ) );
		global $pagenow;
		$admin_pages = array( 'admin.php', 'index.php', 'plugins.php', 'tools.php' );
		if ( Options::get_option( 'login_screen_v2' ) === false && in_array( $pagenow, $admin_pages, true ) ) {
			add_action( 'admin_notices', array( $this, 'messages_plugins' ) );
		}
	}

	public function init() {
		add_action( 'wp_ajax_ct4gg_remove_messages', array( $this, 'dismiss_messages' ) );
	}

	/**
	 * Display Geochart plugins notice.
	 */
	public function messages_plugins() {
		if ( ! get_option( 'ct4gg_remove_messages' ) ) {
			?>
			<div id="ct4gg-dismiss-messages" class="notice notice-ct4gg-warning is-dismissible">
				<div class="ct4gg-messages-img">
				<img src="<?php echo esc_html( CT4GG_URL ); ?>/assets/img/login-min.png" alt="GeoChart" title="GeoChart">
				</div>
				<div class="ct4gg-messages-txt">
					<p>
						<?php
						$link         = admin_url( 'admin.php?page=ct4gg_plugin' );
						$current_user = wp_get_current_user();
						printf( __( 'Hey <b>%1$s</b>, %2$s v1.3.0 add a new options for customize login page (New Version only), see %3$s.', 'ct4gg' ), esc_html( $current_user->user_login ), '<em>CT4GG</em>', '<a href="' . esc_html( $link ) . '"><em>' . esc_html( __( 'Settings', 'ct4gg' ) . '</em></a>' ) );
						?>
					</p>
					<p><?php esc_html_e( 'Enable New Version for customize login page in the plugin options.', 'ct4gg' ); ?> <a href="<?php echo esc_html( admin_url( 'admin.php?page=ct4gg_plugin' ) ); ?>"><?php esc_html_e( 'Settings.', 'ct4gg' ); ?></a></p>
				</div>
			</div>
			<?php
		}
	}

	/**
	 * Ajax callback to disable the messages notice permanently.
	 */
	public function dismiss_messages() {
		wp_send_json_success(
			array(
				'notice_removed' => update_option( 'ct4gg_remove_messages', true ),
			)
		);
		exit;
	}
}
