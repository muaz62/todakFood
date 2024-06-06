<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\order;
use App\Models\point;
use App\Models\restaurant;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Auth;

class adminController extends Controller
{
    public static function index(){

        return view('admin.index');
    }

    public function getData(){

        $data = restaurant::all();

        return $data;
    }

    public function orderData(Request $req){

        if(Auth::user()->hasRole('customer')) return order::where('user_id',Auth::user()->id)->whereNot('status','complete')->whereNot('status','cancel')->with('restaurant')->get();

        if(Auth::user()->hasRole('vendor')){

            if($req->status == 'all')  return order::has('owner')->with(['owner','customer'])->get();

            return order::where('status', $req->status)->has('owner')->with(['owner','customer'])->get();

        }
        
        return '';
    }

    public function changeStatus(Request $req){
        
        // dd($req);

        $Order = order::where('id',$req->id)->first();

        if($req->status == 'complete'){

            $pointUser = point::where('user_id',$Order->user_id)->first();
        
            if($pointUser == null){
                point::create([
                    'user_id' => $Order->user_id,
                    'point' => $req->total
                ]);
    
    
            }else{
                $totalPoint = (int)$pointUser->point + (int)$Order->total_price;
    
                // dd($totalPoint);
    
                point::where('user_id',$Order->user_id)->update([
                    'point' => $totalPoint
                ]);
            }
        }

        order::where('id',$req->id)->update([
            'status' => $req->status,
        ]);
        
        return redirect()->back()->with('success', 'order Status Changed');
    }
 
    public function success()
    {
        return redirect(url('/index'))->with('success','order created');
    }

    public function cancel()
    {
        return redirect(url('/index'))->with('errors','order failed'); 
    }
    

    

}
