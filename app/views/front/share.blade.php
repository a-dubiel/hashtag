<div class="content-popup animated bounceInDown">
	<div class="popup-intro">
		<h3>Podziel się!</h3>
		<p>Skopiuj link albo podziel się bezpośrednio.</p>
	</div>

		<input type="text" value="{{ URL::to($url) }}" class="input-default input-block" />
		<!-- Go to www.addthis.com/dashboard to generate a new set of sharing buttons -->
		<div class="share-links">
			<a data-vendor="fb" data-url="{{ URL::to($url) }}" href="#"><span class="filter filter-facebook"><i class="fa fa-facebook"></i></span></a>
			<a data-vendor="tw" data-url="{{ URL::to($url) }}" href="#"><span class="filter filter-twitter"><i class="fa fa-twitter"></i></span></a>
			<a data-vendor="gl" data-url="{{ URL::to($url) }}" href="#"><span class="filter filter-google-plus"><i class="fa fa-google-plus"></i></span></a>
			<a data-vendor="mail" data-url="{{ URL::to($url) }}" href="#"><span class="filter filter-envelope"><i class="fa fa-envelope"></i></span></a>
		</div>
</div>