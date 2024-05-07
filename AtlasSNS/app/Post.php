<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//投稿登録機能
class Post extends Model
{
    //テーブル名を指定
    protected $table = 'posts';

    //マスアサインメント可能な属性
    protected $fillable = ['user_id', 'post'];

    //リレーションシップ
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
