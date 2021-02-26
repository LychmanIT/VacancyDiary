<?php

namespace Database\Seeders;

use App\Models\VacancyStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $user_count = rand(8, 15);
        for($i = 0; $i < $user_count; $i++) {
            $name = $faker->name;
            $email = $faker->email;
            $password = $email;

            DB::table('users')->insert([
                'name' => $name,
                'email' => $email,
                'password' => $password,
            ]);
        }
        for($i = 0; $i < $user_count; $i++) {
            $count = rand(15, 50);
            for ($j = 0; $j < $count; $j++) {
                $user_id = $i;
                $name = $faker->company;
                $position = $faker->jobTitle;
                $salary = rand(500, 4000);
                $link = strtolower('https://' . $faker->company . '/');
                $contacts = $faker->email;
                $status = VacancyStatus::statuses[strval(array_rand(VacancyStatus::statuses, 1))];
                $notes = $faker->text;

                DB::table('vacancies')->insert([
                    'user_id' => $user_id,
                    'name' => $name,
                    'position' => $position,
                    'salary' => $salary,
                    'link' => $link,
                    'contacts' => $contacts,
                    'status' => $status,
                    'notes' => $notes,
                ]);
            }
        }
    }
}
