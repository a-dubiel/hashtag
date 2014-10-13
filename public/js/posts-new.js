(function() {

	var $container = $('#posts');
	var $loading = $('.board-loading');
	var $check = $('.check-new');
	var $count = is_live == true ? 0 : parseInt($('.check-new').find('span').text());
	var newPosts = '';
	var filterValue;
	var endpoints;


	$container.isotope({
		animationEngine: 'css',
		masonry: {
			columnWidth: 270,
			isFitWidth: true,
			gutter: 20
		}	
	});

	$.ajax({
		url: base + '/show/board/' + board_id,
		type: 'GET',	
		success: function(data, status, xhr) {
			
			if(data.message == 'No posts') {
				$loading.html('<div class="no-posts"><i class="fa fa-meh-o"></i><span>Brak wyników</span></div>');
			}
			else {
				console.log(data.endpoints);
				display_posts(data.posts, false);
				endpoints = data.endpoints;
			
				if(is_logged_in == true) {
					refresh_board(parseInt(refresh_interval));
				}
			}

		},
		error: function(data, status, xhr) {
		
		}
	});

	var display_posts = function(posts, option) {
		
		var $items = $(posts);
		if(option == false) {
			$items.imagesLoaded(function(){
				$loading.remove();
				$container.isotope( 'insert', $items );
				$('abbr.timeago').timeago();
			});
		}
		else if(option == true){
			$items.imagesLoaded(function(){
				$container.prepend( $items ).isotope( 'prepended', $items );
				$('abbr.timeago').timeago();
			});
		}
		
	};

	$(document).on('click', '.js-remove-featured', function(e){

		var el = $(this)
		var id = el.data('post-id');
		el.removeClass('js-remove-featured').addClass('js-make-featured');

		$('.post[data-post-id='+ id +']').removeClass('is-featured-post');

		
		$.ajax({
			url: base + '/board/post/featured/remove',
			data: {
				'board_id' : board_id,
				'post_id' : id,		
				'_token': $('meta[name="_token"]').attr('content')
			},
			type: 'POST',	
			success: function(data, status, xhr) {
					if(data == 'max') {
						alert('Limit promowanych postów przekroczony!');
						$('.post[data-post-id='+ id +']').removeClass('is-featured-post');
					}
			},
			error: function(data, status, xhr) {
			
			}
		});


		e.preventDefault();
	});

	$(document).on('click', '.js-make-featured', function(e){

		var el = $(this)
		var id = el.data('post-id');
		el.removeClass('js-make-featured').addClass('js-remove-featured');

		$('.post[data-post-id='+ id +']').addClass('is-featured-post');

		post_data = $('.post[data-post-id='+ id +']').clone().wrap('<div>').parent().html();
		
		$.ajax({
			url: base + '/board/post/featured',
			data: {
				'board_id' : board_id,
				'post_id' : id,
				'post' : post_data,
				'_token': $('meta[name="_token"]').attr('content')
			},
			type: 'POST',	
			success: function(data, status, xhr) {
					
				if(data == 'max') {
					alert('Limit promowanych postów przekroczony!');
					$('.post[data-post-id='+ id +']').removeClass('is-featured-post');
				}
			},
			error: function(data, status, xhr) {
			
			}
		});


		e.preventDefault();
	});

	$('.filters').on( 'click', 'a.filter', function() {
		var $el = $(this);
		if($el.attr('data-filter') == filterValue) {
			$('a.filter').removeClass('active').removeClass('inactive');
			filterValue = '*';
		}
		else {
			$('a.filter').removeClass('active').addClass('inactive');
			$el.removeClass('inactive').addClass('active');
    		filterValue = $el.attr('data-filter');
		}		

    	$container.isotope({ filter: filterValue });
  	});


  	$('.load-more').click(function(e){
  		
  		$el = $(this);
 		$el.html('<i class="fa fa-circle-o-notch fa-spin"></i>');
  		
  		$.ajax({
			url: base + '/show/board/more/' + board_id,
			data: {
				'endpoints': endpoints,
				'_token': $('meta[name="_token"]').attr('content')
			},
			type: 'POST',	
			success: function(data, status, xhr) {
	
				if(data.message == 'No posts') {
					$el.remove();
				}
				else {
					display_posts(data.posts, false);
					endpoints.twitter_max_id = data.endpoints.twitter_max_id;
					endpoints.instagram_max_id = data.endpoints.instagram_max_id;
					endpoints.google_token = data.endpoints.google_token;
					endpoints.facebook_until_id = data.endpoints.facebook_until_id;
					$el.html('Pokaż więcej');
				}
			},
			error: function(data, status, xhr) {
			
			}
			});

		e.preventDefault();
  	});

  	var refresh_board = function(interval) {	
  		
  		var the_refresh_count = 0;

  		var func = setInterval(function(){
  			console.log(refresh_count);
  			console.log(the_refresh_count);
  			if(the_refresh_count < parseInt(refresh_count)) {
  				
	  			if($count <= 50 ) {

			  		$.ajax({
						url: base + '/show/board/new/' + board_id,
						data: {
							'endpoints': endpoints,
							'_token': $('meta[name="_token"]').attr('content')
						},
						type: 'POST',	
						success: function(data, status, xhr) {
							console.log(data);
							if(data.message != 'No posts') {

								endpoints.twitter_since_id = data.endpoints.twitter_since_id;
								endpoints.instagram_min_tag = data.endpoints.instagram_min_tag;
								endpoints.facebook_since_id = data.endpoints.facebook_since_id;
								endpoints.vine_since_id = data.endpoints.vine_since_id;

								if(is_live == true) {
									newPosts += data.posts;
									display_posts(newPosts, true);
		  							newPosts = '';
								} 
								else {
									$check.removeClass('inactive');
									$count += data.count; 
									$check.find('span').text($count);
									$('title').text('(' + $count + ') #' + hashtag + ' | hashtag.info' );
									newPosts += data.posts;
								}
								

							}
							
						},
						error: function(data, status, xhr) {
						
						}
					});
		  		}

		  		the_refresh_count++

	  		}
	  		else {
	  			clearInterval(func);
	  		}
	  		
	  	}, interval * 1000);
  	};

  	

  	$('.check-new').click(function(e){
  		e.preventDefault();
  		
  		if(is_logged_in == false) {
  			
  			$.ajax({
          url: base + '/popup/login',
          type: 'POST', 
          data: {
            '_token': $('meta[name="_token"]').attr('content'),
            'path' : window.location.pathname
          },
          success: function(data, status, xhr) {

              $.magnificPopup.close();
     
              $.magnificPopup.open({
                items: {
                  src: data, // can be a HTML string, jQuery object, or CSS selector
                  type: 'inline'
                },
                callbacks: {
                markupParse: function(template, values, item) {
                    // optionally apply your own logic - modify "template" element based on data in "values"
                     console.log('Parsing:', template, values, item);
                  }
                }
              });


          },
          error: function(data, status, xhr) {
            
          }
      });


  		}
  		else {
  			if($(this).hasClass('inactive')) {
  				return;
	  		}
	  		else {
	  			if(newPosts.length > 0) {
		  			display_posts(newPosts, true);
		  			newPosts = '';
		  			$count = 0;
		  			$check.addClass('inactive').find('span').text('0');
		  			$('title').text('#' + hashtag + ' | hashtag.info' );
	  			}
	  		}
  		}
 
	
  	});

  




	
	
	



      
    

        

     
    

	


})();





  