<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <!--IEブラウザ対策-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description" content="ページの内容を表す文章" />
        <title>AtlasSNS / 改修課題</title>
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
                <h1><a href="/top"><img src="/images/Atlas.png" alt="アトラスのロゴ" class="logo"></a></h1>
                <div id="headerMenu">
                    <!-- 伊藤：ユーザー名を表示_ビューコンポーザーを設定 -->
                    @if(isset($logged_in_user))
                        <p class="login_name">{{ $logged_in_user->username }}さん</p>
                    @endif
                    <!-- 伊藤：アコーディオンメニューの作成 -->
                    <div class="menu">
                        <label for="menuBar01" class="menu_trigger"></label>
                        <input type="checkbox" id="menuBar01" />
                        <ul id="links01">
                            <li><a href="/top">HOME</a></li>
                            <li><a href="{{ route('user.profile', ['id' => Auth::id()]) }}">プロフィール編集</a></li>
                            <li><a href="/logout">ログアウト</a></li>
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
            <div id="sideBar" class="side_bar">
                <div id="confirm" class="confirm">
                    <!-- 伊藤：ユーザー名を表示_ビューコンポーザーを設定 -->
                    @if(isset($logged_in_user))
                        <p>{{ $logged_in_user->username }}さんの</p>
                    @endif
                    <div class=follow_count>
                        <p>フォロー数</p>
                        <!-- 変数の定義とnullチェック -->
                        <p class="count_text">@if(isset($followingsCount))
                                {{ $followingsCount }}名
                        @else
                            未定義
                        @endif</p>
                    </div>
                    <p class="btn"><a href="/follow-list">フォローリスト</a></p>
                    <div class="follower_count">
                        <p>フォロワー数</p>
                        <!-- 変数の定義とnullチェック -->
                        <p class="count_text">@if(isset($followersCount))
                                {{ $followersCount }}名
                        @else
                            未定義
                        @endif</p>
                    </div>
                    <p class="btn"><a href="/follower-list">フォロワーリスト</a></p>
                </div>
                <div class="search_button">
                    <p class="btn"><a href="/search">ユーザー検索</a></p>
                </div>
            </div>
        </div>
        <footer>
        </footer>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="{{ asset('js/script.js') }}"></script>
    </body>
</html>
