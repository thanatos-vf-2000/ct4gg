<?php
/**
 * Manager Callbacks
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
 * @since     1.0.0
 */

namespace CT4GG\Api\Callbacks;

use CT4GG\Core\BaseController;
use CT4GG\Core\Options;

/**
 * Class ManagerCallbacks
 */
class ManagerCallbacks extends BaseController {

	/**
	 * Function checkboxSanitize
	 *
	 * @param array $input Array data
	 *
	 * @return Output
	 */
	public function checkboxSanitize( $input ) {
		$output = array();

		$all_defaults = $this->load_php_config( CT4GG_PATH . 'assets/defaults.php' );

		foreach ( $this->managers as $key => $value ) {
			if ( isset( $all_defaults[ $key ] ) ) {
				$config = $all_defaults[ $key ];
				if ( 'checkboxField' === $config['type'] ) {
					$output[ $key ] = isset( $input[ $key ] ) ? true : false;
				} else {
					$output[ $key ] = $input[ $key ];
				}
			}
		}

		return $output;
	}

	/**
	 * Function adminIndexSectionManager
	 *
	 * @return message
	 */
	public function adminIndexSectionManager() {
		esc_html_e( 'Manage the Sections and Features of this Plugin by activating options.', 'ct4gg' );
	}

	/**
	 * Function adminLoginSectionManager
	 *
	 * @return message
	 */
	public function adminLoginSectionManager() {
		if ( Options::get_option( 'login_screen_v2' ) === false ) {
			esc_html_e( 'Manage the screen login <b style="color:red">Old version please use the new version section "Login Custom"</b>.', 'ct4gg' );
		}
	}

	/**
	 * Function adminSettingSectionManager
	 *
	 * @return message
	 */
	public function adminSettingSectionManager() {
		esc_html_e( 'Manage the Sections and Features of WP Administration Dashboard by activating options.', 'ct4gg' );
	}

	/**
	 * Function postSettingSectionManager
	 *
	 * @return message
	 */
	public function postSettingSectionManager() {
		esc_html_e( 'Manage the Sections and Features of post and articles activating the checkboxes from the following list.', 'ct4gg' );
	}

	/**
	 * Function htaccessSettingSectionManager
	 *
	 * @return message
	 */
	public function htaccessSettingSectionManager() {
		esc_html_e( 'Management of options to be included in the .htaccess file.', 'ct4gg' );
	}

	/**
	 * Function robotsSettingSectionManager
	 *
	 * @return message
	 */
	public function robotsSettingSectionManager() {
		esc_html_e( 'Management of options to be included in the robots.txt file.', 'ct4gg' );
	}

	/**
	 * Function humansSettingSectionManager
	 *
	 * @return message
	 */
	public function humansSettingSectionManager() {
		esc_html_e( 'Management of options to be included in the humans.txt file.', 'ct4gg' );
	}

	/**
	 * Function securitySettingSectionManager
	 *
	 * @return message
	 */
	public function securitySettingSectionManager() {
		esc_html_e( 'Security of options to be included in the security.txt file.', 'ct4gg' );
	}

	/**
	 * Function loginSettingSectionManager
	 *
	 * @return message
	 */
	public function loginSettingSectionManager() {
		esc_html_e( 'Manage the screen login <b style="color:blue">New version</b>.<br>After saving the options go to <b>"Appearance (Themes)"</b> and choose <b>"Login Custom"</b> <b style="color:red">or</b> in the menu of <b>this plugin</b> chose <b>"Login Custom"</b>.', 'ct4gg' );
	}

	/**
	 * Function socialbuttonsSettingSectionManager
	 *
	 * @return message
	 */
	public function socialbuttonsSettingSectionManager() {
		esc_html_e( 'Management of options for Social Buttons.<br>This will create a WordPress shortcode <b style="color:blue">[ct4gg_social]</b>.', 'ct4gg' );
	}

