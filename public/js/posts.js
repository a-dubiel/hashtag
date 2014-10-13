var current_posts = [];
var new_posts = [];
var old_posts = [];
var ajax_connections = 0;
var $load_more = $('.load-more');
var board = { data: '', config: ''};
var $container = $('#posts');
var min_tag_id;
var next_max_id;
var twitter_max_id;
var twitter_new_max_id;
var $count = parseInt($('.check-new').find('span').text());
var $loading = $('.board-loading');
var in_progress = 0;
var google_next;

function handle_before() {
    in_progress++;
};

function handle_complete(posts) {
	in_progress--;
    if (true) {
    	$loading.hide();
    	$load_more.html('Pokaż więcej');
        display_posts(posts);
    }
};

var get_google_posts = function(){
	$.ajax({
		url: base + '/api/google/' + hashtag,
		type: 'GET',
		beforeSend: handle_before,
		async: false,
		success: function(data,status,xhr) {
			current_posts.push(data.posts);
			google_next = data.token;
			handle_complete(current_posts);	
			current_posts = [];				
			
		},
		error: function(data) {
			handle_complete(current_posts);
		}
	});
};

var get_old_google_posts = function(){
	$.ajax({
		url: base + '/api/google/' + hashtag + '/' + google_next,
		type: 'GET',
		beforeSend: handle_before,
		async: false,
		success: function(data,status,xhr) {
			console.log(data.posts);
			current_posts.push(data.posts);
			google_next = data.token;
			handle_complete(current_posts);	
			current_posts = [];				
			
		},
		error: function(data) {
			handle_complete(current_posts);
		}
	});
};

var get_instagram_posts = function(){
	$.ajax({
		url: base + '/api/instagram/' + hashtag,
		type: 'GET',
		beforeSend: handle_before,
		async: false,
		success: function(data,status,xhr) {
			next_max_id = data.next_max_id;
			min_tag_id = data.min_tag_id;
			current_posts.push(data.posts);
			handle_complete(current_posts);	
			current_posts = [];				
			
		},
		error: function(data) {
			handle_complete(current_posts);
		}
	});
};

var get_old_instagram_posts = function(){
	$.ajax({
		url: base + '/api/instagram/' + hashtag + '/' + next_max_id,
		type: 'GET',
		async: false,
		beforeSend: handle_before,
		success: function(data,status,xhr) {
			if(!data.next_max_id == '') {		
				next_max_id = data.next_max_id;
				old_posts.push(data.posts);
				handle_complete(old_posts);	
				old_posts = [];
			}
		},
		error: function(data) {
			handle_complete(old_post);
		}
	});
};

var get_twitter_posts = function(){
	$.ajax({
		url: base + '/api/twitter/' + hashtag,
		type: 'GET',
		beforeSend: handle_before,
		async: false,
		success: function(data,status,xhr) {
			current_posts.push(data.posts);	
			twitter_max_id = data.max_id;
			twitter_new_max_id = data.new_id;
			handle_complete(current_posts);	
			console.log(data);
			current_posts = [];
		},
		error: function(data) {
			handle_complete(current_posts);
		}
	});
	
};

var get_old_twitter_posts = function(){
	$.ajax({
		url: base + '/api/twitter/' + hashtag + '/' + twitter_max_id,
		type: 'GET',
		beforeSend: handle_before,
		async: false,
		success: function(data,status,xhr) {
			if(twitter_max_id !== data.max_id) {
				if(data.posts !== undefined) {
					old_posts.push(data.posts);		
					twitter_max_id = data.max_id;
					handle_complete(old_posts);	
					old_posts = [];
				}
				else {
					handle_complete(old_posts);	
				}

			}
			
		},
		error: function(data) {
			handle_complete(old_posts);
		}
	});
};

