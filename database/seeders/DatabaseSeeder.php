<?php

namespace Database\Seeders;

use App\Models\CategoryModel;
use App\Models\DeveloperModel;
use App\Models\EmailModel;
use App\Models\PhoneModel;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        //User::factory()->create([
        //    'name' => 'Test User',
        //    'email' => 'test@example.com',
        //]);

        //save the categories, developers, phones,

        //categories
        $categories = [
            ['name' => 'Lotificación',],
            ['name' => 'Urbanización',],
        ];

        foreach ($categories as $category) {
            CategoryModel::create($category);
        }

        //developers
        $developers = [
            [
                'name' => 'Desarrolladora JC',
                'short_name' => 'DJC',
                'large_name' => 'Desarrolladora JC S.A. de C.V.',
                'description' => 'Desarrolladora JC S.A. de C.V. es una empresa dedicada al desarrollo de proyectos inmobiliarios.',
                'logo' => 'images/developers/desarrolladora-jc.png',
            ],
            [
                'name' => 'DGD Urbano',
                'short_name' => 'DGD',
                'large_name' => 'DGD Urbano S.A. de C.V.',
                'description' => 'DGD Urbano S.A. de C.V. es una empresa dedicada al desarrollo de proyectos inmobiliarios.',
                'logo' => 'images/developers/dgd-urbano.png',
            ],
        ];

        foreach ($developers as $developer) {
            DeveloperModel::create($developer);
        }

        //phones
        $phones = [
            [
                'phone_number' => '2222222222',
                'phoneable_type' => 'App\Models\DeveloperModel',
                'phoneable_id' => 1,
            ],
            [
                'phone_number' => '3333333333',
                'phoneable_type' => 'App\Models\DeveloperModel',
                'phoneable_id' => 2,
            ],
        ];



        foreach ($phones as $phone) {
            PhoneModel::create($phone);
        }



        //emails
        $emails = [
            [
                'email_address' => 'desarrolladorajc21@gmail.com',
                'emailable_type' => 'App\Models\DeveloperModel',
                'emailable_id' => 1,
            ],
            [
                'email_address' => 'dgdurbano.esa@gmail.com',
                'emailable_type' => 'App\Models\DeveloperModel',
                'emailable_id' => 2,
            ],
        ];

        foreach ($emails as $email) {
            EmailModel::create($email);
        }
    }
}
