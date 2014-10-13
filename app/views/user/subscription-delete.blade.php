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
			<h3>Rezygnuj z subskrypcji</h3>
			<p>Usuń subskrypcję lub wróć do planu podstawowego.</p>
		</div>

		<div class="alert alert-error add-bottom">
				<p>Zapoznaj się dokładnie z każdą z opcją i wybierz odpowiednią. Miej świadomość, że te zmiany są nieodwracalne.</p>
			</div>
		
		<div class="account-user-module">
			<h4>Usuń subskrypcję</h4>
			<p>Usuń moją subskrypcję oraz usuń wszystkie tablice powiązane z moim kontem.</p>
			{{ Form::open(array('method' => 'post', 'url' => 'pro/subscription/delete', 'class' => 'form-inline' )) }}
				<button type="submit" class="btn-submit btn-link btn-lg btn-default btn-red-inverted js-confirm"><i class="fa fa-times"></i> Usuń Subskrypcję</button>
			{{ Form::close() }}

		</div>

		<div class="account-user-module">
			<h4>Zmień na plan podstawowy</h4>
			@if($boards->count() > 0)
				<p>Usuń moją subskrypcję, wróć do planu podstawowego zachowując jedną z moich tablic. Tablica straci zaawansowane funkcje.</p>
				<p>Wybierz tablicę, którą chcesz zachować:</p>
			@else
				<p>Usuń moją subskrypcję, wróć do planu podstawowego.</p>
			@endif
			
			
			{{ Form::open(array('method' => 'post', 'url' => 'pro/subscription/downgrade', 'class' => 'form-inline' )) }}
				@if($boards->count() > 0)
					@foreach($boards as $board)
						<label><input type="radio" name="board" value="{{ $board->id }}"> #{{ $board->hashtag }}</label><br />
					@endforeach
						<label><input type="radio" name="board" value="all"> Usuń wszystkie tablice</label><br />
						<div class="clearfix add-bottom"></div>
				@else
					<input type="hidden" name="board" value="all">
				@endif
			
				<button type="submit" class="btn-submit btn-link btn-lg btn-default btn-gray-inverted js-confirm"><i class="fa fa-arrow-down"></i> Zmień na plan podstawowy</button>
			{{ Form::close() }}

		</div>
</div>

</div>



@stop