(function() {
	$container.isotope({
		animationEngine: 'css',
		masonry: {
			columnWidth: 270,
			isFitWidth: true,
			gutter: 20
		}	
	});
	$.ajax({
		url: base + '/api/board/' + board_id,
		type: 'GET',
		success: function(data,status,xhr) {
			board.data = data.board; 
			board.config = data.config;	


			
			if(data.config.has_insta == 0) {
				get_instagram_posts();
			}
			
			if(data.config.has_tw == 0) {
				get_twitter_posts();
			}

			if(data.config.has_google == 0) {
				get_google_posts();
			}
			
			/**
			if(data.config.refresh == 0) {
				//board_refresh(parseInt(60));
			}
			else {
				//board_refresh(parseInt(data.config.refresh));
			}
			*/
			
				
			
			board_refresh(parseInt(60));
			
			
			
			
		},
		error: function(data) {
			console.log(data);
		}
		
	});
	
})();
$(document).on('click', '.load-more', function(e){

	console.log($load_more);
	
	$load_more.html('<i class="fa fa-circle-o-notch fa-spin"></i>');
	if(board.config.has_insta == 0) {
		get_old_instagram_posts();
	}
	if(board.config.has_tw == 0) {
		get_old_twitter_posts();
	}
	if(board.config.has_google == 0) {
		get_old_google_posts();
	}
	e.preventDefault();
});
var prepend_posts = function(posts) {
	var $items = $(prepare_posts(posts));
	
	$items.imagesLoaded(function(){
		$container.prepend( $items ).isotope( 'prepended', $items );
		$('.check-new').delay(300).addClass('inactive').html('Nowe posty <span>0</span>');
		$("abbr.timeago").timeago();
	});
	
}
var display_posts = function(posts) {
	var $items = $(prepare_posts(posts));
	$items.imagesLoaded(function(){
		$container.isotope( 'insert', $items );
		$("abbr.timeago").timeago();
	});
	posts = [];
}
var prepare_posts = function(data) {
	var content = '';
	for (var i = 0; i < data.length; i++) {
	
		for (var j = 0; j < data[i].length; j++) {
			//console.log( data[i].posts[j].user_id );
			var post = data[i][j];
			if(post.username) {
				content += '<div class="post post-' + post.vendor +'">';
				content += '<div class="filter filter-'+ post.vendor +' pull-right"><i class="fa fa-'+ post.vendor +'"></i></div>';
				content += '<div class="user-info pull-left">';		
				content += '<img src="'+ post.user_img_url +'" />';
				if(post.vendor == "twitter") {
					content += '<a href="http://www.twitter.com/'+ post.username +'" target="_blank">'+ post.username +'</a>';
				}
				else if(post.vendor == "instagram") {
					content += '<a href="http://www.instagram.com/'+ post.username +'" target="_blank">'+ post.username +'</a>';
				}
				else if(post.vendor == "google-plus") {
					content += '<a href="https://plus.google.com/'+ post.user_id +'" target="_blank">'+ post.username +'</a>';
				}
				content += '<p><abbr class="timeago" title="'+ post.date_created +'">'+ post.date_created + '</abbr></p>';
				content += '</div><div class="clearfix"></div>';
				if(post.post_type == "image") {
					content += '<div class="post-img">';
					content += '<img src="'+ post.img_url +'" alt="" />';
					content += '</div>';
				}
				else if(post.post_type == "video") {
					content += '<div class="post-img">';
					content += '<img src="'+ post.img_url +'" alt="" />';
					content += '</div>';
				}


				if(post.caption && post.caption.length > 0){
					content += '<div class="post-description">';
					content += '<p>' + post.caption.replace(/#([^\s#]+)/g, '<a class="hashtag" href="'+ base +'/$1/szukaj">#$1</a> ') + '</p>';
					content += '</div>';	
				}

				content += '</div>';
			}		
		};
	};
	return content;
};
var board_refresh = function(interval){
	
	$check = $('.check-new');
	setInterval(function(){
	if(board.config.has_insta == 0) {
		var new_insta = $.ajax({
		    type: 'GET',       
		    url: base + '/api/instagram/new/' + hashtag + '/' + min_tag_id,
		    global: false,
		    async:false,
		    dataType:'json',
		    success: function(data, status, xhr) {		      	       
		        min_tag_id = data.min_tag_id;
		        return data;
		    }
		}).responseText;
		
		if(new_insta.length > 0) {
			$count += $.parseJSON(new_insta).count;
			$posts = $.parseJSON(new_insta).posts;
			new_posts.push($posts);
		}
	}
	if(board.config.has_tw == 0) {
		
	
		var new_tw = $.ajax({
		    type: 'GET',       
		    url: base + '/api/twitter/new/' + hashtag + '/' + twitter_new_max_id,
		    global: false,
		    async:false,
		    dataType:'json',
		    success: function(data, status, xhr) {			    	
			       return data;
		    }
		}).responseText;
	
		if(new_tw.length > 0) {
			if(twitter_new_max_id !==  $.parseJSON(new_tw).max_id) {
				$count += $.parseJSON(new_tw).count;
				$posts = $.parseJSON(new_tw).posts;
				twitter_new_max_id = $.parseJSON(new_tw).max_id;
				new_posts.push($posts);
			}
		}
		
	}
	if($count > 0) {
		$check.removeClass('inactive');
		$check.find('span').text($count);
		$('title').text('(' + $count + ') #' + hashtag + ' | hashtag.info' );	
	}
	}, interval * 1000);
	
	
	
	
};
$(document).on('click', '.check-new', function(e){
	$('.check-new').html('Dodaje <i class="fa fa-circle-o-notch fa-spin"></i>');
	$('title').text('#' + hashtag + ' | hashtag.info' );
	$count = 0;
	prepend_posts(new_posts);
	new_posts = [];
	
	e.preventDefault();
});
(function() {
	function numpf(n, s, t) {
    // s - 2-4, 22-24, 32-34 ...
    // t - 5-21, 25-31, ...
    var n10 = n % 10;
    if ( (n10 > 1) && (n10 < 5) && ( (n > 20) || (n < 10) ) ) {
    	return s;
    } else {
    	return t;
    }
}
jQuery.timeago.settings.strings = {
	prefixAgo: null,
	prefixFromNow: "za",
	suffixAgo: "temu",
	suffixFromNow: null,
	seconds: "mniej niż minutę",
	minute: "minutę",
	minutes: function(value) { return numpf(value, "%d minuty", "%d minut"); },
	hour: "godzinę",
	hours: function(value) { return numpf(value, "%d godziny", "%d godzin"); },
	day: "dzień",
	days: "%d dni",
	month: "miesiąc",
	months: function(value) { return numpf(value, "%d miesiące", "%d miesięcy"); },
	year: "rok",
	years: function(value) { return numpf(value, "%d lata", "%d lat"); }
};
})();
$(document).ready(function(){
	
});