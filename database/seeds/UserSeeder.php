<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Todo;

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
                
        for ($i=0; $i < 3; $i++) { 
            $todo = new Todo;
            $todo->user_id = $user->id;
            $todo->title = 'Title ' . $i;
            $todo->content = 'Content ' . $i;
            $todo->status = $i;
            $todo->save();
        }     
    }
}
