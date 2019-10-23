<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $users = [
            [
                'fullname' => 'Suleiman Abdulrazaq',
                'service_number' => '66818',
                'email' => 'elbichy@gmail.com',
                'password' => Hash::make('@Suleimanu1'),
                'gender' => 'male',
                'directorate' => 'Admin',
                'dob' => Carbon::create(1992,01,27,0),
                'doe' => Carbon::create(1992,01,27,0),
                'gl' => '9',
                'category' => 'Senior',
                'isAdmin' => 0
            ],
            [
                'fullname' => 'Usman Shehu',
                'service_number' => '66819',
                'email' => 'ussy@gmail.com',
                'password' => Hash::make('@Suleimanu1'),
                'gender' => 'male',
                'directorate' => 'Admin',
                'dob' => Carbon::create(1992,01,27,0),
                'doe' => Carbon::create(1992,01,27,0),
                'gl' => '9',
                'category' => 'Senior',
                'isAdmin' => 1
            ]
        ];
    
        foreach($users as $user){
            User::create($user);
        }
    }
}
