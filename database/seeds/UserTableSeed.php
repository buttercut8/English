<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class UserTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
         $faker = Faker::create('App\User');
         App\User::truncate();
         DB::table('users')->insert([
             [
                 'avatar' => "Mark_Remy.jpg",
                 'background' => 'vuejs.jpg',
                 'facebook' => 'https://www.facebook.com/NguyenTietNgocChau96',
                 'skype' => 'https://secure.skype.com/portal/overview',
                 'twitter' => 'https://twitter.com/MarkRemy4',
                 'name' => 'Mark Remy',
                 'phone' => '0976830624',
                 'email' => 'remy@gmail.com',
                 'password' => bcrypt('2007'),
                 'ip_address' => '192.168.1.1',
                 'remember_token' => str_random(100),
                 'created_at' => \Carbon\Carbon::now(),
                 'updated_at' => \Carbon\Carbon::now(),
             ],
             [
                 'avatar' => "avatar.png",
                 'background' => 'background.jpg',
                //  'avatar' => $faker->imageUrl($width = 440, $height = 280),
                 'facebook' => 'https://www.facebook.com/profile.php?id=100004055552399',
                 'skype' => 'https://www.facebook.com/profile.php?id=100004055552399',
                 'twitter' => 'https://www.facebook.com/profile.php?id=100004055552399',
                 'name' => 'Trần Đoàn Hải Yến',
                 'phone' => '0909257619',
                 'email' => 'yen@gmail.com',
                 'password' =>bcrypt('123456'),
                 'ip_address' => $faker->ipv4,
                 'remember_token' => str_random(100),
                 'created_at' => \Carbon\Carbon::now(),
                 'updated_at' => \Carbon\Carbon::now(),
             ],
         ]);
     }
}
