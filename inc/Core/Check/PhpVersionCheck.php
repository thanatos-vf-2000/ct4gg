<?php
/**
 * @package  CT4GGPlugin
 * @Version 0.0.1
 */
namespace CT4GG\Core\Check;

class PhpVersionCheck 
{
    /**
     * Class instance.
     *
     * @since 0.0.1
     * @access private
     * @var $instance Class instance.
     */
    private static $instance;

    public function register() {
		if ( ! isset( self::$instance ) ) {
            self::$instance = new self();
        }
        if ( is_admin() ) {
            if( ! function_exists('get_plugin_data') ){
                require_once(ABSPATH . 'wp-admin/includes/plugin.php' );
            }
            $plugin_data = get_plugin_data(CT4GG_FILE );
            if (self::check($plugin_data['RequiresPHP'], '8.0.10') === false) {
                return;
            }
        }
	}


    public static function check($minVer, $suggestedVer)
    {
        self::$minVer       = $minVer;
        self::$suggestedVer = $suggestedVer;

        if (version_compare(PHP_VERSION, self::$minVer, '<')) {
            if (is_multisite()) {
                add_action('network_admin_notices', array(__CLASS__, 'notice'));
            } else {
                add_action('admin_notices', array(__CLASS__, 'notice'));
            }
            return false;
        } else {
            return true;
        }
    }

    public static function notice()
    {
        if( ! function_exists('get_plugin_data') ){
            require_once(ABSPATH . 'wp-admin/includes/plugin.php' );
        }
        $plugin_data = get_plugin_data(CT4GG_FILE );
        ?>
        <div class="error notice">
            <p>
                <?php
                $str = 'CT4GG Plugin: '.__('Your system is running a very old version of PHP (%s) that is no longer supported by %s.  ', 'ct4gg');
                printf($str, PHP_VERSION, CT4GG_NAME);

                $str = __('Please ask your host or server administrator to update to PHP %1s or greater.', 'ct4gg') . '<br/>';
                $str .= __('If this is not possible, please visit the FAQ link titled ', 'ct4gg');
                $str .= '<a href="' . $plugin_data['Plugin URI'] . '/docs/faqs-tech/" target="blank">';
                $str .= __('"What version of PHP Does Support?"', 'ct4gg');
                $str .= '</a>';
                $str .= __(' for instructions on how to download a previous version of this plugin compatible with PHP %2s.', 'ct4gg');
                printf($str, self::$suggestedVer, PHP_VERSION);
                ?>
            </p>
        </div>
        <?php
    }
}