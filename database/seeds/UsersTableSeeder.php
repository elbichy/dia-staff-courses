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
                'username' => 'elbichy',
                'email' => 'elbichy@gmail.com',
                'password' => Hash::make('@Suleimanu1'),
                'gender' => 'male',
                'isRecord' => 1,
                'isAccount' => 0,
                'isNurse' => 0,
                'isDoctor' => 0,
                'isLab' => 0,
                'isPhamacy' => 0
            ],
            [
                'fullname' => 'Usman Shehu',
                'service_number' => '66819',
                'username' => 'ussy',
                'email' => 'ussy@gmail.com',
                'password' => Hash::make('@Suleimanu1'),
                'gender' => 'male',
                'isRecord' => 0,
                'isAccount' => 1,
                'isNurse' => 0,
                'isDoctor' => 0,
                'isLab' => 0,
                'isPhamacy' => 0
            ],
            [
                'fullname' => 'Hauwa Abdulahi',
                'service_number' => '66820',
                'username' => 'hauwie',
                'email' => 'hauwie@gmail.com',
                'password' => Hash::make('@Suleimanu1'),
                'gender' => 'female',
                'isRecord' => 0,
                'isAccount' => 0,
                'isNurse' => 1,
                'isDoctor' => 0,
                'isLab' => 0,
                'isPhamacy' => 0
            ],
            [
                'fullname' => 'Tahir Usman Aboki',
                'service_number' => '66821',
                'username' => 'aboki',
                'email' => 'aboki@gmail.com',
                'password' => Hash::make('@Suleimanu1'),
                'gender' => 'male',
                'isRecord' => 0,
                'isAccount' => 0,
                'isNurse' => 0,
                'isDoctor' => 1,
                'isLab' => 0,
                'isPhamacy' => 0
            ],
            [
                'fullname' => 'Fatima Aliyu',
                'service_number' => '66822',
                'username' => 'fasha',
                'email' => 'fasha@gmail.com',
                'password' => Hash::make('@Suleimanu1'),
                'gender' => 'female',
                'isRecord' => 0,
                'isAccount' => 0,
                'isNurse' => 0,
                'isDoctor' => 0,
                'isLab' => 1,
                'isPhamacy' => 0
            ],
            [
                'fullname' => 'Salisu Mohd',
                'service_number' => '66823',
                'username' => 'salisu',
                'email' => 'salisu@gmail.com',
                'password' => Hash::make('@Suleimanu1'),
                'gender' => 'male',
                'isRecord' => 0,
                'isAccount' => 0,
                'isNurse' => 0,
                'isDoctor' => 0,
                'isLab' => 0,
                'isPhamacy' => 1
            ]
        ];
    
        foreach($users as $user){
            User::create($user);
        }
    }
}