	/**
	 * Function adminHeaderCheckManager
	 *
	 * @return message
	 */
	public function adminHeaderCheckManager() {
		esc_html_e( 'Management of options for headers check (Security, Information and cache).', 'ct4gg' );
	}

	/**
	 * Function checkboxField
	 *
	 * @param $args Array data
	 *
	 * @return Output
	 */
	public function checkboxField( $args ) {
		$name        = $args['label_for'];
		$classes     = $args['class'];
		$option_name = $args['option_name'];
		$checkbox    = get_option( $option_name );
		$checked     = isset( $checkbox[ $name ] ) ? ( $checkbox[ $name ] ? true : false ) : false;

		echo '<div class="' . esc_attr( $classes ) . '"><input type="checkbox" id="' . esc_attr( $name ) . '" name="' . esc_attr( $option_name ) . '[' . esc_attr( $name ) . ']" value="1" class="" ' . ( esc_attr( $checked ) ? 'checked' : '' ) . '><label for="' . esc_attr( $name ) . '"><div></div></label></div>';

		if ( '' !== $args['message'] ) {
			echo '<p class="description">' . esc_html( $args['message'] ) . '</p>';
		}
	}

	/**
	 * Function listField
	 *
	 * @param array $args Array data
	 *
	 * @return Output
	 */
	public function listField( $args ) {
		$name        = $args['label_for'];
		$classes     = $args['class'];
		$option_name = $args['option_name'];

		echo '<div class="' . esc_attr( $classes ) . '"><select id="' . esc_attr( $name ) . '" name="' . esc_attr( $option_name ) . '[' . esc_attr( $name ) . ']">';
		foreach ( $args['choices'] as $value => $label ) :
			$opt = ( $args['value'] === $value ) ? 'selected' : '';
			echo '<option value="' . esc_attr( $value ) . '" ' . esc_attr( $opt ) . '>' . esc_html( $label ) . '</option>';
		endforeach;
		?>
			</select>
		</div>
		<?php
		if ( '' !== $args['message'] ) {
			echo '<p class="description">' . esc_html( $args['message'] ) . '</p>';
		}
	}

	/**
	 * Function imageField
	 *
	 * @param array $args Array data
	 *
	 * @return Output
	 */
	public function imageField( $args ) {
		$name        = $args['label_for'];
		$classes     = $args['class'];
		$option_name = $args['option_name'];
		echo '<div class="' . esc_attr( $classes ) . '">
				<input id="upload_image" type="text" size="36" name="' . esc_attr( $option_name ) . '[' . esc_attr( $name ) . ']" value="' . esc_attr( $args['value'] ) . '" /> 
				<input id="upload_image_button" for="' . esc_attr( $option_name ) . '[' . esc_attr( $name ) . ']" class="button" type="button" value="' . esc_attr( __( 'Upload Menu', 'ct4gg' ) ) . '" />
				<br>
				<img id="imageBox" name="' . esc_attr( $option_name ) . '[' . esc_attr( $name ) . ']" style="height: ' . esc_attr( $args['height'] ) . '; width: ' . esc_attr( $args['width'] ) . ';" src="' . esc_url( $args['value'] ) . '">
			</div>';
	}

	/**
	 * Function colorField
	 *
	 * @param array $args Array data
	 *
	 * @return Output
	 */
	public function colorField( $args ) {
		$name        = $args['label_for'];
		$classes     = $args['class'];
		$option_name = $args['option_name'];
		echo '<p>
			<label for="' . esc_attr( $option_name ) . '[' . esc_attr( $name ) . ']" style="display:block;">' . esc_attr( __( 'Color:', 'ct4gg' ) ) . '</label> 
			<input class="color-picker" id="' . esc_attr( $option_name ) . '[' . esc_attr( $name ) . ']" name="' . esc_attr( $option_name ) . '[' . esc_attr( $name ) . ']" type="text" value="' . esc_attr( $args['value'] ) . '" />
		</p>';
	}

