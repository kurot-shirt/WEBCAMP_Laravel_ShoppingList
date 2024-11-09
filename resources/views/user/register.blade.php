@extends('layout')

{{--メインコンテンツ--}}
@section('contets')
	<h1>ユーザ登録</h1>

	@if ($errors->any())
	    <div>
	    @foreach ($errors->all() as $error)
	        {{ $error }}<br>
	    @endforeach
	@endif
        </div>
	<form action="/user/register" method="post">
		@csrf
		name:<input name="name" value="{{ old('name') }}"><br>
		email:<input name="email" value="{{ old('email') }}"><br>
		パスワード:<input name="password" type="password"><br>
		パスワード(再度):<input name="password_" type="password"><br>
		<button>登録する</button><br>
	</form>
@endsection