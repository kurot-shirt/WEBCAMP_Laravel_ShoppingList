<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterPostRequest;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
	//登録画面表示用
    public function index()
    {
    	return view('user.register');
    }

    //データベース登録処理用
    public function register(UserRegisterPostRequest $request)
    {
    	//validate済み

    	//データの取得
    	$datum = $request->validated();

        try {
    	    $datum['password'] = Hash::make($datum['password']);

    	    //テーブルへのINSERT
    	    $r = UserModel::create($datum);
    	    } catch(\Throwable $e) {
    	    echo $e->getMessage();
    	    exit;
    	}
    	$request->session()->flash('front.user_register_success', true);
    	return redirect(route('front.index'));
    }
}
