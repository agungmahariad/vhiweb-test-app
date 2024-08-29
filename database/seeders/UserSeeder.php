<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create a default admin user
        $adminRole = Role::create(['name' => 'Administrator']);

        $adminUser = User::factory()->create([
            'email' => 'admin@admin.com',
            'password' => bcrypt('SecurePassword')
        ]);
        $adminUser->assignRole('Administrator');

        // Create a default buyer user
        $adminRole = Role::create(['name' => 'Buyer']);

        $buyerUser = User::factory()->create([
            'email' => 'buyer@buyer.com',
            'password' => bcrypt('SecurePassword')
        ]);
        $buyerUser->assignRole('Buyer');

        // Create a default vendor user
        $vendorRole = Role::create(['name' => 'Vendor']);

        $vendorUser = User::factory()->create([
            'email' => 'vendor@vendor.com',
            'password' => bcrypt('SecurePassword')
        ]);
        $vendorUser->assignRole('Vendor');
    }
}
