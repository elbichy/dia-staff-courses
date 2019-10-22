<?php

use Illuminate\Database\Seeder;
use App\User;
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
                'dob' => '',
                'doe' => '',
                'level' => '9',
                'category' => 'Senior',
                'isAdmin' => 1,
                'isStaff' => 0
            ],
            [
                'fullname' => 'Usman Shehu',
                'service_number' => '66819',
                'email' => 'ussy@gmail.com',
                'password' => Hash::make('@Suleimanu1'),
                'gender' => 'male',
                'directorate' => 'Admin',
                'dob' => '',
                'doe' => '',
                'level' => '9',
                'category' => 'Senior',
                'isAdmin' => 1,
                'isStaff' => 0
            ]
        ];
    
        foreach($users as $user){
            User::create($user);
        }
    }
}
