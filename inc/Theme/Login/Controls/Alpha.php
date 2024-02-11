<?php
/**
 * Alpha Color Picker Customizer Control
 *
 * This control adds a second slider for opacity to the stock WordPress color picker,
 * and it includes logic to seamlessly convert between RGBa and Hex color values as
 * opacity is added to or removed from a color.
 *
 * This Alpha Color Picker is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this Alpha Color Picker. If not, see <https://www.gnu.org/licenses/>.
 *
 * @subpackage Range 1.3.0
 */

namespace CT4GG\Theme\Login\Controls;

require_once ABSPATH . 'wp-includes/class-wp-customize-control.php';

/**
 * Alpha Color Control Class for Customizer
 *
 * @author  Hardeep Asrani
 * @version 2.2.0
 * @correction F. VANHOUCKE 1.5.1
 */
class Alpha extends \WP_Customize_Control {


	public $type    = 'alphacolor';
	public $palette = true;
	public $default = array();

	public function to_json() {
		if ( ! empty( $this->setting->default ) ) {
			$this->json['default'] = $this->setting->default;
		} else {
			$this->json['default'] = false;
		}
		parent::to_json();
	}

	/**
	 * Function to Enqueue styling and scripts
	 *
	 * @return void
	 */
	public function enqueue() {
		wp_enqueue_script( CT4GG_NAME . '-alpha', CT4GG_URL . 'assets/js/Login/Controls/alpha-control.js', array( 'jquery' ), CT4GG_VERSION, true );
		wp_enqueue_style( CT4GG_NAME . '-alpha', CT4GG_URL . 'assets/css/Login/Controls/alpha_control.css', array(), CT4GG_VERSION );
	}

	public function render_content() {
		?>
		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
		<label>
			<input type="text" data-palette="<?php echo esc_attr( $this->palette ); ?>" data-default-color="<?php echo esc_attr( $this->setting->default ); ?>" value="<?php echo intval( $this->value() ); ?>" class="ct4gg-color-control" <?php $this->link(); ?>  />
		</label>
		<?php
	}
}

