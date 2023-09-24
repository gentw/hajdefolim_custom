/* global jQuery:false */
/* global BASEKIT_STORAGE:false */

jQuery( document ).ready(
	function() {
		'use strict';
		setTimeout( function() {
			jQuery('.editor-block-list__layout').addClass('scheme_' + GUTENTYPE_STORAGE['color_scheme']);
		}, 100 );
	}
);

