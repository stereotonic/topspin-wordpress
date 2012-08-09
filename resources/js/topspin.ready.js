/*
 *	Last Modified:		May 23, 2012
 *
 *	----------------------------------
 *	Change Log
 *	----------------------------------
 *	2012-08-09
 		- Added window.wpTopspinPluginDisableHashPermalink (set to true to disable the hash permalink from running)
 *	2012-05-23
 		- Updated viewProduct to load from a lightbox
 		- Added a callback for view product lightbox called "window.wpTopspinPluginOnViewProduct"
 *	2012-02-06
 		- Updated topspin item links to work with or without wp site url [@ezmiller - https://github.com/topspin/topspin-wordpress/issues/32]
 */

jQuery(function($) {

	var viewProduct = function(productID) {
		var data = {
			action : 'topspin_get_lightbox',
			item_id : productID
		};
		$.get(ajaxurl,data,function(ret) {
			$.colorbox({
				innerWidth : '884px',
				html : ret,
				onComplete : function() {
					TSPF.BuyButtons.initializeBuyButtons();
					if(typeof window.wpTopspinPluginOnViewProduct=='function') { window.wpTopspinPluginOnViewProduct.call(); }
				}
			});
		});
	};

	var getPid = function(href) {
		return href.replace(/(^[\w\d\.\/\:_-]*)?(\/)?#!\//,'');
	};

	if(!window.wpTopspinPluginDisableHashPermalink) {
		if(window.location.hash) {
			if(window.location.hash.indexOf('#!/')!=-1) {
				var pid = getPid(window.location.hash);
				if(pid) { viewProduct(pid); }
			}
		}
	}

	$('a.topspin-view-item').live('click',function(e) {
		e.preventDefault();
		var pid = getPid($(this).attr('href'));
		setTimeout(function() { viewProduct(pid); },10);
		window.location.hash = '#!/'+pid;
	});

	$('.topspin-view-more-image-pager .topspin-view-more-image-pager-item a').live('click',function(e) {
		e.preventDefault();
		var img = $('img',this);
		var defaultImage  = $('.topspin-view-more-image-default img',$(this).parent().parent().parent().parent());
		defaultImage.attr('src',img.attr('src'));
	});

	$('.topspin-view-more-image .topspin-view-more-image-default .topspin-view-more-image-default-cell a').live('click',function(e) {
		$(this).parent().parent().parent().toggleClass('topspin-view-more-image-zoom');
	});

	//Pre 3.2
	$('a.topspin-colorbox').live('click',function(e) {
		e.preventDefault();
		var pid = $(this).attr('href').replace('#topspin-view-more-','');
		viewProduct(pid);
	});

});