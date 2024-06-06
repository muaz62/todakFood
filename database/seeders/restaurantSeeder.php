<?php

namespace Database\Seeders;

use App\Models\menu;
use App\Models\User;
use App\Models\restaurant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class restaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        ///western restaurant
        $westernUser =   User::create([
            'name' => 'western1',
            'email' => 'western1@example.com',
            'password' => Hash::make('western1')
        ]);

        $westernUser->assignRole('vendor');

        $westernRes = restaurant::create([
            'name' => 'western1',
            'image' => null,
            'kategori' => 'western', // western / asian / dessert
            'status' => 'new',
            'user_id' =>  $westernUser->id,

        ]);

        menu::create([
            'restaurant_id' => $westernRes->id,
            'image' => null,
            'name' => 'chicken chop',
            'price' => 12.00
        ]);

        menu::create([
            'restaurant_id' => $westernRes->id,
            'image' => null,
            'name' => 'chicken grill',
            'price' => 10.00
        ]);

        menu::create([
            'restaurant_id' => $westernRes->id,
            'image' => null,
            'name' => 'fish n chip',
            'price' => 9.00
        ]);

        ///asia restaurant 
        $asianUser =   User::create([
            'name' => 'asian1',
            'email' => 'asian1@example.com',
            'password' => Hash::make('asian1')
        ]);

        $asianUser->assignRole('vendor');

        $asianRes = restaurant::create([
            'name' => 'asian1',
            'image' => null,
            'kategori' => 'asian', // western / asian / dessert
            'status' => 'new',
            'user_id' =>  $asianUser->id,
        ]);


        menu::create([
            'restaurant_id' => $asianRes->id,
            'image' => null,
            'name' => 'nasi goreng kampung',
            'price' => 9.00
        ]);

        menu::create([
            'restaurant_id' => $asianRes->id,
            'image' => null,
            'name' => 'mee goreng udang',
            'price' => 10.00
        ]);

        menu::create([
            'restaurant_id' => $asianRes->id,
            'image' => null,
            'name' => 'nasi daging merah',
            'price' => 12.00
        ]);

        ///desert restaurant
        $dessertUser =  User::create([
            'name' => 'dessert1',
            'email' => 'dessert1@example.com',
            'password' => Hash::make('dessert1')
        ]);

        $dessertUser->assignRole('vendor');

        $dessertRes = restaurant::create([
            'name' => 'dessert1',
            'image' => null,
            'kategori' => 'dessert', // western / asian / dessert
            'status' => 'new',
            'user_id' =>  $dessertUser->id,
        ]);

        menu::create([
            'restaurant_id' => $dessertRes->id,
            'image' => null,
            'name' => 'cake carrot',
            'price' => 5.00
        ]);

        menu::create([
            'restaurant_id' => $dessertRes->id,
            'image' => null,
            'name' => 'dadih',
            'price' => 2.00
        ]);

        menu::create([
            'restaurant_id' => $dessertRes->id,
            'image' => null,
            'name' => 'cookies',
            'price' => 4.00
        ]);


    }
}
