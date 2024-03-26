<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Truck;


class TruckController extends Controller
{
    public function getTruckList($page,$limit){
        $page = $page?intVal($page):0;
        $limit = $limit?intVal($limit):10;
        $data = Truck::whereRaw('id NOT IN (SELECT truck_id FROM trackings WHERE act_date='.date('Y-m-d',strtotime('now')).')')
                    ->take($limit)->skip($page *$limit)->get();
        $totalRow = Truck::count();
        if(count($data)>0){
            return response()->json(['status'=>'success','data'=>$data,'totalRow'=>$totalRow],200);
        }
        return response()->json(['status'=>'failed','data'=>[],'totalRow'=>$totalRow],500);
    }
    public function getTruckById($id){
        $data = Truck::where('id',$id)->first();
        if($data){
            return response()->json(['status'=>'success','data'=>$data],200);
        }
        return response()->json(['status'=>'failed','message'=>'Data not found!'],400);
    }
}
