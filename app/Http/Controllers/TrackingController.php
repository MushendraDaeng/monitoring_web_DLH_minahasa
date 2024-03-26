<?php

namespace App\Http\Controllers;

use App\Models\Tracking;
use App\Models\Truck;
use App\Models\DetailTracking;
use App\Models\Driver;
use Illuminate\Http\Request;
use Auth,Validator;

class TrackingController extends Controller
{
    public function getHistory($page, $limit){
        $page = $page?intVal($page):0;
        $limit = $limit?intVal($limit):10;
        $driver = Auth::user();
        $data = Tracking::leftJoin('drivers','drivers.id','trackings.driver_id')
                    ->leftJoin('trucks','trucks.id','trackings.truck_id')
                    ->leftJoin('route_lists','route_lists.id','trackings.route_id')
                    ->select('trackings.*','drivers.name as driver_name','trucks.plate as truck_plate','route_lists.name as route_name')
                    ->where('trackings.driver_id',$driver->id)
                    ->orderBy('trackings.act_date','DESC')
                    ->take($limit)->skip($page * $limit)->get();
        $totalRow = Tracking::where('driver_id',$driver->id)->count();
        return response()->json(['status'=>'success','data'=>$data,'totalRow'=>$totalRow],200);
    }
    public function createTracking(Request $req){
        $validate = Validator::make($req->all(),[
            'driver_id'=>'required',
            'truck_id'=>'required',
            'route_id'=>'required',
            'act_date'=>'required'
        ]);
        if($validate->fails()){
            return response()->json(['status'=>'failed','message'=>'validate error '.$validate->errors()],500);
        }
        try{
            $data = Tracking::create($req->all());
            $isDetail = false;
            if($data){
                $detail = DetailTracking::create([
                    'truck_id'=>$data->truck_id,
                    'driver_id'=>$data->driver_id,
                    'activity_id'=>$data->id,
                    'tracking_date'=>$data->act_date
                ]);
                if($detail){
                    $isDetail = true;
                }
            }
            return response()->json(['status'=>'success','data'=>$data,'detail'=>$isDetail],200);
        }catch(\Exception $e){
            return response()->json(['status'=>'failed','message'=>'Error : '.$e],500);
        }
    }
    public function addDetailTracking(Request $req){
        $validate = Validator::make($req->all(),[
            'truck_id'=>'required',
            'driver_id'=>'required',
            'activity_id'=>'required'
        ]);
        if($validate->fails()){
            return response()->json(['status'=>'failed','message'=>'validation error : '.$validate->errors()],500);
        }
        try{
            $detail = DetailTracking::create($req->all());
            return response()->json(['status'=>'success','data'=>$detail],200);
        }catch(\Exception $e){
            return response()->json(['status'=>'failed','message'=>'error : '.$e],500);
        }
    }
    public function startTracking(Request $req){
        $validate = Validator::make($req->all(),[
            'id'=>'required',
            'driver_id'=>'required',
            'truck_id'=>'required',
            'start_location'=>'required',
            'start_time'=>'required'
        ]);
        if($validate->fails()){
            return response()->json(['status'=>'failed','message'=>'validation error : '.$validate->errors()],500);
        }
        try{
            $update = Tracking::where('id',$req->id)->update([
                'start_location'=>$req->start_location,
                'start_time'=>$req->start_time,
                'truck_id'=>$req->truck_id
            ]);
            $data = [];
            if($update){
                $data = Tracking::leftJoin('drivers','drivers.id','trackings.driver_id')
                    ->leftJoin('trucks','trucks.id','trackings.truck_id')
                    ->leftJoin('route_lists','route_lists.id','trackings.route_id')
                    ->select('trackings.*','drivers.name as driver_name','trucks.plate as truck_plate','route_lists.name as route_name')
                    ->where('trackings.driver_id',$req->driver_id)
                    ->where('trackings.id',$req->id)
                    ->first();
            }else{
                return response()->json(['status'=>'failed','message'=>'Failed to update tracking'],500);
            }
            return response()->json(['status'=>'success','data'=>$data],200);
        }catch(\Exception $e){
            return response()->json(['status'=>'failed','message'=>'error : '.$e],500);
        }
    }
    public function stopTracking(Request $req){
        $validate = Validator::make($req->all(),[
            'id'=>'required',
            'driver_id'=>'required',
            'truck_id'=>'required',
            'stop_time'=>'required',
            'stop_location'=>'required'
        ]);
        if($validate->fails()){
            return response()->json(['status'=>'failed','message'=>'validation error : '.$validate->errors()],500);
        }
        try{
            $update = Tracking::where('id',$req->id)->update([
                'stop_time'=>$req->stop_time,
                'stop_location'=>$req->stop_location,
                'geolocation_col'=>$req->geolocation_col??'-'
            ]);
            $data = [];
            if($update){
                $data = Tracking::leftJoin('drivers','drivers.id','trackings.driver_id')
                    ->leftJoin('trucks','trucks.id','trackings.truck_id')
                    ->leftJoin('route_lists','route_lists.id','trackings.route_id')
                    ->select('trackings.*','drivers.name as driver_name','trucks.plate as truck_plate','route_lists.name as route_name')
                    ->where('trackings.driver_id',$req->driver_id)
                    ->where('trackings.id',$req->id)
                    ->first();
            }else{
                return response()->json(['status'=>'failed','message'=>'Failed to update tracking'],500);
            }
            return response()->json(['status'=>'success','data'=>$data],200);
        }catch(\Exception $e){
            return response()->json(['status'=>'failed','message'=>'error : '.$e],500);
        }
    }

