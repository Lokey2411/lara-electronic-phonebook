<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;


class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('departments')->insert([
                'DepartmentName' => $faker->name,
                'Email' => $faker->email,
                'Phone' => $faker->phoneNumber,
                'Address' => $faker->address,
                'WebSite' => $faker->url,
                'Logo' => $faker->imageUrl(),
                'ParentDepartmentID' => $index,
            ]);
        }
    }
}