<?php
/**
 * Padding Control in Customizer
 *
 * @subpackage Range 1.3.0
 */

namespace CT4GG\Theme\Login\Controls;

require_once ABSPATH . 'wp-includes/class-wp-customize-control.php';

/**
 * Padding Control Class
 *
 * @correction F. VANHOUCKE 1.5.1
 */
class Padding extends \WP_Customize_Control {


	public $type = CT4GG_NAME . '-padding';

	public function enqueue() {
		wp_enqueue_script( CT4GG_NAME . '-padding', CT4GG_URL . 'assets/js/Login/Controls/padding-control.js', array(), CT4GG_VERSION, true );
		wp_enqueue_style( CT4GG_NAME . '-padding', CT4GG_URL . 'assets/css/Login/Controls/padding-control.css', array(), CT4GG_VERSION );
	}

	public function render_content() {
		?>
		<label>
			<div id="<?php echo esc_attr( $this->id ); ?>">
				<?php if ( ! empty( $this->label ) ) : ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php endif; ?>
				<?php if ( ! empty( $this->description ) ) : ?>
					<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php endif; ?>
				<div class="field-area">
					<div class="field-icon"><i class="dashicons dashicons-arrow-up"></i><?php esc_html_e( 'Top', 'ct4gg' ); ?></div>
					<input type="number" value="10" min="0" max="1000" />
					<div class="field-icon"><i class="dashicons dashicons-arrow-right"></i><?php esc_html_e( 'Right', 'ct4gg' ); ?></div>
					<input type="number" value="10" min="0" max="1000" />
				</div>
				<div class="field-area">
					<div class="field-icon"><i class="dashicons dashicons-arrow-down"></i><?php esc_html_e( 'Down', 'ct4gg' ); ?></div>
					<input type="number" value="10" min="0" max="1000" />
					<div class="field-icon"><i class="dashicons dashicons-arrow-left"></i><?php esc_html_e( 'Left', 'ct4gg' ); ?></div>
					<input type="number" value="10" min="0" max="1000" />
				</div>
				<input type="text" value="<?php echo esc_html( $this->value() ); ?>" <?php $this->link(); ?> />
			</div>
		</label>
		<?php
	}
}
