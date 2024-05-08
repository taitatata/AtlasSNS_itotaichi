@extends('layouts.logout')

@section('content')

<div id="clear">
    <div class="added_content">
        <div class="added_box">
            <div class="added_title">
                <!-- ユーザー名を表示 -->
                @if (session('registered_username'))
                    <p>{{ session('registered_username') }}さん</p>
                @endif
                <p>ようこそ！AtlasSNSへ！</p>
            </div>
            <div class="added_text">
                <p>ユーザー登録が完了しました。</p>
                <p>早速ログインをしてみましょう。</p>
            </div>
            <p><a class="return_login_btn" href="/login">ログイン画面へ</a></p>
        </div>
    </div>
</div>

@endsection
