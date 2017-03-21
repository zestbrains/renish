(function($) {
	$.fn.scrollPagination = function(options) {		
		var settings = { 
			nop     : 8, // The number of posts per scroll to be loaded
			offset  : 0, // Initial offset, begins at 0 in this case
			initMsg : 'Loading content .....',
			error   : 'No More Posts!', // When the user reaches the end this is the message that is
			                            // displayed. You can change this if you want.
			delay   : 500, // When you scroll down the posts will load after a delayed amount of time.
			               // This is mainly for usability concerns. You can alter this as you see fit
			scroll  : true, // The main bit, if set to false posts will not load as the user scrolls. 
			               // but will still load if the user clicks.
			ajaxFile : '',
			addDiv:true,			
			extraData:new Array(),
			more_button:'<a href="javascript:void(0);" class="more-btn"></a>'
		}		
		// Extend the options so they work with the plugin
		if(options) {
			$.extend(settings, options);
		}		
		// For each so that we keep chainability.
		return this.each(function() {			
			// Some variables 
			$this = $(this);
			$settings = settings;
			var ajaxFile = $settings.ajaxFile;
			var offset = $settings.offset;
			var loadImg = $settings.initMsg;
			var busy = false; // Checks if the scroll action is happening 
			                  // so we don't run it multiple times
			
			// Custom messages based on settings
			if($settings.scroll == true) $initmessage = '';
			else $initmessage = `<div class="text-center">
									`+$settings.more_button+`
								</div>`;
			
			// Append custom messages and extra UI
			if($settings.addDiv)
			{
				$this.append('<ul class="top-events list-content" ></ul><div class="loading-bar flclear clearfix">'+$initmessage+'</div>');
			}
			else
			{
				$this.append('<tr class="loading-bar"><td colspan="4">'+$initmessage+'</td></tr>');
			}
			
			function getData() {
				
				// Post data to ajax.php
				$.post($settings.ajaxFile, {
						
					action        : $settings.action,
				    limit        : $settings.nop,
				    offset        : offset,
					extraData : $settings.extraData
					
					    
				}, function(data) {
					
					// Change loading bar content (it may have been altered)
					
					
					if($settings.addDiv)
					{
						$this.find('.loading-bar').html($initmessage);
					}
					else
					{
						$this.find('.loading-bar').remove();
						$this.append($initmessage);
					}
						
					// If there is no data returned, there are no more posts to be shown. Show error
					
					if(data.list == "") { 
						if($settings.addDiv)
						{
							$this.find('.loading-bar').html('<span class="nmrf">'+$settings.error+'</span>');	
						}
						else
						{
							$this.find('.loading-bar').remove();
							$this.append('<span class="nmrf">'+$settings.error+'</span>');	
						}
					}
					else {
						
						// Offset increases
						offset = offset+$settings.nop; 
						    
						// Append the data to the content div
						if($settings.addDiv)
						{
					   		$this.find('.list-content').append(data.list);
						}
						else
						{
							$this.append(data.list);
						}
						// No longer busy!	
						busy = false;
					}	
						
				}, 'json');
				  $.ajaxSetup({async: false});
					
			}	
			
			getData(); // Run function initially
			
			// If scrolling is enabled
			if($settings.scroll == true) {
				// .. and the user is scrolling
				$(window).scroll(function() {
					
					
					// Check the user is at the bottom of the element
					if((parseFloat($(window).scrollTop()) + parseFloat($(window).height())) > $this.height() && !busy ) {
						
						// Now we are working, so busy is true
						busy = true;
						
						// Tell the user we're loading posts
						$this.find('.loading-bar').html($settings.initMsg);
						
						// Run the function to fetch the data inside a delay
						// This is useful if you have content in a footer you
						// want the user to see.
						setTimeout(function() {
							
							getData();
							
						}, $settings.delay);
							
					}	
				});
			}
			
			// Also content can be loaded by clicking the loading bar/
			$this.find('.loading-bar').click(function() {
			
				if(busy == false) {
					busy = true;
					getData();
				}
			
			});
			
		});
	}

})(jQuery);
