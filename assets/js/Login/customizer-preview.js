/* global ct4gg_script
* Version 1.3.0
*/

(function ($) {
	$( document ).ready(
		function () {

			/*
			* Logo Section
			*/
			wp.customize(
				'ct4gg_options[ct4gg_logo]',
				function (value) {
					value.bind(
						function (newval) {

							$( "#customize-preview iframe" )
							.contents()
							.find( "body.login div#login h1 a" )
							.css(
								{
									"background-image": "url(" + newval.toString() + ")",
								}
							);

						}
					);

				}
			);

		}
	);

	wp.customize(
		'ct4gg_options[ct4gg_logo_show]',
		function (value) {

			value.bind(
				function (newval) {
					showlogo = newval;
					if (showlogo === true) {
						$( "#customize-preview iframe" )
						.contents()
						.find( 'body.login div#login h1 a' )
						.css( { "display": "none", } );

					}
					if (showlogo === false) {
						$( "#customize-preview iframe" )
						.contents()
						.find( 'body.login div#login h1 a' )
						.css( { 'display': 'block',} );

					}
				}
			);
		}
	);
	wp.customize(
		'ct4gg_options[ct4gg_logo_link]',
		function (value) {
			value.bind(
				function (newval) {
					$( "#customize-preview iframe" )
					.contents()
					.find( "body.login div#login h1 a" ).prop( {'href' : 'url(' + newval.toString() + ')'} );
				}
			);
		}
	);

	/*
	* Background
	*/
	wp.customize(
		'ct4gg_options[ct4gg_bg_color]',
		function (value) {
			value.bind(
				function (newval) {
					$( "#customize-preview iframe" )
					.contents()
					.find( "body.login" )
					.css( { background: newval } );
				}
			);
		}
	);
	// Background Image
	wp.customize(
		'ct4gg_options[ct4gg_bg_image]',
		function (value) {
			value.bind(
				function (newval) {
					$( "#customize-preview iframe" )
					.contents()
					.find( "body.login" ).css(
						{
							"background-image": "url(" + newval.toString() + ")",
						}
					);
				}
			);
		}
	);

	wp.customize(
		'ct4gg_options[ct4gg_bg_image_repeat]',
		function (value) {
			value.bind(
				function (newval) {
					$( "#customize-preview iframe" )
					.contents()
					.find( "html>body.login" )
					.css(
						{
							"background-repeat": newval,
						}
					);
				}
			);
		}
	);

	var imageCustom = false;
	wp.customize(
		'ct4gg_options[ct4gg_bg_image_size]',
		function (value) {
			value.bind(
				function (newval) {
					if (newval !== 'custom') {
						$( "#customize-preview iframe" )
						.contents()
						.find( "html>body.login" )
						.css(
							{
								"background-size": newval,
							}
						);
						imageCustom = false;
					} else {
						imageCustom = true;
					}
				}
			);
		}
	);

	// Background position working
	wp.customize(
		'ct4gg_options[ct4gg_bg_size]',
		function (value) {
			value.bind(
				function (newval) {
					if (imageCustom) {
						$( "#customize-preview iframe" )
						.contents()
						.find( "html>body.login" )
						.css(
							{
								"background-size": newval,
							}
						);
					}
				}
			);
		}
	);

	wp.customize(
		'ct4gg_options[ct4gg_form_bg_image]',
		function (value) {
			value.bind(
				function (newval) {
					value.bind(
						function (newval) {
							$( "#customize-preview iframe" )
							.contents()
							.find( "#login form#loginform" )
							.css( { 'background-image': 'url(' + newval.toString() + ')' } );
						}
					);

				}
			);
		}
	);

	/*
	* Form
	*/
	wp.customize(
		'ct4gg_options[ct4gg_form_bg_color]',
		function (value) {
			value.bind(
				function (newval) {
					$( "#customize-preview iframe" )
						.contents()
						.find( "#login form#loginform" )
					.css( { 'background-color': newval } );
				}
			);
		}
	);

	wp.customize(
		'ct4gg_options[ct4gg_form_border_color]',
		function (value) {
			value.bind(
				function (newval) {
					$( "#customize-preview iframe" )
						.contents()
						.find( "#login form#loginform" )
					.css( { 'border-color': newval } );
				}
			);
		}
	);

	wp.customize(
		'ct4gg_options[ct4gg_text_color]',
		function (value) {
			value.bind(
				function (newval) {
					$( "#customize-preview iframe" )
					.contents()
					.find( "#login form#loginform label" )
					.css( { 'color': newval } );
				}
			);
		}
	);

	wp.customize(
		'ct4gg_options[ct4gg_button_bg]',
		function (value) {
			value.bind(
				function (newval) {
					buttonbg = newval;
					$( "#customize-preview iframe" )
					.contents()
					.find( "#login form .submit .button" )
						.css( { 'background-color': newval } );

					$( "#customize-preview iframe" )
					.contents()
					.find( "#login form .submit .button" )
						.css( { 'border-color': newval } );
				}
			);
		}
	);

	wp.customize(
		'ct4gg_options[ct4gg_button_hover_bg]',
		function (value) {
			value.bind(
				function (newval) {

					$( "#customize-preview iframe" )
					.contents()
					.find( '#login form .submit .button' ).hover(
						function () {
							$( this ).css( { 'background-color': newval } );
						},
						function () {
							$( this ).css( { 'background-color': buttonbg } );
						}
					);

					$( "#customize-preview iframe" )
						.contents()
						.find( '#login form .submit .button' ).hover(
							function () {
								$( this ).css( { 'border-color': newval } );
							},
							function () {
								$( this ).css( { 'border-color': buttonbg } );

							}
						);
				}
			);
		}
	);

	wp.customize(
		'ct4gg_options[ct4gg_button_color]',
		function (value) {
			value.bind(
				function (newval) {
					$( "#customize-preview iframe" )
					.contents()
					.find( "#login form .submit .button" )
					.css( { 'color': newval } );
				}
			);
		}
	);

	/*
	* Other
	*/
	wp.customize(
		'ct4gg_options[ct4gg_other_color]',
		function (value) {
			value.bind(
				function (newval) {
					othercolor = newval;
					$( "#customize-preview iframe" )
					.contents()
					.find( ".login #backtoblog a" )
					.css( { 'color': newval } );

					$( "#customize-preview iframe" )
					.contents()
					.find( ".login #nav" )
					.css( { 'color': newval } );

					$( "#customize-preview iframe" )
					.contents()
					.find( ".login #nav a" )
					.css( { 'color': newval } );

					$( "#customize-preview iframe" )
					.contents()
					.find( ".privacy-policy-page-link a" )
					.css( { 'color': newval } );
				}
			);
		}
	);

	wp.customize(
		'ct4gg_options[ct4gg_other_color_hover]',
		function (value) {
			value.bind(
				function (newval) {
					$( "#customize-preview iframe" )
					.contents()
					.find( '.login #backtoblog a, .login .privacy-policy-page-link a' ).hover(
						function () {
							$( this ).css( { 'color': newval } );
						},
						function () {
							$( this ).css( { 'color': othercolor } );
						}
					);

					$( "#customize-preview iframe" )
					.contents()
					.find( '.login #nav a, .login .privacy-policy-page-link a' ).hover(
						function () {
							$( this ).css( { 'color': newval } );
						},
						function () {
							$( this ).css( { 'color': othercolor } );

						}
					);
				}
			);
		}
	);
	wp.customize(
		'ct4gg_options[ct4gg_field_back_blog]',
		function (value) {
			value.bind(
				function (newval) {
					if (newval === true) {
						$( "#customize-preview iframe" )
						.contents()
						.find( ".login #backtoblog" )
						.css( { 'display': 'none' } );
					} else {
						$( "#customize-preview iframe" )
						.contents()
						.find( ".login #backtoblog" )
							.css( { 'display': 'block' } );
					}
				}
			);
		}
	);

	var navNode = document.querySelector( '#nav' );
		wp.customize(
			'ct4gg_options[ct4gg_field_register_link]',
			function (value) {
				value.bind(
					function (newval) {
						if (newval === true) {
							navNode.children( 0 ).css( { 'display': 'none' } );
						} else {
							navNode.children( 0 ).css( { 'display': 'inline'} );
						}
					}
				);
			}
		);

		wp.customize(
			'ct4gg_options[ct4gg_field_lost_password]',
			function (value) {
				value.bind(
					function (newval) {
						if (newval === true) {
							if (navNode.children( 0 ) === undefined) {
								navNode.children( 0 ).css( { 'display': 'none' } );
							} else {
								navNode.children( 1 ).css( { 'display': 'none' } );
							}
						} else {
							if (navNode.children( 1 ) === undefined) {
								navNode.children( 0 ).css( { 'display': 'inline' } );
							} else {
								navNode.children( 1 ).css( { 'display': 'inline' } );
							}
						}
					}
				);
			}
		);

})( jQuery );