<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Pasien;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@gmail.com',
        // ]);

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12121212'),
            'role' => 'admin',
        ]);

        DB::table('users')->insert([
            'name' => 'Doctor',
            'email' => 'doctor@gmail.com',
            'password' => Hash::make('12121212'),
            'role' => 'doctor',
        ]);

        Pasien::create([
            'name_pasien' => 'Pasien1',
            'email_pasien' => 'pasien1@gmail.com',
            'password' => bcrypt('12121212'),
        ]);

        Pasien::create([
            'name_pasien' => 'Pasien2',
            'email_pasien' => 'pasien2@gmail.com',
            'password' => bcrypt('12121212'),
        ]);

        Pasien::create([
            'name_pasien' => 'Pasien3',
            'email_pasien' => 'pasien3@gmail.com',
            'password' => bcrypt('12121212'),
        ]);

        Pasien::create([
            'name_pasien' => 'Pasien4',
            'email_pasien' => 'pasien4@gmail.com',
            'password' => bcrypt('12121212'),
        ]);

        Pasien::create([
            'name_pasien' => 'Pasien5',
            'email_pasien' => 'pasien5@gmail.com',
            'password' => bcrypt('12121212'),
        ]);

        Pasien::create([
            'name_pasien' => 'Pasien6',
            'email_pasien' => 'pasien6@gmail.com',
            'password' => bcrypt('12121212'),
        ]);

        Pasien::create([
            'name_pasien' => 'Pasien7',
            'email_pasien' => 'pasien7@gmail.com',
            'password' => bcrypt('12121212'),
        ]);

        Pasien::create([
            'name_pasien' => 'Pasien8',
            'email_pasien' => 'pasien8@gmail.com',
            'password' => bcrypt('12121212'),
        ]);

        Pasien::create([
            'name_pasien' => 'Pasien9',
            'email_pasien' => 'pasien9@gmail.com',
            'password' => bcrypt('12121212'),
        ]);

        Pasien::create([
            'name_pasien' => 'Pasien0',
            'email_pasien' => 'pasien0@gmail.com',
            'password' => bcrypt('12121212'),
        ]);
    }
}
