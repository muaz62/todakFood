<?php

namespace App\Models;

use App\Models\User;
use App\Models\restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class order extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function restaurant(){
        return $this->hasOne(restaurant::class, 'id' ,'restaurant_id');
    }

    public function customer(){
        return $this->hasOne(User::class, 'id' ,'user_id');
    }

    public function owner(){
        return $this->hasOne(restaurant::class, 'id' ,'restaurant_id')
                        ->where('restaurants.user_id', Auth::user()->id);
    }

}
