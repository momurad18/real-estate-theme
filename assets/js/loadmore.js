jQuery(function($){
	//blog posts static page
	$('#loadmore').click(function(){
 
		var button = $(this),
		    data = {
			'action': 'loadmore',
			'query': utechs_loadmore_params.posts,
			'page' : utechs_loadmore_params.current_page
		};
 
		$.ajax({
			url : utechs_loadmore_params.ajaxurl,
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {
				button.text('....'); 
			},
			success : function( data ){
				if( data ) { 
                    button.text( 'المزيد' ).prev().append($(data).fadeIn(1000)); 
					utechs_loadmore_params.current_page++;
 
					if ( utechs_loadmore_params.current_page == utechs_loadmore_params.max_page ) 
						button.remove();
				} else {
					button.remove();
				}
			}
		});
    });
    
	$('#loadmore-featured').click(function(){
		//custom query on front-page.php
		var button = $(this),
		    data = {
			'action': 'loadmore',
			'query': posts_myajax,
            'page' : current_page_myajax,
            'type' : post_type,
            'featured': featured
		};
 
		$.ajax({
			url : utechs_loadmore_params.ajaxurl, // AJAX handler
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {
				button.text('....'); // change the button text, you can also add a preloader image
			},
			success : function( data ){
				if( data ) { 
                    button.text( 'المزيد' ).prev().append($(data).fadeIn(1000)); // insert new posts
					current_page_myajax++;
 
					if ( current_page_myajax == max_page_myajax )
						button.remove(); // if last page, remove the button
				} else {
					//button.remove(); // if no data, remove the button as well
				}
			}
		});
    });

});