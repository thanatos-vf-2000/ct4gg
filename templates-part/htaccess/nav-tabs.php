<?php
/**
 * Template Nav tabs
 *
 * PHP version 7
 *
 * @category  PHP
 * @package   CT4GGPlugin
 * @author    Franck VANHOUCKE <ct4gg@ginkgos.net>
 * @copyright 2021-2023 Copyright 2023, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later
 * @version   1.4.8 GIT:https://github.com/thanatos-vf-2000/WordPress
 * @link      https://ginkgos.net
 */
?>
    <ul class="nav ct4gg-nav-tabs">
        <li class="<?php echo esc_html(((isset($_POST['tab']) && sanitize_text_field($_POST['tab']) == 'tab-1') || !isset($_POST['tab'])) ? 'active':'');?>"><a href="#tab-1"><?php _e('Display', 'ct4gg'); ?></a></li>
        <li class="<?php echo esc_html((isset($_POST['tab']) && sanitize_text_field($_POST['tab']) == 'tab-2') ? 'active' : '');?>"><a href="#tab-2"><?php _e('Restore .htaccess', 'ct4gg'); ?></a></li>
    </ul>
