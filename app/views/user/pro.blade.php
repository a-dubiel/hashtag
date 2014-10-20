@extends('user.master')

@section('content')

<div class="container">
	<h1>Konto</h1>
	<nav class="nav-account">
		<ul>
			<li><a href="{{ URL::to('/konto') }}">Ustawienia</a></li>
			<li><a href="{{ URL::to('/konto/tablice') }}">Tablice</a></li>
			@if($user->level == 1 )
			<li><a href="{{ URL::to('/konto/pro') }}" class="btn-get-pro">Konto Pro</a></li>
			@else
			<li><a href="{{ URL::to('/konto/pro/subskrypcja') }}">Konto Pro</a></li>
			@endif
		</ul>
	</nav>

	<div class="account-content clearfix">
		<!--
		<div class="account-module-info">
			<h3>Konto Pro</h3>
			<p>Dowiedz się więcej o naszej ofercie dla bardziej wymagających klientów.</p>
		</div>
	
		<table class="table-pricing">
					  <tr class="heading">
					    <th>&nbsp;</th>
					    <th>Plan Podstawowy</th>
					    <th>Plan Pro</th>
					  </tr>
					  
					  <tr>
					  	<td>Ilość Tablic</td>
					  	<td>1</td>
					  	<td>5</td>
					  </tr>

					  <tr>
					  	<td>Promowane Posty</td>
					  	<td>5</td>
					  	<td>100</td>
					  </tr>

					  <tr>
					  	<td>Avatar i tło Tablicy</td>
					  	<td><i class="fa green fa-check"></i></td>
					  	<td><i class="fa green fa-check"></i></td>
					  </tr>

					  <tr>
					  	<td>Wybór sieci</td>
					  	<td><i class="fa green fa-check"></i></td>
					  	<td><i class="fa green fa-check"></i></td>
					  </tr>

					  <tr>
					  	<td>Linki do profilów</td>
					  	<td><i class="fa green fa-check"></i></td>
					  	<td><i class="fa green fa-check"></i></td>
					  </tr>

					  <tr>
					  	<td>Blokowanie użytkowników</td>
					  	<td><i class="fa red fa-times"></i></td>
					  	<td><i class="fa green fa-check"></i></td>
					  </tr>

					  <tr>
					  	<td>Moderacja słów</td>
					  	<td><i class="fa red fa-times"></i></td>
					  	<td><i class="fa green fa-check"></i></td>
					  </tr>

					  <tr>
					  	<td>Funkcja Live</td>
					  	<td><i class="fa red fa-times"></i></td>
					  	<td><i class="fa green fa-check"></i></td>
					  </tr>

					  <tr>
					  	<td>Automatyczne odświeżanie</td>
					  	<td><i class="fa red fa-times"></i></td>
					  	<td><i class="fa green fa-check"></i></td>
					  </tr>

					  <tr>
					  	<td>Funkcja Prezentacji</td>
					  	<td><i class="fa red fa-times"></i></td>
					  	<td><i class="fa green fa-check"></i></td>
					  </tr>

					  <tr>
					  	<td>Branding</td>
					  	<td><i class="fa red fa-times"></i></td>
					  	<td><i class="fa green fa-check"></i></td>
					  </tr>

					   <tr class="prices">
					  	<td></td>
					  	<td>0 zł</td>
					  	<td>
					  		189 zł/miesiąc
					  	</td>
					  </tr>
						
					 </table>

					 <div class="section-promo">
			<a class="btn-link btn-lg btn-default btn-blue" href="{{ URL::to('/konto/pro/platnosci') }}">Dołącz do Pro</a>
		</div>


					
		-->

				

<div class="notice">
					 <p>Aktualnie jesteśmy w fazie testów. Opcja Pro będzie dostępna za około 2 tygodnie.<br />Jeżeli chcesz dostać e-mail z powiadomieniem podaj swój poniżej.</p>

					 {{ Form::open(array('method' => 'post', 'url' => '/contact/send')) }}	
						<input type="email" name="email" class="input-default @if ($errors->has('email'))has-error @endif" id="" placeholder="E-mail">
						<button type="submit" class="btn-default btn-submit btn-green btn-lg">Powiadom mnie</button>	
					{{ Form::close() }}

					 </div>



</div>

</div>



@stop