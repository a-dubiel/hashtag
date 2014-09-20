
var posts = [];
var ajax_connections = 0;
var load_more = $('.load-more');
var board = { config: ''};
var $container = $('#posts');


(function() {





	$container.isotope({
		masonry: {
      		columnWidth: 270,
      		isFitWidth: true,
      		gutter: 20
    	}	
	});

	$.ajax({
		url: base + '/board/' + hashtag,
		type: 'GET',
		success: function(data,status,xhr) {
		
		board.config = data; 			

		if(data.has_instagram == 1) {
			var instagram_posts = get_instagram_posts();
		}

		



		if(ajax_connections == 0) {
			var $items = $(prepare_posts(posts));
			
			$items.imagesLoaded(function(){
  				$container.isotope( 'insert', $items );

  					$("abbr.timeago").timeago();


			});

			posts = [];

			
			
		}







	}
	
		
	});

	load_more.click(function(e){
		get_more_posts();


				e.preventDefault();

	});


})();


var get_more_posts = function() {

	if(board.config.has_instagram == 1) {

		max_id = load_more.attr('data-instagram-max-id');
		
		$.ajax({
		url: base + '/api/instagram/more/' + hashtag + '/' + max_id,
		type: 'GET',
		async: false,
		success: function(data,status,xhr) {
			posts.push(data);

			load_more.attr('data-instagram-max-id', data.next_url );




		}


	});



	}


	var $items = $(prepare_posts(posts));
			
	$items.imagesLoaded(function(){
		$container.isotope( 'insert', $items );

				$("abbr.timeago").timeago();
	});

	posts = [];



	};






var get_instagram_posts = function(){

	$.ajax({
		url: base + '/api/instagram/' + hashtag,
		type: 'GET',
		beforeSend: function() { ajax_connections++ },
		async: false,
		success: function(data,status,xhr) {
			ajax_connections--;
			posts.push(data);

			load_more.attr('data-instagram-max-id', data.next_url );

		}
	});
};



var prepare_posts = function(data) {
	var content = '';

	console.log(data.length);

	for (var i = 0; i < data.length; i++) {
		console.log();
		for (var j = 0; j < data[i].posts.length; j++) {
			//console.log( data[i].posts[j].user_id );
			var post = data[i].posts[j];
			
			content += '<div class="post">';
			content += '<div class="filter filter-'+ post.vendor +' pull-right"><i class="fa fa-'+ post.vendor +'"></i></div>';
			content += '<div class="user-info pull-left">';
			if(post.username && post.user_img_url) {
				content += '<img src="'+ post.user_img_url +'" />';
				content += '<a href="http://www.instagram.com/'+ post.username +'">'+ post.username +'</a>';
			}
			content += '<p><abbr class="timeago" title="'+ post.date_created +'">'+ post.date_created + '</abbr></p>';
			content += '</div>';
			
			if(post.post_type == "image") {
				content += '<div class="post-img">';
				content += '<img src="'+ post.img_url +'" />';
				content += '</div>';
			}
			else if(post.post_type == "video") {
				content += 'video!!!!!';
			}

			if(post.caption){
				content += '<div class="post-description">';
				content += '<p>' + post.caption.replace(/#([^\s#]+)/g, '<a class="hashtag" href="'+ base +'/$1/szukaj">#$1</a> ') + '</p>';
				content += '</div></div>';	
			}		
		};
	};

	return content;

};


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