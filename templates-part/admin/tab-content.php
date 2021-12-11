<?php
/**
 * @package  CT4GGPlugin
 * @Version 1.1.0
 * 
 * Desciption: nav-content for admin
 */
?>
	<div class="ct4gg-tab-content">
		<div id="tab-1" class="ct4gg-tab-pane active">
			<div class="ct4gg-infos">
				<form method="post" action="options.php">
					<?php 
						settings_fields( CT4GG_NAME.'_plugin_settings' );
						do_settings_sections( CT4GG_NAME.'_plugin' );
						submit_button();
					?>
				</form>
			</div>
			<div class="ct4gg-advertise">
				<?php self::get_template(array('admin/support')); ?>
			</div>
		</div>

		<div id="tab-2" class="ct4gg-tab-pane">
			<div class="ct4gg-infos">
				<h3><?php _e('Updates','ct4gg'); ?></h3>
				<dl>
				<?php
					$nb=0;
					if ($file = fopen(CT4GG_PATH ."changelog.txt", "r")) {
						while(!feof($file)) {
							$line = fgets($file);
							if (preg_match("/= (.*) =/", $line, $matches)) {
								$nb++;
								$ver = $matches[1];
							} elseif (preg_match("/\*Release Date -(.*)\*/", $line, $matches)) {
								$nb++;
								echo "<dt><b>" . esc_html($ver). "</b>: ". esc_html($matches[1])."</dt>";
							} elseif ($nb > 2) {
								echo "<dd>". esc_html($line) ."</dd>";
							}
						}
						fclose($file);
					}
					?>
				</dl>
			</div>
			<div class="ct4gg-advertise">
				<?php self::get_template(array('admin/support')); ?>
			</div>
		</div>

		<div id="tab-3" class="ct4gg-tab-pane">
			<div class="ct4gg-infos">
				<h3><?php _e('About','ct4gg'); ?></h3>
				<p>Version : <?php echo CT4GG_VERSION; ?></p>
				<p><?php _e('Credit','ct4gg'); ?>: Franck VANHOUCKE</p>
			</div>
			<div class="ct4gg-advertise">
				<?php self::get_template(array('admin/support')); ?>
			</div>
		</div>
	</div>