jQuery(document).ready(function(){

	$('.js-cc-number').keyup(function(){
		$('.fa-cc-visa, .fa-cc-mastercard').removeClass('selected');
		if($(this).val().length >= 6){
       		cardType = detectCardType($(this).val());
       		
       		if(cardType == 'VISA') {
       			$('.fa-cc-visa').addClass('selected');
       		}
       		if(cardType == 'MASTERCARD') {
       			$('.fa-cc-mastercard').addClass('selected');
       		}
   		}
	});

	$('#form-company').click(function(){
		$('.form-company').removeClass('show').toggleClass('hide').find('input[type="text"]').val('');

	
	});

	if($('.board-description').length > 0 ) {
		$('.js-board-counter').text(100 - $('.board-description').val().length);

		$('.board-description').keyup(function () {
		    var left = 100 - $(this).val().length;
		    if (left < 0) {
		        left = 0;
		    }
		    while($(this).outerHeight() < this.scrollHeight + parseFloat($(this).css("borderTopWidth")) + parseFloat($(this).css("borderBottomWidth"))) {
	        	$(this).height($(this).height()+1); 
	        }
	    
		    $('.js-board-counter').text(100 - $(this).val().length);
		});
	}

	$('.js-confirm').click(function(e){
		var r = confirm('Napewno?');

		if(r == true) {
			return true;
		}
		else {
			return e.preventDefault();
		}
	});

	$container = $('#featured-posts');

	$container.imagesLoaded(function(){

		$container.isotope({
			animationEngine: 'css',
			masonry: {
				columnWidth: 270,
				isFitWidth: true,
				gutter: 10
			}	
		});
				
	});


	$(document).on('click', '.js-remove-featured', function(e){

	var el = $(this);
	var id = el.data('post-id');
	
	$.ajax({
		url: base + '/board/post/featured/remove',
		data: {
			'board_id' : board_id,
			'post_id' : id,		
			'_token': $('meta[name="_token"]').attr('content')
		},
		type: 'POST',	
		success: function(data, status, xhr) {
				$post = $('.post[data-post-id='+ id +']');
				$container.isotope( 'remove', $post ).isotope( 'layout' );

		},
		error: function(data, status, xhr) {
		
		}
	});


	e.preventDefault();
});

});


function detectCardType(number) {
    var re = {
        electron: /^(4026|417500|4405|4508|4844|4913|4917)\d+$/,
        maestro: /^(5018|5020|5038|5612|5893|6304|6759|6761|6762|6763|0604|6390)\d+$/,
        dankort: /^(5019)\d+$/,
        interpayment: /^(636)\d+$/,
        unionpay: /^(62|88)\d+$/,
        visa: /^4[0-9]{12}(?:[0-9]{3})?$/,
        mastercard: /^5[1-5][0-9]{14}$/,
        amex: /^3[47][0-9]{13}$/,
        diners: /^3(?:0[0-5]|[68][0-9])[0-9]{11}$/,
        discover: /^6(?:011|5[0-9]{2})[0-9]{12}$/,
        jcb: /^(?:2131|1800|35\d{3})\d{11}$/
    };
    if (re.electron.test(number)) {
        return 'ELECTRON';
    } else if (re.maestro.test(number)) {
        return 'MAESTRO';
    } else if (re.dankort.test(number)) {
        return 'DANKORT';
    } else if (re.interpayment.test(number)) {
        return 'INTERPAYMENT';
    } else if (re.unionpay.test(number)) {
        return 'UNIONPAY';
    } else if (re.visa.test(number)) {
        return 'VISA';
    } else if (re.mastercard.test(number)) {
        return 'MASTERCARD';
    } else if (re.amex.test(number)) {
        return 'AMEX';
    } else if (re.diners.test(number)) {
        return 'DINERS';
    } else if (re.discover.test(number)) {
        return 'DISCOVER';
    } else if (re.jcb.test(number)) {
        return 'JCB';
    } else {
        return undefined;
    }
}