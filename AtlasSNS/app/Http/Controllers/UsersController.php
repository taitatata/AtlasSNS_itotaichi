<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// 検索ページの何も検索していない状態でのユーザー表示
use App\User;
use Auth;

// プロフィール編集
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    public function search(Request $request){
        $query = $request->input('query'); // 検索フォームからの入力を取得
        $current_user = Auth::user();

        if(empty($query)) {
            // 検索ワードが空の場合はセッションから削除
            $request->session()->forget('last_search');
            // 検索ワードがない場合、自分以外の全ユーザーを取得
            $users = User::where('id', '!=', Auth::id())->get();
        } else {
            // セッションに検索キーワードを保存
            $request->session()->put('last_search', $query);
            // ユーザー名に検索キーワードを含むユーザーを取得
            $users = User::where('id', '!=', Auth::id())
                        ->where('username', 'like', '%' . $query . '%')
                        ->get();
        }

        //フォローしているユーザーのIDリストを取得
        $followings = $current_user->followings()->pluck('followed_id')->toArray();

        return view('users.search', compact('users', 'followings'));
    }

    // 相手ユーザーのプロフィールを表示
    public function profile($id)
    {
        $user = User::findOrFail($id);
        $posts = $user->posts()->orderBy('created_at', 'desc')->get();
        $logged_in_user = Auth::user();
        // フォローしているユーザーのIDの配列を取得
        $following_id = $logged_in_user->followings()->pluck('followed_id')->toArray();

        return view('users.profile', compact('user', 'posts', 'following_id'));
    }

    // ログインユーザーの編集ページ
    public function update(Request $request, $id)
    {
        $messages = [
            'username.required' => 'ユーザー名は必須です。',
            'username.min' => 'ユーザー名は2文字以上で入力してください。',
            'username.max' => 'ユーザー名は12文字以内で入力してください。',
            'mail.required' => 'メールアドレスは必須です。',
            'mail.email' => '有効なメールアドレスを入力してください。',
            'mail.unique' => '既に登録されているメールアドレスです。',
            'password.required' => 'パスワードは必須です。',
            'password.alpha_num' => 'パスワードは英数字のみで入力してください。',
            'password.min' => 'パスワードは8文字以上で入力してください。',
            'password.max' => 'パスワードは20文字以内で入力してください。',
            'passwordConfirmation.required' => 'パスワード確認は必須です。',
            'passwordConfirmation.alpha_num' => 'パスワード確認は英数字のみで入力してください。',
            'passwordConfirmation.min' => 'パスワード確認は8文字以上で入力してください。',
            'passwordConfirmation.max' => 'パスワード確認は20文字以内で入力してください。',
            'passwordConfirmation.same' => 'パスワードとパスワード確認が一致しません。',
            'image.image' => 'ファイルは画像でなければなりません。',
            'image.mimes' => '画像はjpeg, png, jpg, gif, svgのいずれかの形式である必要があります。',
        ];

        $rules = [
            'username' => 'required|min:2|max:12',
            'mail' => 'required|email|min:5|max:40|unique:users,mail,' . $id,
            'password' => 'required|alpha_num|min:8|max:20',
            'passwordConfirmation' => 'required|alpha_num|min:8|max:20|same:password',
            'bio' => 'max:150',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ];

        $validated_data = $request->validate($rules, $messages);

        // ユーザーのデータを更新
        $user = User::find($id);
        $user->username = $validated_data['username'];
        $user->mail = $validated_data['mail'];
        $user->bio = $request->bio; // bioはnullableなので直接取得
        if (!empty($validated_data['password'])) {
            $user->password = Hash::make($validated_data['password']);
        }

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
        $image_name = time() . '.' . $request->image->extension();  // ファイル名をユニークにする
        $request->image->move(public_path('images'), $image_name);  // imagesディレクトリにファイルを保存
        $user->images = $image_name;  // 保存したファイル名をデータベースに保存
        }

        $user->save();

        // 成功した場合、トップページにリダイレクト
        return redirect('/top')->with('success', 'プロフィールを更新しました。');
    }

}
