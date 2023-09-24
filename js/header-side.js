(function() {
	"use strict";

	jQuery(document).ready(function () {
		if (jQuery(window).width() > 767) {

			// detect if IE : from http://stackoverflow.com/a/16657946
			var ie = (function () {
				var undef, rv = -1; // Return value assumes failure.
				var ua = window.navigator.userAgent;
				var msie = ua.indexOf('MSIE ');
				var trident = ua.indexOf('Trident/');

				if (msie > 0) {
					// IE 10 or older => return version number
					rv = parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
				}
				else if (trident > 0) {
					// IE 11 (or newer) => return version number
					var rvNum = ua.indexOf('rv:');
					rv = parseInt(ua.substring(rvNum + 3, ua.indexOf('.', rvNum)), 10);
				}

				return ((rv > -1) ? rv : undef);
			}());

			// disable/enable scroll (mousewheel and keys) from http://stackoverflow.com/a/4770179
			// left: 37, up: 38, right: 39, down: 40,
			// spacebar: 32, pageup: 33, pagedown: 34, end: 35, home: 36
			var keys = [32, 37, 38, 39, 40], wheelIter = 0;

			var preventDefault = function(e) {
				e = e || window.event;
				if (e.preventDefault)
					e.preventDefault();
				e.returnValue = false;
			};

			var keydown = function(e) {
				for (var i = keys.length; i--;) {
					if (e.keyCode === keys[i]) {
						preventDefault(e);
						return;
					}
				}
			};

			var touchmove = function(e) {
				preventDefault(e);
			};

			var wheel = function(e) {
				// for IE
				if( ie ) {
				preventDefault(e);
				}
			};

			var disable_scroll = function() {
				window.onmousewheel = document.onmousewheel = wheel;
				document.onkeydown = keydown;
				document.body.ontouchmove = touchmove;
			};

			var enable_scroll = function() {
				window.onmousewheel = document.onmousewheel = document.onkeydown = document.body.ontouchmove = null;
			};

			var docElem = window.document.documentElement,
				scrollVal,
				isRevealed,
				noscroll,
				isAnimating,
				container = document.getElementById('container'),
				trigger = container.querySelector('button.trigger');

			var scrollY = function () {
				return window.pageYOffset || docElem.scrollTop;
			};


			var toggle = function(reveal) {
				isAnimating = true;

				if (reveal) {
					classie.add(container, 'modify');
				}
				else {
					noscroll = true;
					disable_scroll();
					classie.remove(container, 'modify');
				}

				// simulating the end of the transition:
				setTimeout(function () {
					isRevealed = !isRevealed;
					isAnimating = false;
					if (reveal) {
						noscroll = false;
						enable_scroll();
						document.documentElement.setAttribute('style', 'overflow: auto !important');

					}
				}, 600);
			};

			var scrollPage = function () {
				var scrollVal = scrollY();

				if ( noscroll && !ie && (scrollVal < 0) ) {
					return false;
				}

				if (classie.has(container, 'notrans')) {
					classie.remove(container, 'notrans');
					return false;
				}

				if (isAnimating) {
					return false;
				}

				if (scrollVal <= 0 && isRevealed) {
					toggle(0);
				}
				else if (scrollVal > 0 && !isRevealed) {
					toggle(1);
				}
			};


			// refreshing the page...
			var pageScroll = scrollY();
	 		noscroll = pageScroll === 0;

			disable_scroll();

			if (pageScroll) {
				var isRevealed = true;
				// classie.add(container, 'notrans');
				classie.add(container, 'modify');
			}

			window.addEventListener('scroll', scrollPage);

		} else {
			jQuery(window).on('scroll', function() {
				var scroll = jQuery(window).scrollTop();

				if (scroll >= 1) {
					jQuery(".intro-effect-side").addClass("modify", 2000);
				} else {
					jQuery(".intro-effect-side").removeClass("modify");
				}
			});
		}
	});

})();