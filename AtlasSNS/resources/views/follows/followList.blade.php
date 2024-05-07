@extends('layouts.login')

@section('content')
<!-- アイコン一覧の表示 -->
<div class="followings_icons">
  <h3>フォローリスト</h3>
  <div class="user_icons">
    @foreach($followings as $following)
      <a href="{{ route('user.profile' , ['id' => $following->id]) }}">
        <img src="{{ asset('images/' . $following->images) }}" alt="{{ $following->username }}" class="list_user_icon">
      </a>
    @endforeach
  </div>
</div>

<!-- 投稿一覧の表示 -->
@foreach($posts as $post)
  <div class="post">
    <div class="user_info">
      <!-- ユーザーアイコンの表示 -->
      <a href="{{ route('user.profile' , ['id' => $post->user->id]) }}">
        <img src="{{ asset('images/' . $post->user->images) }}" alt="{{ $post->user->username }}" class="user_icon">
      </a>
      <p> {{$post->user->username}} </p>
      <!-- 投稿時間の表示（updated_atに指定し、更新されるように設定） -->
      <small>{{ $post->updated_at->format('Y-m-d H:i') }}</small>
    </div>
    <p class="post_text">{!! nl2br(e($post->post)) !!}</p>
  </div>
@endforeach

@endsection
