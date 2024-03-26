<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;
use Auth,Validator,Hash,File;

class DriverController extends Controller
{
    public function  getProfile(){
        $user = Auth::user();

        $data = Driver::where('id',$user->id)->first();
        if($data){
            return response()->json(['status'=>'success','data'=>$data],200);
        }
        return response()->json(['status'=>'failed','message'=>'user not found!'],500);
    }
    public function updateProfile(Request $req){
        $validate = Validator::make($req->all(),[
            'id'=>'required',
            'name'=>'required',
            'gender'=>'required'
        ]);
        if($validate->fails()){
            return response()->json(['status'=>'failed','message'=>'validation error : '.$validate->errors()],500);
        }{
            $update = Driver::where('id',$req->id)
                        ->update([
                            'name'=>$req->name,
                            'phone'=>$req->phone??'',
                            'gender'=>$req->gender,
                            'dob'=>date('Y-m-d',strtotime($req->dob??'now'))
                        ]);
            if($update){
                $data = Driver::where('id',$req->id)->first();
                return response()->json(['status'=>'success','data'=>$data],200);
            }
            return response()->json(['status'=>'failed','message'=>'failed to update profile'],502);
        }
    }
    public function updatePassword(Request $req){
        $validate = Validator::make($req->all(),[
            'id'=>'required',
            'old'=>'required',
            'password'=>'required'
        ]);
        if($validate->fails()){
            return response()->json(['status'=>'failed','message'=>'validation error : '.$validate->errors()],500);
        }else{
            $ver = Driver::where('id',$req->id)->first();
            if($ver){
                if(Hash::check($req->old,$ver->password)){
                    $update = Driver::where('id',$req->id)
                                ->update([
                                    'password'=>Hash::make($req->password)
                                ]);
                    if($update){
                        return response()->json(['status'=>'success'],200);
                    }
                    return response()->json(['status'=>'failed','message'=>'Failed to update password!'],500);
                }
                return response()->json(['status'=>'failed','message'=>'Old Password wrong!!'],401);
            }
            
            
        }
    }
    public function uploadPhoto(Request $req){
        $validate = Validator::make($req->all(),[
            'id'=>'required',
            'photo'=>'required'
        ]);
        if($validate->fails()){
            return response()->json(['status'=>'failed','message'=>'validation error : '.$validate->errors()],500);
        }else{
            $user = Driver::where('id',$req->id)->first();
            if($user){
                if($req->hasFile('photo')){
                    $fileName = time().'_'.$req->photo->getClientOriginalName();
                    $req->photo->move('driver_photo/',$fileName);
                    if($user->photo!=""){
                        File::delete('driver_photo/'.$user->photo);
                    }
                    $user->photo = $fileName;
                    $user->save();
                    return response()->json(['status'=>'success','message'=>'photo successfully updated','data'=>$user->photo],200);
                }
                return response()->json(['status'=>'failed','message'=>'Photo not uploaded!'],500);
            }
            return response()->json(['status'=>'failed','message'=>'user not found!'],500);
        }
    }
    public function login(Request $req){
        $validator = Validator::make($req->all(),[
            'user_id'=>'required',
            'password'=>'required'
        ]);
        if($validator->fails()){
            return response()->json(['status'=>'failed','message'=>'login failed!. Validation Failed : '.$validate->errors()],401);
        }
        $check = Driver::where('user_name',$req->user_id)->first();
        if(!$check){
            return response()->json(['status'=>'failed','message'=>'login failed user not found!'],401);
        }
        if(!Hash::check($req->password,$check->password)){
            return response()->json(['status'=>'failed','message'=>'login failed, please make sure everything is correctly then try again!'],401);
        }
        $token = $check->createToken('token-driver')->plainTextToken;
        return response()->json(['status'=>'success','token'=>$token,'data'=>$check],200);
    }
    public function logout(){
        $user = Auth::user();
        $user->currentAccessToken()->delete();
        return response()->json(['status'=>'success','message'=>'logout success'],200);
    }
}
