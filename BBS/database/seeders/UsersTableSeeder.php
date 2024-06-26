<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // 生成数据集合
       User::factory()->count(10)->create();

       // 单独处理第一个用户的数据
       $user = User::find(1);
       $user->name = '修改为你的用户名';
       $user->email = '修改为你的邮箱@example.com';
       $user->avatar = 'https://cdn.learnku.com/uploads/images/201710/14/1/ZqM7iaP4CR.png';
       $user->save();

    }
}
