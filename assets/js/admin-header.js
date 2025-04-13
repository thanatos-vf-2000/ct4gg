/**
 * Template Name: ct4gg - Admin
 *
 * @Version 1.5.0
 */
class CT4GG_Class  {

	constructor() {
		this.SiteScanProgress_interval = false;
		this.AJAX_data                 = false
	}

	check_headers( ht, nonce )
		{
		jQuery( '#ct4gg-check-headers .spinner' ).css( 'visibility', 'visible' );
		jQuery( '#ct4gg-headers-container-' + ht ).html( '' );
		jQuery( '#ct4gg-graph-' + ht + ' .ct4gg-graph-data' ).html( 'Loading..' );
		jQuery( '#ct4gg-graph-' + ht + ' .ct4gg-graph-progress' ).css( 'transform', 'rotate(0deg)' );

		jQuery.ajax(
			{
				type: 'POST',
				url: ajaxurl,
				dataType: "json",
				data: {
					'action':'ct4gg_check_headers',
					'nonce' : nonce,
					'type': ht
				},
				success:function (data) {
					jQuery( '#ct4gg-check-headers .spinner' ).css( 'visibility', 'hidden' );
					jQuery( '#ct4gg-headers-container-' + ht ).html( data.html );
					jQuery( '#ct4gg-graph-' + ht + ' .ct4gg-graph-data' ).html( data.graph.message );
					jQuery( '#ct4gg-graph-' + ht + ' .ct4gg-graph-progress' ).css( 'background-color', data.graph.color )
					jQuery( '#ct4gg-graph-' + ht + ' .ct4gg-graph-progress' ).css( 'transform', 'rotate(' + data.graph.value + 'deg)' )
				},
				error: function (errorThrown) {
					jQuery( '#ct4gg-check-headers .spinner' ).css( 'visibility', 'hidden' );
					jQuery( '#ct4gg-headers-container-' + ht ).html( 'Unable to call AJAX.' );
					jQuery( '#ct4gg-graph-' + ht + ' .ct4gg-graph-data' ).html( data.graph.message );
					jQuery( '#ct4gg-graph-' + ht + ' .ct4gg-graph-progress' ).css( 'background-color', data.graph.color )
					jQuery( '#ct4gg-graph-' + ht + ' .ct4gg-graph-progress' ).css( 'transform', 'rotate(' + data.graph.value + 'deg);' )
				}
			}
		);
	}
}

	var CT4GG = new CT4GG_Class();