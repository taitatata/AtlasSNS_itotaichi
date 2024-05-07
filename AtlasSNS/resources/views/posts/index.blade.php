@extends('layouts.login')

@section('content')

<!-- プロフィールを更新した際のポップアップ -->
@if(session('success'))
    <script>
        window.onload = function() {
            alert('{{ session('success') }}');
        };
    </script>
@endif

<!-- 新規投稿フォーム -->
<div class="Submission_form">
    <div class="user_icon_form">
        {{-- ユーザー画像の表示 --}}
        @auth
            <img src="{{ asset('images/' . Auth::user()->images) }}" alt="{{ Auth::user()->name }}" class="img-fluid">
        @endauth
    </div>
    <div class="textarea">
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <textarea class="textarea_post" id="post" name="post" rows="4" required placeholder="投稿内容を入力してください。" minlength="1" maxlength="150"></textarea>
            <button type="submit" class="submit_button"></button>
        </form>
    </div>
</div>
@if(isset($posts))
    <!-- 投稿一覧の表示 -->
    @foreach($posts as $post)
        <div class="post">
            <div class="user_info">
                <!-- ユーザーアイコンの表示 -->
                <img src="{{ asset('images/' . $post->user->images) }}" alt="{{ $post->user->name }}'s icon" class="user_icon">
                <p> {{$post->user->username}} </p>
                <!-- 投稿時間の表示（updated_atに指定し、更新されるように設定） -->
                <small>{{ $post->updated_at->format('Y-m-d H:i') }}</small>
            </div>
            <p class="post_text">{!! nl2br(e($post->post)) !!}</p>

            @if ($post->user_id == Auth::id())
                <div class="post_button">
                    <!-- 編集ボタン -->
                    <button class="edit_button" data-id="{{ $post->id }}" data-toggle="modal" data-target="#editModal"></button>
                    <!-- 削除ボタン -->
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete_button"></button>
                    </form>
                </div>
            @endif
        </div>
    @endforeach
@else
    <p>投稿はありません。</p>
@endif

<!-- 編集用モーダル -->
<div id="overlay" class="overlay">
    <div id="editModal" class="modal">
        <div class="modal-content">
        <form id="editForm" action="/posts/{id}" method="POST">
            @csrf
            @method('PUT')
            <textarea id="postContent" name="postContent" maxlength="150" required></textarea>
            <button type="submit" class="update_button"></button>
        </form>
        </div>
    </div>
</div>

@endsection
