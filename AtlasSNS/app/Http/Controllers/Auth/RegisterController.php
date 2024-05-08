<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; //伊藤：バリデーション

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request){
        $commonClass = 'register_common';
        if($request->isMethod('post')){

            //バリデーションの定義
            $rules = [
            'username' => 'required|min:2|max:12',
            'mail' => 'required|email|unique:users,mail|min:5|max:40',
            'password' => 'required|alpha_num|min:8|max:20',
            'passwordConfirmation' => 'required|alpha_num|min:8|max:20|same:password',
            ];

            //エラーメッセージの表示
            $messages = [
            'username.required' => 'ユーザー名は必須です。',
            'username.min' => 'ユーザー名は2文字以上で入力してください。',
            'username.max' => 'ユーザー名は12文字以内で入力してください。',
            'mail.required' => 'メールアドレスは必須です。',
            'mail.email' => '有効なメールアドレスを入力してください。',
            'mail.unique' => '既に登録されているメールアドレスです。',
            'mail.min' => 'ユーザー名は5文字以上で入力してください。',
            'mail.max' => 'ユーザー名は40文字以内で入力してください。',
            'password.required' => 'パスワードは必須です。',
            'password.alpha_num' => 'パスワードは英数字のみで入力してください。',
            'password.min' => 'パスワードは8文字以上で入力してください。',
            'password.max' => 'パスワードは20文字以上で入力してください。',
            'passwordConfirmation.required' => 'パスワード確認は必須です。',
            'passwordConfirmation.alpha_num' => 'パスワード確認は英数字のみで入力してください。',
            'passwordConfirmation.min' => 'パスワード確認は8文字以上で入力してください。',
            'passwordConfirmation.max' => 'パスワード確認は20文字以内で入力してください。',
            'passwordConfirmation.same' => 'パスワードとパスワード確認が一致しません。',
            ];

            //バリデーションの実行
            $validator = Validator::make($request->all(), $rules,$messages);

            //バリデーションエラーがある場合
            if($validator->fails()){
                return redirect('register')
                ->withErrors($validator)
                ->withInput()
                ->with('commonClass', $commonClass);
            }

            //バリデーション成功時の処理
            User::create([
            'username' => $request->input('username'),
            'mail' => $request->input('mail'),
            'password' => bcrypt($request->input('password')),
            ]);

            //ユーザー名をセッションに保存
            $request->session()->flash('registered_username', $request->input('username'));
            $request->session()->put('registration_success', true); // 新規登録成功のフラグをセット
            return redirect('added')->with('commonClass', 'added-common');
        }
        return view('auth.register',compact('commonClass'));
    }

    public function added(Request $request)
    {
        if (!$request->session()->pull('registration_success', false)) {
            // registration_success フラグがセットされていない場合
            return redirect('register');
        }

        $commonClass = 'added_common'; // 登録完了ページ用のクラス名を安全に設定
        return view('auth.added', compact('commonClass'));
    }


}
