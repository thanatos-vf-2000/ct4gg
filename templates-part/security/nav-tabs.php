<?php
/**
 * @package  CT4GGPlugin
 * @Version 1.4.5
 * 
 * Desciption: nav-tabs for security.txt
 */
?>
    <ul class="nav ct4gg-nav-tabs">
		<li class="<?php echo esc_html(((isset($_POST['tab']) && $_POST['tab'] == 'tab-1') || !isset($_POST['tab'])) ? 'active':'');?>"><a href="#tab-1"><?php _e('Display','ct4gg'); ?></a></li>
		<li class="<?php echo esc_html((isset($_POST['tab']) && $_POST['tab'] == 'tab-2') ? 'active' : '');?>"><a href="#tab-2"><?php _e('Restore security.txt','ct4gg'); ?></a></li>
	</ul>
