<?php
namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            [
                'name' => 'tu',
                'email' => 'clgtqwe1@gmail.com',
                'password' => bcrypt('1234'),
            ]
        ]);
    }
}
