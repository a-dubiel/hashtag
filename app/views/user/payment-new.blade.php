@extends('user.master')

@section('content')

<div class="container page-board page-auth-forms">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
				
				<div class="payment-popup @if($errors->any()) animated shake @endif">
					<div class="popup-intro">
						<h3>Konto Pro</h3>
						<p class="bold">149 zł brutto miesięcznie</p>
						<p>W  celu zapłaty możesz użyć karty kredytowej lub debetowej z możliwością płatności internetowych.</p>
					</div>
					<hr />
					{{ Form::open(array('url' => '/pro/payment', 'class' => 'form-auth', 'id' => 'checkout-form', 'method' => 'GET')) }}
						<div class="alert alert-success">
							<div class="ssl-icon">
								<i class="fa fa-lock"></i>
							</div>
							<p>Płatności są szyfrowane przez 128-bit SSL. Twoja karta i pieniądze są bezpieczne.</p>
						</div>
						<div class="cc-header">
							<h3>Dane Karty</h3>
							<div class="cc-header-types">
								<i class="fa fa-cc-mastercard"></i>
								<i class="fa fa-cc-visa"></i>
							</div>
						</div>
				    	<input type="text" id="cc-number" value="" class="input-default js-cc-number" placeholder="Numer karty" data-paylane="cc-number">
				    	<input type="text" id="cc-expiry-month" class="input-default input-small" placeholder="01" value="" data-paylane="cc-expiry-month">  
				    	<input type="text" id="cc-expiry-year" class="input-default input-small" placeholder="2015"value="" data-paylane="cc-expiry-year">
				  		<input type="text" id="cc-cvv" class="input-default input-small" placeholder="CVV" value="" data-paylane="cc-cvv">
						<input type="text" id="cc-name-on-card" class="input-default" value="" placeholder="Posiadacz karty" data-paylane="cc-name-on-card">
						<h3>Twoje Dane</h3>
						<input type="text" class="@if ($errors->has('first_name'))has-error @endif input-default" name="first_name" value="{{ Input::old('first_name') }}" placeholder="Imię">
						@if ($errors->has('first_name')) <p class="help-block">{{ $errors->first('first_name') }}</p> @endif
					    <input type="text" class="@if ($errors->has('last_name'))has-error @endif input-default" name="last_name" value="{{ Input::old('last_name') }}" placeholder="Nazwisko">
					    @if ($errors->has('last_name')) <p class="help-block">{{ $errors->first('last_name') }}</p> @endif
					    <input type="email" class="input-default @if ($errors->has('email'))has-error @endif" name="email" value="{{ Input::old('email') }}" placeholder="Twój e-mail">
					    @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
					    <input type="text" class="input-default @if ($errors->has('address'))has-error @endif" name="address" value="{{ Input::old('address') }}" placeholder="Adres">
					    @if ($errors->has('address')) <p class="help-block">{{ $errors->first('address') }}</p> @endif
					    <input type="text" class="input-default @if ($errors->has('zip'))has-error @endif" name="zip" value="{{ Input::old('zip') }}" placeholder="Kod Pocztowy">
					    @if ($errors->has('zip')) <p class="help-block">{{ $errors->first('zip') }}</p> @endif
					    <input type="text" class="input-default @if ($errors->has('city'))has-error @endif" name="city" value="{{ Input::old('city') }}" placeholder="Miasto">
					    @if ($errors->has('city')) <p class="help-block">{{ $errors->first('city') }}</p> @endif
					    <input type="text" class="input-default @if ($errors->has('state'))has-error @endif" name="state" value="{{ Input::old('state') }}" placeholder="Województwo">
					    @if ($errors->has('state')) <p class="help-block">{{ $errors->first('state') }}</p> @endif
					    <label><input type="checkbox" @if(Input::old('faktura')) checked="checked" @endif name="faktura" id="form-company" class="add-bottom"> Chcę fakturę VAT</label>
					    <div class="form-company @if (Input::old('faktura')) show @else hide @endif">
					    <h3>Dane Firmy</h3>
						    <input type="text" class="@if ($errors->has('company_name'))has-error @endif input-default" name="company_name" value="{{ Input::old('company_name') }}" placeholder="Nazwa Firmy">
							@if ($errors->has('company_name')) <p class="help-block">{{ $errors->first('company_name') }}</p> @endif
						    <input type="text" class="@if ($errors->has('company_id'))has-error @endif input-default" name="company_id" value="{{ Input::old('company_id') }}" placeholder="NIP">
							@if ($errors->has('company_id')) <p class="help-block">{{ $errors->first('company_id') }}</p> @endif
						    <input type="text" class="@if ($errors->has('company_address'))has-error @endif input-default" name="company_address" value="{{ Input::old('company_address') }}" placeholder="Adres">
							@if ($errors->has('company_address')) <p class="help-block">{{ $errors->first('company_address') }}</p> @endif
						    <input type="text" class="@if ($errors->has('company_zip'))has-error @endif input-default" name="company_zip" value="{{ Input::old('company_zip') }}" placeholder="Kod Pocztowy">
						    @if ($errors->has('company_zip')) <p class="help-block">{{ $errors->first('company_zip') }}</p> @endif
						    <input type="text" class="@if ($errors->has('company_city'))has-error @endif input-default" name="company_city" value="{{ Input::old('company_city') }}" placeholder="Miasto">
							@if ($errors->has('company_city')) <p class="help-block">{{ $errors->first('company_city') }}</p> @endif
						    <input type="text" class="input-default @if ($errors->has('company_state'))has-error @endif" name="company_state" value="{{ Input::old('company_state') }}" placeholder="Województwo">
					    	@if ($errors->has('company_state')) <p class="help-block">{{ $errors->first('company_state') }}</p> @endif
					    </div>
					    
						<button type="submit" class="btn-default btn-green btn-block btn-lg btn-submit"><i class="fa fa-lock"></i> Zapłać</button>
						<p class="form-note">Klikając "Zapłać" zgadzasz się z warunkami naszego <a href="URL::to('/regulamin')">regulaminu</a>.</p>
					{{ Form::close() }}
					</form>	
				</div>
		
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