<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\review;
use App\Models\Series;
use App\Models\Topic;
use App\Models\User;
use App\Models\Course;
use App\Models\Platform;
use App\Models\Author;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return array
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Ashraful Alam',
            'email' =>  'ashrafulalamsajal@gmail.com',
            'password' => bcrypt('password'),
            'type'      => 1
        ]);

        $series = [
            [
                'name'  =>  'Laravel',
                'slug'  =>  'laravel',
                'image' =>  'https://laravel-courses.com/storage/series/54e8baab-727e-4593-a78a-e0c22c569b61.png'
            ],
            [
                'name'  =>  'PHP',
                'slug'  =>  'php',
                'image' =>  'https://laravel-courses.com/storage/series/54e8baab-727e-4593-a78a-e0c22c569b61.png'
            ],
            [
                'name'  =>  'Livewire',
                'slug'  =>  'livewire',
                'image' =>  'https://laravel-courses.com/storage/series/54e8baab-727e-4593-a78a-e0c22c569b61.png'
            ],
            [
                'name'  =>  'Vue',
                'slug'  =>  'vue',
                'image' =>  'https://laravel-courses.com/storage/series/54e8baab-727e-4593-a78a-e0c22c569b61.png'
            ],
            [
                'name'  =>  'Js',
                'slug'  =>  'js',
                'image' =>  'https://laravel-courses.com/storage/series/54e8baab-727e-4593-a78a-e0c22c569b61.png'
            ]
        ];


        foreach ($series as $item){
            Series::create([
                'name' => $item['name'],
                'image' =>  $item['image'],
                'slug' =>  $item['slug']
            ]);
        }

        $topics = ['Eloquent', 'Validation', 'Refactoring', 'Testing', 'lasttopic'];
        foreach ($topics as $item){

            $slug = strtolower(str_replace('', '-' ,$item));

            Topic::create([
                'name' => $item,
                'slug' => $slug
            ]);
        }

        $platforms = ['Laracast', 'W3schools.org', 'php.net', 'Youtube', 'Facebook'];
        foreach ($platforms as $item){
            Platform::create([
                'name' => $item
            ]);
        }

        $authors = ['Ashraful', 'Rasel', 'Shamim'];
            foreach($authors as $author){
                Author::create([
                    'name' => $author
                ]);
            }
        Author::factory(10)->create();
        User::factory(50)->create();
        Course::factory(100)->create();


        $courses = Course::all();

        foreach ( $courses as $course){
            $topic_id_array = Topic::all()->random(rand(1,5))->pluck('id')->toArray();
            $course->topics()->attach($topic_id_array);
        }

        foreach ( $courses as $course){
            $author_id_array = Author::all()->random(rand(1,3))->pluck('id')->toArray();
            $course->authors()->attach($author_id_array);
        }

       foreach ($courses as $course) {
           $series_id_array = Series::all()->random(rand(1, 5))->pluck('id')->toArray();
           $course->series()->attach($series_id_array);
       }

        Review::factory(100)->create();


    }
}
