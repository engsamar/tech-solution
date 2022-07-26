<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminsTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //php artisan db:seed --class=AdminsTableDataSeeder

        User::create([
            'email' => 'admin@admin.com',
            'phone' => '+966533620026',
            'password' => 'admin@123',
            'name' => 'Ghadah'
        ]);
    }
}
