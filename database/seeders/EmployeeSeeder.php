<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
            DB::table('employees')->insert([
                'FullName' => $faker->name,
                'Email' => $faker->email,
                'MobilePhone' => $faker->phoneNumber,
                'Address' => $faker->address,
                'Position' => "Nhân Viên",
                'Avatar' => $faker->imageUrl(),
                'DepartmentID' => $index,
            ]);
        }
    }
}