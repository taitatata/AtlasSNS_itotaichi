<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//伊藤：追記
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            if (Auth::check()) { // ユーザーがログインしているかチェック
                //伊藤：ログイン名の表示
                $view->with('logged_in_user', Auth::user());
                //伊藤：フォローとフォロワー数の表示
                $user = Auth::user();
                $followingsCount = $user->followings()->count();
                $followersCount = $user->followers()->count();
                $view->with('followingsCount', $followingsCount)
                    ->with('followersCount', $followersCount);
            }
        });
    }
}
