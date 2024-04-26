@extends('layouts.logout')

@section('content')
<!-- 適切なURLを入力してください -->
{!! Form::open(['url' => '/register']) !!}
<!-- 伊藤：/registerを指定 -->

<h2>新規ユーザー登録</h2>

<!-- 伊藤：バリデーションのエラーメッセージを表示 -->
@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

{{ Form::label('ユーザー名') }}
{{ Form::text('username',null,['class' => 'input']) }}

{{ Form::label('メールアドレス') }}
{{ Form::text('mail',null,['class' => 'input']) }}

<!-- 伊藤：伏せ文字にする -->
<!-- 'Form::text'から'Form::password'へ変更 -->
{{ Form::label('パスワード') }}
{{ Form::password('password',null,['class' => 'input']) }}

<!-- 伊藤：伏せ文字にする -->
<!-- 'Form::text'から'Form::password'へ変更 -->
{{ Form::label('パスワード確認') }}
{{ Form::password('password_confirmation',null,['class' => 'input']) }}

{{ Form::submit('登録') }}

<p><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}


@endsection
