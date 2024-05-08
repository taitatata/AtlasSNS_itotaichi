@extends('layouts.logout')

@section('content')
<!-- 適切なURLを入力してください -->
{!! Form::open(['url' => '/register']) !!}
<!-- 伊藤：/registerを指定 -->


<div class="user_registration_container">
    <div class="user_registration">
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
            <div class="user_registration_form">
            {{ Form::label('ユーザー名') }}
            {{ Form::text('username',null,['class' => 'input']) }}
        </div>
            <div class="user_registration_form">
            {{ Form::label('メールアドレス') }}
            {{ Form::text('mail',null,['class' => 'input']) }}
        </div>
        <div class="user_registration_form">
            <!-- 伏せ文字にする -->
            {{ Form::label('パスワード') }}
            {{ Form::password('password',['class' => 'input']) }}
        </div>
        <div class="user_registration_form">
            <!-- 伏せ文字にする -->
            {{ Form::label('パスワード確認') }}
            {{ Form::password('passwordConfirmation',['class' => 'input']) }}
        </div>
        {{ Form::submit('新規登録',['class' => 'submit_btn']) }}

        <p><a class="return_login_link" href="/login">ログイン画面へ戻る</a></p>
    </div>
</div>

{!! Form::close() !!}


@endsection
