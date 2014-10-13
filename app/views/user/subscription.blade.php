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
			<h3>Konto Pro</h3>
			<p>Wszystko o Twojej subskrypcji.</p>
		</div>
		
	

		<p>Status @if($subscription->first()->is_active == 1) <i class="fa green fa-check"></i>@else <i class="fa fa-times red"></i>@endif</p>
		@if($subscription->first()->is_active == 1)
		<div class="alert alert-success add-bottom">
			<p>Twoja subskrypcja odnowi się automatycznie za {{ Carbon::parse($subscription->first()->expires_at)->diffInDays() }} dni ({{ date('d-m-Y', strtotime($subscription->first()->expires_at) )}}). W tym dniu obciążymy Twoją kartę kwotą 149 złotych, chyba że zrezygnujesz z subskrypcji przed tym terminem.</p>
		</div>

		@endif
		<a href="{{ URL::to("konto/pro/subskrypcja/edytuj") }}" class="btn-default btn-sm btn-green-inverted"><i class="fa fa-credit-card"></i> Dane Płatności</a>
		<a href="{{ URL::to("konto/pro/subskrypcja/rezygnuj") }}" class="btn-default btn-sm btn-red-inverted"><i class="fa fa-times"></i> Zrezygnuj z Subskrypcji</a>
		<div class="clearfix add-bottom"></div> 
		<h3>Historia Płatności</h3>
		<table class="rwd-table">
		  <tr class="heading">
		    <th>#</th>
		    <th>Kwota</th>
		    <th>Status</th>
		    <th>Potwierdzenie</th>
		    <th>Data</th>
		    <th>PDF</th>
		  </tr>
			@foreach($payments->get() as $payment)
			<tr>
				@if($payment->is_success == 1)
					<td data-th="#">{{ $payment->id }}</td>
					<td data-th="Kwota">149 zł</td>
					<td data-th="Status"><i class="fa green fa-check"></i></td>
					<td data-th="Potwierdzenie">{{ $payment->sale_id }}</td>
					<td data-th="Data">{{ $payment->created_at }}</td>
					<td data-th="PDF">
						<a class="pdf-link" target="_blank" href="{{ URL::to($payment->invoice()->first()->path) }}"><i class="fa fa-file-pdf-o"></i></a>			
					</td>
				@elseif($payment->is_success == 0)
					<td data-th="#">{{ $payment->id }}</td>
					<td data-th="Kwota"></td>
					<td data-th="Status"><i class="fa red fa-times"></i></td>
					<td data-th="Potwierdzenie"></td>
					<td data-th="Data">{{ $payment->created_at }}</td>
					<td data-th="PDF"></td>

				@endif
				
		    </tr>
			@endforeach
		</table>




</div>

</div>



@stop