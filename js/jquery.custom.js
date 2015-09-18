jQuery(document).ready(function($) {

	$('[data-toggle="tooltip"]').tooltip()
	.filter('[data-trigger*="click"]')
	.on('click', function(e) {
		e.preventDefault();
	});
	
	// mCustomScrollbar JS
	function detectMobile() {
		$.browser.device = (/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase()));

		if( $.browser.device === false ) {
			$(".main-navigation").mCustomScrollbar();
		} else {
			$(".main-navigation").mCustomScrollbar("destroy");
		}
	}

	// Target your .container, .wrapper, .post, etc.
	$(".post, .hentry, .entry-content, .mejs-video").fitVids();

	function mosaicInit() {

		// triggered after each item is loaded
		function onProgress( imgLoad, image ) {
			// change class if the image is loaded or broken
			var $item = $( image.img ).parent().parent();
				$item.removeClass('is-loading');
				$item.addClass('is-loaded');
			if ( !image.isLoaded ) {
				$item.removeClass('is-loaded');
				$item.addClass('is-broken');
			}
			// update progress element
			//loadedImageCount++;
			//updateProgress( loadedImageCount );
		}

		var $blogContainer = $('.blog-grid');
		$blogContainer.imagesLoaded( function() {
			$blogContainer.packery({
				itemSelector: '.blog-item'
			});
		});

		var $portfolioContainer = $('.portfolio-masonry');
		$portfolioContainer.imagesLoaded( function() {
			$portfolioContainer.packery({
				itemSelector: '.portfolio-item',
				transitionDuration: '0.1s',
			});
		})
		.progress( onProgress );
	}

	// Add Dropdown Effect & Slide
	function subMenuDropDown() {
		$("<div class='menu-btn-sub-menu'></div>").prependTo('.menu-item-has-children');

		$(".menu-item-has-children .menu-btn-sub-menu").click(function() {
			if ($(this).hasClass('sub-menu-expanded')) {
				$(this).removeClass('sub-menu-expanded');
				$(this).next().next().slideUp();
			} else {
				$(this).addClass('sub-menu-expanded');
				$(this).next().next().slideDown();
			}
		});
	}

	subMenuDropDown();

	// Mobile Nav Button JS
	$(".mobile-nav-btn").click(function() {
		var wrapper = $("#wrapper");
		var wrapperWidth = wrapper.width();
		var containers = $('#content, .portfolio-masonry, .blog-masonry');

		if ($('body').hasClass('nav-expand')) {
			$('body, .main-navigation').removeClass("nav-expand");
			containers.css("width", "auto");
		} else {
			$('body, .main-navigation').addClass("nav-expand");
			containers.css("width", wrapperWidth);
		}
	});

	function mobileNavInit() {
		var windowWidth = $(window).width();

		if( windowWidth < 1000 ) {
			$(".main-navigation .widget").click(function() {
				if ($('body').hasClass('nav-expand')) {
					return;
				} else {
					$('body, .main-navigation').addClass("nav-expand", function() {
						$('.portfolio-masonry').packery();
					});
				}
			});
		}
	}

	// Fire once loaded
	$(window).load(function(){
		detectMobile();
		mosaicInit();
		mobileNavInit();
	});

	// Fire resizing
	$(window).resize(function() {
		mobileNavInit();
    });

	$(function() {
		mosaicInit();
		mobileNavInit();
	});

});