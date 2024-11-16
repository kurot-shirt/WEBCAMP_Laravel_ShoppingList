<?php

declare(strict_types=1);
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginPostRequest;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function top()
    {
    	return view('admin.top');
    }

    //ログイン処理
    public function login(AdminLoginPostRequest $request)
    {
    	//validate済
    	//データの取得
    	$datum = $request->validated();

    	//認証に失敗した場合
    	if (Auth::attempt($datum) === false) {
    	    return back()
    	           ->withInput()//入力値の保持
    	           ->withErrors(['auth' => 'emailかパスワードに誤りがあります',])//エラーメッセージの出力
    	           ;
    	}

    	//認証に成功した場合
    	$request->session()->regenerate();
    	return redirect()->intended(route('admin.top'));

    }

    //ログアウト処理
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->regenerateToken(); //CSRFトークンの再生成
        $request->session()->regenerate(); //セッションIDの再生成
        return redirect(route('front.index'));
    }
}
