<?php

namespace App\Http\Controllers\Web;

use App\Models\{Tracking, Driver, RouteList, Truck, DetailTracking};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrackingWebController extends Controller
{
    public function validateForm($req){
        $req->validate([
            'driver_id' => 'required',
            // 'truck_id' => 'required',
            'route_id' => 'required',
            'act_date' => 'required',
        ]);
    }
    public function findId($id){
        $find = Tracking::find($id);
        return $find;
    }
    public function index()
    {
        //
        return view('tracking.index', [
            'data' => Tracking::leftJoin('drivers', 'trackings.driver_id', 'drivers.id')
                        ->leftJoin('trucks', 'trackings.truck_id', 'trucks.id')
                        ->leftJoin('route_lists', 'trackings.route_id', 'route_lists.id')
                        ->select('trackings.*', 'drivers.name AS driver', 'trucks.name AS truck', 'route_lists.name AS route')
                        ->orderBy('trackings.created_at', 'desc')
                        ->get()
        ]);
    }

    public function create()
    {
        //
        return view('tracking.create',
            [
                'driver' => Driver::all(),
                'truck' => Truck::all(),
                'route' => RouteList::all()
            ]
        );
    }

    
    public function store(Request $request)
    {
        //
        $this->validateForm($request);
        $input = $request->except(['_token']);
        $tracking = Tracking::create($input);
        return redirect()->route('tracking.index')->with('success','Data Tracking telah tersimpan!!');
        
    }

    public function show($id)
    {
        //
        // $detailTracking = DetailTracking::
        //                         leftJoin('trucks', 'detail_trackings.truck_id', 'trucks.id')
        //                         ->leftJoin('drivers', 'detail_trackings.driver_id', 'drivers.id')
        //                         ->leftJoin('trackings', 'detail_trackings.activity_id','trackings.id')
        //                         ->where('detail_trackings.activity_id', $id)
        //                         ->select(
        //                             'detail_trackings.geolocation_col as listLocation',
        //                             'trucks.name as truck',
        //                             'drivers.name as driver',
        //                             'trackings.start_location',
        //                             'trackings.stop_location',
        //                             'trackings.start_time',
        //                             'trackings.stop_time',
        //                             )
        //                         ->first();
        $detailTracking = Tracking::leftJoin('trucks', 'trackings.truck_id', 'trucks.id')
                                ->leftJoin('drivers', 'trackings.driver_id', 'drivers.id')
                                ->leftJoin('route_lists', 'trackings.route_id', 'route_lists.id')
                                ->where('trackings.id', $id)
                                ->select(
                                    'trackings.*',
                                    'trackings.geolocation_col as listLocation',
                                    'route_lists.name as route_name',
                                    'route_lists.description as route_desc',
                                    'trucks.name as truck_name',
                                    'drivers.name as drivers_name'
                                    )
                                ->first();
        // dd($detailTracking);
        if($detailTracking != null){
            // $obj = array(
            //     "content" => base64_decode($detailTracking->listLocation)
            // );
            $obj = base64_decode($detailTracking->listLocation);
            $geoLocationJson = json_decode($obj);
            $geoLocationJson = json_decode($geoLocationJson->items);
            $test = (double)explode(',',$detailTracking->start_location)[0];
            // dd($test);
            
            //add start location in the first array
            list($latitude, $longitude) = explode(',', $detailTracking->start_location);
            // Create the new item as an array
            $newItem = (object)[
                'time' => $detailTracking->start_time,
                'longitude' => (double) $longitude,  // Ensure float conversion
                'latitude' => (double) $latitude,   // Ensure float conversion
            ];

            // dd($obj, $newItem, $geoLocationJson);
            // Use array_unshift to prepend the new item to the items array
            array_unshift($geoLocationJson, $newItem);
            // array_unshift($geoLocationJson, (object)[
            //     'time' => $detailTracking->start_time,
            //     'longitude' => (double)explode(',',$detailTracking->start_location)[1],
            //     'latitude' => (double)explode(',',$detailTracking->start_location)[0]
            // ]);
            
            //add stop location in the last array
            array_push($geoLocationJson, (object)[
                'time' => $detailTracking->stop_time,
                'longitude' => (double)explode(',',$detailTracking->stop_location)[1],
                'latitude' => (double)explode(',',$detailTracking->stop_location)[0]
            ]); 
        }else{
            $geoLocationJson = [];
        }
        
        
        // dd($detailTracking, $geoLocationJson);
        return view('tracking.show', [
            'data' => $this->findId($id),
            'tracking_detail' => $detailTracking,
            'listLocation' => $geoLocationJson
        ]);

    }

    public function edit($id)
    {
        //
        return view('tracking.edit', 
            [
                'data' => $this->findId($id),
                'driver' => Driver::all(),
                'route' => RouteList::all()
            ]
        );
    }

   
    public function update(Request $request, $id)
    {
        //
        // dd($request->password == '');
        $oldData = $this->findId($id);
        $this->validateForm($request);
        $input = $request->except(['_token','_method']);
        
        $tracking = Tracking::where('id',$id)->update($input);
        
        return redirect()->route('tracking.index')->with('success','Data Tracking telah diperbaharui!!');
    }

   
    public function destroy($id)
    {
        //
        $this->findId($id)->delete();
        return redirect()->route('tracking.index')->with('deleted','Data Tracking terhapus!!');
        
    }
}