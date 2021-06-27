<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teacher = [
            'unique_id' => uniqid('teacher_'),
            'full_name' => 'John sinh',
            'email' => 'john@gmail.com',
            'password' => bcrypt('john123'),
            'role' => 'teacher',
            'gender' => 'Male',
        ];
        \App\User::create($teacher);

        $student = [
            'unique_id' => uniqid('user_'),
            'full_name' => 'Ravi Ramani',
            'email' => 'ravi@gmail.com',
            'password' => bcrypt('ravi123'),
            'role' => 'student',
            'gender' => 'Male',
        ];
        \App\User::create($student);

        $admin = [
            'unique_id' => uniqid('admin_'),
            'full_name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 'admin',
        ];
        \App\User::create($admin);
    }
}
