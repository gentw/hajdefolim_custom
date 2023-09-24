/* global jQuery:false */
/* global GUTENTYPE_STORAGE:false */

(function() {
	"use strict";

	jQuery( document ).on(
		'action.ready_gutentype', function() {

			// Change display mode
			jQuery( '.woocommerce,.woocommerce-page' ).on(
				'click', '.gutentype_shop_mode_buttons a', function(e) {
					var mode = jQuery( this ).hasClass( 'woocommerce_thumbs' ) ? 'thumbs' : 'list';
					gutentype_set_cookie( 'gutentype_shop_mode', mode, 365 );
					jQuery( this ).siblings( 'input' ).val( mode ).parents( 'form' ).get( 0 ).submit();
					e.preventDefault();
					return false;
				}
			);
			// Add buttons to quantity on first run
			if (jQuery( '.woocommerce div.quantity .q_inc,.woocommerce-page div.quantity .q_inc' ).length == 0) {
				var woocomerce_inc_dec = '<span class="q_inc"></span><span class="q_dec"></span>';
				jQuery( '.woocommerce div.quantity,.woocommerce-page div.quantity' ).append( woocomerce_inc_dec );
				jQuery( '.woocommerce div.quantity,.woocommerce-page div.quantity' ).on(
					'click', '>span', function(e) {
						gutentype_woocomerce_inc_dec_click( jQuery( this ) );
						e.preventDefault();
						return false;
					}
				);
			}
			// Add buttons to quantity after the cart is updated
			jQuery( document.body ).on(
				'updated_wc_div', function() {
					if (jQuery( '.woocommerce div.quantity .q_inc,.woocommerce-page div.quantity .q_inc' ).length == 0) {
						jQuery( '.woocommerce div.quantity,.woocommerce-page div.quantity' ).append( woocomerce_inc_dec );
						jQuery( '.woocommerce div.quantity,.woocommerce-page div.quantity' ).on(
							'click', '>span', function(e) {
								gutentype_woocomerce_inc_dec_click( jQuery( this ) );
								e.preventDefault();
								return false;
							}
						);
					}
				}
			);

			// Make buttons from links
			var wishlist = jQuery( '.woocommerce .product .yith-wcwl-add-to-wishlist' );
			if (wishlist.length > 0) {
				wishlist.find( '.add_to_wishlist' ).addClass( 'button' );
				if (jQuery( '.woocommerce .product .compare' ).length > 0) {
					jQuery( '.woocommerce .product .compare' ).insertBefore( wishlist );
				}
			}

			// Wrap new select (created dynamically) with .select_container
			jQuery( 'select#calc_shipping_country:not(.inited)' ).addClass( 'inited' ).on(
				'change', function() {
					setTimeout(
						function() {
							var state = jQuery( 'select#calc_shipping_state' );
							if (state.length == 1 && ! state.parent().hasClass( 'select_container' )) {
								state.wrap( '<div class="select_container"></div>' );
							}
						}, 10
					);
				}
			);
			jQuery( document.body ).on(
				'wc_fragments_refreshed updated_shipping_method update_checkout', function() {
					jQuery( 'div.cart_totals select' ).each(
						function() {
							if ( ! jQuery( this ).parent().hasClass( 'select_container' )) {
								jQuery( this ).wrap( '<div class="select_container"></div>' );
							}
						}
					);
				}
			);

			// Generate 'scroll' event after the cart is filled
			jQuery( document.body ).on(
				'wc_fragment_refresh', function() {
					jQuery( window ).trigger( 'scroll' );
				}
			);

			// Add stretch behaviour to WooC tabs area
			jQuery( document ).on(
				'action.prepare_stretch_width', function() {
					if (GUTENTYPE_STORAGE['stretch_tabs_area'] > 0) {
						jQuery( '.single-product .woocommerce-tabs' ).wrap( '<div class="trx-stretch-width"></div>' );
					}
				}
			);

			// Inc/Dec quantity on buttons inc/dec
			function gutentype_woocomerce_inc_dec_click(button) {
				var f = button.siblings( 'input' );
				if (button.hasClass( 'q_inc' )) {
					f.val( ( f.val() == '' ? 0 : parseInt( f.val(), 10 ) ) + 1 ).trigger( 'change' );
				} else {
					f.val( Math.max( 0, ( f.val() == '' ? 0 : parseInt( f.val(), 10 ) ) - 1 ) ).trigger( 'change' );
				}
			}

			// Check device and update cart if need
			if (jQuery( 'table.cart' ).length > 0) {
				gutentype_woocommerce_update_cart( 'init' );
			}

			// Resize action
			jQuery( window ).resize(
				function() {
					"use strict";
					if (jQuery( 'table.cart' ).length > 0) {
						gutentype_woocommerce_update_cart( 'resize' );
					}
				}
			);

			// Update cart
			jQuery( document.body ).on(
				'updated_wc_div', function() {
					"use strict";
					if (jQuery( 'table.cart' ).length > 0) {
						gutentype_woocommerce_update_cart( 'update' );
					}
				}
			);

			// Update cart display
			function gutentype_woocommerce_update_cart(status){
				"use strict";
				setTimeout(
					function() {
						var w = window.innerWidth;
						if (w == undefined) {
							w = jQuery( window ).width() + (jQuery( window ).height() < jQuery( document ).height() || jQuery( window ).scrollTop() > 0 ? 16 : 0);
						}

						if (GUTENTYPE_STORAGE['mobile_layout_width'] >= w) {
							if (status == 'resize' && jQuery( 'table.cart .mobile_cell' ).length > 0) {
								return false;
							} else {
								var tbl = jQuery( 'table.cart' );
								if ( tbl.length > 0 ) {
									tbl.find( 'thead tr .product-quantity, thead tr .product-subtotal, thead tr .product-thumbnail' ).hide();
									if ( tbl.hasClass( 'wishlist_table' ) ) {
										tbl.find( 'thead tr .product-remove, thead tr .product-stock-status' ).hide();
										tbl.find( 'tfoot tr td' ).each(function() {
											jQuery( this ).data( 'colspan', jQuery( this ).attr( 'colspan' ) ).attr( 'colspan', 3 );
										});
									}
									tbl.find( '.cart_item,[id*="yith-wcwl-row-"]' ).each(
										function(){
											jQuery( this ).prepend( '<td class="mobile_cell" colspan="3"><table width="100%"><tr class="first_row"></tr><tr class="second_row"></tr></table></td>' );
											jQuery( this ).find( '.first_row' ).append( jQuery( this ).find( '.product-thumbnail, .product-name, .product-price' ) );
											jQuery( this ).find( '.second_row' ).append( jQuery( this ).find( '.product-remove, .product-quantity, .product-subtotal, .product-stock-status, .product-add-to-cart' ) );
										}
									);
									if ( ! tbl.hasClass( 'inited' )) {
										tbl.addClass( 'inited' );
									}
								}
							}
						}

						if (GUTENTYPE_STORAGE['mobile_layout_width'] < w && status == 'resize' && jQuery( 'table.cart .mobile_cell' ).length > 0) {
							var tbl = jQuery( 'table.cart' );
							if ( tbl.length > 0 ) {
								tbl.find( 'thead tr .product-quantity, thead tr .product-subtotal, thead tr .product-thumbnail' ).show();
								if ( tbl.hasClass( 'wishlist_table' ) ) {
									tbl.find( 'thead tr .product-remove, thead tr .product-stock-status' ).show();
									tbl.find( 'tfoot tr td' ).each(function() {
										jQuery( this ).attr( 'colspan', jQuery( this ).data( 'colspan' ) );
									});
								}
								tbl.find( '.cart_item,[id*="yith-wcwl-row-"]' ).each(
									function(){
										jQuery( this ).find( '.first_row td, .second_row td' ).prependTo( jQuery( this ) );
										jQuery( this ).find( '.product-remove' ).prependTo( jQuery( this ) );
										jQuery( this ).find( 'td.mobile_cell' ).remove();
									}
								);
							}
						}

					}, 10
				);
			}
		}
	);
})();
