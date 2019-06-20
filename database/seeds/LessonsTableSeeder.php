<?php

use Illuminate\Database\Seeder;

class LessonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lessons')->insert([
            'title' => 'Lesson1',
            'description' => 'This is lesson1',
            'image_url' => 'https://yutarofruta.s3.amazonaws.com/ag8WZYBRxIbEOdQSAZswa0hJSGnIEh6ru90MJ8q7.jpeg',
            'level' => 1,
            'order' => 10,
        ]);
        
        DB::table('lessons')->insert([
            'title' => 'Lesson2',
            'description' => 'This is lesson2',
            'image_url' => 'https://yutarofruta.s3.amazonaws.com/pqwUzghKCFet72VvzakPRKzOKnOYTBruEfHGeMxB.jpeg',
            'level' => 2,
            'order' => 20,
        ]);
    }
}
