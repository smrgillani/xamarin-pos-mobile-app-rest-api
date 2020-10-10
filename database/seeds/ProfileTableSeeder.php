<?php
use App\User;
use Illuminate\Database\Seeder;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
       
        
        DB::table('profiles')->insert([

            'name'        => "user",
            'user_id'     =>    1,
            'description' => "dsgjhfdgfdhgdf",
            'address'     => "hdfhjfdjhdfg",
            'city'     => "hdfhjfdjhdfg",
            'postal_code'     => "hdfhjfdjhdfg",
            'phone_no'     => "564545454",
            "image_name"  => "ndsfhgdsfhgsd",
            "image_path"  => "dfhgfdhgfdhjgfd",
            'created_at'  => date("Y-m-d h:i:s"),
        ]);
       

        DB::table('profiles')->insert([

            'name'        => "user la",
            'user_id'     => 1,
            'description' => "dsgjhfdgfdhgdf",
            'address'     => "hdfhjfdjhdfg",
            'city'     => "hdfhjfdjhdfg",
            'postal_code'     => "hdfhjfdjhdfg",
            'phone_no'     => "5545445",
            "image_name"  => "ndsfhgdsfhgsd",
            "image_path"  => "dfhgfdhgfdhjgfd",
            'created_at'  => date("Y-m-d h:i:s"),
        ]);
       
        DB::table('profiles')->insert([

            'name'        => "userWO",
            'user_id'     => 1,
            'description' => "dsgjhfdgfdhgdf",
            'address'     => "hdfhjfdjhdfg",
            'city'     => "hdfhjfdjhdfg",
            'postal_code'     => "hdfhjfdjhdfg",
            'phone_no'     => "245465454",
            "image_name"  => "ndsfhgdsfhgsd",
            "image_path"  => "dfhgfdhgfdhjgfd",
            'created_at'  => date("Y-m-d h:i:s"),
        ]);

         DB::table('profiles')->insert([

            'name'        => "userma",
            'user_id'     => 1,
            'description' => "dsgjhfdgfdhgdf",
            'address'     => "hdfhjfdjhdfg",
            'city'     => "hdfhjfdjhdfg",
            'postal_code'     => "hdfhjfdjhdfg",
            'phone_no'     => "654654564",
            "image_name"  => "ndsfhgdsfhgsd",
            "image_path"  => "dfhgfdhgfdhjgfd",
            'created_at'  => date("Y-m-d h:i:s"),
        ]);
    }
}
