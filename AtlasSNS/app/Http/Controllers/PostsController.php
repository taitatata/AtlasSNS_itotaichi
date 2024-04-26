<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//投稿フォーム
use App\Http\Controllers\PostsController;

//投稿登録機能
use App\Post;
use Auth;

//投稿一覧表示
use App\User;

class PostsController extends Controller
{
    //
    public function index(){

        $user = Auth::user();
        //自分の投稿とフォローしているユーザーの情報を取得
        $posts = Post::whereIn('user_id', [$user->id] + $user->followings->pluck('id')->toArray())
        ->with('user') // ユーザーモデルを事前に読み込む
        ->orderBy('created_at', 'desc') // 投稿を新しい順に並べ替え
        ->get();

        return view('posts.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
        'post' => 'required|string', //投稿内容は必須
        ]);

        $post = new Post();
        $post->user_id = Auth::id();
        $post->post = $request->post;
        $post->save();

        return redirect()->route('top')->with('status', '投稿が成功しました。');
    }

    // 投稿内容編集
    public function edit(Post $post)
    {
        return response()->json($post);
    }

    public function update(Request $request, Post $post)
    {
        $post->update(['post' => $request->postContent]);
        return redirect()->back()->with('success', 'Post updated successfully');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->back()->with('success', 'Post deleted successfully');
    }
}
