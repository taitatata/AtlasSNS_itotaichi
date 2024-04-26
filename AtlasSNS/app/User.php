<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // 伊藤：フォロー・フォロワー数表示用
    // ユーザーがフォローしている人々
    public function followings() {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id');
    }

    // ユーザーをフォローしている人々
    public function followers() {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'following_id');
    }
}
