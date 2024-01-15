<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorShopProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'vendor@gmail.com')->first();
        Vendor::insert([
            [
                'banner' => 'Admin',
                'phone' => '545412',
                'email' => 'vendor@gmail.com',
                'address' => 'usa',
                'description' => 'description',
                'user_id' => $user->id,
            ]
        ]);
    }
}
