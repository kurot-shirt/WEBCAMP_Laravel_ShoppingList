@extends('layout')

{{--メインコンテンツ--}}
@section('contets')
	<h1>ログイン</h1>

	@if ($errors->any())
	    <div>
	    @foreach ($errors->all() as $error)
	        {{ $error }}<br>
	    @endforeach
	@endif
        </div>
	<form action="/login" method="post">
		@csrf
		email:<input name="email" value="{{ old('email') }}"><br>
		パスワード:<input name="password" type="password"><br>
		<button>ログインする</button><br>
		<a href="./top.html">会員登録</a><br>
	</form>
@endsection