<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class exampleUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
               //make admin
            $admin = Role::create([
                'name' => 'admin'
            ]);
                   
            $adminUser = User::create([
                'name' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin')
            ]);
    
            $adminUser->assignRole('admin');
    
    
            //make customer
            $customer = Role::create([
                'name' => 'customer'
            ]);
                   
            $customerUser =   User::create([
                'name' => 'customer',
                'email' => 'customer@example.com',
                'password' => Hash::make('customer')
            ]);
    
            $customerUser->assignRole('customer');
    
            //make vendor  / restaurant manager
            $vendor = Role::create([
                'name' => 'vendor'
            ]);
    
    }
}
