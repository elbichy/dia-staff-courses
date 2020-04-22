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
                'servicename' => 'S. Abdulrazaq',
                'username' => 'elbichy',
                'service_number' => '66818',
                'password' => Hash::make('@Suleimanu1'),
                'gender' => 'male',
                'directorate' => 'Admin',
                'soo' => 'Kano',
                'lgoo' => 'Bichi',
                'dob' => Carbon::create(1992,01,27,0),
                'doe' => Carbon::create(1992,01,27,0),
                'gl' => '9',
                'category' => 'Senior',
                'isAdmin' => 1,
                'isCDI' => 0
            ],
            [
                'fullname' => 'Usman Shehu',
                'servicename' => 'U. Shehu',
                'username' => 'ussy',
                'service_number' => '66819',
                'password' => Hash::make('@Suleimanu1'),
                'gender' => 'male',
                'directorate' => 'Admin',
                'soo' => 'Kano',
                'lgoo' => 'Bichi',
                'dob' => Carbon::create(1992,01,27,0),
                'doe' => Carbon::create(1992,01,27,0),
                'gl' => '9',
                'category' => 'Senior',
                'isAdmin' => 0,
                'isCDI' => 1
            ]
        ];
    
        foreach($users as $user){
            User::create($user);
        }
    }
}