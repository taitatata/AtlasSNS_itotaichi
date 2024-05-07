@extends('layouts.login')

@section('content')

<!-- プロフィール編集でエラーが発生した際の表示 -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (Auth::user()->id == $user->id)
<!-- ログインユーザーのプロフィール編集 -->
<div class="profile_edit">
    <img src="{{ asset('images/' . Auth::user()->images) }}" alt="{[ Auth::user()->username }}" class="profile_icon">
    <div class="profile_group_all">
        <form action="{{ route('user.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="profile_group">
                <label for="username">ユーザー名</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ Auth::user()->username }}">
            </div>
            <div class="profile_group">
                <label for="email">メールアドレス</label>
                <input type="email" class="form-control" id="email" name="mail" value="{{ Auth::user()->mail }}">
            </div>
            <div class="profile_group">
                <label for="password">パスワード</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="profile_group">
                <label for="passwordConfirmation">パスワード確認</label>
                <input type="password" class="form-control" id="passwordConfirmation" name="passwordConfirmation">
            </div>
            <div class="profile_group">
                <label for="bio">自己紹介</label>
                <textarea class="form-control" id="bio" name="bio">{{ Auth::user()->bio }}</textarea>
            </div>
            <div class="profile_group">
                <label for="image">アイコン画像</label>
                <div class="file_upload_container">
                    <input type="file" class="form_control_file" id="image" name="image">
                    <div class="file_upload_box">
                        <button type="button" onclick="document.getElementById('image').click();">ファイルを選択</button>
                        <span id="fileName" class="file_name">選択されたファイルはありません</span>
                    </div>
                </div>
            </div>
            <div class="profile_button">
                <button type="submit" class="profile_update_button">更新</button>
            </div>
        </form>
    </div>
</div>

@else
    <!-- 相手ユーザーのプロフィール表示 -->
    <div class="user_profile">
        <img src="{{ asset('images/' . $user->images) }}" alt="{[ $user->username }}" class="profile_icon">
        <div class="profile_info">
            <div class="profile_row">
                <h2 class="username_title">ユーザー名</h2>
                <h2>{{ $user->username }}</h2>
            </div>
            <div class="profile_row">
                <p class="bio_title">自己紹介</p>
                <p>{{ $user->bio }}</p>
            </div>
        </div>
        <!-- フォロー・フォロー解除 -->
        <div class="follow_button">
            @if(in_array($user->id, $following_id))
                <form action="{{ route('unfollow', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="unfollow_btn">フォロー解除</button>
                </form>
            @else
                <form action="{{ route('follow', $user->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="follow_btn">フォローする</button>
                </form>
            @endif
        </div>
    </div>

    <!-- 投稿一覧の表示 -->
    @foreach($posts as $post)
        <div class="post">
            <div class="user_info">
                <!-- ユーザーアイコンの表示 -->
                <img src="{{ asset('images/' . $user->images) }}" alt="{{ $user->username }}" class="user_icon">
                <p> {{$post->user->username}} </p>
                <!-- 投稿時間の表示（updated_atに指定し、更新されるように設定） -->
                <small>{{ $post->updated_at->format('Y-m-d H:i') }}</small>
            </div>
            <p class="post_text">{!! nl2br(e($post->post)) !!}</p>
        </div>
    @endforeach
@endif


@endsection
