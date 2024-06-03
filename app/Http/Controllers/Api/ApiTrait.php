<?php
namespace App\Http\Controllers\Api;

trait ApiTrait
{
    public function apiResponse($data=null ,$messsage=null, $status=null){
        $array=[
            'data'     =>  $data,
            'message'  =>  $messsage,
            'status'   =>  $status,
        ];
        // return response(   $orders   ,   200   ,   $msg   );
        return response($array);
    }
}