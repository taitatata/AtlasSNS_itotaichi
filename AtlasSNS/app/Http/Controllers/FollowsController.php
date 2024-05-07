<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Follow;
use Auth;
use App\User;
use App\Post;

class FollowsController extends Controller
{
    //フォローリスト表示
    public function followList(){
        $user = Auth::user();
        $following_id = $user->followings()->pluck('followed_id')->toArray();
        //フォローしているユーザー情報を取得
        $followings = User::whereIn('id', $following_id)->get();
        // フォローしているユーザーの投稿を取得
        $posts = Post::whereIn('user_id',$following_id)
        ->with('user')//ユーザーモデルを事前に組み込む
        ->orderBy('created_at', 'desc')//投稿を新しい順に並び替え
        ->get();

    return view('follows.followList',compact('followings', 'posts'));
}

// フォロワーリスト表示
    public function followerList(){
    $user = Auth::user();
    $follower_id = $user->followers()->pluck('following_id')->toArray();
    //フォローしているユーザー情報を取得
    $followers = User::whereIn('id', $follower_id)->get();
    // フォローしているユーザーの投稿を取得
    $posts = Post::whereIn('user_id',$follower_id)
    ->with('user')//ユーザーモデルを事前に組み込む
    ->orderBy('updated_at', 'desc')//投稿を新しい順に並び替え
    ->get();

    return view('follows.followerList', compact('followers', 'posts'));
}

    public function follow($userId)
    {
        $follow = new Follow;
        $follow->following_id = Auth::id();
        $follow->followed_id = $userId;
        $follow->save();

        return back()->with('success','ユーザーをフォローしました。');
    }

    public function unfollow($userId)
    {
        Follow::where('following_id',Auth::id())
        ->where('followed_id',$userId)
        ->delete();

        return back()->with('success','フォローを解除しました。');
    }
}
