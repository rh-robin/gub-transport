<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;
Use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $obj = new Admin();
        $obj->gub_id = "19302133";
        $obj->name = "Apurbo";
        $obj->email = "apurbo@gmail.com";
        $obj->password = Hash::make('1234');
        $obj->save();
    }
}
