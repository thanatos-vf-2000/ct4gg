<?php
/**
 * @package  CT4GGPlugin
 * @Version 0.0.1
 * 
 * Desciption: Admin Page
 */

 ?>
 <div class="wrap">
    <h1>Customer Tools For GinkGos - Plugin</h1>
    <?php settings_errors(); ?>
    <ul class="nav nav-tabs">
		<li class="active"><a href="#tab-1"><?php _e('Manage Settings','ct4gg'); ?></a></li>
		<li><a href="#tab-2"><?php _e('Updates','ct4gg'); ?></a></li>
		<li><a href="#tab-3"><?php _e('About','ct4gg'); ?></a></li>
	</ul>

	<div class="tab-content">
		<div id="tab-1" class="tab-pane active">

			<form method="post" action="options.php">
				<?php 
					settings_fields( CT4GG_NAME.'_plugin_settings' );
					do_settings_sections( CT4GG_NAME.'_plugin' );
					submit_button();
				?>
			</form>
			
		</div>

		<div id="tab-2" class="tab-pane">
			<h3><?php _e('Updates','ct4gg'); ?></h3>
			<dl>
				<dt><b>0.0.1</b>: Initial version (2109)</dt>
				<dd>Customiser Screen Login</dd>
				<dd>Used "Classic" Widget settings screens</dd>
				<dd>Managed the interval before displaying the administration email verification screen</dd>
				<dd>Disable Jetpack for Automattic</dd>
			</dl>
		</div>

		<div id="tab-3" class="tab-pane">
			<h3><?php _e('About','ct4gg'); ?></h3>
			<p>Version : <?php echo CT4GG_VERSION; ?></p>
			<p><?php _e('Credit','ct4gg'); ?>: Franck VANHOUCKE</p>
		</div>
	</div>
</div>
