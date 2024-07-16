<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reservation;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $reservations = [
            [
                'user_id' => 1, 
                'event_id' => 1,
                'number_of_tickets'=>2,
                'total_price'=>200
            ],
             [
                'user_id' => 2, 
                 'event_id' => 2, 
            ],
        ];

        foreach ($reservations as $reservationData) {
            Reservation::create($reservationData);
        }
}
}