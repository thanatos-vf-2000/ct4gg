<?php 
/**
 * @package  CT4GGPlugin
 * @Version 1.4.3
 */
namespace CT4GG\Api\Callbacks;

use CT4GG\Core\BaseController;
use CT4GG\Core\Options;

class ManagerCallbacks extends BaseController
{
	public function checkboxSanitize( $input )
	{
		$output = array();

		$all_defaults = $this->loadPHPConfig(CT4GG_PATH . 'assets/defaults.php');

		foreach ( $this->managers as $key => $value ) {
			if (isset($all_defaults[$key])) {
				$config = $all_defaults[$key];
				if ($config['type'] == "checkboxField") {
					$output[$key] = isset( $input[$key] ) ? true : false;
				} else {
					$output[$key] = $input[$key];
				}
			}
		}

		return $output;
	}

	public function adminIndexSectionManager()
	{
		echo __('Manage the Sections and Features of this Plugin by activating options.','ct4gg');
	}

	public function adminLoginSectionManager()
	{
		if (Options::get_option('login_screen_v2') == false) {
			echo __('Manage the screen login <b style="color:red">Old version please use the new version section "Login Custom"</b>.','ct4gg');
		}
		
	}

	public function adminSettingSectionManager()
	{
		echo __('Manage the Sections and Features of WP Administration Dashboard by activating options.','ct4gg');
	}

	public function postSettingSectionManager()
	{
		echo __('Manage the Sections and Features of post and articles activating the checkboxes from the following list.','ct4gg');
	}

	public function htaccessSettingSectionManager()
	{
		echo __('Management of options to be included in the .htaccess file.','ct4gg');
	}

	public function robotsSettingSectionManager()
	{
		echo __('Management of options to be included in the robots.txt file.','ct4gg');
	}

	public function humansSettingSectionManager()
	{
		echo __('Management of options to be included in the humans.txt file.','ct4gg');
	}

	public function loginSettingSectionManager()
	{
		_e('Manage the screen login <b style="color:blue">New version</b>.<br>After saving the options go to <b>"Appearance (Themes)"</b> and choose <b>"Login Custom"</b> <b style="color:red">or</b> in the menu of <b>this plugin</b> chose <b>"Login Custom"</b>.','ct4gg');
	}

	public function socialbuttonsSettingSectionManager()
	{
		_e('Management of options for Social Buttons.<br>This will create a wordpress shortcode <b style="color:blue">[ct4gg_social]</b>.','ct4gg');
	}

	public function checkboxField( $args )
	{
		$name = $args['label_for'];
		$classes = $args['class'];
		$option_name = $args['option_name'];
		$checkbox = get_option( $option_name );
		$checked = isset($checkbox[$name]) ? ($checkbox[$name] ? true : false) : false;

		echo '<div class="' . esc_attr($classes) . '"><input type="checkbox" id="' . esc_attr($name) . '" name="' . esc_attr($option_name) . '[' . esc_attr($name) . ']" value="1" class="" ' . ( esc_attr($checked) ? 'checked' : '') . '><label for="' . esc_attr($name) . '"><div></div></label></div>';

		if ($args['message'] <> '') {echo '<p class="description">' . esc_html($args['message']) . '</p>';}
	}

	public function listField($args)
	{
		$name = $args['label_for'];
		$classes = $args['class'];
		$option_name = $args['option_name'];

		echo '<div class="' . esc_attr($classes) . '"><select id="' . esc_attr($name) . '" name="' . esc_attr($option_name) . '[' . esc_attr($name) . ']">';
		foreach ($args['choices'] as $value => $label) :
			$opt = ($args['value'] == $value) ? 'selected' : '';
			echo '<option value="' . esc_attr($value) . '" ' . esc_attr($opt) . '>' . esc_html($label) . '</option>';
		endforeach;
		?>
			</select>
		</div>
		<?php
		if ($args['message'] <> '') {echo '<p class="description">' . esc_html($args['message']) . '</p>';}

	}

	public function ImageField($args)
	{
		$name = $args['label_for'];
		$classes = $args['class'];
		$option_name = $args['option_name'];
		echo '<div class="' . esc_attr($classes) . '">
				<input id="upload_image" type="text" size="36" name="' . esc_attr($option_name) . '[' . esc_attr($name) . ']" value="' . esc_attr($args['value']) . '" /> 
				<input id="upload_image_button" for="' . esc_attr($option_name) . '[' . esc_attr($name) . ']" class="button" type="button" value="' . __('Upload Menu', 'ct4gg') . '" />
				<br>
				<img id="imageBox" name="' . esc_attr($option_name) . '[' . esc_attr($name) . ']" style="height: ' . $args['height'] . '; width: ' . $args['width'] . ';" src="' . esc_url($args['value']) . '">
			</div>';
	}

	public function ColorField($args)
	{
		$name = $args['label_for'];
		$classes = $args['class'];
		$option_name = $args['option_name'];
		echo '<p>
			<label for="' . $option_name . '[' . $name . ']" style="display:block;">' . __( 'Color:', 'ct4gg' ) .'</label> 
			<input class="color-picker" id="' . esc_attr($option_name) . '[' . esc_attr($name) . ']" name="' . esc_attr($option_name) . '[' . esc_attr($name) . ']" type="text" value="' . esc_attr($args['value']) . '" />
		</p>';
	}

	public function TextField($args)
	{
		$name = $args['label_for'];
		$classes = $args['class'];
		$option_name = $args['option_name'];
		echo '<div class="' . esc_attr($classes) . '">
				<input id="'. esc_attr($name) .'" type="text" size="50" name="' . esc_attr($option_name) . '[' . esc_attr($name) . ']" value="' . esc_attr($args['value']) . '" /> 
			</div>';
		if ($args['message'] <> '') {echo '<p class="description">' . esc_html($args['message']) . '</p>';}
	}

	public function TextAreaField($args)
	{
		$name = $args['label_for'];
		$classes = $args['class'];
		$option_name = $args['option_name'];
		echo '<div class="' . esc_attr($classes) . '">
				<textarea id="'. esc_attr($name) .'" name="' . esc_attr($option_name) . '[' . esc_attr($name) . ']" rows="'. esc_attr($args['rows']) .'" cols="'. esc_attr($args['cols']) .'" >' . esc_attr($args['value']) . '</textarea> 
			</div>';
		if ($args['message'] <> '') {echo '<p class="description">' . esc_html($args['message']) . '</p>';}
	}

	public function TextFieldUrl($args)
	{
		$value = $args['value'];
		$name = $args['label_for'];
		$classes = $args['class'];
		$option_name = $args['option_name'];
		$class = explode("_",$name);
		
		echo '<div class="' . esc_attr($classes) . '" >
				<input id="'. esc_attr($name) .'" type="text" size="20" name="' . esc_attr($option_name) . '[' . esc_attr($name) . ']" value="' . esc_attr($value) . '" class="' . esc_attr($class[0] . '-'.$class[1]).'"/>
				<em>' . site_url() . '/<b id="'. esc_attr($name) .'_txt">' . esc_attr($value) . '</b></em>
			</div>';
	}

	private function loadPHPConfig($path)
        {
            if ( ! file_exists($path)) {
                return array();
            }
            $content = require $path;
            return $content;
        }
}