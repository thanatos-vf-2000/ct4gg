<?php 
/**
 * @package  CT4GGPlugin
 * @Version 1.2.0
 */
namespace CT4GG\Api\Callbacks;

use CT4GG\Core\BaseController;

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
		echo __('Manage the Sections and Features of this Plugin by activating the checkboxes from the following list.','ct4gg');
	}

	public function adminLoginSectionManager()
	{
		echo __('Manage the screen login	.','ct4gg');
	}

	public function adminSettingSectionManager()
	{
		echo __('Manage the Sections and Features of WP Administration Dashboard by activating the checkboxes from the following list.','ct4gg');
	}

	public function postSettingSectionManager()
	{
		echo __('Manage the Sections and Features of post and articles activating the checkboxes from the following list.','ct4gg');
	}

	public function htaccessSettingSectionManager()
	{
		echo __('Management of options to be included in the .htaccess file. <b style="color:red">Please go to htaccess menu for apply this parameters.</b>','ct4gg');
	}

	public function robotsSettingSectionManager()
	{
		echo __('Management of options to be included in the robots.txt file. <b style="color:red">Please go to robots menu for apply this parameters.</b>','ct4gg');
	}

	public function humansSettingSectionManager()
	{
		echo __('Management of options to be included in the humans.txt file. <b style="color:red">Please go to humans menu for apply this parameters.</b>','ct4gg');
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

	private function loadPHPConfig($path)
        {
            if ( ! file_exists($path)) {
                return array();
            }
            $content = require $path;
            return $content;
        }
}