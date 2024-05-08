@extends('layouts.logout')

@section('content')
<!-- 適切なURLを入力してください -->
{!! Form::open(['url' => '/login']) !!}
<!-- /loginを指定 -->
<div class="login_container">
    <div class="login_menu_form">
        <p class="login_text">AtlasSNSへようこそ</p>
        <div class="login_mail">
            {{ Form::label('メールアドレス') }}
            {{ Form::text('mail',null,['class' => 'input']) }}
        </div>
        <div class="login_pass">
            {{ Form::label('パスワード') }}
            {{ Form::password('password',['class' => 'input']) }}
        </div>

        {{ Form::submit('ログイン', ['class' => 'login_btn']) }}

        <p><a href="/register" class="user_registration_link">新規ユーザーの方はこちら</a></p>
    </div>
</div>

{!! Form::close() !!}

@endsection
