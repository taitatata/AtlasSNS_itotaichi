@extends('layouts.login')

@section('content')
<!-- 新規投稿フォーム -->
<div class="Submission-form">
  <div class="user-icon">
    {{-- ユーザー画像の表示 --}}
    @auth
      <img src="{{ asset('images/' . Auth::user()->images) }}" alt="{{ Auth::user()->name }}" class="img-fluid">
    @endauth
  </div>
  <div class="text-area">
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
            <textarea class="textarea-post" id="post" name="post" rows="4" required placeholder="投稿内容を入力してください。" minlength="1" maxlength="150"></textarea>
        <button type="submit" class="submit-button"></button>
    </form>
  </div>
</div>
@if(isset($posts))
  <!-- 投稿一覧の表示 -->
  @foreach($posts as $post)
  <div class="post">
    <div class="user-info">
      <!-- ユーザーアイコンの表示 -->
      <img src="{{ asset('images/' . $post->user->images) }}" alt="{{ $post->user->name }}'s icon" class="user-icon">
      <p> {{Auth::user()->username}} </p>
      <h4>{{ $post->user->name }}</h4>
    </div>
    <p>{{ $post->post }}</p>
    <!-- 投稿時間の表示（updated_atに指定し、更新されるように設定） -->
    <small>{{ $post->updated_at->format('Y-m-d H:i') }}</small>

    @if ($post->user_id == Auth::id())
      <div class="post">
        <!-- 編集ボタン -->
        <button class="edit-button" data-id="{{ $post->id }}" data-toggle="modal" data-target="#editModal"></button>
        <!-- 削除ボタン -->
        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="delete-button"></button>
        </form>
      </div>
    @endif
  </div>
  @endforeach
@else
  <p>投稿はありません。</p>
@endif

<!-- 編集用モーダル -->
<div id="editModal" class="modal" style="display:none;">
  <form id="editForm" action="/posts/{id}" method="POST">
    @csrf
    @method('PUT')
    <textarea id="postContent" name="postContent" maxlength="150" required></textarea>
    <button type="submit" class="update-button"></button>
  </form>
</div>

@endsection
