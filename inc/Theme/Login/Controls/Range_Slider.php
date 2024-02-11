<?php
/**
 * Range Slider Customizer Control - Modified version of O2 Customizer Library
 *
 * This control adds range slider to the Customizer which allows
 * you to choose number from a range slider.
 *
 * Radio Buttonset is a part of O2 library, which is a
 * free software: you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the
 * Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this library. If not, see <https://www.gnu.org/licenses/>.
 *
 * @package    O2 Customizer Library
 * @subpackage Range 1.3.0
 *
 * @correction F. VANHOUCKE 1.5.1
 */

namespace CT4GG\Theme\Login\Controls;

require_once ABSPATH . 'wp-includes/class-wp-customize-control.php';

class Range_Slider extends \WP_Customize_Control {


	public $type = 'o2-range-slider';

	public function to_json() {
		if ( ! empty( $this->setting->default ) ) {
			$this->json['default'] = $this->setting->default;
		} else {
			$this->json['default'] = false;
		}
		if ( ! empty( $this->input_attrs ) ) {
			$this->json['max'] = $this->input_attrs['max'];
			$this->json['min'] = $this->input_attrs['min'];
		} else {
			$this->json['max'] = 1000;
			$this->json['min'] = 0;
		}
		if ( isset( $this->choices['percent'] ) ) {
			$this->json['percent'] = $this->choices['percent'];
		} else {
			$this->json['percent'] = false;
		}
		parent::to_json();
	}

	public function enqueue() {
		wp_enqueue_script( 'o2-range-slider', CT4GG_URL . 'assets/js/Login/Controls/range-slider-control.js', array( 'jquery' ), CT4GG_VERSION, true );
		wp_enqueue_style( 'o2-range-slider', CT4GG_URL . 'assets/css/Login/Controls/range-slider-control.css', array(), CT4GG_VERSION );
	}

	public function render_content() {
		?>

		<div>
			<?php if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?>
				<?php if ( isset( $this->choices['percent'] ) && ( false !== $this->choices['percent'] ) ) : ?>
					<div class="button-group" data-setting="align">
						<input type="radio" class="o2-range-slider-buttonset" id="px-<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="px" />
						<label class="button" for="px-<?php echo esc_attr( $this->id ); ?>"><?php esc_html_e( 'px', 'ct4gg' ); ?></label>
						<input type="radio" class="o2-range-slider-buttonset" id="percent-<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="%" />
						<label class="button" for="percent-<?php echo esc_attr( $this->id ); ?>"><?php esc_html_e( '%', 'ct4gg' ); ?></label>
					</div>
				<?php endif; ?>
				</span>
				<?php
			endif;
			if ( ! empty( $this->description ) ) :
				?>
				<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<?php endif; ?>
			<div id="<?php echo esc_attr( $this->id ); ?>">
				<div class="o2-range-slider">
					<input class="o2-range-slider-range" type="range" value="<?php echo intval( $this->value() ); ?>" <?php $this->input_attrs(); ?> />
					<input class="o2-range-slider-value" type="number" value="<?php echo intval( $this->value() ); ?>" <?php $this->input_attrs(); ?> />
					<?php if ( ! empty( $this->setting->default ) ) : ?>
						<span class="o2-range-reset-slider" title="<?php esc_html_e( 'Reset', 'ct4gg' ); ?>"><span class="dashicons dashicons-image-rotate"></span></span>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php
	}
}
