<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['username' => '伊藤', 'mail' =>'ito@gmail.com', 'password' => Hash::make('ito')], //パスワードをハッシュ化して登録
            ['username' => '佐藤', 'mail' =>'sato@gmail.com', 'password' => Hash::make('sato')], //パスワードをハッシュ化して登録
            ['username' => '後藤', 'mail' =>'goto@gmail.com', 'password' => Hash::make('goto')], //パスワードをハッシュ化して登録
            ['username' => '須藤', 'mail' =>'sudo@gmail.com', 'password' => Hash::make('sudo')], //パスワードをハッシュ化して登録
            ['username' => '加藤', 'mail' =>'kato@gmail.com', 'password' => Hash::make('kato')], //パスワードをハッシュ化して登録
        ]);
    }
}
//初期レコードを5つ登録
//暗号化処理のため、Hash::makeメソッドを使用
