<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        return [
            'user_id' => fake()->numberBetween(1,10),
            'category_id' => fake()->numberBetween(1,5),
            'title' => fake()->sentence(6),
            'desc' => fake()->paragraph(10),
            'type_place'=> fake()->randomElement(['Restaurant','Hotel','Transport','College','Museum','Gardens','Airport']),
            'city' => fake()->randomElement(['Amman','Zarqa','Irbid']),
            'location' => fake()->sentence(2),
            'type' => fake()->randomElement(['Lost', 'Found']),
            'time' => fake()->dateTimeThisMonth()->format('Y-m-d H:i:s'),
            'image' => fake()->randomElement(['https://media.istockphoto.com/id/1271880340/vector/lost-items-line-vector-icon-unidentified-items-outline-isolated-icon.jpg?s=170667a&w=0&k=20&c=iB2fQWNV6PWxV1BjYs02Qs_ugu8oGo4ZSz-lTSUqHe4=',
                                                    'https://cdn-icons-png.flaticon.com/512/1201/1201867.png',
                                                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQlJKICbC_2x7UZ_TZnPOTY26P6AVCI0APZvA&usqp=CAU',
                                                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLb9gbjxz2aaQWvwxjTIhQhXInQqeloP19xh5mu-s5Ei5lmcHYeCTv5mb9Ckt_UJ3_2U0&usqp=CAU'])
        ];
    }
}
