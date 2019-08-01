<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->truncate();

        // 头像假数据
        $avatars = [
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/s5ehp11z6s.png?imageView2/1/w/200/h/200',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/Lhd1SHqu86.png?imageView2/1/w/200/h/200',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/LOnMrqbHJn.png?imageView2/1/w/200/h/200',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/xAuDMxteQy.png?imageView2/1/w/200/h/200',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/ZqM7iaP4CR.png?imageView2/1/w/200/h/200',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/NDnzMutoxX.png?imageView2/1/w/200/h/200',
        ];

        // 单独处理第一个用户的数据
        $user = DB::table('users')->insert([
           'name'=>'Summer',
           'password'=>
                Hash::make('12345')
           ,
           'email'=> 'summer@yousails.com',
           'avatar'=> array_random($avatars),
           'remember_token'=>str_random(10),
        ]);
        $user = DB::table('users')->insert([
           'name'=>'Alisha',
           'password'=>
                Hash::make('12345')
           ,
           'email'=> 'alisha@qq.com',
           'avatar'=> array_random($avatars),
           'remember_token'=>str_random(10),
        ]);
        $user = DB::table('users')->insert([
           'name'=>'over',
           'password'=>
                Hash::make('12345')
           ,
           'email'=> 'over@you.com',
           'avatar'=> array_random($avatars),
           'remember_token'=>str_random(10),
        ]);

    }
}

