<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $events = [
            [
                'title' => 'Art Exhibition',
                'description' => 'An exhibition showcasing various forms of art.',
                'date_time' => '2024-03-01 10:00:00',
                'location' => 'Art Gallery',
                'category_id' => 1, 
                'available_seats' => 100,
                'user_id'=>2,
                'reservation_type'=>'automatic',
                'image'=>'images/art.jpg',
                'price'=>15,
            ],
            [
                'title' => 'Sea Activity',
                'description' => 'A football match between two rival teams.',
                'date_time' => '2024-03-02 15:00:00',
                'location' => 'Stadium',
                'category_id' => 2, 
                'available_seats' => 5000,
                'user_id'=>2,
                'image'=>'images/sport.jpg',
                'reservation_type'=>'manual',
                'price'=>10,



            ],
            [
                'title' => 'Political Conference',
                'description' => 'A conference discussing current political issues.',
                'date_time' => '2024-03-03 09:00:00',
                'location' => 'Conference Center',
                'category_id' => 3, 
                'available_seats' => 300,
                'user_id'=>2,
                'image'=>'images/sport.jpg',
                'reservation_type'=>'manual',
                'price'=>18,




            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
