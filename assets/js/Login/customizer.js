/* global ct4gg_script
* Version 1.3.0
*/

jQuery( document ).ready(
	function ( $ ) {

		$( '<li class="accordion-section control-section control-section-default control-subsection"><h4 class="accordion-section-title"><a href="https://wordpress.org/support/plugin/ct4gg/reviews/#new-post" target="_blank">Like our plugin? Leave a review here!</a></h4></li><li style="padding: 10px; text-align: center;">Made <a href="https://ginkgos.net" target="_blank">Franck VANHOUCKE</a></li>' ).appendTo( '#sub-accordion-panel-ct4gg_login_panel' );

		/*
			* Detect when the Login Customizer panel is expanded (or closed) so we can preview the login form easily.
			*/
		wp.customize.panel(
			'ct4gg_panel',
			function ( section ) {
				section.expanded.bind(
					function ( isExpanding ) {

						// Value of isExpanding will = true if you're entering the section, false if you're leaving it.
						if ( isExpanding ) {

								// Only send the previewer to the login Customizer page, if we're not already on it.
								var current_url = wp.customize.previewer.previewUrl();
							current_url         = current_url.includes( ct4gg_script.page );

							if ( ! current_url ) {
								wp.customize.previewer.send( 'ct4gg-url-switcher', { expanded: isExpanding } );
							}

						} else {
							// Head back to the home page, if we leave the Login ustomizer panel.
							wp.customize.previewer.send( 'ct4gg-back-to-home', { home_url: wp.customize.settings.url.home } );
						}
					}
				);
			}
		);

		/*
			* Logo Section
			*/
		if (  wp.customize( 'ct4gg_options[ct4gg_logo_show]' )._value == 1) {
			$( '#customize-control-ct4gg_options-ct4gg_logo' ).hide();
			$( '#customize-control-ct4gg_options-ct4gg_logo_link' ).hide();
		} else {
				$( '#customize-control-ct4gg_options-ct4gg_logo' ).show();
				$( '#customize-control-ct4gg_options-ct4gg_logo_link' ).show();
		}

		wp.customize(
			'ct4gg_options[ct4gg_logo_show]',
			function ( setting ) {
				setting.bind(
					function ( value ) {
						if ( value === true ) {
								$( '#customize-control-ct4gg_options-ct4gg_logo' ).hide();
								$( '#customize-control-ct4gg_options-ct4gg_logo_link' ).hide();
						} else {
							$( '#customize-control-ct4gg_options-ct4gg_logo' ).show();
							$( '#customize-control-ct4gg_options-ct4gg_logo_link' ).show();
						}
					}
				);
			}
		);

		/*
			* Background
			*/
		if ( wp.customize( 'ct4gg_options[ct4gg_bg_image]' )._value === '' ) {
			$( '#customize-control-ct4gg_options-ct4gg_bg_image_size' ).hide();
			$( '#customize-control-ct4gg_options-ct4gg_bg_size' ).hide();
			$( '#customize-control-ct4gg_options-ct4gg_bg_image_repeat' ).hide();
			$( '#customize-control-ct4gg_options-ct4gg_bg_image_position' ).hide();
		}

		if ( wp.customize( 'ct4gg_options[ct4gg_bg_image_size]' )._value !== 'custom' ) {
				$( '#customize-control-ct4gg_options-ct4gg_bg_size' ).hide();
		}

		wp.customize(
			'ct4gg_options[ct4gg_bg_image]',
			function ( setting ) {
				setting.bind(
					function ( value ) {
						if ( value === '' ) {
								$( '#customize-control-ct4gg_options-ct4gg_bg_image_size' ).hide();
								$( '#customize-control-ct4gg_options-ct4gg_bg_size' ).hide();
								$( '#customize-control-ct4gg_options-ct4gg_bg_image_repeat' ).hide();
								$( '#customize-control-ct4gg_options-ct4gg_bg_image_position' ).hide();
						} else {
							$( '#customize-control-ct4gg_options-ct4gg_bg_image_size' ).show();
							if ( wp.customize( 'ct4gg_options[ct4gg_bg_image_size]' )._value === 'custom' ) {
								$( '#customize-control-ct4gg_options-ct4gg_bg_size' ).show();
							}
							$( '#customize-control-ct4gg_options-ct4gg_bg_image_repeat' ).show();
							$( '#customize-control-ct4gg_options-ct4gg_bg_image_position' ).show();
						}
					}
				);
			}
		);

		wp.customize(
			'ct4gg_options[ct4gg_bg_image_size]',
			function ( setting ) {
				setting.bind(
					function ( value ) {
						if ( value === 'custom' ) {
								$( '#customize-control-ct4gg_options-ct4gg_bg_size' ).show();
						} else {
							$( '#customize-control-ct4gg_options-ct4gg_bg_size' ).hide();
						}
					}
				);
			}
		);

		/*
			* Form
			*/

	}
);