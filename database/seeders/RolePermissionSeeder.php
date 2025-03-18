<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create ([
            'name' => 'Admin',
        ]);

        $studentRole = Role::create ([
            'name' => 'Student',
        ]);

        $mentorRole = Role::create ([
            'name' => 'Mentor',
        ]);


        $user = User::create([
            'name' => 'Admin Seeder',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

         $student = User::create([
            'name' => 'Student Seeder',
            'email' => 'student@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

         $mentor = User::create([
            'name' => 'mentor Seeder',
            'email' => 'mentor@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $user->assignRole($adminRole);
        $student->assignRole($studentRole);
        $mentor->assignRole($mentorRole);

    }

}
