(function($) {
    "use strict"; 
    $(function() {     	
		// primary menu sub navigation	
		$('#primary-menu .menu-item-has-children').each(function() {
			$('a:first', this).append('<span class="glyphicon glyphicon-plus-sign"></span>');
		});	
		$('#primary-menu li span').on('click', function(event) {
			event.preventDefault();
			var id = $(this).closest('li').attr('id');	
			$('#'+id).addClass('nav-clicked');		
			if ($(this).hasClass('glyphicon-plus-sign')) {							
				$('#'+id+' .sub-menu').slideDown();
				$(this).attr('class','glyphicon glyphicon-minus-sign');												
			} else {
				$('#'+id+' .sub-menu').slideUp();
				$(this).attr('class','glyphicon glyphicon-plus-sign');
				$(this).closest('li').removeClass('nav-clicked');
			}			
		});		
    	// scroll to top
    	$('a[href="#top"]').click(function() {
			$('html, body').animate({ scrollTop: 0 }, 'slow');
			return false;
		}); 
		// sidebar zebra		
		$('#sidebar-right .widget:even').addClass('zebra');    	   	
 	}); 
}(jQuery));