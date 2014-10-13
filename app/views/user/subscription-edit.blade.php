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
			<li><a class="active" href="{{ URL::to('/konto/pro/subskrypcja') }}">Konto Pro</a></li>
			@endif
		</ul>
	</nav>
	<div class="account-content clearfix">
		<div class="account-module-info">
			<h3>Edytuj dane płatności</h3>
			<p class="add-bottom">Tutaj zmienisz dane swoich płatności.</p>
		</div>

		<div class="alert alert-success add-bottom">
			<p>Płatności są szyfrowane przez 128-bit SSL. Twoja karta i pieniądze są bezpieczne.</p>
		</div>
		
		<div class="account-user-module">

			{{ Form::open(array('method' => 'post', 'url' => 'pro/subscription/update', 'class' => '' )) }}
				
			<h3>Twoje Dane</h3>
			<input type="text" class="@if ($errors->has('first_name'))has-error @endif input-default" name="first_name" value="{{ $subscription->first_name }}" placeholder="Imię">
			@if ($errors->has('first_name')) <p class="help-block">{{ $errors->first('first_name') }}</p> @endif
		    <input type="text" class="@if ($errors->has('last_name'))has-error @endif input-default" name="last_name" value="{{ $subscription->last_name}}" placeholder="Nazwisko">
		    @if ($errors->has('last_name')) <p class="help-block">{{ $errors->first('last_name') }}</p> @endif
		    <input type="email" class="input-default @if ($errors->has('email'))has-error @endif" name="email" value="{{ $subscription->email}}" placeholder="Twój e-mail">
		    @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
		    <input type="text" class="input-default @if ($errors->has('address'))has-error @endif" name="address" value="{{ $subscription->address}}" placeholder="Adres">
		    @if ($errors->has('address')) <p class="help-block">{{ $errors->first('address') }}</p> @endif
		    <input type="text" class="input-default @if ($errors->has('zip'))has-error @endif" name="zip" value="{{ $subscription->zip}}" placeholder="Kod Pocztowy">
		    @if ($errors->has('zip')) <p class="help-block">{{ $errors->first('zip') }}</p> @endif
		    <input type="text" class="input-default @if ($errors->has('city'))has-error @endif" name="city" value="{{ $subscription->city}}" placeholder="Miasto">
		    @if ($errors->has('city')) <p class="help-block">{{ $errors->first('city') }}</p> @endif
		    <input type="text" class="input-default @if ($errors->has('state'))has-error @endif" name="state" value="{{ $subscription->state}}" placeholder="Województwo">
		    @if ($errors->has('state')) <p class="help-block">{{ $errors->first('state') }}</p> @endif
		    <label><input type="checkbox" @if($subscription->company_id != 0) checked="checked" @endif name="faktura" id="form-company" class="@if($subscription->company_id != 0) add-bottom @endif"> Chcę fakturę VAT</label>
		    <div class="form-company @if ($subscription->company_id == 0) hide @else show @endif">
		    <h3>Dane Firmy</h3>
			    <input type="text" class="@if ($errors->has('company_name'))has-error @endif input-default" name="company_name" value="{{ $subscription->company_name}}" placeholder="Nazwa Firmy">
				@if ($errors->has('company_name')) <p class="help-block">{{ $errors->first('company_name') }}</p> @endif
			    <input type="text" class="@if ($errors->has('company_id'))has-error @endif input-default" name="company_id" value="{{ $subscription->company_id}}" placeholder="NIP">
				@if ($errors->has('company_id')) <p class="help-block">{{ $errors->first('company_id') }}</p> @endif
			    <input type="text" class="@if ($errors->has('company_address'))has-error @endif input-default" name="company_address" value="{{ $subscription->company_address}}" placeholder="Adres">
				@if ($errors->has('company_address')) <p class="help-block">{{ $errors->first('company_address') }}</p> @endif
			    <input type="text" class="@if ($errors->has('company_zip'))has-error @endif input-default" name="company_zip" value="{{ $subscription->company_zip}}" placeholder="Kod Pocztowy">
			    @if ($errors->has('company_zip')) <p class="help-block">{{ $errors->first('company_zip') }}</p> @endif
			    <input type="text" class="@if ($errors->has('company_city'))has-error @endif input-default" name="company_city" value="{{ $subscription->company_city}}" placeholder="Miasto">
				@if ($errors->has('company_city')) <p class="help-block">{{ $errors->first('company_city') }}</p> @endif
			    <input type="text" class="input-default @if ($errors->has('company_state'))has-error @endif" name="company_state" value="{{ $subscription->company_state}}" placeholder="Województwo">
		    	@if ($errors->has('company_state')) <p class="help-block">{{ $errors->first('company_state') }}</p> @endif
		    </div>
		    <div class="clearfix"></div>
			<button type="submit" class="btn-default btn-green btn-lg btn-submit">Aktualizuj</button>

			{{ Form::close() }}


		</div>

		<div class="account-user-module">

			<div class="cc-header">
				<h3>Dodaj Nową Kartę</h3>
				<div class="cc-header-types">
					<i class="fa fa-cc-mastercard"></i>
					<i class="fa fa-cc-visa"></i>
				</div>
			</div>
			{{ Form::open(array('url' => '/pro/payment/update', 'class' => 'form-auth', 'id' => 'checkout-form', 'method' => 'GET')) }}
	    	<input type="text" id="cc-number" value="" class="input-default js-cc-number" placeholder="Numer karty" data-paylane="cc-number">
	    	<input type="text" id="cc-expiry-month" class="input-default input-small" placeholder="01" value="" data-paylane="cc-expiry-month">  
	    	<input type="text" id="cc-expiry-year" class="input-default input-small" placeholder="2015"value="" data-paylane="cc-expiry-year">
	  		<input type="text" id="cc-cvv" class="input-default input-small" placeholder="CVV" value="" data-paylane="cc-cvv">
			<input type="text" id="cc-name-on-card" class="input-default" value="" placeholder="Posiadacz karty" data-paylane="cc-name-on-card">
			<button type="submit" class="btn-default btn-green btn-lg btn-submit"><i class="fa fa-lock"></i> Dodaj Kartę</button>
			{{ Form::close() }}


		</div>
</div>

</div>

<script type="text/javascript">
	try
	{
	    var client = new PayLaneClient({
	        publicApiKey: 'c7f86de3c1538288181d3813681290178156778f',
	        paymentForm: 'checkout-form',
	        errorHandler: function(type, code, description){
	        	alert(code + " - " + description);
	        }
	    });
	}
	catch (e)
	{
	    alert('Wystąpił błąd bramki płatności. Spróbuj później.');
	}

</script>



@stop