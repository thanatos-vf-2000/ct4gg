<?php
/**
 * @package CT4GGPlugin
 * @version 1.5.6
 */


function ct4gg_t( $text,  $domain = 'ct4gg') {
    return did_action( 'init' )
        ? __( $text, $domain )
        : $text;
}