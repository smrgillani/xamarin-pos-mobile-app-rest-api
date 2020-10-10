<?php
use App\UserType;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // Bini telecom - Admin
    
        $password = bcrypt("123");
        

        DB::table('users')->insert([

            'name'         => "restaurantuser",
            'user_type_id'      => UserType::RESTAURANTUSER,
            'email'        => "resuser@gmail.com",
            'password'     => $password,
            'created_at'   => date("Y-m-d h:i:s"),
        ]);
        

        DB::table('users')->insert([

            'name'         => "user",
            'user_type_id'      => UserType::CLIENTUSER,
            'email'        => "user@gmail.com",
            'password'     => $password,
            'created_at'   => date("Y-m-d h:i:s"),
        ]);


    }
}
