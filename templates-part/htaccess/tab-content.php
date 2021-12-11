<?php
/**
 * @package  CT4GGPlugin
 * @Version 1.2.0
 * 
 * Desciption: nav-content for htaccess
 */
use CT4GG\Api\FileHTAcccess;
?>
	<div class="ct4gg-tab-content">
		<div id="tab-1" class="ct4gg-tab-pane <?php echo esc_html(((isset($_POST['tab']) && $_POST['tab'] == 'tab-1') || !isset($_POST['tab'])) ? 'active':'');?>">

		<form method="post" >
			<input type="hidden" name="page" value="ct4gg_htaccess"/>
			<input type="hidden" name="tab" value="tab-1"/>
			<?php wp_nonce_field(CT4GG_NAME.'-opt', CT4GG_NAME.'-verif'); ?>
			<p style="color:red"><?php _e('Management of options to be included in the .htaccess file on Settings option.', 'ct4gg'); ?></p>
			<p><?php submit_button( __("Update Htaccess", 'ct4gg'), 'primary', 'submit-build-htaccess',false); ?></p>
		</form>
		<?php
		$htaccess_file = ABSPATH.".htaccess";
		if (file_exists($htaccess_file)) {
			echo esc_html($htaccess_file. __(' updated on ', 'ct4gg'). date ("F d Y H:i:s.", filemtime($htaccess_file)) );
		?>
			<textarea cols="150" style="margin-top: 0px; margin-bottom: 0px; height: 500px;" disabled><?php echo esc_html(file_get_contents($htaccess_file)); ?></textarea>
		<?php } ?>
		</div>

		<div id="tab-2" class="ct4gg-tab-pane <?php echo esc_html((isset($_POST['tab']) && $_POST['tab'] == 'tab-2') ? 'active' : '');?>" >
			<h3><?php _e('Htaccess file(s)','ct4gg'); ?></h3>
			<?php if (file_exists($htaccess_file)) {?>
			<form method="POST">
				<input type="hidden" name="page" value="ct4gg_htaccess"/>
				<input type="hidden" name="tab" value="tab-2"/>
				<?php wp_nonce_field(CT4GG_NAME.'-opt', CT4GG_NAME.'-verif'); ?>
				<dl>
				<?php
					foreach (scandir(ABSPATH) as $htaccess_filename)  {
						if(preg_match('~htaccess*~', $htaccess_filename)) {
							if (basename($htaccess_filename) == '.htaccess') {
								$check='';
							} else {
								$check='<input type="checkbox" class="radio" value="'. esc_attr(basename($htaccess_filename)) . '" id="ct4gg-htaccess" name="ct4gg-htaccess" />';
							}
							echo "<dt>$check<b>". esc_html(basename($htaccess_filename)) . '</b> - '. date ("Ymd H:i:s.", filemtime(ABSPATH . $htaccess_filename)) . '</dt>';
						}
					}
					submit_button( __("Restore", 'ct4gg'), 'primary', 'submit-htaccess-restore',false);
					submit_button( __("Delete", 'ct4gg'), 'secondary', 'submit-htaccess-delete',false);
					?>
				</dl>
			</form>
			<?php
			} else {
				echo esc_html(__('No .htaccess fils found.', 'ct4gg'));
			}
			?>
		</div>
	</div>