<?php
/**
 * Message version
 *
 * @package ct4gg
 * @since   1.3.0
 * @version 1.4.8
 */

if ($type == 'ct4gg-humans-ko') :?>
    <div class="notice notice-alt notice-error notice-large">
        <h4><?php _e('$_POST error (ct4gg-humans-ko)', 'ct4gg'); ?></h4>
        <p>
            <?php _e('impossible to retrieve the variable <strong>ct4gg-humans-ko</strong>.', 'ct4gg'); ?> <br/>
        </p>
    </div>
<?php endif;
if ($type == 'backup-ko') :?>
    <div class="notice notice-alt notice-error notice-large">
        <h4><?php _e('Backup failed!', 'ct4gg'); ?></h4>
        <p>
            <?php _e('backup file humans.txt failed. ', 'ct4gg'); ?><br/>
        </p>
    </div>
<?php endif;
if ($type == 'delete-ko') :?>
    <div class="notice notice-alt notice-error notice-large">
        <h4><?php _e('Delete failed!', 'ct4gg'); ?></h4>
        <p>
            <?php _e('Unable to delete the file: ', 'ct4gg'); ?><strong><?php echo esc_html($_POST['ct4gg-humans']);?> </strong> <br/>
        </p>
    </div>
<?php endif;
if ($type == 'delete-ok') :?>
    <div class="notice notice-alt notice-success notice-large">
        <h4><?php _e('Delete file successfuly.', 'ct4gg'); ?></h4>
        <p>
            <?php _e('Delete file: ', 'ct4gg'); ?> <strong><?php echo esc_html($_POST['ct4gg-humans']);?> </strong> <br/>
        </p>
    </div>
<?php endif;
if ($type == 'copy-ko') :?>
    <div class="notice notice-alt notice-error notice-large">
        <h4><?php _e('Copy failed!', 'ct4gg'); ?></h4>
        <p>
            <?php _e('Unable to copy the file: ', 'ct4gg'); ?><strong><?php echo esc_html($_POST['ct4gg-humans']);?> </strong> => humans.txt<br/>
        </p>
    </div>
<?php endif;
if ($type == 'copy-ok') :?>
    <div class="notice notice-alt notice-success notice-large">
        <h4><?php _e('Copy file successfuly.', 'ct4gg'); ?></h4>
        <p>
            <?php _e('Copy file: ', 'ct4gg'); ?> <strong><?php echo esc_html($_POST['ct4gg-humans']);?> </strong> => humans.txt<br/>
        </p>
    </div>
<?php endif;
if ($type == 'update-ko') :?>
    <div class="notice notice-alt notice-error notice-large">
        <h4><?php _e('Update failed!', 'ct4gg'); ?></h4>
        <p>
            <?php _e('Unable to update the file: ', 'ct4gg'); ?><strong>humans.txt </strong>.<br/>
        </p>
    </div>
<?php endif;
if ($type == 'update-ok') :?>
    <div class="notice notice-alt notice-success notice-large">
        <h4><?php _e('Update file successfuly.', 'ct4gg'); ?></h4>
        <p>
            <?php _e('Update file: ', 'ct4gg'); ?> <strong>humans.txt </strong>.<br/>
        </p>
    </div>
<?php endif;?>
