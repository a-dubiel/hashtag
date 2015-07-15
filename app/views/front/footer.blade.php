<footer class="footer-bottom">
	<div class="container">
		<a href="{{ URL::to('/') }}" class="logo-footer">hasztag.info</a>
		<nav class="footer-nav">
			<ul>
				<li><a href="{{ URL::to('/informacje') }}">Informacje</a></li>
				<li><a href="{{ URL::to('/kontakt') }}">Kontakt</a></li>
				<li><a href="{{ URL::to('/regulamin') }}">Regulamin</a></li>
			</ul>
		</nav>
		
      <a href="http://dubiel.me" target="_blank" class="made-by">
       <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
       viewBox="0 0 800 600" enable-background="new 0 0 800 600" xml:space="preserve">
       <g opacity="0.25">
         <path fill="#FFFFFF" d="M360.3,345.6c0,16.1,8,25.5,24.4,25.5c13.6,0,26.1-8.3,33.8-23.3V314h-11.1
         C372.3,314,360.3,324.8,360.3,345.6z"/>
         <path fill="#FFFFFF" d="M659.9,149.8L399.2,0L138.7,149.8v299.6l260.7,149.8l260.5-149.8V149.8z M480.7,416.1
         c-25.2-2.5-41.9-10-51.9-27.5c-15.3,19.7-39.7,28.3-65.2,28.3c-43.8,0-70.7-27.5-70.7-66.9c0-46,36.1-72.4,101.5-72.4h24.4v-7.5
         c0-24.7-10-32.5-38.8-32.5c-12.8,0-33.6,3.9-55.2,11.1l-14.4-42.4c27.2-10.3,57.1-16.1,79.6-16.1c64.6,0,90.4,25.5,90.4,75.2v82.7
         c0,16.1,3.6,21.9,13.6,25.5L480.7,416.1z"/>
       </g>
     </svg>
   </a>


</div>
</footer>
<?php if(Cookie::get('cookie_accept') === NULL ):?>
 <div class="cookie-info animated fadeInUp">
    <p>Wcinamy ciastka. Możesz poczytać <a href="{{ URL::to('/regulamin') }}">dlaczego</a> tak robimy. Korzystając z serwisu akceptujesz regulamin. <a href="#" class="js-close-cookies"><i class="fa fa-times"></i></a></p>
  </div>
<?php endif;?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-55885153-1', 'auto');
  ga('send', 'pageview');

</script>