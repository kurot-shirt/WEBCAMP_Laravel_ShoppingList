<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CompletedShoppingList as CompletedShoppingListModel;

class CompletedShoppingListController extends Controller
{
    public function list()
    {
        //1page辺りの表示アイテム数を設定
        $per_page = 3;

        //一覧の取得
        $list = CompletedShoppingListModel::where('user_id', Auth::id())
                                         ->orderBy('name')
                                         ->orderBy('created_at')
                                         ->paginate($per_page);
                                         //->get();

        //var_dump($list); exit;
    	return view('completed_shopping_list', ['list' => $list]);
    }
}
