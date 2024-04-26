<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
</head>
<body>
    <header>
        <div id = "head">
            <!-- 伊藤：ロゴのURL貼り付け -->
            <h1><a href="top"><img src="images/Atlas.png" class="logo"></a></h1>
            <div id="header-menu">
                <!-- 伊藤：ユーザー名を表示_ビューコンポーザーを設定 -->
                @if(isset($logged_in_user))
                    <p class="login-name">{{ $logged_in_user->username }}さん</p>
                @endif
                <!-- 伊藤：アコーディオンメニューの作成 -->
                <div class="menu">
                    <label for="menu_bar01" class="menu-trigger"></label>
                    <input type="checkbox" id="menu_bar01" />
                    <ul id="links01">
                        <li><a href="top">HOME</a></li>
                        <li><a href="profile">プロフィール編集</a></li>
                        <li><a href="logout">ログアウト</a></li>
                    </ul>
                    @auth
                    <img src="{{ asset('images/' . Auth::user()->images) }}" alt="{{ Auth::user()->name }}" class="img-fluid">
                    @endauth
                </div>
            </div>
        </div>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">
            <div id="confirm">
                <!-- 伊藤：ユーザー名を表示_ビューコンポーザーを設定 -->
                @if(isset($logged_in_user))
                    <p>{{ $logged_in_user->username }}さんの</p>
                @endif
                <div class=follow-count>
                    <p>フォロー数</p>
                    <!-- 変数の定義とnullチェック -->
                    <p>@if(isset($followingsCount))
                            {{ $followingsCount }}名
                    @else
                        未定義
                    @endif</p>
                </div>
                <p class="btn"><a href="/follow-list">フォローリスト</a></p>
                <div class="follower-count">
                    <p>フォロワー数</p>
                    <!-- 変数の定義とnullチェック -->
                    <p>@if(isset($followersCount))
                            {{ $followersCount }}名
                    @else
                        未定義
                    @endif</p>
                </div>
            </div>
            <p class="btn"><a href="/follower-list">フォロワーリスト</a></p>
            <p class="btn"><a href="/search">ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
