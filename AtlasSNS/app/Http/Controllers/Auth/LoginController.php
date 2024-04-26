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
    // protected $redirectTo = '/home';//伊藤：コメントアウト
    protected $redirectTo = '/login'; //伊藤：追記

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
            //↓ログイン条件は公開時には消すこと
            if(Auth::attempt($data)){
                // ユーザー名をセッションに保存
                // session(['username' => Auth::user()->name]);
                return redirect('/top');
            }
        }
        return view("auth.login");
    }

    //伊藤：ログインページ表示用
    public function showLoginForm()
    {
        return view('auth.login');
    }


    //伊藤：ログアウト用の記述を追加
    public function logout(Request $request)
    {
        Auth::logout(); // ユーザーをログアウトさせる

        $request->session()->invalidate(); // セッションを無効化する

        return redirect('/login'); // ログアウト後はログインページにリダイレクトする
    }
}
