// Being nice to other libraries
jQuery.noConflict();

// In here $ is jQuery regardless of what other libraries are used
(function($) {
	
	/* blockUI global overrides */
	$.blockUI.defaults.css.padding			= '5px';
	$.blockUI.defaults.css.color			= '#29261b';
	$.blockUI.defaults.css.border			= '2px solid #2e2c23';
	$.blockUI.defaults.css.backgroundColor	= '#f0f0f0';
	$.blockUI.defaults.css.cursor			= 'default';
	$.blockUI.defaults.overlayCSS.cursor	= 'default';
	$.blockUI.message						= '<h1>Please wait...</h1>';
	
	/* Show Tips */
	show_tip = function() {
		if($.browser.msie) {
			$('#tip').text(this.title)
		}
		else {
			$('#tip').queue('fx', []);
			$('#tip').stop();

			$('#tip').text(this.title)
			.show()
			.animate({opacity: 1}, 100);
		}
	}
	
	/* Hide tips */
	hide_tip = function() {
		if(! $.browser.msie) {
			$('#tip')
			.animate({opacity: 1}, 500)
			.fadeOut('slow', function() {
				$(this).html('&nbsp;')
				.show();
			})
		}
	}
		
	/* Observe Confirmations */
	observe_confirm = function() {
		var link = this.href;
				
		$.ajax({
			url: link, 
			cache: false,
			complete: function(html) { 
				$.blockUI({ message: '<p>'+html.responseText+'</p>'}); 
			}
		});

		$('#confirm_cancel').click(function() {
			$.unblockUI();
			return false;
		});
		
		return false;
	}
	
	/* Display forms below the clicked link */
	show_inline = function() {				
		var link = this.href;
		var el = $(this);
				
		$.ajax({
			url: link,
			cache: false,
			complete: function(html) {
				$('.ajax_add').remove();
				
				$('<div class="ajax_add hidden clearfix"></div>')
				.insertAfter(el.parents().get(1))
				.html(html.responseText);
				
				$('.ajax_add > :not(form)').remove();
				$('.ajax_add').slideDown('fast');
			}
		});
		
		return false;
	}
	
	/* Hide Inline Form */
	hide_inline = function() {
		$('.ajax_add').slideUp('fast');
		return false;
	}

	/* Create Flashdata Container */
	create_container = function() {
		$('<div id="flashdata"><span class="message_content"></span></div>').prependTo('#main');
		return $('#flashdata');
	}

	/* 
	 * Fade out flashdata div (or create if it doesn't exist)
	 * Update message
	 * Fade back in
	 */
	show_flash = function(msg) {
		// Clear timer - just in case
		if(window.timer)
			clearTimeout(window.timer);
				
		var container = $('#flashdata');

		if (! container.get(0)) {
			container = create_container();
			container.hide();
		}

		container.fadeOut('fast', function() {
			$('.message_content').html(msg);
		});
		
		container.fadeIn('fast', hide_flash);
	}

	/* Hide flashdata after 5 seconds (or immediately if it's empty) */
	hide_flash = function() {
		// Clear existing timer to avoid flickering
		if(window.timer)
			clearTimeout(window.timer);

		window.timer = window.setTimeout(function() {
			$('#flashdata').fadeOut("slow", function() {
				$('#flashdata').remove();
			});
		}, 5000);
	}
	
	/* Hijack empty categories */
	observe_empty = function() {
		$('.empty').click(function() {
			var cat = this.id;
			cat = cat.split('_')[1];

			var add_url = BASE_URL + 'member/listings/add/' + cat;

			show_flash('This category is empty.  Be the first to <a href="' + add_url + '">add an entry</a>.');
			return false;
		});
	}

	init = function() {
		// Open links that contain http:// and point to another domain in a new window
	    $('a:not([@href*='+BASE_URL+'])[@href^="http://"]').attr('target', '_blank');
		
		// Registration Optional Field toggle
		$('#show_optional').toggle(
			function() {
				$('#optional').show();
				$(this).toggleClass('less');
				$(this).text('Hide Optional Fields');
				return false;
			},
			function() {
				$('#optional').hide();
				$(this).toggleClass('less');
				$(this).text('Show Optional Fields');
				return false;
			}
		);
		
		// Show/hide inline forms
		$('a.inline').toggle(
			show_inline,
			hide_inline
		);

		// Hide/show stuff
		$('.js_hide').hide();
		$('.js_show').show();

		// Fade out flashdata
		hide_flash();
		
		// Hijack clicks on empty categories - show flash_message
		observe_empty();
		
		// Tips
		$('.tip').mouseover(show_tip);
		$('.tip').mouseout(hide_tip);
		
		// Add confirmations to delete links
		$('.confirm').click(observe_confirm);
		
		// Force focus
		$('.field_error, .focus').get(0).focus();
	}

	$(document).ready(init);
	
	/* Safari bug workaround */
	$(window).bind('load', function() {
		$('.js_hide').hide();
		$('.js_show').show();
	});


})(jQuery);