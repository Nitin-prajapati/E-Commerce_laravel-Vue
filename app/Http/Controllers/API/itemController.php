<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class itemController extends Controller
{
    
    //
    public function getItems(){
        
        $items=DB::table('listedItems')->get();
  
        $response=[
            'success'=>true,
            'data'=>$items,
            'message'=>'Succesfully Fetched',
        ];
        return response()->json($response,200);
    }
    

    public function getItemWithId($id){
        
            
            $item=DB::table('listeditems')->where('id',$id)->first();
            
            // $item=DB::table('users')->where('name','nitin')->first();
            $response=[
                'success'=>true,
                'data'=>$item,
                'message'=>'item fetched succesfully',
            ];
    
            return response()->json($response,200);
        
    }
}
