<?php

namespace App\Http\Controllers;

use App\Models\menu;
use App\Models\restaurant;
use Illuminate\Http\Request;

class vendorController extends Controller
{
    public static function index(){
        
        return view('vendorFood.index');
    }


    public function update(Request $req){
        
        restaurant::where('id', $req->id)->update([
            'name' => $req->name,
            'kategori' => $req->kategori,
            'status' => $req->status,
        ]);

        return redirect()->back()->with('success','successfull updated');
    }

    public function allData(){

        return restaurant::all();
    }

    public function available(Request $req){

        return restaurant::where('kategori', $req->kategori)->where('status', 'available')->get();
    }

    public function menu(Request $req){

        return menu::where('restaurant_id', $req->restaurant_id)->get();
    }

}
