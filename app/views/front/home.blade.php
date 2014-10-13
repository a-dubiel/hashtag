@extends('front.master')

@section('content')

{{ Form::open(array('url' => 'szukaj')) }}
    <input type="text" name="query" id="">
    <input type="submit" value="Szukaj">
{{ Form::close() }}


@if (Auth::check())

     {{ Auth::user() }}
     <a href="{{ URL::to('/wyloguj') }}">Wyloguj</a>
@else

<a class="btn-default btn-social-auth btn-facebook btn-green btn-block btn-lg" href="{{ route('social-login', array('facebook')) }}">Połącz przez Facebook</a>

@endif





@stop