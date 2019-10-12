/**
 * Backend Babystreet scripts
 */
(function ($) {
	"use strict";
	$(document).ready(function () {
		// Init wpColorPicker color picker for menu label colors
		$('input.babystreet-menu-colorpicker').wpColorPicker();

        // Init wpColorPicker color picker for theme options
        $('input.babystreet-theme-options-colorpicker').wpColorPicker({
            change: function(event, ui){
                $(this).closest('div.controls').find('div.babystreet_font_preview p').css({color: ui.color});
			}
		});

		// Proper position featured images metaboxes
		var featured_img_meta = $('#postimagediv');
		var featured_imgs_arr = new Array();
		if (featured_img_meta.length) {
			for (var i = 6; i >= 2; i--) {
				featured_imgs_arr[i] = $('#babystreet_featured_' + i);
				if (featured_imgs_arr[i].length) {
					featured_imgs_arr[i].detach().insertAfter(featured_img_meta);
				}
			}
		}

		// Proper position Portfolio Gallery Options metabox
		var prtfl_gallery_options_meta = $('#babystreet_portfolio_cz');
		if (prtfl_gallery_options_meta.length && featured_img_meta.length) {
			prtfl_gallery_options_meta.detach().insertBefore(featured_img_meta);
		}

        // Proper position Product Gallery Type Options metabox
        var product_gallery_options_meta = $('#babystreet_product_gallery_type');
		var product_gallery_meta = $('#woocommerce-product-images');
        if (product_gallery_options_meta.length && product_gallery_meta.length) {
            product_gallery_options_meta.detach().insertBefore(product_gallery_meta);
        }

		// Init fonticonpicker on menu edit
		$('#menu-to-edit a.item-edit').on('click', function () {
			$(this).parents("li.menu-item").find("input.babystreet-menu-icons").fontIconPicker({
				source: ['flaticon-3-standing-archives','flaticon-auricular-of-a-phone','flaticon-bag-with-handle','flaticon-baggage-doodle','flaticon-bar-graphic-doodle','flaticon-basket-doodle','flaticon-blank-paper-doodle','flaticon-blank-tag-doodle','flaticon-calculator-doodle','flaticon-cd-with-shines','flaticon-chart-presentation-doodle','flaticon-circles-doodle','flaticon-circular-grid','flaticon-clip-doodle','flaticon-clipboard-with-filled-out-paper','flaticon-clipboard-with-paper','flaticon-clothing-hanger-doodle','flaticon-computer-doodle-outline','flaticon-computer-mouse-draw','flaticon-cross-mark','flaticon-cup-doodle','flaticon-cut-flag','flaticon-database-gross-rustic-lines-symbol','flaticon-dollar-sign-inside-oval-shape','flaticon-doodle-frame','flaticon-draw-bag','flaticon-draw-battery-charging-status','flaticon-draw-bible-book-with-bookmark','flaticon-draw-boat','flaticon-draw-calendar','flaticon-draw-calendar-day-five','flaticon-draw-cellular-phone','flaticon-draw-check-mark','flaticon-draw-computer-screen','flaticon-draw-credit-card','flaticon-draw-directional-compass','flaticon-draw-film-strip','flaticon-draw-flag','flaticon-draw-information-sign','flaticon-draw-magnifying-lens','flaticon-draw-mercury-thermometer-with-high-temperature','flaticon-draw-pie-graph','flaticon-draw-printer-with-paper','flaticon-draw-star','flaticon-draw-t-shirt','flaticon-draw-upload-arrow','flaticon-drawn-drawer','flaticon-drawn-fence','flaticon-envelope-doodle','flaticon-floppy-disk-doodle','flaticon-flower-with-petals','flaticon-full-inbox-doodle','flaticon-game-control-doodle','flaticon-gift-bag','flaticon-half-filled-battery-status-doodle','flaticon-hammer-and-wrench-doodle','flaticon-heart-doodle','flaticon-large-pointer','flaticon-lightbulb-doodle-with-shine','flaticon-line-graph-doodle','flaticon-locked-padlock','flaticon-microphone-drawing','flaticon-mobile-gaming-device','flaticon-mouse-arrow','flaticon-music-quaver-draw','flaticon-network-forum-avatar-doodle','flaticon-open-box-doodle','flaticon-open-empty-folder-outline','flaticon-open-padlock','flaticon-origami-airplane','flaticon-painting-palette','flaticon-plus-sign','flaticon-power-button-doodle','flaticon-recycling-sign-doodle','flaticon-rewind-arrow-draw','flaticon-rounded-draw-airplane','flaticon-shooting-target-doodle','flaticon-shop-cart-doodle','flaticon-small-palm-tree','flaticon-speech-bubble','flaticon-speech-bubble-with-text-doodle','flaticon-spring-binder-notebook','flaticon-star-doodle','flaticon-suitcase-doodle','flaticon-text-page-doodle','flaticon-tiny-cloud','flaticon-trash-bin-doodle','flaticon-up-arrow-draw','flaticon-upside-down-wifi-symbol','flaticon-user-information-doodle','flaticon-volume-levels-or-bars-graph']
			});
		});

	});
})(window.jQuery);