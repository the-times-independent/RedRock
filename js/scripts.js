/*!
 * Script for RedRock
 */
(function($) {
	$(document).ready(function() {
		var $container = $('#post-list');
		
		$container.append('\
			<div class="grid-sizer"></div>\
			<div class="grid-item"></div>\
			<div class="grid-item grid-item--width2"></div>\
		');
		$('.entry-footer').append($('#jp-post-flair').detach());

	});

	$(window).on('load', function() {
		var $wrapper = $('.js body'),
			$container = $('#post-list');
			
		$wrapper.animate({
			opacity: 1,
		}, 30);
		
		$(function() {
			$container.imagesLoaded(function() {
				$container.masonry({
					columnWidth: '.grid-sizer',
					gutter: 0,
					percentPosition: true,
					itemSelector: '.card',
					transitionDuration: 0,
					isFitWidth: false,
					isOriginLeft: true
				});
			});
			
			$container.find('.card').animate({
				'opacity' : 1
			});
		});
	});
})(jQuery);