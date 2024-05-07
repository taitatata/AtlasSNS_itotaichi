@extends('layouts.login')

@section('content')

<!-- 検索フォームの設置 -->
<div class="search_container">
    <div class="search_box">
        <form action="{{ route('user.search') }}" method="GET" class="search_form">
            <input type="text" name="query" placeholder="ユーザー名" class="search_input">
            <button type="submit" class="search_form_button"></button>
        </form>
        <!-- 検索値の表示 -->
        @if(session('last_search'))
            <p class="search_word">検索ワード：{{ session('last_search') }}</p>
        @endif
    </div>
    <!-- ユーザー一覧を表示 -->
    <div class="empty_form">
        @forelse ($users as $user)
            <li>
                <img src="{{ asset('images/' . $user->images) }}" alt="{{ $user->name }}" class="img-fluid">
                <p class="username">{{ $user->username }}</p>
                <!-- フォロー・フォロー解除 -->
                @if(in_array($user->id, $followings))
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
            </li>
        @empty
            <p class="no_users">ユーザーが見つかりません。</p>
        @endforelse
    </div>
</div>

@endsection
