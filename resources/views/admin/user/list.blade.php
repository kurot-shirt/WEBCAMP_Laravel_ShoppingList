@extends('admin.layout')

{{--タイトル--}}
@section('title')(ユーザ一覧画面)@endsection

{{--メインコンテンツ--}}
@section('contets')
	<h1>ユーザ一覧</h1>
	<table border="1">
	<tr>
		<th>ユーザID
		<th>ユーザ名
		<th>購入した「買うもの」の数
	@foreach ($users as $user)
	<tr>
		<th>{{ $user->id }}
		<th>{{ $user->name }}
		<th>{{ $user->task_num }}
	@endforeach
	</table>
@endsection