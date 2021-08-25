<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@transisi.id',
            'password' => bcrypt('transisi')
        ]);

        for ($i=0; $i < 10; $i++) {

            $id_company = DB::table('companies')->insertGetId([
                "name" => "PT. ".Str::random(10),
                "email" => Str::random(10)."@gmail.com",
                "logo" => Str::random(10).".jpg",
                "Website" => Str::random(10).".com"
            ]);

            for ($a=0; $a < 5; $a++) { 
                DB::table('employees')->insertGetId([
                    "name" => Str::random(10),
                    "email" => Str::random(10)."@gmail.com",
                    "company_id" => $id_company,
                ]);
            }
        }
    }
}