    public function updateTracking(Request $req){
        $validate = Validator::make($req->all(),[
            'id'=>'required',
            'driver_id'=>'required',
            'truck_id'=>'required',
            'stop_time'=>'required',
            'stop_location'=>'required',
            'start_location'=>'required',
            'start_time'=>'required'
        ]);
        if($validate->fails()){
            return response()->json(['status'=>'failed','message'=>'validation error : '.$validate->errors()],500);
        }
        try{
            $update = Tracking::where('id',$req->id)->update([
                'stop_time'=>$req->stop_time,
                'stop_location'=>$req->stop_location,
                'start_location'=>$req->start_location,
                'start_time'=>$req->start_time
            ]);
            $data = [];
            if($update){
                $data = Tracking::leftJoin('drivers','drivers.id','trackings.driver_id')
                    ->leftJoin('trucks','trucks.id','trackings.truck_id')
                    ->leftJoin('route_lists','route_lists.id','trackings.route_id')
                    ->select('trackings.*','drivers.name as driver_name','trucks.plate as truck_plate','route_lists.name as route_name')
                    ->where('trackings.driver_id',$req->driver_id)
                    ->where('trackings.id',$req->id)
                    ->first();
            }else{
                return response()->json(['status'=>'failed','message'=>'Failed to update tracking'],500);
            }
            return response()->json(['status'=>'success','data'=>$data],200);
        }catch(\Exception $e){
            return response()->json(['status'=>'failed','message'=>'error : '.$e],500);
        }
    }
    public function updateDetailTracking(Request $req){
        $validate = Validator::make($req->all(),[
            'id'=>'required',
            'activity_id'=>'required',
            'geolocation_col'=>'required'
        ]);
        if($validate->fails()){
            return response()->json(['status'=>'failed','message'=>'validation error : '.$validate->errors()],500);
        }
        try{
            $update = DetailTracking::where('id',$req->id)->update([
                'geolocation_col'=>$req->geolocation_col
            ]);
            $data = [];
            if($update){
                $data = DetailTracking::where('id',$req->id)->first();
            }else{
                return response()->json(['status'=>'failed','message'=>'failed to update detail tracking'],500);
            }
            return response()->json(['status'=>'success','data'=>$data],200);
        }catch(\Exception $e){
            return response()->json(['status'=>'failed','message'=>'error : '.$e],500);
        }
    }
    public function deleteTracking($trackingId){
        $driver = Auth::user();
        try{
            $delete = Tracking::where('driver_id',$driver->id)
                            ->where('id',$trackingId)->delete();
            if($delete){
                DetailTracking::where('activity_id',$trackingId)->delete();
             
            }else{
                return response()->json(['status'=>'failed','message'=>'failed to delete tracking'],500);
            }
            
            return response()->json(['status'=>'success'],200);
        }catch(\Exception $e){
            return response()->json(['status'=>'failed','message'=>'error : '.$e],500);
        }
    }

    public function getCurrentTrackingByDriver(){
        $driver = Auth::user();
        $query = Tracking::query();
        $query->leftJoin('drivers','drivers.id','trackings.driver_id')
                    ->leftJoin('trucks','trucks.id','trackings.truck_id')
                    ->leftJoin('route_lists','route_lists.id','trackings.route_id')
                    ->select('trackings.*','drivers.name as driver_name','trucks.plate as truck_plate','route_lists.name as route_name')
                    ->where('driver_id',$driver->id)
                    ->where('act_date',date('Y-m-d',strtotime('now')))
                    ->orderBy('trackings.created_at','DESC');
                    // ->first();
        $tracking = $query->first();
        if($tracking){
            return response()->json(['status'=>'success','data'=>$tracking],200);
        }
        return response()->json(['status'=>'failed','message'=>'No data yet!'.date('Y-m-d',strtotime('now')),'tracking'=>$tracking],500);
    }
}
