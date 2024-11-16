<?php

declare(strict_types=1);
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ListRegisterPostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Shopping_list as Shopping_listModel;
use App\Models\CompletedShoppingList as CompletedShoppingListModel;

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

    //タスクの新規登録
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

    /**
     * 「単一のタスク」Modelの取得
     */
    protected function getShopping_listModel($shopping_list_id)
    {
        // task_idのレコードを取得する
        $task = Shopping_listModel::find($shopping_list_id);
        if ($task === null) {
        }
        // 本人以外のタスクならNGとする
        if ($task->user_id !== Auth::id()) {
        }
        return $task;
    }

    //タスクの完了
    public function complete(Request $request, $shopping_list_id)
    {
        //タスクを完了テーブルに移動させる
        try{
            //トランザクション開始
            DB::beginTransaction();

            //shopping_list_idのレコードを取得する
            $task = $this->getShopping_listModel($shopping_list_id);
            if ($task === null) {
                //shopping_list_idが不正なのでトランザクション終了
                throw new \Exception('');
            }
            //var_dump($task->toArray()); exit;
            //lists側を削除する
            $task->delete();

            //completed_shopping_lists側にinsertする
            $dask_datum = $task->toArray();
            unset($dask_datum['created_at']);
            unset($dask_datum['updated_at']);
            $r = CompletedShoppingListModel::create($dask_datum);
            if ($r === null) {
                //insertで失敗したのでトランザクション終了
                throw new \Exception('');
            }

            //トランザクション終了
            DB::commit();
            //完了メッセージ出力
            $request->session()->flash('front.list_completed_success', true);
        } catch(\Throwable $e) {
            //トランザクション異常終了
            DB::rollBack();
        }
        //一覧に遷移する
        return redirect('/shopping_list/list');

    }
    //削除処理
    public function delete(Request $request, $shopping_list_id)
    {
        // shopping_list_idのレコードを取得する
        $task = $this->getShopping_listModel($shopping_list_id);

        //タスクを削除する
        if ($task !== null) {
            $task->delete();
            $request->session()->flash('front.list_delete_success', true);
        }

        //一覧に遷移する
        return redirect('/shopping_list/list');

    }
}
