<?php
/**FunctionTemplate header
 *
 * PHP version 7
 *
 * @category  PHP
 * @package   CT4GGPlugin
 * @author    Franck VANHOUCKE <ct4gg@ginkgos.net>
 * @copyright 2021-2023 Copyright 2023, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later
 * @version   1.5.2 GIT:https://github.com/thanatos-vf-2000/WordPress
 * @link      https://ginkgos.net
 */

 if (!(PHP_VERSION_ID <= 80000)) {
    function esc_txt( $text ) {
        $safe_text = (string) $text;
        return apply_filters( 'esc_txt', $safe_text, $text );
    }
}