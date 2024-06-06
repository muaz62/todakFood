<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\menu;
use App\Models\order;
use App\Models\point;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class customerController extends Controller
{
    public static function index(){
        
        return view('admin.index');
    }

    public function order(Request $req){
        
        $det = $this->createDetailOrder($req->item);

        order::create([

            'restaurant_id' => $req->restaurant_id,
            'user_id' => Auth::user()->id,
            'detail' => $this->createDetailOrder($req->item),
            'status' => 'ordered',
            'type' => $req->type,
            'total_price' => $req->total,

        ]);

        Stripe::setApiKey(config('stripe.sk'));
 
        // $productname = $request->get('productname');
        $totalprice = $req->total;
        $two0 = "00";
        $total = "$totalprice$two0";
 
        $session = Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'myr',
                        'product_data' => [
                            "name" => 'Makanan',
                        ],
                        'unit_amount'  => $total,
                    ],
                    'quantity'   => 1,
                ],
                 
            ],
            'mode'        => 'payment',
            'success_url' => route('success'),
            'cancel_url'  => route('cancel'),
        ]);


        return redirect()->away($session->url);

    }

    public function createDetailOrder($data){

        $arrayDetail = collect();

        foreach ($data as $key => $value) {
            # code...
            $menu = menu::where('id', $value)->first(['id','name']);

            $arrayDetail->push($menu);
        }

        return $arrayDetail;
    }

    public function point(){
        $userPoint = point::where('user_id', Auth::user()->id)->first();

        if($userPoint == null) return '';

        return $userPoint->point;
    }

    public function overallS(){

        $overallSale = order::has('owner')->where('status','complete')->sum('total_price');

        if($overallSale == null) return '';

        return $overallSale;
    }

    public function todayS(){
        $todaySale = order::has('owner')->where('status','complete')->whereDate('updated_at', DB::raw('CURDATE()'))->sum('total_price');

        if($todaySale == null) return '';

        return $todaySale;
    }



    
}
