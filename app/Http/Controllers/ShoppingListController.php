<?php

declare(strict_types=1);
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ListRegisterPostRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Shopping_list as Shopping_listModel;

class ShoppingListController extends Controller
{
    public function list()
    {
        //1ページ辺りの表示アイテム数を設定
        $per_page = 3;

        //一覧の取得
        $list = Shopping_listModel::where('user_id', Auth::id())
                                  ->orderBy('name','ASC')
                                  ->orderBy('created_at',)
                                  ->paginate($per_page);
                                  //->get();

    	return view('shopping_list.list', ['list' => $list]);
    }

    //リストの新規登録
    public function register(ListRegisterPostRequest $request)
    {
        //validate済み
        $datum = $request->validated();
        //var_dump($datum); exit;

        //$user_idの追加
        $datum['user_id'] = Auth::id();

        //テーブルへのINSERT
        try {
    	    $r = Shopping_listModel::create($datum);
    	} catch(\Throwable $e) {
    	    //本当はログに書く等の処理をする
    	    echo $e->getMessage();
    	    exit;
    	}

    	//タスク登録成功
    	$request->session()->flash('front.list_register_success', true);

    	//リダイレクト
    	return redirect('/shopping_list/list');

    }
}
