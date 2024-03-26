<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\Customer;
use App\Models\Kategori;
use App\Models\SubKategori;
use App\Models\Tracking;
use Auth,Validator,File;

class VisitController extends Controller
{
    public function createVisit(Request $req){
        $validate = Validator::make($req->all(),[
            'customer_id'=>'required',
            'tracking_id'=>'required',
            'description'=>'required'
        ]);
        if($validate->fails()){
            return response()->json(['status'=>'failed','message'=>'validation error : '.$validate->errors()],500);
        }
        try{
            $data = Visit::create([
                'customer_id'=>$req->customer_id,
                'tracking_id'=>$req->tracking_id,
                'photo_url'=>'-',
                'description'=>$req->description,
            ]);
            $updateTracking = Tracking::where('id',$req->tracking_id)->update([
                'geolocation_col'=>$req->geolocation_col??'-'
            ]);
            return response()->json(['status'=>'success','data'=>$data],200);
        }catch(\Exception $e){
            return response()->json(['status'=>'failed','message'=>'Error : '.$e],500);
        }
    }
    public function updateVisit(Request $req){
        $validate = Validator::make($req->all(),[
            'id'=>'required',
            'customer_id'=>'required',
            'tracking_id'=>'required',
            'description'=>'required'
        ]);
        if($validate->fails()){
            return response()->json(['status'=>'failed','message'=>'validation error : '.$validate->errors()],500);
        }
        try{
            $data = Visit::where('id',$req->id)->update([
                'customer_id'=>$req->customer_id,
                'tracking_id'=>$req->tracking_id,
                'photo_url'=>'-',
                'description'=>$req->description,
            ]);
            $updateTracking = Tracking::where('id',$req->tracking_id)->update([
                'geolocation_col'=>$req->geolocation_col??'-'
            ]);
            $data = Visit::where('id',$req->id)->first();
            return response()->json(['status'=>'success','data'=>$data],200);
        }catch(\Exception $e){
            return response()->json(['status'=>'failed','message'=>'Error : '.$e],500);
        }
    }
    public function deleteVisit($visitId){
        
        try{
            $data = Visit::where('id',$visitId)->delete();
            return response()->json(['status'=>'success','data'=>$data],200);
        }catch(\Exception $e){
            return response()->json(['status'=>'failed','message'=>'Error : '.$e],500);
        }
    }
    public function uploadPhotoVisit(Request $req){
        $validate = Validator::make($req->all(),[
            'id'=>'required',
            'photo'=>'required'
        ]);
        if($validate->fails()){
            return response()->json(['status'=>'failed','message'=>'validation error : '.$validate->errors()],500);
        }else{
            $visit= Visit::where('id',$req->id)->first();
            if($visit){
                if($req->hasFile('photo')){
                    $fileName = time().'_'.$req->photo->getClientOriginalName();
                    $req->photo->move('visit_photo/',$fileName);
                    if($visit->photo_url!=""){
                        File::delete('visit_photo/'.$visit->photoUrl);
                    }
                    $visit->photo_url = $fileName;
                    $visit->save();
                    return response()->json(['status'=>'success','data'=>$visit],200);
                }
                return response()->json(['status'=>'failed','message'=>'Photo not uploaded!'],500);
            }
            return response()->json(['status'=>'failed','message'=>'user not found!'],500);
        }
    }
    public function getVisitById($id){
        $data = Visit::where('id',$id)->first();
        if($data){
            return response()->json(['status'=>'success','data'=>$data],200);
        }
        return response()->json(['status'=>'failed','message'=>'Visit not found!'],400);
    }
    public function getVisitByCustomerId($customerId,$trackingId){
        $data = Visit::where('customer_id',$customerId)
                    ->where('tracking_id',$trackingId)->first();
        if($data){
            return response()->json(['status'=>"success",'data'=>$data],200);
        }
        return response()->json(['status'=>'failed','message'=>'Visit not found!'],400);
    }
}
