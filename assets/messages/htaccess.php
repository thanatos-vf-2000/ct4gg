<?php
/**
 * Message version
 *
 * @package tfm4ct4ggwp
 * @since 1.1.0
 */

if ( $type == 'ct4gg-htaccess-ko' ) :?>
    <div class="notice notice-alt notice-error notice-large">
        <h4><?php _e('$_POST error (ct4gg-htaccess-ko)', 'ct4gg'); ?></h4>
        <p>
            <?php _e('impossible to retrieve the variable <strong>ct4gg-htaccess-ko</strong>.', 'ct4gg'); ?> <br/>
        </p>
    </div>
<?php endif;
if ( $type == 'backup-ko' ) :?>
    <div class="notice notice-alt notice-error notice-large">
        <h4><?php _e('Backup failed!', 'ct4gg'); ?></h4>
        <p>
            <?php _e('backup file .htaccess failed. ', 'ct4gg'); ?><br/>
        </p>
    </div>
<?php endif;
if ( $type == 'delete-ko' ) :?>
    <div class="notice notice-alt notice-error notice-large">
        <h4><?php _e('Delete failed!', 'ct4gg'); ?></h4>
        <p>
            <?php _e('Unable to delete the file: ', 'ct4gg'); ?><strong><?php echo esc_html($_POST['ct4gg-htaccess']);?> </strong> <br/>
        </p>
    </div>
<?php endif;
if ( $type == 'delete-ok' ) :?>
    <div class="notice notice-alt notice-info notice-large">
        <h4><?php _e('Delete file successfuly.', 'ct4gg'); ?></h4>
        <p>
            <?php _e('Delete file: ', 'ct4gg'); ?> <strong><?php echo esc_html($_POST['ct4gg-htaccess']);?> </strong> <br/>
        </p>
    </div>
<?php endif;
if ( $type == 'copy-ko' ) :?>
    <div class="notice notice-alt notice-error notice-large">
        <h4><?php _e('Copy failed!', 'ct4gg'); ?></h4>
        <p>
            <?php _e('Unable to copy the file: ', 'ct4gg'); ?><strong><?php echo esc_html($_POST['ct4gg-htaccess']);?> </strong> => .htaccess<br/>
        </p>
    </div>
<?php endif;
if ( $type == 'copy-ok' ) :?>
    <div class="notice notice-alt notice-info notice-large">
        <h4><?php _e('Copy file successfuly.', 'ct4gg'); ?></h4>
        <p>
            <?php _e('Copy file: ', 'ct4gg'); ?> <strong><?php echo esc_html($_POST['ct4gg-htaccess']);?> </strong> => .htaccess<br/>
        </p>
    </div>
<?php endif;
if ( $type == 'update-ko' ) :?>
    <div class="notice notice-alt notice-error notice-large">
        <h4><?php _e('Update failed!', 'ct4gg'); ?></h4>
        <p>
            <?php _e('Unable to update the file: ', 'ct4gg'); ?><strong>.htaccess </strong>.<br/>
        </p>
    </div>
<?php endif;
if ( $type == 'update-ok' ) :?>
    <div class="notice notice-alt notice-info notice-large">
        <h4><?php _e('Update file successfuly.', 'ct4gg'); ?></h4>
        <p>
            <?php _e('Update file: ', 'ct4gg'); ?> <strong>.htaccess </strong>.<br/>
        </p>
    </div>
<?php endif;?>
