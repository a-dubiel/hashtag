/*
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height properties
 * ( source: http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
*/
function updateViewportDimensions() {
	var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
	return { width:x,height:y }
}
// setting the viewport width
var viewport = updateViewportDimensions();


/*
 * Throttle Resize-triggered Events
*/
var waitForFinalEvent = (function () {
	var timers = {};
	return function (callback, ms, uniqueId) {
		if (!uniqueId) { uniqueId = "Don't call this twice without a uniqueId"; }
		if (timers[uniqueId]) { clearTimeout (timers[uniqueId]); }
		timers[uniqueId] = setTimeout(callback, ms);
	};
})();

// how long to wait before deciding the resize has stopped, in ms. Around 50-100 should work ok.
var timeToWaitForLast = 100;



function youtube_parser(url){
    var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
    var match = url.match(regExp);
    if (match&&match[7].length==11){
        return match[7];
    }
}

function facebook_parser(url){
    var regExp = /^[^#?]*\?(?:[^#]*&)?v=(\d+)(?:[#&]|$)/;
    var match = url.match(regExp);
    if (match){
        return match[1];
    }
}
/*
 * Put all your regular jQuery in here.
*/
jQuery(document).ready(function($) {

  $('.faq-item').click(function(){
    el = $(this);
    el.find('.fa').toggleClass('fa-minus');
    el.parent().find('.faq-content').toggleClass('hide');
    return false;
  });

  if(('.timeago').length > 0) {
    $('.timeago').timeago();
  }

  if(('.alert-top').length > 0) {
    setTimeout(function() {
      $('.alert-top').addClass('fadeOutUpBig');
    }, 5000);
  }

  $('.js-close-alert').click(function(e){
    $('.alert-top').addClass('fadeOutUpBig');
    e.preventDefault();
  });

  $('.js-close-cookies, .cookie-info').click(function(e) {
    $('.cookie-info').addClass('fadeOutDown');
    $.get(base + '/ajax/cookies', function(){});
    e.preventDefault();
  });

  if (window.location.hash == '#_=_') {
    window.location.hash = '';
    history.pushState('', document.title, window.location.pathname);
}

  $('.input-default').focus(function(){
    $el = $(this);
    if($el.hasClass('has-error')) {
      $el.removeClass('has-error');
      $el.next('p.help-block').hide();
    }
  });

  $(document).on('click', '.js-signup-popup', function(e){

      if(!is_logged_in) {

        $.ajax({
          url: base + '/popup/signup',
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
                }
              });


          },
          error: function(data, status, xhr) {
            
          }
      });

      }

      e.preventDefault();
    });

   $(document).on('click', '.js-login-popup', function(e){

      if(!is_logged_in) {

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
                }
              });
          },
          error: function(data, status, xhr) {
            console.log(data);
          }
      });

      }

      e.preventDefault();
    });

    $(document).on('submit', '#change-desc',function(){

      $wrap = $('.board-description');
      $data = $('#input-desc').val()


        $.ajax({
          url: base + '/board/update/description',
          type: 'POST', 
          data: {
            '_token': $('meta[name="_token"]').attr('content'),
            'description' : $('#input-desc').val(),
            'board_id' : board_id
          },
          success: function(data, status, xhr) {

              if(data.length > 0) {
                $('#change-desc').remove();
                $wrap.append('<div class="board-description-wrapper"><p class="board-description-data">'+ data +'</p><a href="#" class="btn-default btn-link-primary btn-text js-update-description">Edytuj opis</a></div>')
              }
              else {
                $wrap.html('');
                $wrap.append('<div class="board-description-wrapper"><p class="board-description-data">Co oznacza ten hasztag?</p><a href="#" class="btn-default btn-link-primary btn-text js-update-description">Edytuj opis</a></div>')
              } 


          },
          error: function(data, status, xhr) {
            
          }
      });
      return false;
    });
  
    $(document).on('click', '.share-links a', function(e){
        share_url = $(this).data('url');
        vendor = $(this).data('vendor');
        width = 500;
        height = 400;
        var leftPosition, topPosition, url;


        if(vendor == 'fb') {
          url = 'https://www.facebook.com/sharer/sharer.php?u='+ encodeURI(share_url) +'"';
        }
        else if(vendor == 'tw') {
          url = 'http://www.twitter.com/share?url='+ encodeURI(share_url);
        }
        else if(vendor == 'gl') {
          url = 'https://plus.google.com/share?url='+ encodeURI(share_url);
        }
        else if(vendor == 'mail') {
          url = "mailto:?body=" + share_url + "&subject=Zobacz to na hasztag.info";
        }


        


        //Allow for borders.
        leftPosition = (window.screen.width / 2) - ((width / 2) + 10);
        //Allow for title and status bars.
        topPosition = (window.screen.height / 2) - ((height / 2) + 50);
        window.open(url, "share_window", "status=no,height=" + height + ",width=" + width + ",resizable=yes,left=" + leftPosition + ",top=" + topPosition + ",screenX=" + leftPosition + ",screenY=" + topPosition + ",toolbar=no,menubar=no,scrollbars=no,location=no,directories=no");

        e.preventDefault();
    });
    
    $('.js-share').click(function(e){

       $.ajax({
          url: base + '/popup/share',
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
                }
              });
          },
          error: function(data, status, xhr) {
            console.log(data);
          }
      });
     
      e.preventDefault();
    });

    $(document).on('click', '.js-update-description', function(e) {

      if(is_logged_in) {
          $desc = $('.board-description-data');
          $wrap = $('.board-description-wrapper');
          $wrap.wrap('<form action="" id="change-desc" method="post">');
          $wrap.append($('<input />',{'value' : $desc.text(), 'class' : 'input-blank input-default', 'type' : 'text', 'id' : 'input-desc'}  ));
          $wrap.append($('<input />',{'value' : 'OK', 'class' : 'hide', 'type' : 'submit' }  ));
          $('#change-desc').find('.input-blank').val('').focus();
          $(this).hide();
          $desc.hide();
      }
      else {

        $.ajax({
          url: base + '/popup/signup',
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
                }

              });


          },
          error: function(data, status, xhr) {
            
          }
      });
        
      }

      e.preventDefault();
    });

    $.extend(true, $.magnificPopup.defaults, {
      tClose: 'Zamknij (Esc)', // Alt text on close button
      tLoading: 'Ładuje...', // Text that is displayed during loading. Can contain %curr% and %total% keys
      gallery: {
        tPrev: 'Poprzedni (Lewa strzałka)', // Alt text on left arrow
        tNext: 'Następny (Prawa strzałka)', // Alt text on right arrow
        tCounter: '%curr% z %total%' // Markup for "1 of 7" counter
      },
      image: {
        tError: 'Nie mogę załadować <a href="%url%">obrazka</a>.' // Error message when image could not be loaded
      },
      ajax: {
        tError: 'Nie mogę otworzyć <a href="%url%">zawartości</a>.' // Error message when ajax request failed
      }
});

    $(document).on('click', '.video-link-popup', function(e){
        
        $el = $(this);



        var $video = '<div class="video-popup"><video type="video/mp4" autoplay="autoplay" controls="controls" loop="true" poster="'+ $el.attr('href') +'" src="'+ $el.data('video') +'" alt=""><img src="'+ $el.attr('href') +'" alt=""></video></div>';

        $.magnificPopup.open({
          items: {
            src: $video, // can be a HTML string, jQuery object, or CSS selector
            type: 'inline'
          }
        });

        e.preventDefault();
   });

   $(document).on('click', '.image-link', function(e){
        
        $el = $(this);

        console.log($el.data('username'));

        $.magnificPopup.open({
          image: {
            titleSrc: $el.data('username'),
            verticalFit: true
          },
          items: {
            src: $el.attr('href'),
          },
          type: 'image'        

          // You may add options here, they're exactly the same as for $.fn.magnificPopup call
          // Note that some settings that rely on click event (like disableOn or midClick) will not work here
        }, 0);

        e.preventDefault();
   });

   $(document).on('click', '.video-link', function(e){
        
        $el = $(this);

        $.magnificPopup.open({
          image: {
            titleSrc: $el.data('username'),
            verticalFit: true
          },
          items: {
            src: $el.attr('href'),
          },
          type: 'iframe',
          iframe: {
              markup: '<div class="mfp-iframe-scaler">'+
                        '<div class="mfp-close"></div>'+
                        '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
                      '</div>', // HTML markup of popup, `mfp-close` will be replaced by the close button

              patterns: {
                youtube: {
                  index: 'youtu', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).

                  id: function(url){
                    return youtube_parser(url)
                  }, // String that splits URL in a two parts, second part should be %id%
                  // Or null - full URL will be returned
                  // Or a function that should return %id%, for example:
                  // id: function(url) { return 'parsed id'; } 

                  src: '//www.youtube.com/embed/%id%?autoplay=1' // URL that will be set as a source for iframe. 
                },
                vimeo: {
                  index: 'vimeo.com/',
                  id: '/',
                  src: '//player.vimeo.com/video/%id%?autoplay=1'
                },
                gmaps: {
                  index: '//maps.google.',
                  src: '%id%&output=embed'
                },
                facebook: {
                    index: 'facebook.com',
                    id: function(url) {
                        return facebook_parser(url)
                    },
                    src: '//www.facebook.com/video/embed?video_id=%id%'
                }
                

                // you may add here more sources

              },

              srcAction: 'iframe_src', // Templating object key. First part defines CSS selector, second attribute. "iframe_src" means: find "iframe" and set attribute "src".
        }        

          // You may add options here, they're exactly the same as for $.fn.magnificPopup call
          // Note that some settings that rely on click event (like disableOn or midClick) will not work here
        }, 0);

        e.preventDefault();

   });
  

}); /* end of as page load scripts */
