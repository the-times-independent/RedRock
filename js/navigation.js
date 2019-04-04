/* global redrockScreenReaderText */
(function($) {

	var body, masthead, menuToggle, siteMenu, siteNavigation;
	
	function initMainNavigation(container) {
		var dropdownToggle =
		    $(
                '<button />', {
                    'class': 'dropdown-toggle',
                    'aria-expanded': false
                }    
            )
            .append($(
                '<span />', {
                    'class': 'screen-reader-text',
                    text: redrockScreenReaderText.expand
                }
            ));

		container.find('.menu-item-has-children > a').after(dropdownToggle);
		
		container.find('.current-menu-ancestor > button').addClass('toggled-on');
		container.find('.current-menu-ancestor > .sub-menu').addClass('toggled-on');
		
		container.find('.menu-item-has-children').attr('aria-haspopup', 'true');

		container.find('.dropdown-toggle').click(function(e) {
			var _this            = $(this),
				screenReaderSpan = _this.find('.screen-reader-text');

			e.preventDefault();
			_this.toggleClass('toggled-on');
			_this.next('.children, .sub-menu').toggleClass('toggled-on');
			_this.attr('aria-expanded', _this.attr('aria-expanded') === 'false' ? 'true' : 'false');
			screenReaderSpan.text(screenReaderSpan.text() === redrockScreenReaderText.expand ? redrockScreenReaderText.collapse : redrockScreenReaderText.expand);
		});
	}
	initMainNavigation($('.main-navigation'));
	
	$(document).on('customize-preview-menu-refreshed', function(e, params) {
		if ('header' === params.wpNavMenuArgs.theme_location) {
			initMainNavigation(params.newContainer);
		}
	});

	masthead         = $('#masthead');
	menuToggle       = masthead.find('.menu-toggle');
	siteMenu         = masthead.find('.main-navigation');
	siteNavigation   = masthead.find('.main-navigation > div');
	
	(function() {
		if (! menuToggle.length) {
			return;
		}
		
		menuToggle.add(siteNavigation).attr('aria-expanded', 'false');

		menuToggle.on('click.redrock', function() {
			$(this).add(siteMenu).add(siteNavigation).toggleClass('toggled-on');
			$(this).add(siteMenu).add(siteNavigation).attr('aria-expanded', $(this).add(siteNavigation).attr('aria-expanded') === 'false' ? 'true' : 'false');
		});
	})();
	
	(function() {
		if (!siteNavigation.length || !siteNavigation.children().length) {
			return;
		}
		
		function toggleFocusClassTouchScreen() {
			if (window.innerWidth >= 896) {
				$(document.body).on('touchstart.redrock', function(e) {
					if (! $(e.target).closest('.main-navigation li').length) {
						$('.main-navigation li').removeClass('focus');
					}
				});
				siteNavigation.find('.menu-item-has-children > a').on('touchstart.redrock', function(e) {
					var el = $(this).parent('li');

					if (! el.hasClass('focus')) {
						e.preventDefault();
						el.toggleClass('focus');
						el.siblings('.focus').removeClass('focus');
					}
				});
			} else {
				siteNavigation.find('.menu-item-has-children > a').unbind('touchstart.redrock');
			}
		}

		if ('ontouchstart' in window) {
			$(window).on('resize.redrock', toggleFocusClassTouchScreen);
			toggleFocusClassTouchScreen();
		}

		siteNavigation.find('a').on('focus.redrock blur.redrock', function() {
			$(this).parents('.menu-item').toggleClass('focus');
		});
	})();
	
	function onResizeARIA() {
		if (window.innerWidth < 896) {
			if (menuToggle.hasClass('toggled-on')) {
				menuToggle.attr('aria-expanded', 'true');
				siteMenu.attr('aria-expanded', 'true');
				siteNavigation.attr('aria-expanded', 'true');
			} else {
				menuToggle.attr('aria-expanded', 'false');
				siteMenu.attr('aria-expanded', 'false');
				siteNavigation.attr('aria-expanded', 'false');
			}
		} else {
			menuToggle.removeAttr('aria-expanded');
			siteMenu.removeAttr('aria-expanded');
			siteNavigation.removeAttr('aria-expanded');
		}
	}

	$(document).ready(function() {
		body = $(document.body);

		$(window)
			.on('load.redrock', onResizeARIA)
			.on('resize.redrock', onResizeARIA);
	});

})(jQuery);
