<?php
/**
 * Message llms
 *
 * PHP version 7
 *
 * @category  PHP
 * @package   CT4GGPlugin
 * @author    Franck VANHOUCKE <ct4gg@ginkgos.net>
 * @copyright 2021-2026 Copyright 2026, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later
 * @version   1.6.0 GIT:https://github.com/thanatos-vf-2000/ct4gg
 * @link      https://ginkgos.net
 * @since     1.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( isset( $_POST[ CT4GG_NAME . '-verif' ] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ CT4GG_NAME . '-verif' ] ) ), CT4GG_NAME . '-opt' ) ) {

	if ( isset( $_POST['ct4gg-llms'] ) ) {
		$ct4gg_llms = sanitize_text_field( wp_unslash( $_POST['ct4gg-llms'] ) );
	} else {
		$ct4gg_llms = '';
	}
	if ( 'ct4gg-llms-ko' === $type ) :?>
		<div class="notice notice-alt notice-error notice-large">
			<h4><?php esc_html_e( '$_POST error (ct4gg-llms-ko)', 'ct4gg' ); ?></h4>
			<p>
		<?php esc_html_e( 'impossible to retrieve the variable <strong>ct4gg-llms-ko</strong>.', 'ct4gg' ); ?> <br/>
			</p>
		</div>
		<?php
	endif;
	if ( 'backup-ko' === $type ) :
		?>
		<div class="notice notice-alt notice-error notice-large">
			<h4><?php esc_html_e( 'Backup failed!', 'ct4gg' ); ?></h4>
			<p>
		<?php esc_html_e( 'backup file llms.txt failed. ', 'ct4gg' ); ?><br/>
			</p>
		</div>
		<?php
	endif;
	if ( 'delete-ko' === $type ) :
		?>
		<div class="notice notice-alt notice-error notice-large">
			<h4><?php esc_html_e( 'Delete failed!', 'ct4gg' ); ?></h4>
			<p>
		<?php esc_html_e( 'Unable to delete the file: ', 'ct4gg' ); ?><strong><?php echo esc_html( $ct4gg_llms ); ?> </strong> <br/>
			</p>
		</div>
		<?php
	endif;
	if ( 'delete-ok' === $type ) :
		?>
		<div class="notice notice-alt notice-success notice-large">
			<h4><?php esc_html_e( 'Delete file successfuly.', 'ct4gg' ); ?></h4>
			<p>
		<?php esc_html_e( 'Delete file: ', 'ct4gg' ); ?> <strong><?php echo esc_html( $ct4gg_llms ); ?> </strong> <br/>
			</p>
		</div>
		<?php
	endif;
	if ( 'copy-ko' === $type ) :
		?>
		<div class="notice notice-alt notice-error notice-large">
			<h4><?php esc_html_e( 'Copy failed!', 'ct4gg' ); ?></h4>
			<p>
		<?php esc_html_e( 'Unable to copy the file: ', 'ct4gg' ); ?><strong><?php echo esc_html( $ct4gg_llms ); ?> </strong> => llms.txt<br/>
			</p>
		</div>
		<?php
	endif;
	if ( 'copy-ok' === $type ) :
		?>
		<div class="notice notice-alt notice-success notice-large">
			<h4><?php esc_html_e( 'Copy file successfuly.', 'ct4gg' ); ?></h4>
			<p>
		<?php esc_html_e( 'Copy file: ', 'ct4gg' ); ?> <strong><?php echo esc_html( $ct4gg_llms ); ?> </strong> => llms.txt<br/>
			</p>
		</div>
		<?php
	endif;
	if ( 'update-ko' === $type ) :
		?>
		<div class="notice notice-alt notice-error notice-large">
			<h4><?php esc_html_e( 'Update failed!', 'ct4gg' ); ?></h4>
			<p>
		<?php esc_html_e( 'Unable to update the file: ', 'ct4gg' ); ?><strong>llms.txt </strong>.<br/>
			</p>
		</div>
		<?php
	endif;
	if ( 'update-ok' === $type ) :
		?>
		<div class="notice notice-alt notice-success notice-large">
			<h4><?php esc_html_e( 'Update file successfuly.', 'ct4gg' ); ?></h4>
			<p>
		<?php esc_html_e( 'Update file: ', 'ct4gg' ); ?> <strong>llms.txt </strong>.<br/>
			</p>
		</div>
		<?php
	endif;
}
