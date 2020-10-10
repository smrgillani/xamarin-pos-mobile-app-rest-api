<?php

use Illuminate\Database\Seeder;

class TablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

         DB::table('tables')->insert([

            'name'            => "abc",
            'profile_id'       => 1,
            'type'            => "any",
            'seats'           => 4,
            'free_tables'      => 8,
            'reservation_time' => "7:30",
            "status"          => "1",
            'created_at'      => date("Y-m-d h:i:s"),
        ]);

        DB::table('tables')->insert([

            "profile_id"       => 1,
            "name"            => "xgyz",
            "type"            => "anyggg type",
            "seats"           => 7,
            "free_tables"      => 2,
            "reservation_time" => "7:30",
            "status"          => 1,
            'created_at'      => date("Y-m-d h:i:s"),
        ]);

        DB::table('tables')->insert([

            "profile_id"       => 2,
            "name"            => "def",
            "type"            => "anyggg type",
            "seats"           => 3,
            "free_tables"      => 6,
            "reservation_time" => "7:30",
            "status"          => 1,
            'created_at'      => date("Y-m-d h:i:s"),
        ]);

        DB::table('tables')->insert([

            "profile_id"       => 2,
            "name"            => "abcd",
            "type"            => "anyggg type",
            "seats"           => 4,
            "free_tables"      => 5,
            "reservation_time" => "7:30",
            "status"          => 1,
            'created_at'      => date("Y-m-d h:i:s"),
        ]);
    }
}
