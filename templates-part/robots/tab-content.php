<?php
/**
 * @package  CT4GGPlugin
 * @Version 1.2.0
 * 
 * Desciption: nav-content for robots
 */
use CT4GG\Api\FileRobots;
?>
	<div class="ct4gg-tab-content">
		<div id="tab-1" class="ct4gg-tab-pane <?php echo esc_html(((isset($_POST['tab']) && $_POST['tab'] == 'tab-1') || !isset($_POST['tab'])) ? 'active':'');?>">

		<form method="post" >
			<input type="hidden" name="page" value="ct4gg_robots"/>
			<input type="hidden" name="tab" value="tab-1"/>
			<?php wp_nonce_field(CT4GG_NAME.'-opt', CT4GG_NAME.'-verif'); ?>
			<p><?php submit_button( __("Update Robots.txt", 'ct4gg'), 'primary', 'submit-build-robots',false); ?></p>
		</form>
		<?php
		$robots_file = ABSPATH."robots.txt";
		if (file_exists($robots_file)) {
			echo esc_html($robots_file. __(' updated on ', 'ct4gg'). date ("F d Y H:i:s.", filemtime($robots_file)) );
		?>
			<textarea cols="150" style="margin-top: 0px; margin-bottom: 0px; height: 500px;" disabled><?php echo esc_html(file_get_contents($robots_file)); ?></textarea>
		<?php } ?>
		</div>

		<div id="tab-2" class="ct4gg-tab-pane <?php echo esc_html((isset($_POST['tab']) && $_POST['tab'] == 'tab-2') ? 'active' : '');?>" >
			<h3><?php _e('Robots.txt file(s)','ct4gg'); ?></h3>
			<?php if (file_exists($robots_file)) {?>
			<form method="POST">
				<input type="hidden" name="page" value="ct4gg_robots"/>
				<input type="hidden" name="tab" value="tab-2"/>
				<?php wp_nonce_field(CT4GG_NAME.'-opt', CT4GG_NAME.'-verif'); ?>
				<dl>
				<?php
					foreach (scandir(ABSPATH) as $robots_filename)  {
						if(preg_match('~robots*~', $robots_filename)) {
							if (basename($robots_filename) == 'robots.txt') {
								$check='';
							} else {
								$check='<input type="checkbox" class="radio" value="'. esc_attr(basename($robots_filename)) . '" id="ct4gg-robots" name="ct4gg-robots" />';
							}
							echo "<dt>$check<b>". esc_html(basename($robots_filename)) . '</b> - '. date ("Ymd H:i:s.", filemtime(ABSPATH . $robots_filename)) . '</dt>';
						}
					}
					submit_button( __("Restore", 'ct4gg'), 'primary', 'submit-robots-restore',false);
					submit_button( __("Delete", 'ct4gg'), 'secondary', 'submit-robots-delete',false);
					?>
				</dl>
			</form>
			<?php
			} else {
				echo esc_html(__('No robots.txt fils found.', 'ct4gg'));
			}
			?>
		</div>
	</div>