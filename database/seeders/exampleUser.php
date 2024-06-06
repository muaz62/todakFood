<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            // $vendor = Role::create([
            //     'name' => 'vendor'
            // ]);
    
            // $vendorUser =   User::create([
            //     'name' => 'vendor',
            //     'email' => 'vendor@example.com',
            //     'password' => Hash::make('vendor')
            // ]);
    
            // $vendorUser->assignRole('vendor');
    }
}
