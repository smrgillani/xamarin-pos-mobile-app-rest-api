<?php

use App\UserType;
use Illuminate\Database\Seeder;

class UserTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $newUserType       = new UserType;
        $newUserType->name = 'Restaurant User';
        $newUserType->save();

        $newUserType       = new UserType;
        $newUserType->name = 'Client User';
        $newUserType->save();
    }
}