	/**
	 * Function textField
	 *
	 * @param array $args Array data
	 *
	 * @return Output
	 */
	public function textField( $args ) {
		$name        = $args['label_for'];
		$classes     = $args['class'];
		$option_name = $args['option_name'];
		echo '<div class="' . esc_attr( $classes ) . '">
				<input id="' . esc_attr( $name ) . '" type="text" size="50" name="' . esc_attr( $option_name ) . '[' . esc_attr( $name ) . ']" value="' . esc_attr( $args['value'] ) . '" /> 
			</div>';
		if ( '' !== $args['message'] ) {
			echo '<p class="description">' . esc_html( $args['message'] ) . '</p>';
		}
	}

	/**
	 * Function textAreaField
	 *
	 * @param array $args Array data
	 *
	 * @return Output
	 */
	public function textAreaField( $args ) {
		$name        = $args['label_for'];
		$classes     = $args['class'];
		$option_name = $args['option_name'];
		echo '<div class="' . esc_attr( $classes ) . '">
				<textarea id="' . esc_attr( $name ) . '" name="' . esc_attr( $option_name ) . '[' . esc_attr( $name ) . ']" rows="' . esc_attr( $args['rows'] ) . '" cols="' . esc_attr( $args['cols'] ) . '" >' . esc_attr( $args['value'] ) . '</textarea> 
			</div>';
		if ( '' !== $args['message'] ) {
			echo '<p class="description">' . esc_html( $args['message'] ) . '</p>';
		}
	}

	/**
	 * Function textFieldUrl
	 *
	 * @param array $args Array data
	 *
	 * @return Output
	 */
	public function textFieldUrl( $args ) {
		$value       = $args['value'];
		$name        = $args['label_for'];
		$classes     = $args['class'];
		$option_name = $args['option_name'];
		$class       = explode( '_', $name );

		echo '<div class="' . esc_attr( $classes ) . '" >
				<input id="' . esc_attr( $name ) . '" type="text" size="20" name="' . esc_attr( $option_name ) . '[' . esc_attr( $name ) . ']" value="' . esc_attr( $value ) . '" class="' . esc_attr( $class[0] . '-' . $class[1] ) . '"/>
				<em>' . esc_url( site_url() ) . '/<b id="' . esc_attr( $name ) . '_txt">' . esc_attr( $value ) . '</b></em>
			</div>';
	}

	/**
	 * Function dateField
	 *
	 * @param array $args Array data
	 *
	 * @return Output
	 */
	public function dateField( $args ) {
		$name        = $args['label_for'];
		$classes     = $args['class'];
		$option_name = $args['option_name'];
		echo '<div class="' . esc_attr( $classes ) . '">
				<input id="' . esc_attr( $name ) . '" type="date" placeholder="YYYY-MM-DD" name="' . esc_attr( $option_name ) . '[' . esc_attr( $name ) . ']" value="' . esc_attr( $args['value'] ) . '" /> 
			</div>';
		if ( '' !== $args['message'] ) {
			echo '<p class="description">' . esc_html( $args['message'] ) . '</p>';
		}
	}

	/**
	 * Function timeField
	 *
	 * @param array $args Array data
	 *
	 * @return Output
	 */
	public function timeField( $args ) {
		$name        = $args['label_for'];
		$classes     = $args['class'];
		$option_name = $args['option_name'];
		echo '<div class="' . esc_attr( $classes ) . '">
				<input id="' . esc_attr( $name ) . '" type="time" placeholder="HH:MM" name="' . esc_attr( $option_name ) . '[' . esc_attr( $name ) . ']" value="' . esc_attr( $args['value'] ) . '" /> 
			</div>';
		if ( '' !== $args['message'] ) {
			echo '<p class="description">' . esc_html( $args['message'] ) . '</p>';
		}
	}

	/**
	 * Function load_php_config
	 *
	 * @param string $path File name
	 *
	 * @return Content of file
	 */
	private function load_php_config( $path ) {
		if ( ! file_exists( $path ) ) {
			return array();
		}
			$content = include $path;
			return $content;
	}
}
