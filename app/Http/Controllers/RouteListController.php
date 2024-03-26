<?php

namespace App\Http\Controllers;

use App\Models\RouteList;
use Illuminate\Http\Request;
use App\Models\RouteDetail;
use App\Models\Customer;
use App\Models\Kategori;
use App\Models\SubKategori;
use App\Models\Visit;
use Auth;

class RouteListController extends Controller
{
    public function getRouteList(){
        $data = RouteList::get();
        return response()->json(['status'=>'success','data'=>$data],200);
    }    
    public function getDetailRouteList($routeId){
        $data = RouteDetail::leftJoin('customers','customers.id','route_detail.customer_id')
                    ->select('route_detail.*','customers.name AS customer_name',
                            'customers.urban_village as customer_village','customers.sub_district as customer_district','customers.status as customer_status',
                            'customers.latitude as customer_lat','customers.longitude as customer_lng')
                    ->where('route_detail.route_id',$routeId)->get();
        $route = RouteList::where('id',$routeId)->first();
        return response()->json(['status'=>'success','detail'=>$data,'route'=>$route],200);
    }
    
}
