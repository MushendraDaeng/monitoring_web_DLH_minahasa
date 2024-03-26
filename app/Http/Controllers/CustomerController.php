<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\SubKategori;
use App\Models\SubscriptionReport;

class CustomerController extends Controller
{
    public function getCustomerList($page, $limit){
        $page = $page?intVal($page):0;
        $limit = $limit?intVal($limit):10;
        $data = Customer::take($limit)->skip($limit * $page)->get();
        $totalRow = Customer::count();
    
            return response()->json(['status'=>'success','data'=>$data,'totalRow'=>$totalRow],200);
    
    }
    public function getCustomerById($id){
        $data = Customer::where('id',$id)->first();
        if($data){
            return response()->json(['status'=>'success','data'=>$data],200);
        }
        return response()->json(['status'=>'failed','message'=>'No data found!'],400);
    }
}
