<?php

namespace Database\Seeders;

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
        \App\Models\User::create([
            'name' => 'User',
            'email' => 'user@email.com',
            'password' => bcrypt('654321'),
        ]);

        $this->call([
            MerchantSeeder::class,
            ProductSeeder::class,
        ]);
    }
}
