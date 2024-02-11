<?php
/**
 * Radio Images Customizer Control - O2 Customizer Library
 *
 * This control adds radio images to the Customizer which allows
 * you to choose one of the listed images.
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
 * @subpackage Radio Images
 * @since      1.3.0
 *
 * @correction F. VANHOUCKE 1.5.1
 */

namespace CT4GG\Theme\Login\Controls;

require_once ABSPATH . 'wp-includes/class-wp-customize-control.php';

class Radio_Images extends \WP_Customize_Control {


	public $type = 'o2-radio-images';

	public function enqueue() {
		wp_enqueue_style( 'o2-radio-images', CT4GG_URL . 'assets/css/Login/Controls/radio-images-control.css', array(), CT4GG_VERSION );
	}

	public function render_content() {
		?>
		<label>
			<?php if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif; ?>
			<?php if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<?php endif; ?>
			<div id="input_<?php echo esc_attr( $this->id ); ?>" class="image">
			<?php foreach ( $this->choices as $value => $label ) : ?>
				<input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" name="_customize-radio-<?php echo esc_attr( $this->id ); ?>" id="<?php echo esc_attr( $this->id ); ?><?php echo esc_attr( $value ); ?>" <?php $this->link(); ?> <?php checked( $this->value(), $value ); ?> >
					<label for="<?php echo esc_attr( $this->id ); ?><?php echo esc_attr( $value ); ?>">
						<img src="<?php echo esc_attr( $label ); ?>">
						<span class="image-clickable"></span>
					</label>
				</input>
			<?php endforeach; ?>
			</div>
		</label>
		<?php
	}
}
