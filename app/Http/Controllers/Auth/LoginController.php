<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    
    //ログイン後に飛ぶページ
    protected $redirectTo = '/';

    //ログアウト処理以外で未ログインを確認
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    protected function loggedOut(Request $request)
    {
        return redirect(route('login'));
    }
}
