<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = 'Ha Do';
        $user->email = 'ha@gmail.com';
        $user->password = bcrypt('123456');
        $user->save();
    }
}
