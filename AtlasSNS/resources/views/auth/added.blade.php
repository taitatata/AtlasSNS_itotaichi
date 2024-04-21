@extends('layouts.logout')

@section('content')

<div id="clear">
  <!-- <p>〇〇さん</p> -->

  <!-- 伊藤：ユーザー名を表示 -->
  @if (session('registered_username'))
  <p>{{ session('registered_username') }}さん</p>
  @endif

  <p>ようこそ！AtlasSNSへ！</p>
  <p>ユーザー登録が完了しました。</p>
  <p>早速ログインをしてみましょう。</p>

  <p class="btn"><a href="/login">ログイン画面へ</a></p>
</div>

@endsection
