<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class TodoTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\Todo');
        App\Todo::truncate();
        for($i=1;$i <= 23; $i++){
            DB::table('todo')->insert([
                'title' => $faker->country,
                'content' => $faker->text,
                // 'images' => $faker->randomElement($array = array('demo1.jpg','demo2.jpg','demo3.jpg','demo4.jpg')),
                // 'images' => $faker->imageUrl,
                'user_id' => $faker->randomElement($array = array('1','2')),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
    }
}
