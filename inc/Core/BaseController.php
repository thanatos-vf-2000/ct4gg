<?php 
/**
 * @package  CT4GGPlugin
 * @Version 1.1.0
 */
namespace CT4GG\Core;

class BaseController
{
	public $plugin_path;

	public $plugin_url;

	public $plugin;

	public $managers = array();

	public function __construct() {
		$this->plugin_path = CT4GG_PATH;
		$this->plugin_url = CT4GG_URL;
		$this->plugin = CT4GG_NAME;
		$this->managers = array_merge(array(), Options::get_options());
	}

	public function activated( string $key )
	{
		$option = get_option( CT4GG_NAME.'_plugin' );

		return isset( $option[ $key ] ) ? $option[ $key ] : false;
	}

	/**
     * Get Template File
     *
     * @param $template
     * @param array $args
     */
    public static function get_template($template)
    {

        // Check Load single file or array list
        if (is_string($template)) {
            $template = explode(" ", $template);
        }

        // Load File
        foreach ($template as $file) {

            $template_file = CT4GG_PATH . "templates-part/" . $file . ".php";
            if (!file_exists($template_file)) {
                continue;
            }

            // include File
            include $template_file;
        }
    }

    /**
     * Get Template File
     *
     * @param $template
     * @param array $args
     */
    public static function view( $name, array $args = array() ) {
        $args = apply_filters( 'ct4gg_view_arguments', $args, $name );
        
        foreach ( $args AS $key => $val ) {
            $$key = $val;
        }
        
        load_plugin_textdomain( 'ct4gg' );

        $file = CT4GG_PATH . 'assets/messages/'. $name . '.php';

        include( $file );
    }
}