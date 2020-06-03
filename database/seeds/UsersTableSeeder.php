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
                'queries' => 0,
                'commendations' => 0,
                'isAdmin' => 1,
                'isTraining' => 0,
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
                'queries' => 0,
                'commendations' => 0,
                'isAdmin' => 0,
                'isTraining' => 1,
                'isCDI' => 0
            ],
            [
                'fullname' => 'Usman Tahir Aboki',
                'servicename' => 'U. T. Aboki',
                'username' => 'aboki',
                'service_number' => '66519',
                'password' => Hash::make('@Suleimanu1'),
                'gender' => 'male',
                'directorate' => 'Admin',
                'soo' => 'Nasarawa',
                'lgoo' => 'Kiana',
                'dob' => Carbon::create(1992,01,27,0),
                'doe' => Carbon::create(1992,01,27,0),
                'gl' => '9',
                'category' => 'Senior',
                'queries' => 0,
                'commendations' => 0,
                'isAdmin' => 0,
                'isTraining' => 0,
                'isCDI' => 1
            ],
            [
                'fullname' => 'Ibrahim Abdullahi',
                'servicename' => 'I. Abdullahi',
                'username' => 'jegason',
                'service_number' => '66512',
                'password' => Hash::make('@Suleimanu1'),
                'gender' => 'male',
                'directorate' => 'Admin',
                'soo' => 'Jigawa',
                'lgoo' => 'Yanleman',
                'dob' => Carbon::create(1992,01,27,0),
                'doe' => Carbon::create(1992,01,27,0),
                'gl' => '9',
                'category' => 'Senior',
                'queries' => 0,
                'commendations' => 0,
                'isAdmin' => 0,
                'isTraining' => 0,
                'isDirector' => 0,
                'isCDI' => 0
            ]
        ];
    
        foreach($users as $user){
            User::create($user);
        }
    }
}