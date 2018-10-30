<?php

use App\Article;
use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Let's truncate our existing records to start from scratch
        Article::truncate();

        $faker = \Faker\Factory::create();

        //Lets create a few articles in the database
        for ($i=0 ; $i < 50; $i++){
            Article::create([
                'title'         => $faker->sentence,
                'description'   => $faker->paragraph,
            ]);
        }

    }
}
