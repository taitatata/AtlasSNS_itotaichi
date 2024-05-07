<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        if($request->isMethod('post')){

            $data=$request->only('mail','password');
            // ログインが成功したら、トップページへ
            if(Auth::attempt($data)){
                return redirect('/top');
            }
        }
        return view("auth.login");
    }

    //ログインページ表示用
    public function showLoginForm()
    {
        return view('auth.login');
    }


    //ログアウト用の記述を追加
    public function logout(Request $request)
    {
        Auth::logout(); // ユーザーをログアウトさせる

        $request->session()->invalidate(); // セッションを無効化する

        return redirect('/login'); // ログアウト後はログインページにリダイレクトする
    }
}
