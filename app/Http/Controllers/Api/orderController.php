<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class orderController extends Controller
{
    use ApiTrait;
    public function index(){
        $orders = Order::get();
        // $msg = ['The orders ia sended succifully...!!'];
        // $array=[
        //     'data'     =>  $orders,
        //     'message'  =>  'The orders ia sended succifully...!!',
        //     'status'   =>  200
        // ];
        // // return response(   $orders   ,   200   ,   $msg   );
        // return response( $array);
        return $this-> apiResponse($orders,'The orders is sended succifully...!!',200);
    }
    public function show($id){
        $order=Order::find($id);
        if ($order){
            return $this-> apiResponse($order,'The orders ia sended succifully...!!',200);
        }
        return $this-> apiResponse($order,'This order is not found ... !!',404);
        
    }
    
    public function store(Request $request){
        
        $validator = Validator::make ($request->all(),[
            'status' => 'required',
            'description' => 'required',
            'photo' => 'mimes:jpg,bmp,png|file|size:512',
            'location' =>'required', 
        ]);

        if($validator->fails()){
            return $this-> apiResponse(null,'This order is not saved ... !!',400);
        }
        $order = Order::create( $request->all() ) ;
        if($order){
            return $this-> apiResponse($order,'This order is saved  ... !!',201);
        }
    }
    
    
    public function update(Request $request ,$id){
        $validator = Validator::make ($request->all(),[
            'status' => 'required',
            'description' => 'required',
            'photo' => 'required',
            'location' =>'required', 
        ]);
        if ($validator->fails()){
            return $this-> apiResponse(null,'This order is not updated  ... !!',400);
        }
        $order= Order::find($id);
        if(!$order){
            return $this-> apiResponse($order,'This order is not found ... !!',404);
        }
        $order->update($request->all());
        if($order){
        return $this-> apiResponse($order,'The orders ia update succifully...!!',200);
        }   
    }

    
    public function finish($id){
        $order = Order::find($id);
        if(!$order){
            return $this-> apiResponse(null,'This order is not found ... !!',404);
        }
        $order->delete($id);
        if($order){
            return $this-> apiResponse(null,'This order is deleted... !!',201);
        }
    }
}
