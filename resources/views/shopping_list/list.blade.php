@extends('layout')

{{--タイトル--}}
@section('title')(一覧画面)@endsection

{{--メインコンテンツ--}}
	<h1>「買うもの」の登録</h1>
	    <form action="./top.html" method="post">
	    	「買うもの」名:<input name="name"><br>
	    	<button>「買うもの」を登録する</button>
	    </form>
	<h1>「買うもの」一覧</h1>
	<a href="./top.html">購入済み「買うもの」一覧</a><br>
	<table border="1">
	<tr>
		<th>登録日
		<th>「買うもの」名
	<tr>
		<td></td>
		<td></td>
		<td><form action="./top.html"><button>完了</button></form>
		<td><form action="./top.html"><button>削除</button></form>
	</table>
	<!--ページネーション-->
	現在 1 ページ目<br>
	<a href="./top.html">最初のページ</a> /
	<a href="./top.html">前に戻る</a> /
	<a href="./top.html">次に進む</a>
	<br>
	<hr>
	<menu label="リンク">
	<a href="/logout">ログアウト</a><br>
	</menu>
</body>
</html>